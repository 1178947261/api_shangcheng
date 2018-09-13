<?php

namespace app\http\middleware;

use app\api\controller\v1\Basetrait;
use app\api\model\UserGoodsModel;
use think\facade\Response;

class Auth
{


    use Basetrait;
    /**
     * @param $request
     * @param \Closure $next
     * 中间件的验证
     * 用于权限验证
     */
    public function handle($request, \Closure $next)
    {

        $USER = new UserGoodsModel();
       $user_id= $USER->is_chek($this->user_id);
        if ($user_id) {
            $data =self::showReturnCodeWithOutData('301','权限不足');
            return   Response::create($data,'json');
        }
        return $next($request);
    }
}
