<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Document
 *
 * @property int $id
 * @property string $title 文档标题
 * @property string $identify 文档标识符
 * @property string|null $content 文档内容
 * @property int $sort
 * @property int $is_disabled 是否禁用
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document query()
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereIdentify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereIsDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Document extends Model
{

    public function category()
    {
        return $this->belongsTo(DocumentCategory::class, 'category_id');
    }

    /**
     * author: mtg
     * time: 2021/3/3   10:31
     * function description:获取某个文档所有的分类
     * @return \Illuminate\Support\Collection|\Tightenco\Collect\Support\Collection
     */
    public function getCategoryParents()
    {
        $parents = collect([]);

        $tempID = $this->category->id;
        while (true) {
            $tempCategory = DocumentCategory::where('id', $tempID)->first();

            $parents->prepend([
                'title' => $this->category->title,
                'id'   => $this->category->id,
            ]);
            if (!$tempCategory->parent_id) {
                return $parents;
            }
            $tempID = $tempCategory->parent_id;
        }
    }

}
