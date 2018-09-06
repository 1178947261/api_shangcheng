<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 15:38
 */
namespace app\api\controller\v1;


use think\Controller;
use think\Request;

class ProductskusController extends Controller {

    use Basetrait;
    public function add_Productskus(Request $request){
        $user_id = $this->user_id;
        $list = $request->param('','htmlspecialchars');
        $list['user_id']=$user_id;
        $address = new \app\api\logic\Productskuslogic();
        $data = $address->add_Products($list);
        return $data;
    }

}