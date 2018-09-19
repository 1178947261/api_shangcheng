<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:36
 */
namespace app\api\logic;
use app\api\controller\v1\Basetrait;
use app\api\model\OrderitemsModel;

class OrderitemsLogic
{
    use Basetrait;

    public function  add_comment($list){
          $ord = new   OrderitemsModel();
         $status=$ord->chek_comment($list['order_id']);
        if (!empty($status)){
            return self::showReturnCodeWithOutData('422', "发布评论失败_已经评价了");
        }
        $status=  $ord->add_comment($list);
        if ($status){
                return self::showReturnCodeWithOutData('201', "创建成功");
        }else{
            return self::showReturnCodeWithOutData('422', "发布评论失败");
        }


    }

    public function get_comment($product_id){
        $ord = new   OrderitemsModel();
         $return =$ord->get_comment($product_id);
        return self::showReturnCode('200',$return);

    }



}