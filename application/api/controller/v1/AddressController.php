<?php
namespace app\api\controller\v1;

use app\api\logic\UserAddresslogic;
use think\Controller;
use think\Request;
class AddressController extends  Controller{
    use Basetrait;
    /**
     * @param Request $request
     * @return array
     * 添加收货地址
     *
     */
    public function address_data(Request $request)
    {
        $chek =$this->is_cf();
        if ($chek==false){
            return self::showReturnCodeWithOutData('503',lang("FWQFM"));
        }
        $data = $request->param();
        $data['user_id'] = $this->user_id;
        $address = new UserAddresslogic();
        return $address->add($data);
    }

    /**
     * @param Request $request
     * @return array
     * 修改收货地址
     */
    public function update_address(Request $request){
        $chek =$this->is_cf();
        if ($chek==false){
            return self::showReturnCodeWithOutData('503',lang("FWQFM"));
        }
        $data = $request->param('','htmlspecialchars');
        $data['user_id'] = $this->user_id;
        $address = new UserAddresslogic();
        return $address->up_date($data,$this->user_id);
    }

    public function delete_address(Request $request){
         $user_id = $this->user_id;
        $id = $request->post('id');
        $address = new UserAddresslogic();
        return $address->delete_data($id,$user_id);
    }
    public function get_address(){
        $user_id = $this->user_id;
        $address = new UserAddresslogic();
        $data = $address->get_address($user_id);
        return $data;
    }


}