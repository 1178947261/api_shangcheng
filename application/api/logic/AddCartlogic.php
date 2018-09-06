<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:02
 */
namespace app\api\logic;
use app\api\controller\v1\Basetrait;
use app\api\model\AddCartModel;
use app\api\validate\AddCartValidate;

class AddCartlogic extends \app\api\base\model\Base
{
    use Basetrait;


    public function add_Cart($list)
    {
        $validate = new  AddCartValidate();
        if (!$validate->check($list)) {
            return self::showReturnCodeWithOutData('4003', "加入失败", $validate->getError());
        }
        $UserAddress = new AddCartModel();
        if ($validate->check_auth($list)) {
           $status = $UserAddress->update_Products_Cart($list);
            if ($status == 1) {
                return self::showReturnCodeWithOutData('201', "加入成功");
            } else {
                return self::showReturnCodeWithOutData('4003', "加入失败");
            }
        }

        $status = $UserAddress->add_Products_Cart($list);
        if (!$status == 0) {
            return self::showReturnCodeWithOutData('201', "加入成功");
        } else {
            return self::showReturnCodeWithOutData('4003', "加入失败");
        }
    }

    public function delete_Cart($id){

        $UserAddress = new AddCartModel();
        $status=  $UserAddress->delete_Products_Cart($id);
        if ($status) {
            return self::showReturnCodeWithOutData('201', "删除成功");
        } else {
            return self::showReturnCodeWithOutData('4003', "删除失败");
        }
    }

    public function get_Cart($user_id){
        $UserAddress = new AddCartModel();
        $data =  $UserAddress->get_Products_Cart($user_id);
        return self::showReturnCode('200',$data);

    }


}