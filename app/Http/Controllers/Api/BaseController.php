<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;

class BaseController extends Controller
{
    /**
     * @var $request
     */
    protected $request = null;

    /**
     * @var $user
     */
    protected $user = null;

    public function __construct(Request $request = null)
    {
        $this->middleware('auth:api', ['except' => ['postLogin', 'forgot', 'createVerifyCodes']]);
        $this->user = User::autoLogin($request);

    }

    /**
     * ajax请求成功
     * @param array $data
     * @param string $msg
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data = [], $msg = '')
    {
        return response()->json([
            'code' => 'ok',
            'data' => $data,
            'msg'  => $msg,
        ]);
    }

    /**
     * ajax请求失败
     * @param array $error
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($error = [], $code = 422)
    {
        return response()->json([
            'code'  => $code,
            'error' => $error
        ]);
    }
}
