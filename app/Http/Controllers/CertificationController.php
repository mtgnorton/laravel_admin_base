<?php

namespace App\Http\Controllers;

use App\Model\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CertificationController extends Controller
{

    /**
     * author: mtg
     * time: 2021/3/25   18:44
     * function description: 实名认证kyc1和kyc2列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $certification = Certification::where([
            'user_id' => Auth::id(),
        ])->orderBy('id', 'desc')->first();
        if ($certification) {
            $card                     = $certification['id_card'];
            $certification['id_card'] = Str::substr($card, 0, 6) . "********" . Str::substr($card, -4);
        } else {
            $certification = (object)[];
        }
        $data = [
            [
                'name'               => ll('kyc1 auth'),
                'type'               => Certification::TYPE['KYC1'],
                'is_use'             => 1,
                'single_trade_limit' => conf('fiat_kyc1_single_trade_limit'),
                'day_trade_limit'    => conf('fiat_kyc1_day_trade_limit'),
                'current'            => $certification
            ],
            [
                'name'                         => ll('kyc2 auth'),
                'type'                         => Certification::TYPE['KYC2'],
                'is_use'                       => 0,
                'fiat_kyc1_single_trade_limit' => 0,
                'fiat_kyc1_day_trade_limit'    => 0,
                'current'                      => (object)[],
            ]
        ];

        return $this->transfer($data);
    }


    /**
     * author: mtg
     * time: 2021/3/25   18:46
     * function description:
     * @param Request $request
     */
    public function store(Request $request)
    {
        $args = $request->only([
            'name',
            'type',
            'id_card',
            'card_image_front',
            'card_image_behind',
        ]);
        form_validate($args, [
            'name'              => ['required', 'max:10'],
            'type'              => [Rule::in(Certification::TYPE['KYC1'], Certification::TYPE['KYC2'])],
            'id_card'           => ['required', 'min:18', 'max:18'],
            'card_image_front'  => ['required', 'url'],
            'card_image_behind' => ['required', 'url'],

        ]);
        if (Certification::where([
            ['user_id', '=', Auth::id()],
            ['status', 'in', [
                Certification::STATUS['NO AUDIT'],
                Certification::STATUS['PASS AUDIT']
            ]
            ]
        ])->exists()) {
            new_api_exception(ll("can't repeat apply"));
        }
        $args['user_id'] = Auth::id();
        $args['type']    = Certification::TYPE['KYC1'];

        $args['username'] = Auth::user()->username;
        Certification::create($args);

        return $this->transfer(ll('Submit success'));
    }


}
