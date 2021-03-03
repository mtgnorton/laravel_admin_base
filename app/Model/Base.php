<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;


/**
 * App\Model\Base
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Base newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Base newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Base query()
 * @mixin \Eloquent
 */
class Base extends Model
{
    protected $guarded = [];


    public function allowField()
    {
        $fields = Schema::getColumnListing($this->getTable());

    }
}
