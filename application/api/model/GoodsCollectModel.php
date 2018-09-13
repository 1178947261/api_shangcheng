<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 16:37
 */

namespace app\api\model;
class GoodsCollectModel extends  \app\api\base\model\Base {

    protected $table = 'user_goods_collect';


    public function add_Goodsconllect($list){
        $list['created_at']=time();
        $list['updated_at']=time();
        $status=$this->insertGetId($list);
        return $status;
    }

    public function delete_Goodsconllect($id,$user_id){
        $status = $this->where('id','=',$id)->where('user_id','=',$user_id)->delete();
        return $status;
    }

    public function get_Goodsconllect($user_id){
        $subQuery =   $this->table('user_goods')
            ->where('id', 'IN', function ($query) use($user_id){
                $query->table('user_goods_collect')->where('user_id','=',$user_id)->field('goods_id');
            })
            ->select();
        return $subQuery;
    }

    public static function is_chek($data=[]){
        $chek = self::where($data)->find();
        if (!empty($chek)){
            return false;
        }
        return true;
    }
}