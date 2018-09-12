<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:36
 */

namespace app\api\model;
class OrderitemsModel extends \app\api\base\model\Base
{

    protected $table = 'order_items';


    /**
     * @param $list
     * @return int|string
     * 添加订单的小类
     */
    public function addOrderitems($list)
    {

        $OrderitemsModeL = $this->return_OrderitemsModel($list);
        $status = self::insertGetId($OrderitemsModeL);
        return $status;
    }

    private function return_OrderitemsModel($list)
    {

        $data = [
            'product_id' => $list['product_id'],
            'order_id' => $list['id'],//所属订单ID
            'price' => $list['price'],
            'amount' => $list['amount'],
        ];

        return $data;

    }

    /**
     * @param $id
     * @throws \Exception
     * 删除商品小类
     */
    public function delect_Orderitems($id)
    {
        $this->where('order_id', '=', $id)->delete();
    }

    /**
     * @param $id
     * @param $nums
     * @param $type
     * @throws \think\Exception
     * 更新商品数量
     */
    public function update_amount($id, $nums, $type)
    {
        if ($type == "add") {
            $this->where('order_id', '=', $id)->setInc('amount', $nums);
        } else {
            $this->where('order_id', '=', $id)->setDec('amount', $nums);

        }
    }


    /**
     * @param $data
     * 评论商品
     */
    public function add_comment($list, $userid)
    {
        $OrdersModel = new   OrdersModel();
        $data = $OrdersModel->get_orders($list['id']);
        $status = $this->allowField(['paid_at', 'payment_method', 'IsPay'])->isUpdate($data, ['id' => $id]);
        return $status;
    }


    /**
     * @param $product_id
     * 获取商品评论
     */
    public function get_comment($product_id){


    }

}


