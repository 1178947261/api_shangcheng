<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 10:44
 */
namespace app\api\validate;

use think\Validate;

class  ProductsValidate extends Validate{


    protected $rule = [
        'title'  =>'require',
        'description'=>'require',
        'image'=>'require',
        'price'=>'require',
        'stock'=>'require',
        'user_id'=>'require',
        'classification'=>'require',
    ];
    public $rule_s =[
        'id'=>'require|integer'
    ];
    public $message =[


    ];

}