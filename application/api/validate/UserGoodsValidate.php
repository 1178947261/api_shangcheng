<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 10:44
 */
namespace app\api\validate;

use think\Validate;

class  UserGoodsValidate extends Validate{


    protected $rule = [
        'goods_title'  =>'require',
        'goods_synopsis'=>'require',
        'class_goods'=>'require',
    ];

}