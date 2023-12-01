<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use App\Models\Category;
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
        // $form->number('category_id', __('Category id'));
        $form->select('category_id')->options(function(){
            $Category = Category::all();
            $arr = [];
            foreach($Category as $Cate) {
                $arr += [$Cate->id => $Cate->name];
            }
            return $arr;
        });

        return $form;
    }
}
