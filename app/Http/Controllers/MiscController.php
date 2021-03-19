<?php

namespace App\Http\Controllers;


use App\Http\Resources\AnnouncementResource;
use App\Model\Advert;
use App\Model\AdvertCategory;
use App\Model\Announcement;
use App\Model\Message;
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
        return AnnouncementResource::collection($announcements = Announcement::where([
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
            'version' => ['version']
        ]);

        $rs = app('MiscService')->version(request('client_type'), request('version'));

        return $this->transfer($rs);
    }


}
