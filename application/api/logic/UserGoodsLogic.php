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
            return self::showReturnCodeWithOutData('403', "设置失败", $validate->getError());
        }
        $Products = new \app\api\model\UserGoodsModel();
        $status = $Products->addData($id, $param['goods_title'], $param['goods_synopsis'],$param['class_goods']);
        if (!$status == 0) {
            return self::showReturnCodeWithOutData('201', "设置成功");
        } else {
            return self::showReturnCodeWithOutData('403', "设置失败");
        }
    }

    //获取销售额
    public function numberAmount($user_id)
    {
        $model = new UserGoodsModel();
        $data  = $model->getnumber($user_id);
        #var_dump($data); number_attention
        if(!empty($data['number_amount']))
        {
            return $data['number_amount'];
        } else {
            return '暂无销售额';
        }
    }

    //获取店铺的关注量
    public function number_attention($user_id)
    {
        $model = new UserGoodsModel();
        $data  = $model->getnumber($user_id);
        if(!empty($data['number_attention']))
        {
            return $data['number_attention'];
        } else {
            return '暂无关注量';
        }
    }

}