<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/30 0030
 * Time: 11:13
 */
namespace app\api\base\model;
use think\Db;
use think\facade\Lang;
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
            return lang('WFH');
        }
        $get_data = ['SF'=>lang('SF'),'ZT'=>lang('ZT'),'YT'=>lang('YT'),'YZ'=>lang('YZ')];
        return $get_data[$value];
    }

    public function getIsPayAttr($value, $data){

        $get_data = ['0'=>\lang('WFK'),'1'=>lang('YFK')];
        return $get_data[$value];
    }

}