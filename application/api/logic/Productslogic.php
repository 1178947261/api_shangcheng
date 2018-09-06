<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 16:35
 */
namespace app\api\logic;
use app\api\controller\v1\Basetrait;

class Productslogic
{

    use Basetrait;
    public function add_Products($list)
    {
        $validate = new  \app\api\validate\ProductsValidate();
        if (!$validate->check($list)) {
            return self::showReturnCodeWithOutData('4003', "发布失败", $validate->getError());
        }
        $Products = new \app\api\model\ProductsModel();
        $status = $Products->add_Products($list);
        if (!$status == 0) {
            return self::showReturnCodeWithOutData('201', "创建成功");
        } else {
            return self::showReturnCodeWithOutData('4003', "发布失败");
        }
    }

    /**
     * @param $user_id
     * @return array 店家获取自己商品
     */
    public function get_Product($user_id){
        $Products = new \app\api\model\ProductsModel();
        $data =  $Products->get_Products($user_id);
        return self::showReturnCode('200',$data);
    }
    /**
     * @param $user_id
     * @return array 获取商品列表
     */
    public function get_Product_list($list=[]){
        if (empty($list)){
            $Products = new \app\api\model\ProductsModel();
            $data =  $Products->get_Products_list();
        }else{
            $Products = new \app\api\model\ProductsModel();
            $data =  $Products->get_Products_list($list);
        }
        return self::showReturnCode('200',$data);
    }


    public function search_Products_list($list=[]){
        $Products = new \app\api\model\ProductsModel();
        $data =  $Products->search_Products_list($list);
        return self::showReturnCode('200',$data);
    }
}