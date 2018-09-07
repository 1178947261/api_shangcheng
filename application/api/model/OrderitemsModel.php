<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:36
 */

namespace app\api\model;
class OrderitemsModel extends  \app\api\base\model\Base
{

    protected $table = 'order_items';



    public function addOrderitems($list){

        $OrderitemsModeL  =$this->return_OrderitemsModel($list);
        $status=self::insertGetId($OrderitemsModeL);
        return $status;
    }
    private function return_OrderitemsModel($list){

        $data = [
            'product_id'=>$list['product_id'],
            'order_id'=>$list['id'],//所属订单ID
            'price'=>$list['price'],
            'amount'=>$list['amount'],
        ];

        return $data;

    }

    public function delect_Orderitems($id){
        $this->where('order_id','=',$id)->delete();
    }
}


