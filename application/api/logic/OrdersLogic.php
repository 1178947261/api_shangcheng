<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:02
 */
namespace app\api\logic;
use app\api\controller\v1\Basetrait;

class OrdersLogic
{
    use Basetrait;
    public function add_Orders($list)
    {
//        $validate = new  \app\api\validate\ProductsValidate();
//        if (!$validate->check($list)) {
//            return self::showReturnCodeWithOutData('4003', "发布失败", $validate->getError());
//        }
        $Products = new \app\api\model\OrdersModel();
        $status = $Products->add_Orders($list);
        if (!$status == 0) {
            return self::showReturnCodeWithOutData('201', "创建成功");
        } else {
            return self::showReturnCodeWithOutData('4003', "发布失败");
        }
    }
}