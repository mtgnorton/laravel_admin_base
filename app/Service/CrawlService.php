<?php

namespace App\Service;


use App\Exceptions\CurlException;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CrawlService
{


    static protected $curlOptions = [
        'CURLOPT_USERAGENT'      => "Mozilla/5.0 (Windows NT 5.1; zh-CN) AppleWebKit/535.12 (KHTML, like Gecko) Chrome/22.0.1229.79 Safari/535.12",
        'CURLOPT_SSL_VERIFYPEER' => 0, //https验证
        'CURLOPT_SSL_VERIFYHOST' => 0,//https验证
        'CURLOPT_HTTPHEADER'     => [

        ],
        'CURLOPT_RETURNTRANSFER' => 1,//设置获取的信息以文件流的形式返回，而不是直接输出
        'CURLOPT_REFERER'        => "http://www.baidu.com", //在HTTP请求中包含一个'referer'头的字符串
        'CURLOPT_TIMEOUT'        => 3,
        'CURLOPT_PROXY'          => ''
    ];


    static protected $domain = "";




    /**
     * author: mtg
     * time: 2021/6/8   10:15
     * function description:设置curl请求选项
     * @param array $curlOptions
     */
    static public function setOptions(string $domain = "", array $curlOptions = [])
    {
        if ($domain) {
            self::$domain = $domain;
        }

        self::$curlOptions = array_merge(self::$curlOptions, $curlOptions);

        return new static();
    }



    /**
     * author: mtg
     * time: 2021/6/8   10:23
     * function description:get请求
     * @param string $url
     * @param callable $fulfilled
     * @param callable|null $rejected
     * @return mixed|void
     */
    static public function get(string $url)
    {

        return self::request($url);
    }


    static public function post(string $url, array $data)
    {
        $res = self::request($url, $data);


        $data = json_decode($res, true);
        if (is_null($data)) {
            return $res;
        }

        return $data;

    }

    /**
     * author: mtg
     * time: 2021/6/8   10:15
     * function description:
     * @param string $url
     * @return bool|string
     */
    static public function request(string $url, array $data = [])
    {

        return retry(3, function () use ($url, $data) {
            if (strpos($url, 'http://') === false && strpos($url, 'https://') === false) {
                if (!self::$domain) {
                    new CurlException("无法拼接url", 502);
                }
                $url = trim(self::$domain, '/') . '/' . trim($url, '/');
            }


            $ch = curl_init();

            $options = self::$curlOptions;

            gather_log(sprintf("curl 开始对%s进行请求", $url));

            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_USERAGENT, $options['CURLOPT_USERAGENT']);

            curl_setopt($ch, CURLOPT_REFERER, $options['CURLOPT_REFERER']);


            if ($options['CURLOPT_HTTPHEADER']) {
                curl_setopt($ch, CURLOPT_HTTPHEADER, $options['CURLOPT_HTTPHEADER']);
            }


            curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);

            curl_setopt($ch, CURLOPT_TIMEOUT, $options['CURLOPT_TIMEOUT']);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, $options['CURLOPT_RETURNTRANSFER']);

            if (strpos($url, 'https') !== false) {

                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $options['CURLOPT_SSL_VERIFYPEER']);

                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $options['CURLOPT_SSL_VERIFYHOST']);
            }

            if ($options['CURLOPT_PROXY']) {
                curl_setopt($ch, CURLOPT_PROXY, $options['CURLOPT_PROXY']);

            }

            if ($data) { //post提交
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }


            $res = curl_exec($ch);

            if (curl_errno($ch)) {

                $error  = curl_error($ch);
                $status = curl_errno($ch);

                throw new CurlException($error, $status);
            }


            gather_log(curl_getinfo($ch, CURLINFO_HEADER_OUT));

            curl_close($ch);

            return $res;
        }, 0.5, function (\Exception $e) use ($url) {
            gather_log(sprintf("curl 请求%s失败,失败状态码为:%s,失败原因为:%s", $url, $e->getCode(), $e->getMessage()));
            if ($e->getCode() === 56) //Recv failure: Connection was reset
            {
                throw new \Exception("该ip无法访问,可能需要vpn访问");
            }
            if ($e instanceof CurlException) {
                return true;
            }

            return false;
        });


    }

    /**
     * author: mtg
     * time: 2021/6/12   17:03
     * function description: 当url中包含[]时,需要替换为合法url,如http://www.xiuren.org/page-[1-400].html
     * @param string $beginURL
     * @return array|string
     */
    static public function parseURLs(string $beginURL): array
    {
        $URLs = [];
        if (strpos($beginURL, '[') !== false && strpos($beginURL, ']') !== false) {
            preg_match_all('|\[(\d+-\d+)\]|', $beginURL, $args);

            if ($range = data_get($args, '1.0')) {

                list($begin, $end) = explode('-', $range);
                for ($i = $begin; $i <= $end; $i++) {
                    $URLs[] = str_replace("[$range]", $i, $beginURL);
                }
                return $URLs;
            }
        }
        return [$beginURL];

    }

    /**
     * author: mtg
     * time: 2021/6/5   14:19
     * function description:将后台填入的多行正则解析成代码可以使用的正则表达式
     * @param string $str
     * @return Collection
     */
    static public function parsePatterns(string $str): Collection
    {
        $patterns = explode(PHP_EOL, $str);

        $patterns = collect($patterns)->map(function ($value) {
            return '|' . trim($value, "\r") . '|';
        });
        return $patterns;
    }

    /**
     * author: mtg
     * time: 2021/6/5   14:19
     * function description:将后台填入的多行正则解析成代码可以使用的正则表达式,正则表达式为key,正则前后如果包含*,value将为true
     * @param string $str
     * @return Collection
     */
    static public function parseAsteriskPatterns(string $str): Collection
    {
        if (trim($str) == "") {
            return collect([]);
        }
        $patterns = explode(PHP_EOL, $str);

        $patterns = collect($patterns)->mapWithKeys(function ($pattern) {

            if (Str::startsWith($pattern, '*') && Str::endsWith($pattern, '*')) {
                return ['|' . trim($pattern, "\r *") . '|' => true];
            }
            return ['|' . trim($pattern, "\r") . '|' => false];

        });
        return $patterns;
    }

    /**
     * author: mtg
     * time: 2021/6/4   18:07
     * function description:获取url的域名部分
     * @param string $url
     * @return mixed
     */
    static public function getDomain(string $url)
    {
        $parts = parse_url($url);
        return data_get($parts, 'scheme') . '://' . data_get($parts, 'host');
    }

    /**
     * author: mtg
     * time: 2021/6/4   18:09
     * function description:获取url的路径部分
     * @param string $url
     * @return array|mixed
     */
    static public function getPath(string $url)
    {
        return data_get(parse_url($url), 'path');
    }


    /**
     * author: mtg
     * time: 2021/6/4   18:51
     * function description:获取html中的所有url
     * @param string $content
     * @return array|mixed
     */
    static public function getHtmlURLs(string $content): Collection
    {
        preg_match_all('|href="([^"]+)"|', $content, $URLs);
        return collect(data_get($URLs, 1, []));
    }


    /**
     * author: mtg
     * time: 2021/6/5   10:43
     * function description:移除不相关的字符,包含html标签,\t,\r,\n等其他特殊字符
     * @param string $html
     */
    static public function stripIrrelevantChars(string $html)
    {
        $html = strip_tags($html);
        $html = trim(str_ireplace(["\r", "\t", "\n", ' ', '　　'], '', $html));
        return $html;
    }

    /**
     * author: mtg
     * time: 2021/6/5   11:19
     * function description:将整篇内容分隔成句子
     * @param string $content
     * @return Collection
     */
    static public function split2Sentence(string $content, $delimiter = ["。"]): Collection
    {

        $sentences = array_reduce($delimiter, function ($carry, $delimiter) {
            return $carry->map(function ($item) use ($delimiter) {
                return explode($delimiter, $item);
            })->flatten();
        }, collect([static::stripIrrelevantChars($content)]));

        return $sentences->map(function ($value) {
            return trim($value, ' ');
        });
    }

    /**
     * author: mtg
     * time: 2021/6/7   11:08
     * function description:提取并加入res中所有符合条件的url
     * @param string $res
     * @param string $regulars
     */
    static public function extractAndPushUrls(string $res, string $regulars, callable $filterFun = null)
    {
        $patterns = static::parseAsteriskPatterns($regulars);

        if ($patterns->isEmpty()) {
            return [[], []];
        }
        $URLs = static::getHtmlURLs($res);


        $matchURLs       = [];
        $filterMatchURLs = [];
        foreach ($URLs as $url) {
            foreach ($patterns as $pattern => $isFilter) {

                if (preg_match($pattern, $url)) {
                    $matchURLs[] = $url;
                    if ($filterFun && $filterFun($url, $isFilter)) {
                        $filterMatchURLs [] = $url;
                    }
                }
            }
        }
        return [$matchURLs, $filterMatchURLs];

    }

    /**
     * author: mtg
     * time: 2021/6/4   18:18
     * function description: 闭包绑定当前对象
     * @param callable $callback
     * @return \Closure
     */
    public function bindThis(callable $callback)
    {
        return \Closure::bind($callback, $this, "static");
    }
}
