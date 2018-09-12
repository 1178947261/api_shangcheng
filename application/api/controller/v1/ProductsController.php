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
    public function add_Products(Request $request){
        $user_id = $this->user_id;
        $list = $request->param('','htmlspecialchars');
        $list['user_id']=$user_id;
        $address = new Productslogic();
        $data = $address->add_Products($list);
        return $data;
    }
    public function delete_Products(){


    }


    public function update_Products(){


    }
    /**
     * 搜索
     */
    public function search_Products(Request $request){
        $list = $request->param('','htmlspecialchars');
        $address = new Productslogic();
        $data = $address->search_Products_list($list);
        return $data;

    }

    /**
     *
     * 返回分类列表
     */
    public function classification_Products(Request $request,ClassificationModel $classificationModel){
            $data =  $classificationModel->getClassification();
            return self::showReturnCode('200',$data);
    }


}