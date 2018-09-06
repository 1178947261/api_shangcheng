<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/30 0030
 * Time: 11:13
 */
namespace app\api\base\model;
use think\Db;
use think\Model;

class Orders extends Base
{
    protected $table = "my_orders";
    protected $pk = "id";
    public function getDistributeAttr($value, $data){
        $get_data = ['SF'=>'顺丰快递','ZT'=>'中通快递','YT'=>'圆通','YZ'=>'邮政'];
        return $get_data[$value];
    }
    public function getPaid_atAttr($value, $data){
        return date('Y-m-d h:i:s', $value);
    }
    public function getPayment_MethodAttr($value, $data){
        if ($value){
            $get_data = ['HBC'=>'HBC支付','XCU'=>'XAU支付'];
            return isset($get_data[$value]) ? $get_data[$value] : '其他方式';
        }else{
            return $value;
        }

    }
    public function getIsPayTextAttr($value, $data){
        $get_data = ['0'=>'未付款','1'=>'已付款'];
        return $get_data[$data['is_pay']];
    }

}