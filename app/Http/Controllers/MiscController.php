<?php

namespace App\Http\Controllers;


use App\Define\UploadDefine;
use App\Http\Resources\AnnouncementResource;
use App\Model\Advert;
use App\Model\AdvertCategory;
use App\Model\Announcement;
use App\Model\AppVersion;
use App\Model\Document;
use App\Model\Feedback;
use App\Model\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MiscController extends Controller
{

    /**
     * author: mtg
     * time: 2021/2/25   18:55
     * function description:广告轮播接口
     * @return \Illuminate\Http\JsonResponse
     */
    public function advertList()
    {
        $identifying = request('identifying');
        $categoryID  = AdvertCategory::where('identifying', $identifying)->value('id');

        $adverts = Advert::where([
            'is_disabled' => 0,
            'category_id' => $categoryID
        ])->orderBy('sort')->get()->map(function ($item) {

            $item['image_path'] = \Storage::disk(config("admin.upload.disk"))->url($item['image_path']);
            return $item;

        });


        return $this->transfer($adverts);
    }

    /**
     * author: mtg
     * time: 2021/2/25   18:56
     * function description:公告列表接口
     */
    public function announcementList()
    {

        return $this->transfer(Announcement::where([
            'is_disabled' => 0
        ])->select(['id', 'title'])->orderBy('sort')->orderByDesc('id')->paginate(request('limit', 10)));


    }

    /**
     * author: mtg
     * time: 2021/2/26   10:38
     * function description:查看公告内容
     * @return \Illuminate\Http\JsonResponse
     */
    public function announcementDetail()
    {
        $id           = request('id');
        $announcement = Announcement::where([
            'id'          => $id,
            'is_disabled' => 0,
        ])->first();

        return $this->transfer($announcement);
    }

    /**
     * author: mtg
     * time: 2021/2/27   11:24
     * function description:发送短信验证码
     * @return \Illuminate\Http\JsonResponse
     */
    public function smsCode()
    {

        $data = request()->only([
            'mobile', 'type'
        ]);
        form_validate($data, [
            'mobile' => ['required', 'mobile'],
            'type'   => [Rule::in(Message::Type)]
        ]);
        app('SmsService')->sendAuthCode($data['mobile'], $data['type']);
        return $this->transfer(ll('Send success'));
    }

    /**
     * author: mtg
     * time: 2021/3/2   14:45
     * function description:获取最新版本
     */
    public function version()
    {

        $data = request()->all();
        form_validate($data, [
            'client_type' => ['required', Rule::in(AppVersion::CLIENT_TYPE)],
            'version'     => ['version']
        ]);

        $rs = app('MiscService')->version(request('client_type'), request('version'));

        return $this->transfer($rs);
    }


    /**
     * author: mtg
     * time: 2021/3/3   10:19
     * function description:帮助中心文档接口
     */
    public function document()
    {
        $identify = request('identify');

        $document = Document::where('identify', $identify)->first();

        if (!$document) {
            return $this->transfer();
        }
        $document['categories'] = $document->getCategoryParents();

        $document->makeHidden(['category', 'is_disabled']);

        return $this->transfer($document);

    }


    /**
     * author: mtg
     * time: 2021/3/12   16:12
     * function description:分享接口
     * @return \Illuminate\Http\JsonResponse
     */
    public function share(Request $request)
    {
        $ios     = AppVersion::getMaxVersion(AppVersion::CLIENT_TYPE['IOS'])->toArray();
        $android = AppVersion::getMaxVersion(AppVersion::CLIENT_TYPE['ANDROID'])->toArray();
        if (!$ios || !$android) {
            new_api_exception('下载链接不存在');
        }
        $registerUrl = config('app.url') . conf('h5_register_link');

        $registerUrl = Str::replaceFirst('{username}', Auth::user()->invite_code, $registerUrl);
        $registerUrl = Str::replaceFirst('{download_ios_link}', $ios['download_url'], $registerUrl);
        $registerUrl = Str::replaceFirst('{download_android_link}', $android['download_url'], $registerUrl);


        return $this->transfer([
            'url' => $registerUrl
        ]);
    }


    /**
     * author: mtg
     * time: 2021/3/22   16:41
     * function description:意见反馈接口
     */
    public function feedback()
    {
        $args = request()->only('content', 'mobile', 'email');
        form_validate($args, [
            'content' => 'required|max:1000',
            'mobile'  => 'required|mobile',
            'email'   => 'email|max:50'
        ]);

        Feedback::create($args);


        return $this->transfer(ll('Submit success'));

    }


    /**
     * author: mtg
     * time: 2021/3/22   17:01
     * function description:关于我们
     */
    public function about()
    {
        $args = request()->only('client_type');
        form_validate($args, [
            'client_type' => ['required', Rule::in(AppVersion::CLIENT_TYPE)],
        ]);
        $data                    = conf([
            'block_chain_browser_url', 'open_source_url', 'official_url'
        ]);
        $data['current_version'] = AppVersion::getMaxVersion($args['client_type']);
        if (!$data['current_version']->toArray()) {
            $data['current_version'] = (object)[];
        }
        return $this->transfer($data);
    }


    public function uploads(Request $request)
    {


        $args = $request->all();


        $uploadMaxSize = conf('upload_file_max_size');
        $fileMaxSize   = $uploadMaxSize ? $uploadMaxSize * 1024 : 10 * 1024;

        form_validate($args, [
            'folder'   => ['required', Rule::in(UploadDefine::FRONT_UPLOAD_FOLDER)],
            'images'   => ['required', 'array', 'max:5'],
            'images.*' => ['image', 'max:' . $fileMaxSize]
        ]);


        foreach ($request->file('images') as $image) {

            $url = Storage::url(Storage::put($args['folder'], $image));

            $urls[] = $url;
        }

        return $this->transfer([
            'url' => $urls
        ]);
    }


}
