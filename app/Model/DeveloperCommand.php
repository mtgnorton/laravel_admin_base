<?php

namespace App\Model;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatus;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;

class DeveloperCommand extends Model
{
    public function paginate()
    {

        $perPage = Request::get('per_page', 50);

        $page = Request::get('page', 1);

        $data = [
            [
                'id'        => 1,
                'operation' => 'App\Admin\Components\Actions\RecoverOrigin',
                'desc'      => '恢复到原始数据,将会把storage/sql下的sql覆盖到数据库中',
            ],
            [
                'id'        => 2,
                'operation' => 'App\Admin\Components\Actions\Clear',
                'desc'      => '清空业务数据',
            ],
            [
                'id'        => 3,
                'operation' => 'App\Admin\Components\Actions\AlterField',
                'desc'      => '当数据库有新增字段时,将z_alter修改写入数据库',
            ],

        ];

        $collection = static::hydrate($data);

        $paginator = new LengthAwarePaginator($collection, count($data), $perPage);

        $paginator->setPath(url()->current());

        return $paginator;
    }

    // 获取单项数据展示在form中
    static public function findOrFail($id)
    {

        return (new self())->newFromBuilder([
            'id' => $id
        ]);
    }

    public static function with($relations)
    {
        return new static;
    }

    // 覆盖`orderBy`来收集排序的字段和方向
    public function orderBy($column, $direction = 'asc')
    {
        return $this;
    }

    // 覆盖`where`来收集筛选的字段和条件
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {

    }
}
