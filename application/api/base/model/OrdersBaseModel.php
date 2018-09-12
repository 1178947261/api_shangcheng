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

class OrdersBaseModel extends Base
{


    public function getPaidatAttr($value, $data){
        if ($value==null){

        return 0;
        }
        return date('Y-m-d h:i:s', $value);
    }
    public function getPaymentmethodAttr($value, $data){
        if ($value){
            $get_data = ['HBC'=>'HBC支付','XCU'=>'XAU支付'];
            return isset($get_data[$value]) ? $get_data[$value] : '其他方式';
        }else{
            return $value;
        }

    }
    public function getShiptypeAttr($value){
        if ($value==null){
            return "未发货";
        }
        $get_data = ['SF'=>'顺丰快递','ZT'=>'中通快递','YT'=>'圆通','YZ'=>'邮政'];
        return $get_data[$value];
    }

    public function getIsPayAttr($value, $data){

        $get_data = ['0'=>'未付款','1'=>'已付款'];
        return $get_data[$value];
    }

}