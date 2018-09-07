<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:34
 */
namespace app\api\controller\v1;
use app\api\logic\OrdersLogic;
use think\Controller;
use think\Request;

class OrdersController extends Controller
{
    /**
     * 订单详细
     *
     */
    use Basetrait;
    public function add_Orders(Request $request)
    {
        $data = $request->param();
        $data['user_id'] = $this->user_id;
        $address = new OrdersLogic();
        return $address->add_Orders($data);
    }

}
