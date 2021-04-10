<?php

namespace App\Define;

class UploadDefine
{
    const FRONT_UPLOAD_FOLDER = [
        'ID_CARD'              => 'id_card',        //身份证
        'ACCOUNT_QR_CODE'      => 'account_qr_code', //收款二维码
        'FIAT_PAY_CREDENTIALS' => 'fiat_pay_credentials', //法币支付凭据
        'FIAT_TRADE_COMPLAINT' => 'fiat_trade_complaint' //法币申诉
    ];

    const BACKEND_UPLOAD_FOLDER = [
        'ID_CARD'              => 'id_card',        //身份证
        'ACCOUNT_QR_CODE'      => 'account_qr_code', //收款二维码
        'ADVERT'               => 'advert',
        'SYMBOL'               => 'symbol',
        'FIAT_PAY_CREDENTIALS' => 'fiat_pay_credentials' //法币支付凭据
    ];

}


