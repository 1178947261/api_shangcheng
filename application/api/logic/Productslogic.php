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
            return self::showReturnCodeWithOutData('422', "发布失败", $validate->getError());
        }
        $Products = new \app\api\model\ProductsModel();
        $status = $Products->add_Products($list);
        if (!$status == 0) {
            return self::showReturnCodeWithOutData('201', "创建成功");
        } else {
            return self::showReturnCodeWithOutData('422', "发布失败");
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
     * 商家删除商品
     *
     */
    public function delect_Product($id,$user_id){
        if (empty($id)) {
            return self::showReturnCodeWithOutData('422', "删除失败_参数错误");
        }
        $Products = new \app\api\model\ProductsModel();
        $status= $Products->delete_Products($id,$user_id);
        if ($status) {
            return self::showReturnCodeWithOutData('201', "删除成功");
        } else {
            return self::showReturnCodeWithOutData('422', "删除失败");
        }
    }
    /**
     *
     * 商家修改商品
     */

    public function updata_Products($list,$user_id){
        $validate = new  \app\api\validate\ProductsValidate();
        $check=$validate->rule_s;
        if (!$validate->check($list,$check)) {
            return self::showReturnCodeWithOutData('422', "修改失败_参数错误", $validate->getError());
        }
        $Products = new \app\api\model\ProductsModel();
        $status= $Products->updata_Products($list,$user_id);
        if ($status) {
            return self::showReturnCodeWithOutData('201', "修改成功");
        } else {
            return self::showReturnCodeWithOutData('422', "修改失败");
        }

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

    /**
     * @param array $list
     * @return array
     * 商品检索
     */

    public function search_Products_list($list=[]){
        $Products = new \app\api\model\ProductsModel();
        $data =  $Products->search_Products_list($list);
        return self::showReturnCode('200',$data);
    }

    /**
     * @param $id
     * @return array
     * 下架商品
     */
    public function xiajiashangpin($id){
        $Products = new \app\api\model\ProductsModel();
        $data =  $Products->xiajiashangpin($id);
        return self::showReturnCode('200',$data);
    }

    /**
     * @param $user_id
     * @return string
     * 获取商品数量（订单数量、销售额、关注量）
     */
    public function shangpin_nums($user_id){
        $model = new \app\api\model\ProductsModel();
        $data = $model->shangpin_nums($user_id);
        $data['product_num']=$data;
        return self::showReturnCode('200',$data);
    }
}