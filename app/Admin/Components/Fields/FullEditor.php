<?php

namespace App\Admin\Components\Fields;

use Encore\Admin\Form\Field;

class FullEditor extends Field
{

    protected $view = "admin.customs.editor";

    protected static $js = [
        'vendor/editor/wangEditor.min.js',
    ];

    public function render()
    {
        $config = \json_encode([
            'zIndex'              => 0,
            'uploadImgShowBase64' => true,
            'uploadImgFileName'   => 'images',
            'uploadImgServer'     => '/admin/upload',
            'debug'               => true,
            'showFullScreen'      => true,
            'height'              => 600,
            'uploadImgMaxLength'  => 5,
            'uploadImgMaxSize '   => 10 * 1024 * 1024,
        ]);


        $token = csrf_token();


        $this->script = <<<EOT
(function ($){
    if ($('#{$this->id}').attr('initialized')) {
        return;
    }
    const E = window.wangEditor
    const editor = new E('#{$this->id}')
    editor.config.uploadImgParams = {_token: '$token'}
    Object.assign(editor.config, {$config})
    editor.create()
    $('#{$this->id}').css({"margin-top":"20px"})
    $('#{$this->id}').attr('initialized', 1);
})(jQuery);
EOT;

        return parent::render();
    }
}
