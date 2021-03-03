<?php

namespace App\Model;

use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\DocumentCategory
 *
 * @property int $id
 * @property string $title 分类标题
 * @property int $parent_id 父级id
 * @property \Illuminate\Support\Carbon $created_at 创建时间
 * @property \Illuminate\Support\Carbon $updated_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DocumentCategory extends Base
{
    use ModelTree;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setOrderColumn('sort');
    }


    public function documents()
    {
        return $this->hasMany(Document::class, 'category_id');
    }
}
