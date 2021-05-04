<?php

namespace App\Admin\Controllers;

use App\Admin\Components\Actions\BackupRun;
use App\Admin\Components\Actions\Clear;
use App\Admin\Components\Actions\RecoverBackup;

use App\Admin\Components\Actions\RecoverOrigin;
use App\Model\Backup;
use Encore\Admin\Controllers\AdminController;

use Encore\Admin\Grid;

use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;

class BackupController extends AdminController
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title;


    public function __construct()
    {
        $this->title = ll('Backup list');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new Backup());
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disableFilter();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableEdit();
            $actions->disableView();
        });

        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new BackupRun());

            $tools->disableBatchActions();
        });
        $grid->column('id', ll('Id'));

        $grid->column('name', ll('Backup file name'));
        $grid->column('size', ll('Backup size'));

        $depot = BackupDestinationStatusFactory::createForMonitorConfig(config('backup.monitor_backups'))->first();
        $disk  = $depot->backupDestination()->disk();

        $grid->column('download', ll('Download'))->display(function ($value) use ($disk) {
            return $disk->url($this->path);

        })->downloadable();

        $grid->column('created_at', ll('Backup time'));

        $grid->column('recover', ll('Recover'))->action(RecoverBackup::class);

        return $grid;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     */
    public function destroy($id)
    {

        $filePath = Backup::getFilePathByModifyTime($id);

        Backup::getBackupDisk()->delete($filePath);

        return response()->json([
            'status'  => true,
            'message' => trans('admin.delete_succeeded'),
        ]);
    }

}
