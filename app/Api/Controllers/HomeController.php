<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;

class HomeController extends ApiBaseController
{

    public function index(Request $request)
    {
        $user = $this->auth->user();
        if ($user) {
            echo $user->name;
        } else {
            echo 123;
        }
    }
}
