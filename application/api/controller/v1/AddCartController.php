<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 15:58
 */
namespace app\api\controller\v1;
use app\api\logic\AddCartLogic;
use think\Controller;
use think\Request;

class AddCartController extends Controller
{
    use Basetrait;
    public function Add_Cart(Request $request){
        $chek =$this->is_cf();
        if ($chek==false){
            return self::showReturnCodeWithOutData('503',lang("FWQFM"));
        }
        $data = $request->param();
        $data['user_id'] = $this->user_id;
        $address = new AddCartLogic();
        return $address->add_Cart($data);
    }
    public function delete_Cart(Request $request){
        $user_id = $this->user_id;
        $id = $request->post('id');
        $address = new AddCartLogic();
        return $address->delete_Cart($id);
    }
    public function get_Cart(){
        $user_id = $this->user_id;
        $address = new AddCartLogic();
        $data = $address->get_Cart($user_id);
        return $data;
    }


}