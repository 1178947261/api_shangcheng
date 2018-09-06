<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 10:44
 */
namespace app\api\validate;

use think\Validate;

class  UserAddressValidate extends Validate{

    protected $rule = [
        'user_id'  =>'require',
        'province'=>'require',
        'city'=>'require',
        'address'=>'require',
        'zipcode'=>'require',
        'contact_name'=>'require',
        'contact_phone'=>'require',
    ];
    protected $message  =   [
        'name.require' => 'ID必须',
        'province.require' => '省不能为空',
        'city.require' => '市不能为空',
        'address.require' => '具体地址不能为空',
        'zipcode.require' => '邮编不能为空',
        'contact_name.require' => '联系人姓名不能为空',
        'contact_phone.require' => '联系电话不能为空',
    ];

    public $scene_list  = [
        'user_id'  =>'require',
        ];
}