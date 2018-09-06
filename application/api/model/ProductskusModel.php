<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5 0005
 * Time: 14:10
 */
namespace app\api\model;
class ProductskusModel extends  \app\api\base\model\Base {

    protected $table = 'product_skus';


    /**
     * @param $list
     * @return int|string
     * 添加商品的小类
     */
    public  function add_Products_skus($list){
        $data=[
            'title_sku'=>$list['title_sku'],
            'description_sku'=>$list['description_sku'],
            'stock_sku'=>$list['stock_sku'],
            'price_sku'=>$list['price_sku'],
            'product_id'=>$list['product_id'],
        ];
        $status=self::insertGetId($data);
        return $status;
    }

    /**
     * @param $id
     * @return bool
     * @throws \Exception
     * 删除商品小类
     */

    public function delete_Products_skus($id){
        $status = $this->where('id','=',$id)->delete();
        return $status;
    }
}