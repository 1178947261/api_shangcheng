<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 10:28
 */
namespace app\api\model;
class UserAddressModel extends  \app\api\base\model\Base {
    // 设置当前模型对应的完整数据表名称
    protected $table = 'user_addresses';
    protected $pk = 'id';
    public function add_address($list){
        $list['create_time']=time();
        $list['update_time']=time();
        $status=$this->insertGetId($list);
        return $status;
    }
    public function updata_address($list,$userid){
       $status = $this->save($list,['user_id'=>$userid]);
       return $status;
    }
    public function delete_address($id,$user_id){
        $status = $this->where('id','=',$id)->where('user_id','=',$user_id)->delete();
        return $status;
    }
    public function get_address($user_id){
        $list = $this->where('user_id','=',$user_id)->paginate(10);
        return $list;
    }



}