<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 10:44
 */
namespace app\api\validate;
use app\api\model\ProductsModel;
use think\Validate;

class  ProductskusValidate extends Validate{


    protected $rule = [
        'title_sku'  =>'require',
        'description_sku'=>'require',
        'price_sku'=>'require',
        'stock_sku'=>'require',
        'product_id'=>'require',
    ];

    // 自定义验证规则
    public function check_auth ($data=[])
    {
        $chek =  ProductsModel::is_chek($data['user_id'],$data['product_id']);
        return $chek;
    }

}