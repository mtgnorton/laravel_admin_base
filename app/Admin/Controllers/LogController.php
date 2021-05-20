<?php

namespace App\Admin\Controllers;

use App\Model\FrontOperationLog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Illuminate\Support\Arr;

class LogController extends AdminController
{
    /**
     * {@inheritdoc}
     */
    protected function title()
    {
        return trans('admin.operation_log');
    }

    /**
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FrontOperationLog());

        $grid->model()->orderBy('id', 'DESC');

        $grid->column('id', 'ID')->sortable();
        $grid->column('username', ll('Username'));
        $grid->column('method', ll('Method'))->display(function ($method) {
            $color = Arr::get(FrontOperationLog::$methodColors, $method, 'grey');

            return "<span class=\"badge bg-$color\">$method</span>";
        });
        $grid->column('path', ll('Path'))->label('info');
        $grid->column('ip')->label('primary');
        $grid->column('input', ll('Args'))->display(function ($input) {
            $input = json_decode($input, true);
            $input = Arr::except($input, ['_pjax', '_token', '_method', '_previous_']);
            if (empty($input)) {
                return '<code>{}</code>';
            }

            return '<pre>' . json_encode($input, JSON_PRETTY_PRINT | JSON_HEX_TAG) . '</pre>';
        });

        $grid->column('created_at', trans('admin.created_at'));

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableEdit();
            $actions->disableView();
        });

        $grid->disableCreateButton();

        $grid->filter(function (Grid\Filter $filter) {
            $userModel = config('admin.database.users_model');

            $filter->equal('username', ll('Username'));
            $filter->equal('method', ll('Method'))->select(array_combine(FrontOperationLog::$methods, FrontOperationLog::$methods));
            $filter->like('path', ll('Path'));
            $filter->equal('ip');
        });

        return $grid;
    }

    /**
     * @param mixed $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $ids = explode(',', $id);

        if (FrontOperationLog::destroy(array_filter($ids))) {
            $data = [
                'status'  => true,
                'message' => trans('admin.delete_succeeded'),
            ];
        } else {
            $data = [
                'status'  => false,
                'message' => trans('admin.delete_failed'),
            ];
        }

        return response()->json($data);
    }
}
