<?php

namespace App\Admin\Components\Renders;

use Encore\Admin\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid\Simple;
use Illuminate\Support\Facades\Cache;

class DynamicOutput
{
    public static function modalRender($labelName, $buttonName, $modalTitle, $loadUrl, $position = 1)
    {
        static $storage = [];

        $position--;

        while (true) {
            $key = mt_rand(1, 10000);
            if ($exist = data_get($storage, 'key.' . $key)) {
                continue;
            }
            $storage['key'][$key] = 1;
            break;
        }

        while (true) {
            $name = mt_rand(1, 10000);
            if ($exist = data_get($storage, 'name.' . $name)) {
                continue;
            }
            $storage['name'][$name] = 1;
            break;
        }

        $width  = '900px';
        $height = '550px';

        $html = Admin::component('admin::widgets.dynamic_output', [
            'async'  => 0,
            'grid'   => 0,
            'title'  => $modalTitle,
            'html'   => self::getIframeHtml($loadUrl),
            'key'    => $key,
            'value'  => $buttonName,
            'name'   => $name,
            "width"  => $width,
            "height" => $height,
        ]);


        Admin::html($html);


        $js = <<<JS

var buttonHtml = `


<div class="form-group ">
    <label class="col-sm-2  control-label">{$labelName}<\/label>
    <div class="col-sm-8">
        <div class="box box-default box_default_system no-margin">
            <div class="box-body">

<span data-toggle="modal" data-target="#grid-modal-{$name}" data-key="{$key}"\>
   <a href="javascript:void(0)"><label class="btn btn-primary">{$buttonName}<\/label><\/a>
<\/span>
            <\/div>
        <\/div>

    <\/div>
<\/div>


`

var fieldAmount = $('.fields-group .form-group').size();

var position = {$position}

if (fieldAmount == 0){
  $('.fields-group').append(buttonHtml)
}else{
   $('.fields-group .form-group').eq(position).before(buttonHtml)
}


JS;
        Admin::script($js);

        /*当关闭modal框时重载*/
        $js = <<<EOT

function getIframeHtml(name,src){

return  `<div>
		 <div class="btn-group pull-left" style="margin-bottom: 8px">
         <button type="reset" class="btn btn-warning stop-gather">停止<\/button>
         <\/div>

         <\/div>
         <iframe src="\${src}" width="100%" height="550px">
         <\/iframe>`
}


$('.modal-content').click(function (event){
    if($(event.target).attr('aria-hidden')){

    }else{
        event.stopPropagation();
    }
})

$('.grid-modal').click( function (){
    modal_id = $(this).attr('id')
    src  = $(this).find('iframe').attr('src')
     gatherName = $(this).find('.gather-name').text()
    $("#"+modal_id+" .custom-width-height").empty().append(getIframeHtml(gatherName,src))
})



EOT;

        Admin::script($js);

    }

    static private function getIframeHtml($loadUrl = "")
    {

        $iframe = <<<EOT


<div>
<div class="btn-group pull-left" style="margin-bottom: 8px">
            <button type="reset" class="btn btn-warning stop-gather">停止</button>
        </div>
</div>


 <iframe src="{$loadUrl}" width="100%" height="550px">

</iframe>
EOT;
        return $iframe;
    }


    public static function get($form)
    {

        $script = self::extendJs();

        $css = <<<EOT
<style>
.box-header{
display:none;
}
body > .box{
    border: none;
    box-shadow: none;
}
.btn-primary {
    background-color: #3E4AF5;
    border-color: #3E4AF5;
}
.btn-primary:hover,.btn-primary:active,.btn-primary.hover {
    background-color: #3E4AF5
}
.btn{ border: none; }

.btn:active {
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
}
.btn-primary.active.focus, .btn-primary.active:focus,
.btn-primary.active:hover, .btn-primary:active.focus,
.btn-primary:active:focus, .btn-primary:active:hover{
    color: #fff;
    background-color: #3E4AF5;
    border-color: #3E4AF5;
}
.btn-primary.focus,.btn-primary:focus {
    color: #fff;
    background-color: #3E4AF5;
    border-color: #3E4AF5;
}
.btn-default { background: #99A1AA; color: #FFFFFF; border-color: #99A1AA }
.btn-default:hover, .btn-default:active, .btn-default.hover{ background: #99A1AA; color: #FFFFFF; border-color: #99A1AA; }

.btn-default.active.focus,.btn-default.active:focus,
.btn-default.active:hover,.btn-default:active.focus,
.btn-default:active:focus,.btn-default:active:hover {
    color: #fff;
    background-color: #99A1AA;
    border-color: #99A1AA
}
.form-group .control-label+div{
    width: 100%;
    min-height: 50px;
}
.form-group .control-label{
    display: block;
    float: inherit;
    text-align: left !important;
    height: 40px;
    line-height: 34px
    margin-bottom: 10px;
    font-weight: 600;
}
form > .box-body{
    height: 460px;
}
.box.box-solid.box-default{
    border-radius: 10px;
    height: 50px;
}
.box.box-solid.box-default .box-body{
    height: 30px;
    line-height: 30px;
}
.file-caption-main .file-caption{
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
}
.file-caption-main .btn-file{
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}
.box-footer .col-md-8 {
    text-align: center;
}
.box-footer .col-md-8 .btn-group:nth-child(1){
    margin-right: 20px;
}
.box-footer .col-md-8 .pull-left{
    float: inherit !important;
}
</style>
EOT;

        $form->tools(function (Form\Tools $tools) {
            // 去掉`列表`按钮
            $tools->disableList();
        });
        $form->footer(function ($footer) {


            // 去掉`查看`checkbox
            $footer->disableViewCheck();

            // 去掉`继续编辑`checkbox
            $footer->disableEditingCheck();

            // 去掉`继续创建`checkbox
            $footer->disableCreatingCheck();

        });


        return $script . $css . $form->render();

    }


    public static function post()
    {

        $script = self::extendJs();
        set_time_limit(0);
        $css = <<<EOT
<style>
body {
height: 400px;
padding: 30px
}

</style>
EOT;

        header('X-Accel-Buffering: no');
        force_response($css . $script);

    }


    public static function extendJs()
    {
        $script = <<<EOT
    <script>

    function LA() {}

    window.parent.$(function () {//使用window.parent调用父级jquery
        var head = document.getElementsByTagName("head").item(0);
        var linkList = window.parent.document.getElementsByTagName("link");//获取父窗口link标签对象列表
        for (var i = 0; i < linkList.length; i++) {
            var _link = document.createElement("link");
            _link.rel = 'stylesheet'
            _link.type = 'text/css';
            _link.href = linkList[i].href;
            head.appendChild(_link);
        }

        var scriptList = window.parent.document.getElementsByTagName("script");//获取父窗口script标签对象列表
        for (var i = 0; i < scriptList.length; i++) {
            var _script = document.createElement("script");
            _script.type = 'text/javascript';
            _script.src = scriptList[i].src;
            head.appendChild(_script);
        }
    });
</script>
EOT;
        return $script;
    }

}
