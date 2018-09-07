<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 16:35
 */
namespace app\api\logic;
use app\api\controller\v1\Basetrait;

class Productskuslogic
{
    use Basetrait;

    public function add_Products($list)
    {
        $validate = new  \app\api\validate\ProductskusValidate();
        if (!$validate->check($list)) {
            return self::showReturnCodeWithOutData('4003', "发布失败", $validate->getError());
        }
        if (!$validate->check_auth($list)) {
            return self::showReturnCodeWithOutData('4003', "发布失败非法操作", $validate->getError());
        }
        $Products = new \app\api\model\ProductskusModel();
        $status = $Products->add_Products_skus($list);
        if (!$status == 0) {
            return self::showReturnCodeWithOutData('201', "创建成功");
        } else {
            return self::showReturnCodeWithOutData('4003', "发布失败");
        }
    }



}