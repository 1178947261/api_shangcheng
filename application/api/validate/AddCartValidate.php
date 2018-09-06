<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:03
 */

namespace app\api\validate;
use app\api\model\AddCartModel;
use think\Validate;

class  AddCartValidate extends Validate{


    protected $rule = [
        'user_id'  =>'require',
        'product_id'=>'require',
    ];
    // 自定义验证规则
    public function check_auth ($data=[])
    {
        $chek =  AddCartModel::is_chek($data);
        return $chek;
    }

}