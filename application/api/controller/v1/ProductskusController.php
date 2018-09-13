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

    /**
     * @param Request $request
     * @return array
     * 添加商品小类sku
     */
    public function add_Productskus(Request $request){
        $user_id = $this->user_id;
        $list = $request->param('','htmlspecialchars');
        $list['user_id']=$user_id;
        $address = new \app\api\logic\Productskuslogic();
        $data = $address->add_Products($list);
        return $data;
    }

    /**
     * @param Request $request
     * 商户修改商品小类
     */
    public function update_Productskus(Request $request){



    }
    /**
     *
     * 商户删除商品小类
     */

    public function delect_Productskus(Request $request){



    }

}