<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->column('id', __('Id'));
        $grid->column('user.name', __('User id'));
        $grid->column('address', __('Address'));
        $grid->column('code', __('Code'));
        $grid->column('payment_method', __('Payment method'))->display(function ($value) {
            switch ($value) {
                case 1:
                    $color = 'blue';
                    $text = 'ATM Banking';
                    break;

                case 0:
                    $color = 'blue';
                    $text = 'Thanh toán khi nhận hàng';
                    break;

                default:
                    $color = 'red';
                    $text = 'Chưa xác định';
                    break;
            }
            return "<span style='color: $color;'>$text</span>";

        });
        $grid->column('status', __('Status'))->display(function ($value) {
            switch ($value) {
                case 1:
                    $color = 'primary';
                    $text = 'Đang xử lý';
                    break;
                case 2:
                    $color = 'warning';
                    $text = 'Đang giao';
                    break;
                case 3:
                    $color = 'success';
                    $text = 'Giao hàng thành công';
                    break;
                case 4:
                    $color = 'danger';
                    $text = 'Đã hủy';
                    break;
                default:
                    $color = 'dark';
                    $text = 'Trạng thái không xác định';
                    break;
            }


            return "<span class='btn btn-$color' style='color: $color;'>$text</span>";
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
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user.name', __('User id'));
        $show->field('address', __('Address'));
        $show->field('code', __('Code'));
        $show->field('payment_method', __('Payment method'))->as(function ($value) {
            $payment = [
                1 => 'ATM Banking',
                0 => 'Thanh toán khi nhận hàng',
               
            ];

            return $payment[$value] ?? 'Trạng thái không xác định';
        })->label('info');
        $show->field('status', __('Status'))->as(function ($value) {
            $statuses = [
                1 => 'Đang xử lý',
                2 => 'Đang giao',
                3 => 'Giao hàng thành công',
                4 => 'Đã hủy',
            ];

            return $statuses[$value] ?? 'Trạng thái không xác định';
        })->label('info');

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
        $form = new Form(new Order());

        $form->text('user.name', __('User'));
        $form->textarea('address', __('Address'));
        $form->text('code', __('Code'));
        $form->select('payment_method', __('Payment method'))->options([
            1 => 'ATM Banking',
            0 => 'Thanh toán khi nhận hàng',
        ]);
        $form->select('status', __('Status'))->options([
            1 => 'Đang xử lý',
            2 => 'Đang giao',
            3 => 'Giao hàng thành công',
            4 => 'Đã hủy',
        ])->default(1);


        return $form;
    }
}
