<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\AdvertCategory
 *
 * @property int $id
 * @property string $name 广告分类名称
 * @property int $width 图片宽度
 * @property int $height 图片高度
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Advert[] $adverts
 * @property-read int|null $adverts_count
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertCategory whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertCategory whereWidth($value)
 * @mixin \Eloquent
 */
class AdvertCategory extends Model
{
    public function adverts()
    {
        return $this->hasMany(Advert::class, 'category_id');
    }
}
