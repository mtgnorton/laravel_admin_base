#laravel api 脚手架

## 部署

1. git clone 拉取代码    
2. composer install --no-scripts
3. php artisan key:generate,将.env生成的APP_KEY复制到go项目的config/config.toml的AppKey,该key不能泄露
4. 修改.env中的数据库信息
5. chmod -R a+w storage
6. php artisan storage:link



##常用命令
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
2. tymon/jwt-auth
3. medz/cors


## 已实现功能
1. 异常捕捉
2. 数据返回
3. jwt注册 单点登录





            
