<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/13 0013
 * Time: 18:17
 */

namespace app\api\model;


use think\Model;

class ProductShowModel extends  Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'product_show';
    protected $pk    = 'id';


    public function get_ProductShow_list(){
       $data = $this->order('product_sort','desc')->paginate(3);
       return $data;
    }



}