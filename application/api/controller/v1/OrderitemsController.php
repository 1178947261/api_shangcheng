<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:37
 */
namespace app\api\controller\v1;
use app\api\logic\OrderitemsLogic;
use app\api\model\OrderitemsModel;
use think\Controller;
use think\facade\Request;

class OrderitemsController extends Controller
{
    use Basetrait;

    /**
     * @param Request $request
     * @param OrderitemsModel $orderitemsModel
     * @return OrderitemsModel
     * 订单评论
     */
    public function add_comment(Request $request,OrderitemsLogic $orderitemsLogic){
        $chek =$this->is_cf();
        if ($chek==false){
            return self::showReturnCodeWithOutData('503',lang("FWQFM"));
        }
        $list=   $request::param("");
        return $orderitemsLogic->add_comment($list);
    }

    /**
     * @param Request $request
     *
     * 评论列表 暂定
     */
    public function get_comment_list(Request $request,OrderitemsLogic $orderitemsLogic){
            $products_id=$request::param('product_id');
            return $orderitemsLogic->get_comment($products_id);
    }



}