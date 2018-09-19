<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 16:37
 */

namespace app\api\model;
class ProductcollectModel extends  \app\api\base\model\Base {

    protected $table = 'user_product_collect';


    public function add_Productcollect($list){
        $list['created_at']=time();
        $list['updated_at']=time();
        $status=$this->insertGetId($list);
        return $status;
    }

    public function delete_Productcollect($id,$user_id){
        $status = $this->where('id','=',$id)->where('user_id','=',$user_id)->delete();
        return $status;
    }

    public function get_Productcollect($user_id){
        $subQuery =   $this->table('products')
            ->where('id', 'IN', function ($query) use($user_id){
                $query->table('user_product_collect')->where('user_id','=',$user_id)->field('goods_id');
            })
            ->paginate();
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