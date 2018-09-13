<?php
namespace app\api\model;
use think\Db;

class MoneyLogModel extends  \app\api\base\model\Base
{
	 
	// 设置当前模型对应的完整数据表名称
    protected $table = 'money_log';
    protected $pk = 'id';


    //我的账单
    public function get_bill($user_id){
    	$where = [
    		'user_id' => $user_id,
    	];
    	$bill = $this->where($where)->paginate(10);
        return $bill;
    }



}