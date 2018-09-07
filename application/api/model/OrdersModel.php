<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:03
 */
namespace app\api\model;
use think\Db;

class OrdersModel extends  \app\api\base\model\Base
{


    protected $pk = 'id';
    protected $table = 'orders';

    public function cart()
    {
        return $this->hasOne('OrderitemsModel','id','order_id');
    }




    /**
     * @param $list
     * @return int|string
     * 创建订单
     */
    public  function add_Orders($list){
        // 启动事务
       Db::startTrans();
       try{
           $orderitemsModel=new OrderitemsModel();
            $list['no']=self::createRandNum(13);//
             $data = $this->return_Orders_array($list);
            $status=self::insertGetId($data);
             $list['id']=$status;
            $orderitemsModel->addOrderitems($list);
            Db::commit();
       } catch (\Exception $e) {
            // 回滚事务
           Db::rollback();
           $status=false;
      }
        return $status;
    }
    /**
     * @param mixed $where
     * @return bool|void
     *
     * 修改订单
     */
    public function update_Orders($where,$id,$userid)
    {
        if ($where['amount']){


        }


        $status = $this->save($where,['user_id'=>$userid,'id'=>$id]);
        return $status;
    }

    /**
     *
     * 删除订单
     */

    public function delete_Orders($id,$user_id)
    {
        // 启动事务
        Db::startTrans();
        try{
        $orderitemsModel=new OrderitemsModel();
        $orderitemsModel->delect_Orderitems($id);
        $status = $this->where('id','=',$id)->where('user_id','=',$user_id)->delete();
        Db::commit();
        return $status;
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return false;
        }
    }


    private function return_Orders_array($list){
        $data = [
            'no'=>$list['no'],
            'address'=>$list['address'],
            'total_amount'=>$list['total_amount'],//订单总金额
            'remark'=>$list['remark'],//订单备注
            'user_id'=>$list['user_id']
        ];
        return $data;

    }
}