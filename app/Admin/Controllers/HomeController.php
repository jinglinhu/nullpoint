<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Dashboard');
            $content->description('Description...');
            $content->row(function ($row) {
                $row->column(3, new InfoBox('New Users', 'users', 'aqua', '/users', '1024'));
                $row->column(3, new InfoBox('New Orders', 'shopping-cart', 'green', '/orders', '150%'));
                $row->column(3, new InfoBox('Articles', 'book', 'yellow', '/articles', '2786'));
                $row->column(3, new InfoBox('Documents', 'file', 'red', '/files', '698726'));
            });

        });
    }
}
