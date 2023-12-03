<?php

namespace App\Admin\Controllers;

use App\Models\Cart;
use App\Models\Color;
use App\Models\Size;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CartController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cart';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cart());

        $grid->column('id', __('Id'));
        $grid->column('user.name', __('User'));
        $grid->column('product.name', __('Product id'));
        $grid->column('quantity', __('Quantity'));
        $grid->column(__('Color'))->display(function () {
            $color_id = $this->color_id;
            $color = Color::find($color_id);
            return $color ? $color->name : 'N/A'; // Replace 'N/A' with a default value if color is not found
        });
    
        $grid->column(__('Size'))->display(function () {
            $size_id = $this->size_id;
            $size = Size::find($size_id);
            return $size ? $size->name : 'N/A'; // Replace 'N/A' with a default value if size is not found
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Cart::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('product_id', __('Product id'));
        $show->field('quantity', __('Quantity'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Cart());

        $form->number('user_id', __('User id'));
        $form->number('product_id', __('Product id'));
        $form->number('quantity', __('Quantity'))->default(1);

        return $form;
    }
}
