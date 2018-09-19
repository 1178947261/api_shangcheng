<?php

namespace app\api\logic;
use app\api\controller\v1\Basetrait;
use app\api\model\UserGoodsModel;

class UserGoodsLogic{

	//设置商家资料
	use Basetrait;
    public function addData($id, $param)
    {
        $validate = new  \app\api\validate\UserGoodsValidate();
        if (!$validate->check($param)) {
            return self::showReturnCodeWithOutData('422', "设置失败", $validate->getError());
        }
        $Products = new \app\api\model\UserGoodsModel();
        $status = $Products->addData($id, $param['goods_title'], $param['goods_synopsis'],$param['class_goods']);
        if (!$status == 0) {
            return self::showReturnCodeWithOutData('201', "设置成功");
        } else {
            return self::showReturnCodeWithOutData('422', "设置失败");
        }
    }

    //获取销售额
    public function numberAmount($user_id)
    {
        $model = new UserGoodsModel();
        $data  = $model->getnumber($user_id);
        $data['product_amount'] = $data['number_amount'];
        return self::showReturnCode('200',$data);
    }

    //获取店铺的关注量
    public function number_attention($user_id)
    {
        $model = new UserGoodsModel();
        $data  = $model->getnumber($user_id);
        $data['product_attention'] = $data['number_attention'];
        return self::showReturnCode('200',$data);
    }

}