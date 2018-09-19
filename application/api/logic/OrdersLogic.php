<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:02
 */
namespace app\api\logic;
use app\api\controller\v1\Basetrait;
use app\api\model\OrderitemsModel;

class OrdersLogic
{
    use Basetrait;
    public function add_Orders($list)
    {
        $validate = new  \app\api\validate\OrdersValidate();
        if (!$validate->check($list)) {
            return self::showReturnCodeWithOutData('422', "发布失败", $validate->getError());
        }
        $OrdersModel = new \app\api\model\OrdersModel();
        $status = $OrdersModel->add_Orders($list);
        if (!$status == 0) {
            return self::showReturnCodeWithOutData('201', "创建成功");
        } else {
            return self::showReturnCodeWithOutData('422', "发布失败");
        }
    }
    /**
     * @param $user_id
     * @return array  获取用户自己的订单列表
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
     * 用户自己删除订单
     */
    public function delete_Orders($id,$user_id){
        $OrdersModel = new \app\api\model\OrdersModel();
        $data =  $OrdersModel->delete_Orders($id,$user_id);
        return self::showReturnCode('200',$data);
    }


    //订单管理  发货
    public function dingdanfahuo($id, $param)
    {

        // 表单验证
        $rule = [
            'ship_type' => 'require', //快递
            'extra'     => 'require', //物流单号
        ];
        $field = [
            'ship_type' => '快递有误',
            'extra'     => '物流单号有误',
        ];
        $validate = new Validate($rule, $field);
        $result = $validate->check($param);
        if (!$result) {
            return ['422', $validate->getError()];
        }
        $model  = new OrdersModel();
        $status = $model->dingdanfahuo($id, $param['ship_type'], $param['extra']);
        if (!$status == 0) {
            return self::showReturnCodeWithOutData('201', "发货成功");
        } else {
            return self::showReturnCodeWithOutData('422', "发货失败");
        }
    }

    //获取订单数量
    public function ordersNums($user_id)
    {
        $model = new OrderitemsModel();
        $data  = $model->ordersNums($user_id);
        $data['ordersNums']=$data;
            return self::showReturnCode('200',$data);
    }

    /**
     * @param $user_id
     * @return array  商户获取用户的订单列表
     */
    public function get_Orders_goods($user_id){
        $OrdersModel = new \app\api\model\UserGoodsModel();
        $data =  $OrdersModel->get_Orders_goods($user_id);
        return self::showReturnCode('200',$data);
    }

}