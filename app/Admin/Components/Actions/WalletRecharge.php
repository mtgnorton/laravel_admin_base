<?php

namespace App\Admin\Components\Actions;

use App\ApiException;
use App\Model\User;
use App\Model\Wallet;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * author: mtg
 * time: 2021/1/14   16:45
 * class description: 钱包充值
 * @package App\Admin\Components\Actions
 */
class WalletRecharge extends RowAction
{
    public $name;

    public function __construct()
    {
        parent::__construct();
        $this->name            = ll('Wallet Recharge');
        $this->accountTypeText = [
            Wallet::ACCOUNT_TYPE['EXCHANGE'] => ll('Account exchange'),
            Wallet::ACCOUNT_TYPE['FAIT']     => ll('Account fait'),
        ];
        $this->balanceTypeText = [
            Wallet::BALANCE_TYPE['BALANCE'] => ll('Balance'),
            Wallet::BALANCE_TYPE['FROZEN']  => ll('Frozen'),
        ];
    }

    public function handle(Model $model, Request $request)
    {

        try {
            app('WalletService')->change(User::find($request->user_id), $request->symbol_id, $request->recharge_amount, Wallet::SOURCE_TYPE['BACKEND'], $request->balance_type);
        } catch (ApiException $e) {
            return $this->response()->error($e->getMessage());
        } catch (\Exception $e) {
            return $this->response()->error('Wallet recharge error');
        }

        return $this->response()->success('Wallet recharge success')->refresh();
    }

    // 这个方法来根据`star`字段的值来在这一列显示不同的图标
    public function display($star)
    {
        return '<i class="fa fa-credit-card"></i>';
    }

    public function form()
    {

        $this->text('user_id', ll('User id'))->value($this->row->user_id)->readonly();
        $this->text('symbol_type', ll('Symbol type'))->value($this->row->symbol->name)->readonly();
        $this->hidden("symbol_id")->value($this->row->symbol->id);
        $this->radio('account_type', ll('Account type'))->options($this->accountTypeText);
        $this->radio('balance_type', ll('Balance type'))->options($this->balanceTypeText);
        $this->text('recharge_amount', ll('Recharge amount'))->help(ll('positive number add number,negative number deduct money'))->value(0)->rules('required|numeric');

    }

}
