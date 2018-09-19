<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 10:39
 */

namespace app\api\logic;

use app\api\controller\v1\Basetrait;
use app\api\model\UserAddressModel;
use app\api\validate\UserAddressValidate;

class UserAddresslogic
{

    use  Basetrait;
    public function add($list)
    {
        $validate = new  UserAddressValidate();
        if (!$validate->check($list)) {
            return self::showReturnCodeWithOutData('422', "创建失败", $validate->getError());
        }
        $UserAddress = new UserAddressModel();
        $status = $UserAddress->add_address($list);
        if (!$status == 0) {
            return self::showReturnCodeWithOutData('201', "创建成功");
        } else {
            return self::showReturnCodeWithOutData('422', "创建失败");
        }
    }
    public function up_date($list,$userid){
        $UserAddress = new UserAddressModel();
        $validate = new  UserAddressValidate();
        $check=$validate->scene_list;
        if (!$validate->check($list,$check)) {
            return self::showReturnCodeWithOutData('422', "修改失败", $validate->getError());
        }
        $status = $UserAddress->updata_address($list,$userid);
        if ($status) {
            return self::showReturnCodeWithOutData('201', "修改成功");
        } else {
            return self::showReturnCodeWithOutData('422', "修改失败");
        }

    }
    public function delete_data($id,$user_id){
        $UserAddress = new UserAddressModel();
        $status=  $UserAddress->delete_address($id,$user_id);
        if ($status) {
            return self::showReturnCodeWithOutData('201', "删除成功");
        } else {
            return self::showReturnCodeWithOutData('422', "删除失败");
        }
    }

    public function get_address($user_id){
        $UserAddress = new UserAddressModel();
         $data =  $UserAddress->get_address($user_id);
        return self::showReturnCode('200',$data);

    }


}