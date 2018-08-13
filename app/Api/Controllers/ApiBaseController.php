<?php

namespace App\Api\Controllers;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;

class ApiBaseController extends Controller
{
    use Helpers;

    protected $auth;

    /****
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->auth = \Auth::guard('api');
    }
}
