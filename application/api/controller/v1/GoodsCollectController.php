<?php

namespace app\api\controller\v1;

use app\api\model\UserGoodsModel;
use think\Controller;
use think\Request;
use app\api\logic\GoodsCollectLogic;
/**
 * Class GoodsCollectController
 * @package app\api\controller\v1
 *
 * 店铺关注
 */
class GoodsCollectController extends  Controller
{
    use Basetrait;
    /**
     * 显示资源列表
     * 我的店铺关注
     * @return \think\Response
     */
    public function get_GoodsCollect(){
        $user_id = $this->user_id;
        $address = new GoodsCollectLogic();
        $data = $address->get_Goodsconllect($user_id);

        return $data;
    }


    /**
     *  关注店铺
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function add_GoodsCollect(Request $request)
    {
        $chek =$this->is_cf();
        if ($chek==false){
            return self::showReturnCodeWithOutData('503',lang("FWQFM"));
        }
        $user_id = $this->user_id;
        $list = $request->param('','htmlspecialchars');
        $list['user_id']=$user_id;
        $address = new GoodsCollectLogic();
        $data = $address->add_Goodsconllect($list);
        return $data;
    }

    /**
     * 删除指定关注
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete_GoodsCollect(Request $request)
    {
        $user_id = $this->user_id;
        $id = $request->param('id','htmlspecialchars');
        $address = new GoodsCollectLogic();
        $data = $address->delete_Goodsconllect($id,$user_id);
        return $data;
    }
}
