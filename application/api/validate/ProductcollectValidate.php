<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 16:37
 */
namespace app\api\validate;

use app\api\model\ProductcollectModel;
use think\Validate;

class  ProductcollectValidate extends Validate{



    protected $rule = [
        'user_id'  =>'require',
        'product_id'=>'require',
    ];
 

    // 自定义验证规则
    public function check_repetition ($data=[])
    {
         $chek =  ProductcollectModel::is_chek($data);
         return $chek;
    }
}