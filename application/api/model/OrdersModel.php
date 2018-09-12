<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:03
 */

namespace app\api\model;

use app\api\base\model\OrdersBaseModel;
use think\Db;

class OrdersModel extends OrdersBaseModel
{
    protected $pk = 'id';
    protected $table = 'orders';
    public function cart()
    {
        return $this->hasOne('OrderitemsModel', 'order_id', 'id');
    }


    /**
     * @param $list
     * @return int|string
     * 创建订单 //未考虑安全暂时版本
     */
    public function add_Orders($list)
    {
        // 启动事务
        Db::startTrans();
        try {
            $orderitemsModel = new OrderitemsModel();
            $list['no'] = self::createRandNum(13);//
            $AddCart =  new AddCartModel();
            $data_AddCart = $AddCart->get_Cart($list['cart_id']);
            //单价
            $productskusModel =new  ProductskusModel();
            $money =  $productskusModel->get_price($data_AddCart['product_id']);
            $total_amount = bcmul ($money,$data_AddCart['amount']);
            $data = $this->return_Orders_array($list,$total_amount);
            $status = self::insertGetId($data);
            $list['id'] = $status;
            $list['price']=$total_amount;
            $list['amount']=$data_AddCart['amount'];
            $list['product_id']=$data_AddCart['product_id'];
            $orderitemsModel->addOrderitems($list);
             $boole = $this->xiugaikuchun($data_AddCart);
             if ($boole==false){
                 Db::rollback();
                 $status = false;
             }
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            $status = false;
        }
        return $status;
    }

    public function xiugaikuchun($data){
     $Products =new   ProductsModel();
        $boole= $Products->reduce_stock_Products($data['product_id'],$data['product_sku_id']);
        return $boole;
    }


    /**
     * @param mixed $where
     * @return bool|void
     *
     * 修改订单
     */
    public function update_Orders($where, $id, $userid)
    {
        // 启动事务
        Db::startTrans();
        try {
            $orderitemsModel = new OrderitemsModel();
            $this->where('id', 1)->lock(true)->find();
            if ($where['amount']) {
                $orderitemsModel->update_amount($where['id'],$where['amount'],$where['type']);
                unset($where['amount']);
                unset($where['type']);
                $status = $this->save($where, ['user_id' => $userid, 'id' => $id]);
            }else{
                $status = $this->save($where, ['user_id' => $userid, 'id' => $id]);
            }
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            $status = false;
        }
        return $status;
    }
    /**
     *
     * 删除订单
     */

    public function delete_Orders($id, $user_id)
    {
        // 启动事务
        Db::startTrans();
        try {
            $orderitemsModel = new OrderitemsModel();
            $orderitemsModel->delect_Orderitems($id);
            $status = $this->where('id', '=', $id)->where('user_id', '=', $user_id)->delete();
            Db::commit();
            return $status;
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return false;
        }
    }


    private function return_Orders_array($list,$total_amount)
    {


        $data = [
            'no' => $list['no'],
            'address' => $list['address'],
            'total_amount' => $total_amount,//订单总金额
            'remark' => $list['remark'],//订单备注
            'user_id' => $list['user_id']
        ];
        return $data;

    }

    /**
     * @param $id
     * @param $user_id
     * 获取订单详情
     */

    public function get_Orders_list_one($user_id, $id)
    {

        $data = $this->with('cart')->where('user_id', '=', $user_id)->where('id', '=', $id)->find();
        return $data;
    }

    /**
     * @param $user_id
     * 获取订单的list 列表
     *
     */
    public function get_Orders_list($user_id)
    {
        $data = $this->with('cart')->where('user_id', '=', $user_id)->select();
        return $data;
    }

    /**
     * @param $id
     * @param $user_id
     * 修改付款状态 支付成功修改
     */
    public function update_play($id, $data)
    {
        $status = $this->allowField(['paid_at', 'payment_method', 'IsPay'])->isUpdate($data, ['id' => $id]);
        return $status;
    }

    /**
     * @param $data
     * 修改物流状态
     * 商户修改物流状态
     *
     */
    public function update_ship_status($id, $data)
    {
        $status = $this->allowField(['ship_status', 'ship_type'])->isUpdate($data, ['id' => $id]);
        return $status;
    }

    public function get_orders($id){

       $data =  $this->field('id,user_id')->where('id','=',$id)->field();
       return $data;
    }

}