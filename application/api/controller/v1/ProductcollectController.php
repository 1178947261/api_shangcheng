<?php

namespace app\api\controller\v1;

use think\Controller;
use think\Request;
use app\api\logic\Productcollectlogic;
/**
 * Class ProductcollectController
 * @package app\api\controller\v1
 *
 * 商品收藏
 */
class ProductcollectController extends  Controller
{
    use Basetrait;
    /**
     * 显示资源列表
     * 我的商品收藏
     * @return \think\Response
     */
    public function get_Productcollect(){
        $user_id = $this->user_id;
        $address = new Productcollectlogic();
        $data = $address->get_Productcollect($user_id);
        return $data;
    }


    /**
     *  收藏商品
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function add_Productcollect(Request $request)
    {
        $chek =$this->is_cf();
        if ($chek==false){
            return self::showReturnCodeWithOutData('503',lang("FWQFM"));
        }
        $user_id = $this->user_id;
        $list = $request->param('','htmlspecialchars');
        $list['user_id']=$user_id;
        $address = new Productcollectlogic();
        $data = $address->add_Productcollect($list);
        return $data;
    }

    /**
     * 删除指定收藏
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete_Productcollect(Request $request)
    {
        $user_id = $this->user_id;
        $id = $request->param('id','htmlspecialchars');
        $address = new Productcollectlogic();
        $data = $address->delete_Productcollect($id,$user_id);
        return $data;
    }
}
