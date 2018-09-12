<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:37
 */
namespace app\api\controller\v1;
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
    public function add_comment(Request $request,OrderitemsModel $orderitemsModel){
        $list=   $request::param("");
        return $orderitemsModel->add_comment($list,$this->user_id);
    }

    /**
     * @param Request $request
     *
     * 评论列表
     */
    public function get_comment_list(Request $request){



    }



}