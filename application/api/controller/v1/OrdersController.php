<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:34
 */
namespace app\api\controller\v1;
use app\api\logic\OrdersLogic;
use app\api\model\ClassificationModel;
use think\Controller;
use think\Request;

class OrdersController extends Controller
{
    /**
     * 订单详细
     *
     */
    use Basetrait;

    /**
     * @param Request $request
     * @return array
     * 添加订单
     */

    public function add_Orders(Request $request)
    {
        $data = $request->param();
        $data['user_id'] = $this->user_id;
        $address = new OrdersLogic();
        return $address->add_Orders($data);
    }

    /**
     * @return array
     * 订单列表
     */
    public function get_Orders_list(){
        $address = new OrdersLogic();
        return $address->get_Orders( $this->user_id);
    }

    /**
     * @param Request $request
     * @return array
     *订单详情
     *
     */
    public function get_Orders_list_one(Request $request){
        $id = $request->param('id');
        $address = new OrdersLogic();
        return $address->get_Orders_one( $this->user_id,$id);
    }

    /**
     * @param Request $request
     * @return array
     * 删除订单
     */
    public function delete_Orders(Request $request){
        $id = $request->param('id');
        $address = new OrdersLogic();
        return $address->delete_Orders( $id,$this->user_id);
    }

    /**
     * @param Request $request
     * 支付订单
     */
    public function close_Orders(Request $request){


    }

    /**
     * @param Request $request
     * 商户发货
     */


}
