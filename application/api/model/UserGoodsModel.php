<?php
namespace app\api\model;

class UserGoodsModel extends \app\api\base\model\Base
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'user_goods';
    protected $pk    = 'id';

    //设置商家资料
    public function addData($id, $goods_title, $goods_synopsis, $class_goods)
    {
        $where = [
            'user_id' => $id,
        ];

        $ziliao = [
            'goods_title'    => $goods_title, //店铺名字
            'goods_synopsis' => $goods_synopsis, //店铺的简介
            'class_goods'    => $class_goods, //商家分类
        ];

        $data = $this->save($ziliao, $where);

        return $data === false ? false : true;
    }

    //获取销售额、店铺的关注量
    public function getnumber($user_id)
    {
        $where = [
            'user_id' => $user_id,
        ];
        return $this->where($where)->find();
    }

    /**
     * 是否未商家
     *
     */
    public function is_chek($user_id){
        $chek = self::where('user_id','=',$user_id)->find();
        if (!empty($chek)){
            return false;
        }
        return true;
    }

    /**
     * 添加关注量
     *
     */

    static public function add_number_attention($user_id){

        self::where('user_id', $user_id)->setInc('number_attention');
    }
    /**
     * 添加number_goods
     *店铺的商品数量
     */

    static  public function add_number_goods($user_id){

        self::where('user_id', $user_id)->setInc('添加number_goods');
    }
    /**
     * 添加订单数
     *订单数
     */

    static  public function add_number_order($user_id){

        self::where('user_id', $user_id)->setInc('number_order');
    }

    /**
     * @param $user_id
     * @throws \think\Exception
     * 增加销售额
     */
    static public function add_number_amount($user_id){

        self::where('user_id', $user_id)->setInc('number_amount');
    }
    //减少

    /**
     * 减少关注量
     *
     */

    static  public function lower_number_attention($user_id){

        self::where('user_id', $user_id)->setDec('number_attention');
    }
    /**
     * 减少number_goods
     *店铺的商品数量
     */

    static  public function lower_number_goods($user_id){

        self::where('user_id', $user_id)->setDec('number_goods');
    }
    /**
     * 减少订单数
     *订单数
     */

    static  public function lower_number_order($user_id){

        self::where('user_id', $user_id)->setDec('number_order');
    }

    /**
     * @param $user_id
     * @throws \think\Exception
     * 减少销售额
     */
   static public function lower_number_amount($user_id){

       self::where('user_id', $user_id)->setDec('number_amount');
    }
}
