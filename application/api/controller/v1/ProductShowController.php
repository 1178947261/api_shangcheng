<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/13 0013
 * Time: 18:14
 */
namespace app\api\controller\v1;

use app\api\model\ProductShowModel;
use app\api\model\ProductsModel;
use think\Controller;
use think\Request;

class ProductShowController extends  Controller{
    use Basetrait;
    /**
     * 商品推荐——广告
     *
     */
    public function get_ProductShow_list(Request $request){
        $list = $request->param('','htmlspecialchars');
        $ProductShowModel = new ProductShowModel();
        $data = $ProductShowModel->get_ProductShow_list($list);
        return self::showReturnCode(200,$data);
    }
    /**
     *
     * 精选
     */
    public function get_Choiceness_show(Request $request){

        $list = $request->param('','htmlspecialchars');
        $ProductsModel=  new ProductsModel();
       $data= $ProductsModel->get_choiceness_show();
        return self::showReturnCode(200,$data);
    }

    /**
     * @param Request $request
     * @return array
     * 推荐
     */

    public function get_Recommend_show(Request $request){
        $list = $request->param('','htmlspecialchars');
        $ProductsModel=  new ProductsModel();
        $data= $ProductsModel->get_Recommend_show();
        return self::showReturnCode(200,$data);
    }

}
