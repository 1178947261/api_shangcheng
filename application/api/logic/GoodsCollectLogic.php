<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 16:38
 */
namespace app\api\logic;
use app\api\controller\v1\Basetrait;

class GoodsCollectLogic
{
use Basetrait;

    public function add_Goodsconllect($list)
    {
        $validate = new  \app\api\validate\GoodsCollectValidate();
        if (!$validate->check($list)) {
            return self::showReturnCodeWithOutData('4003', "关注失败", $validate->getError());
        }
        if (!$validate->check_repetition($list)) {
            return self::showReturnCodeWithOutData('4003', "关注失败_重复关注", $validate->getError());
        }
        $Productcollect = new \app\api\model\GoodsCollectModel();
        $status = $Productcollect->add_Goodsconllect($list);
        if (!$status == 0) {
            return self::showReturnCodeWithOutData('201', "关注成功");
        } else {
            return self::showReturnCodeWithOutData('4003', "关注失败");
        }
    }

    public function delete_Goodsconllect($id,$user_id){
        $validate = new  \app\api\validate\GoodsCollectValidate();
        $list=[
            'user_id'=>$user_id,
            'id'=>$id
        ];
        if ($validate->check_repetition($list)) {
            return self::showReturnCodeWithOutData('4003', "取消关注失败", $validate->getError());
        }
        $Productcollect = new \app\api\model\GoodsCollectModel();
        $status=  $Productcollect->delete_Goodsconllect($id,$user_id);

        if ($status) {
            return self::showReturnCodeWithOutData('201', "取消关注成功");
        } else {
            return self::showReturnCodeWithOutData('4003', "取消关注失败");
        }
    }

    public function get_Goodsconllect($user_id){

        $Productcollect = new \app\api\model\GoodsCollectModel();
        $data =  $Productcollect->get_Goodsconllect($user_id);
        return self::showReturnCode('200',$data);

    }

}