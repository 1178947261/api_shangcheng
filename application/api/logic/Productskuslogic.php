<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 16:35
 */
namespace app\api\logic;
use app\api\controller\v1\Basetrait;
use app\api\model\ProductsModel;

class Productskuslogic
{
    use Basetrait;

    public function add_Products($list)
    {
        $validate = new  \app\api\validate\ProductskusValidate();
        if (!$validate->check($list)) {
            return self::showReturnCodeWithOutData('422', "发布失败", $validate->getError());
        }
        if (!$validate->check_auth($list)) {
            return self::showReturnCodeWithOutData('422', "发布失败非法操作", $validate->getError());
        }
        $Products = new \app\api\model\ProductskusModel();
        $status = $Products->add_Products_skus($list);
        if (!$status == 0) {
            return self::showReturnCodeWithOutData('201', "创建成功");
        } else {
            return self::showReturnCodeWithOutData('422', "发布失败");
        }
    }
    public function delect_Products_sku($product_sku_id,$user_id,$id){
        if (empty($product_sku_id)) {
            return self::showReturnCodeWithOutData('422', "修改失败_参数错误");
        }
        $Products =new ProductsModel();
        $status= $Products::is_chek($user_id,$product_sku_id);
        if (!$status) {
            return self::showReturnCodeWithOutData('422', "修改失败非法操作");
        }
        $Products = new \app\api\model\ProductskusModel();
        $status= $Products->delete_Products_skus($id);
        if ($status) {
            return self::showReturnCodeWithOutData('201', "删除成功");
        } else {
            return self::showReturnCodeWithOutData('422', "删除失败");
        }
    }

    public function updata_Products_skus($list){
        $validate = new  \app\api\validate\ProductsValidate();
        $check=$validate->rule_s;
        if (!$validate->check($list,$check)) {
            return self::showReturnCodeWithOutData('422', "修改失败_参数错误", $validate->getError());
        }
        $Products =new ProductsModel();
        $status= $Products::is_chek($list['user_id'],$list['product_id']);
        if (!$status) {
            return self::showReturnCodeWithOutData('422', "修改失败非法操作", $validate->getError());
        }
        $Products_SKU = new \app\api\model\ProductskusModel();
        $status= $Products_SKU->updata_Products_skus($list);
        if ($status) {
            return self::showReturnCodeWithOutData('201', "修改成功");
        } else {
            return self::showReturnCodeWithOutData('422', "修改失败");
        }

    }



}