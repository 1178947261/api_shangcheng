<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:02
 */
namespace app\api\logic;
use app\api\controller\v1\Basetrait;

class OrdersLogic
{
    use Basetrait;
    public function add_Orders($list)
    {
        $validate = new  \app\api\validate\OrdersValidate();
        if (!$validate->check($list)) {
            return self::showReturnCodeWithOutData('4003', "发布失败", $validate->getError());
        }
        $OrdersModel = new \app\api\model\OrdersModel();
        $status = $OrdersModel->add_Orders($list);
        if (!$status == 0) {
            return self::showReturnCodeWithOutData('201', "创建成功");
        } else {
            return self::showReturnCodeWithOutData('4003', "发布失败");
        }
    }
    /**
     * @param $user_id
     * @return array  获取订单列表
     */
    public function get_Orders($user_id){
        $OrdersModel = new \app\api\model\OrdersModel();
        $data =  $OrdersModel->get_Orders_list($user_id);
        return self::showReturnCode('200',$data);
    }

    /**
     * @param $user_id
     * @param $id
     * @return array
     * 获取订单详情
     */
    public function get_Orders_one($user_id,$id){
        $OrdersModel = new \app\api\model\OrdersModel();
        $data =  $OrdersModel->get_Orders_list_one($user_id,$id);
        return self::showReturnCode('200',$data);
    }

    /**
     * @param $id
     * @param $user_id
     * @return array
     * 获取订单列表
     */
    public function delete_Orders($id,$user_id){
        $OrdersModel = new \app\api\model\OrdersModel();
        $data =  $OrdersModel->delete_Orders($id,$user_id);
        return self::showReturnCode('200',$data);
    }

}