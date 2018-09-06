<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 16:03
 */
namespace app\api\model;
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
     * 添加商品的
     */
    public  function add_Products_Cart($list,OrderitemsModel $orderitemsModel){
        $list['on']=self::createRandNum(26);
        $status=self::insertGetId($list);
        return $status;
    }



    public function updateData($where)
    {
        return parent::updateData($where); // TODO: Change the autogenerated stub
    }
}