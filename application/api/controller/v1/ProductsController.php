<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 15:49
 */

namespace app\api\controller\v1;

use app\api\logic\Productslogic;
use app\api\model\ClassificationModel;
use think\Controller;
use think\Request;

class ProductsController extends Controller {
    use Basetrait;
    /**
     * 普通用户只有GET_Products
     *  获取商品列表
     */
    public function get_Products_list(Request $request){
        $list = $request->param('','htmlspecialchars');
        $address = new Productslogic();
        $data = $address->get_Product_list($list);
        return $data;
    }

    /**
     * @param Request $request
     * @return array
     * 商户添加商品
     */
    public function add_Products(Request $request){
        $user_id = $this->user_id;
        $list = $request->param('','htmlspecialchars');
        $list['user_id']=$user_id;
        $address = new Productslogic();
        $data = $address->add_Products($list);
        return $data;
    }

    /**
     * @param Request $request
     * 商户删除商品
     */
    public function delete_Products(Request $request){
        $user_id = $this->user_id;
        $Product_id = $request->param('product_id');
        $Productslogic =  new Productslogic();
          return  $Productslogic->delect_Product($Product_id,$user_id);

    }

    /**
     * @param Request $request
     * 商户获取自己的商品
     */
    public function get_Products_user(Request $request){
        $user_id = $this->user_id;
        $Productslogic =  new Productslogic();
        return $Productslogic->get_Product($user_id);

    }
    /**
     * @param Request $request
     *
     * 商户修改商品
     */
    public function update_Products(Request $request){
        $user_id = $this->user_id;
        $Product = $request->param('');
        $Productslogic =  new Productslogic();
        return    $Productslogic->updata_Products($Product,$user_id);

    }
    /**
     * 搜索商品
     */
    public function search_Products(Request $request){
        $list = $request->param('','htmlspecialchars');
        $address = new Productslogic();
        $data = $address->search_Products_list($list);
        return $data;

    }

    /**
     *
     * 返回商品分类列表
     */
    public function classification_Products(Request $request,ClassificationModel $classificationModel){
            $data =  $classificationModel->getClassification();
            return self::showReturnCode('200',$data);
    }
    /**
     * @param Request $request
     * @return mixed
     * 下架商品
     */
    public function xiajiashangpin(Request $request){
        // $id = $this->id;
        $id = 3;
        $xiajiashangpin = new Productslogic();
        return $xiajiashangpin->xiajiashangpin($id);
    }
    /**
     * @return mixed
     * 获取商品数量
     */
    public function shangpin_nums(){
        $user_id = $this->user_id;
        $shangpin_nums = new Productslogic();
        return $shangpin_nums->shangpin_nums($user_id);
    }


}