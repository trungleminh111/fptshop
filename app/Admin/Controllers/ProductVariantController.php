<?php

namespace App\Admin\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductVariantController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ProductVariant';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductVariant());

        $grid->column('id', __('Id'));
        $grid->column('product_id', __('Product id'));
        $grid->column('size_id', __('Size id'));
        $grid->column('color_id', __('Color id'));
        $grid->column('price', __('Price'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('image', __('Image'))->display(function ($image) {
            return '<img src="../uploads/'.$image.'" style ="width: 40px; height: 40px">';
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
        $show = new Show(ProductVariant::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_id', __('Product id'));
        $show->field('size_id', __('Size id'));
        $show->field('color_id', __('Color id'));
        $show->field('price', __('Price'));
        $show->field('quantity', __('Quantity'));
        $show->field('image', __('Image'));
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
        $form = new Form(new ProductVariant());

        // $form->number('product_id', __('Product id'));
        // $form->number('size_id', __('Size id'));
        // $form->number('color_id', __('Color id'));
        $form->select('product_id')->options(function(){
            $products = Product::all();
            $arr = [];
            foreach($products as $product) {
                $arr += [$product->id => $product->name];
            }
            return $arr;
        });
        $form->select('size_id')->options(function(){
            $sizes = Size::all();
            $arr = [];
            foreach($sizes as $size) {
                $arr += [$size->id => $size->name];
            }
            return $arr;
        });
        $form->select('color_id')->options(function(){
            $colors = Color::all();
            $arr = [];
            foreach($colors as $color) {
                $arr += [$color->id => $color->name];
            }
            return $arr;
        });
        $form->decimal('price', __('Price'));
        $form->number('quantity', __('Quantity'));
        $form->image('image', __('Image'));

        return $form;
    }
}
