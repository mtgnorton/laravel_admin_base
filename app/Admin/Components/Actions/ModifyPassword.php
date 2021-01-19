<?php

namespace App\Admin\Components\Actions;

use App\Model\User;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ModifyPassword extends RowAction
{
    public $name = '修改密码';

    public function handle(Model $model, Request $request)
    {
        $isModify = false;
        if ($request->password) {
            $isModify = true;

            $model->password = Hash::make($request->password);
        }
        if ($request->pay_password) {
            $isModify = true;

            $model->pay_password = Hash::make($request->pay_password);
        }
        if ($isModify) {
            $model->save();
            return $this->response()->success(__('Modify success'))->refresh();

        }
        return $this->response()->info('No modify')->refresh();
    }

    // 这个方法来根据`star`字段的值来在这一列显示不同的图标
    public function display($star)
    {

        return '<i class="fa fa-expeditedssl"></i>';
    }

    public function form()
    {

        $this->text('user_id', __('User id'))->value($this->row->id)->readonly();
        $this->password('password', __('Password'))->help(__("input modify"))->rules("sometimes|nullable|min:6|confirmed");
        $this->password('password_confirmation', __('Password confirmation'));
        $this->password('pay_password', __('Pay password'))->help(__("input modify"))->rules("sometimes|nullable|min:6|confirmed");
        $this->password('pay_password_confirmation', __('Pay password confirmation'));

    }

}
