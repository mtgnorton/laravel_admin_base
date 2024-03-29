<?php

namespace App\Admin\Components\Renders;

use App\Admin\Controllers\PostController;
use App\Model\Post;
use Illuminate\Contracts\Support\Renderable;

/**
 * author: mtg
 * time: 2021/1/14   16:43
 * class description:成交中的订单像是
 * @package App\Admin\Components
 */
class PostRender implements Renderable
{
    protected $orderID;


    public function render($userID = null)
    {

        $o = new PostController();

        $grid = $o->grid();

        $grid->model()->whereIn('id', [$userID]);

        grid_disabled_all($grid);

        return $grid->render();
    }
}
