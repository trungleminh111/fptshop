<?php

namespace App\Admin\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use App\Models\Size;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        // $grid->column('image', __('Image'));
        $grid->column('image', __('Image'))->display(function ($image) {
            return '<img src="../uploads/'.$image.'" style ="width: 40px; height: 40px">';
        });
        $grid->column('price', __('Price'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('description', __('Description'));
        $grid->column('status', __('Status'))->switch([
            'on' => ['value' => 0, 'text' => 'Hiện', 'color' => 'success'],
            'off' => ['value' => 1, 'text' => 'Ẩn', 'color' => 'danger'],
        ]);
        $grid->column('category.name', __('Category'));
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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('image', __('Image'));
        $show->field('price', __('Price'));
        $show->field('quantity', __('Quantity'));
        $show->field('description', __('Description'));
        $show->field('status', __('Status'));
        $show->field('category.name', __('Category id'));
        $show->panel('Product Variants', function ($panel) use ($id) {
            $variants = ProductVariantt::where('product_id', $id)->get();
            $panel->table('Product Variants', function ($table) use ($variants) {
                $table->column('id', __('ID'));
                $table->column('size.name', __('Size'));
                $table->column('color.name', __('Color'));
                $table->column('price', __('Price'))->display(function ($price) {
                    return number_format($price);
                });
                $table->column('quantity', __('Quantity'));
                $table->column('created_at', __('Created at'));
                $table->column('updated_at', __('Updated at'));

            });
        });
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
        $form = new Form(new Product());

        $form->text('name', __('Name'));
        $form->image('image', __('Image'));
        $form->decimal('price', __('Price'));
        $form->number('quantity', __('Quantity'));
        $form->textarea('description', __('Description'));
        $form->switch('status', __('Status'));
        $form->select('category_id')->options(function(){
            $Category = Category::all();
            $arr = [];
            foreach($Category as $Cate) {
                $arr += [$Cate->id => $Cate->name];
            }
            return $arr;
        });
        $form->hasMany('variants', 'Product Variants', function (Form\NestedForm $form) {
            $form->select('size_id', 'Size')->options(function () {
                return Size::pluck('name', 'id');
            });
            $form->select('color_id', 'Color')->options(function () {
                return Color::pluck('name', 'id');
            });
            $form->decimal('price', 'Price');
            $form->number('quantity', 'Quantity');
        });

        return $form;
    }
}
