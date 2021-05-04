# 安装

## 要求:
 1. php扩展 
 2. 函数: 
 
## 部署:
1. git clone 拉取代码    
2. composer install --no-scripts
4. 修改.env中的数据库信息和redis的REDIS_DB和REDIS_CACHE_DB,注意不要和其他交易所用的redis重复
4. 把storage/sql下的文件导入到数据库中
4. php artisan key:generate
5. chmod -R a+w storage
6. php artisan storage:link
7. 根目录下执行`cp -f ./storage/origin/DateMultiple.php ./vendor/encore/laravel-admin/src/Form/Field/DateMultiple.php` 解决第三方包静态文件使用cdn过慢问题
7. 根目录下执行`cp -f ./storage/origin/AliOssAdapter.php ./vendor/jacobcyl/ali-oss-storage/src/AliOssAdapter.php` 结局alioss图片不存在抛出异常的问题
8. `visudo ;%www ALL=(ALL) NOPASSWD: ALL`为www用户组开启免密
7. 伪静态
    ```
    location / {
        try_files $uri $uri/ /index.php?$query_string;
     }    
    ```
  
 
## 定时
2. 每分钟执行一次laravel调度器  `php artisan schedule:run`


## 生产环境/正式环境优化
### laravel 项目

1. 开发环境改成生产环境,将env文件中 `APP_ENV=local` 改成 `APP_ENV=production`,
2. 关闭调试模式,将env文件中 `APP_DEBUG=true` 改成 `APP_DEBUG=false`

1. `composer install --optimize-autoloader --no-dev` 自动加载器改进

2. `php artisan config:cache` 配置文件缓存,在代码中不要使用env函数 //有修改时,先清除配置缓存php artisan config:clear,再进行缓存  

3. `php artisan route:cache` 路由缓存  //有修改时,先清除配置缓存php artisan route:clear,再进行缓存  

### laravel-admin项目
1. 压缩静态文件 先安装`composer require matthiasmullie/minify --dev
`,然后执行`php artisan admin:minify` // 清理压缩状态  `php artisan admin:minify --clear`






# 其他
## 线上操作
常驻进程查看：supervisorctl status dev-exchange_php
重启：supervisorctl restart  dev-exchange_php
日志目录： /www/wwwroot/dev-exchange_php/trade.log


## 常用命令
1. 创建model `php artisan make:model 
           App\Model\Post
           ` 
2. 创建api控制器 `php artisan make:controller PhotoController --resource --model=App\Model\Post`
3. 创建admin控制器   `php artisan admin:make UserController --model=App\User`
`  
4. 复制扩展包的资源文件`php artisan vendor:publish --provider="Encore\WangEditor\WangEditorServiceProvider"
`
5. 生成软连接 `php artisan storage:link`


## 使用的第三方库
1. barryvdh/laravel-ide-helper 
```
php artisan ide-helper:generate - 为 Facades 生成注释

php artisan ide-helper:models - 为数据模型生成注释

php artisan ide-helper:meta - 生成 PhpStorm Meta file

```









            
