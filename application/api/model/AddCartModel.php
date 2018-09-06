<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:03
 */
namespace app\api\model;
class AddCartModel extends  \app\api\base\model\Base
{
    /**
     * @var string
     * 购物车
     */

    protected $pk = 'id';
    protected $table = 'cart_items';

    public function cart()
    {
        return $this->hasOne('ProductsModel','id','product_id');
    }
    /**
     * @param $list
     * @return int|string
     * 添加商品的
     */
    public  function add_Products_Cart($list){
        $status=self::insertGetId($list);
        return $status;
    }

    /**
     * @param $id
     * @return bool
     * @throws \Exception
     * 删除商品
     */

    public function delete_Products_Cart($id){
        $status = $this->where('id','=',$id)->delete();
        return $status;
    }

    /**
     * @param $user_id
     * 查看购物车
     */

    public function get_Products_Cart($user_id){
        $list = $this->with('cart')->where('user_id','=',$user_id)->paginate(10);
        return $list;
    }
    public function update_Products_Cart($where=[]){
        $status =$this->where($where)->setInc('amount');
        return $status;
    }
    public static function is_chek($data=[]){

        $chek = self::where($data)->find();
        if (empty($chek)){
            return false;
        }
        return true;
    }

}