<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 15:38
 */
namespace app\api\controller\v1;


use app\api\logic\Productskuslogic;
use app\api\logic\Productslogic;
use think\Controller;
use think\Request;
use think\Response;

class ProductskusController extends Controller {

    use Basetrait;

    /**
     * @param Request $request
     * @return array
     * 添加商品小类sku
     */
    public function add_Productskus(Request $request){
        $chek =$this->is_cf();
        if ($chek==false){
            return self::showReturnCodeWithOutData('503',lang("FWQFM"));
        }
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

            $user_id = $this->user_id;
            $Product = $request->param('');
            $Productslogic =  new Productskuslogic();
            return    $Productslogic->updata_Products($Product,$user_id);
    }
    /**
     *
     * 商户删除商品小类
     */

    public function delect_Productskus(Request $request){
        $user_id = $this->user_id;
        $product_sku_id = $request->param('product_sku_id');
        $id = $request->param('id');
        $Productskuslogic = new \app\api\logic\Productskuslogic();
        return  $Productskuslogic->delect_Products_sku($product_sku_id,$user_id,$id);

    }
    /**
     * 修改商户小类
     *
     */
    public function updata_Products_skus(Request $request){
        $user_id = $this->user_id;
        $Product = $request->param('');
        $Product['user_id']=$user_id;
        $Productslogic =  new Productskuslogic();
        return    $Productslogic->updata_Products_skus($Product);
    }


}