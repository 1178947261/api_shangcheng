<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 16:38
 */
namespace app\api\logic;
use app\api\controller\v1\Basetrait;

class Productcollectlogic
{
use Basetrait;

    public function add_Productcollect($list)
    {
        $validate = new  \app\api\validate\ProductcollectValidate();
        if (!$validate->check($list)) {
            return self::showReturnCodeWithOutData('4003', "收藏失败", $validate->getError());
        }
        if (!$validate->check_repetition($list)) {
            return self::showReturnCodeWithOutData('4003', "收藏失败_重复收藏", $validate->getError());
        }
        $Productcollect = new \app\api\model\ProductcollectModel();
        $status = $Productcollect->add_Productcollect($list);
        if (!$status == 0) {
            return self::showReturnCodeWithOutData('201', "收藏成功");
        } else {
            return self::showReturnCodeWithOutData('4003', "收藏失败");
        }
    }

    public function delete_Productcollect($id,$user_id){
        $validate = new  \app\api\validate\ProductcollectValidate();
        $list=[
            'user_id'=>$user_id,
            'id'=>$id
        ];
        if (!$validate->check_repetition($list)) {
            return self::showReturnCodeWithOutData('4003', "取消收藏失败", $validate->getError());
        }
        $Productcollect = new \app\api\model\ProductcollectModel();
        $status=  $Productcollect->delete_Productcollect($id,$user_id);

        if ($status) {
            return self::showReturnCodeWithOutData('201', "取消收藏成功");
        } else {
            return self::showReturnCodeWithOutData('4003', "取消收藏失败");
        }
    }

    public function get_Productcollect($user_id){

        $Productcollect = new \app\api\model\ProductcollectModel();
        $data =  $Productcollect->get_Productcollect($user_id);
        return self::showReturnCode('200',$data);

    }

}