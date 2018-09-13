<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 16:37
 */
namespace app\api\validate;


use app\api\model\GoodsCollectModel;
use think\Validate;

class  GoodsCollectValidate extends Validate{



    protected $rule = [
        'user_id'  =>'require',
        'goods_id'=>'require',
    ];
 

    // 自定义验证规则
    public function check_repetition ($data=[])
    {
         $chek =  GoodsCollectModel::is_chek($data);

         return $chek;
    }
}