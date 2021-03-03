<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Advert
 *
 * @property int $id
 * @property int $category_id 广告分类id
 * @property string $name 广告名称
 * @property string $identify 广告标识或链接
 * @property string $image_path 图片路径
 * @property int $sort
 * @property int $is_disabled 是否禁用
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\AdvertCategory $category
 * @method static \Illuminate\Database\Eloquent\Builder|Advert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advert query()
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereIdentify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereIsDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Advert extends Model
{
    public function category()
    {
        return $this->belongsTo(AdvertCategory::class, 'category_id');
    }
}
