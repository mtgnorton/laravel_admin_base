<?php

namespace App\Model;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Spatie\Backup\Commands\ListCommand;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatus;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;

class Backup extends Model
{
    public function paginate()
    {


        $perPage = Request::get('per_page', 10);

        $page = Request::get('page', 1);

        $files = $this->getAllBackupFiles();

        $disk = self::getBackupDisk();

        $data = $files->map(function ($filePath) use ($disk) {
            return [
                'id'         => $disk->lastModified($filePath),
                'name'       => basename($filePath),
                'path'       => $filePath,
                'size'       => human_file_size($disk->size($filePath)),
                'created_at' => date('Y-m-d H:i:s', $disk->lastModified($filePath)),
            ];
        })->reverse()->forPage($page, $perPage)->toArray();

        $collection = static::hydrate($data);

        $paginator = new LengthAwarePaginator($collection, count($files->toArray()), $perPage);

        $paginator->setPath(url()->current());

        return $paginator;
    }


    public static function getFilePathByModifyTime(int $time)
    {
        $files = self::getAllBackupFiles();

        $disk = self::getBackupDisk();
        return $files->first(function ($file) use ($disk, $time) {
            $fileModifyTime = $disk->lastModified($file);
            if ($fileModifyTime == $time) {
                return true;
            }
            return false;
        });
    }

    public static function getAllBackupFiles(): Collection
    {

        $name = self::getDestination()->backupDestination()->backupName();

        return collect(self::getBackupDisk()->allFiles($name));

    }

    public static function getBackupDisk(): Filesystem
    {

        $depot = self::getDestination();
        $disk  = $depot->backupDestination()->disk();

        return $disk;
    }

    public static function getDestination(): BackupDestinationStatus
    {
        /**
         * @var $depot BackupDestinationStatus
         */

        return BackupDestinationStatusFactory::createForMonitorConfig(config('backup.monitor_backups'))->first();
    }

    public static function getTempDir()
    {
        return realpath(config('backup.backup.temporary_directory') ?? storage_path('app/backup-temp'));
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

    }

    // 覆盖`where`来收集筛选的字段和条件
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {

    }
}
