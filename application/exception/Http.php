<?php
namespace app\exception;

use Exception;
use think\exception\Handle;
use think\exception\HttpException;
class Http extends Handle
{

    public function render(Exception $e)
    {
        $data=['code'=>501,
            'message'=>lang("NBFWQ")
        ];
        // 参数验证错误
        if ($e instanceof ValidateException) {
            return json(lang("NBFWQ"),200);
        }
        // 请求异常
        if ($e instanceof HttpException && request()->isAjax()) {
            return json(lang("NBFWQ"),200);
        }
        return json($data,200);
    }

}