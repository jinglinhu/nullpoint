<?php

namespace App\Api\Controllers;

use App\Models\Users;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AuthController extends ApiBaseController
{
    use AuthenticatesUsers;
    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
    public function __construct()
    {
        parent::__construct();
    }

    /****
     * 判定用户是否登陆
     * @return \Illuminate\Http\JsonResponse
     */
    public function info()
    {
        return $this->response->array([
            'status_code' => 200,
            'message'     => 'success',
            'data'        => ['user' => $this->auth->user()],
        ]);
    }

    /****
     * 登陆
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // 验证规则，由于业务需求，这里我更改了一下登录的用户名，使用手机号码登录
        $rules = [
            'email'    => [
                'required',
                'exists:users',
            ],
            'password' => 'required|string|min:6|max:20',
        ];

        // 验证参数，如果验证失败，则会抛出 ValidationException 的异常
        $params = $this->validate($request, $rules);

        // 使用 Auth 登录用户，如果登录成功，则返回 201 的 code 和 token，如果登录失败则返回
        if ($token = $this->auth->attempt($params)) {
            //清除登陆限制
            $this->clearLoginAttempts($request);
            return $this->response->array([
                'status_code' => 200,
                'message'     => 'success',
                "data"        => ['token' => 'bearer ' . $token],
            ]);
        }
        return $this->response->error("passport error", 500);
    }

    /****
     * 登出
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {

        $this->auth->logout();

        return $this->response->array([
            'status_code' => 200,
            'message'     => 'logout success',
        ]);
    }

    /**
     * 注册
     * @param Request $request
     */
    public function register(Request $request)
    {
        $rules = [
            'name'     => 'required|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:20',
        ];

        // 验证参数，如果验证失败，则会抛出 ValidationException 的异常
        $params = $this->validate($request, $rules);

        $input             = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = new Users($input);

        if ($user->save()) {
            $token = $this->auth->fromUser($user);
            return $this->response->array([
                "status_code" => 200,
                "message"     => "register success",
                "data"        => ['token' => 'bearer ' . $token],
            ]);
        } else {
            return $this->response->error("register fail", 500);
        }
    }

}
