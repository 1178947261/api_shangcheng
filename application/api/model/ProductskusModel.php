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
        $status =  $this->where('id','=',$id)->delete();
        return $status;
    }

    /**
     *
     * 获取商品价格
     */
    public function get_price($Products_id){
        $data = $this->where('product_id','=',$Products_id)->find();
        return $data['price_sku'];
    }
    /**
     *
     *修改小类
     */
    public function updata_Products_skus($list,$userid){

        //限制更新字段
        $status = $this->allowField(['title_sku','description_sku','price_sku','stock_sku','image_sku','price_old','config'])->save($list,['id'=>$list['id']]);
        return $status;
    }
    /**
     * 减少库存
     */
    public function reduce_stock_Products_sku($sku_id){
        $this->where('id',$sku_id)->lock(true)->find();
        $is_num['stock_sku'] = $this->where('id',$sku_id)->field('stock_sku')->find()->toArray();
        if ($is_num['stock_sku']['stock_sku'] >0){
            $this->where('id', $sku_id)->setDec('stock_sku', 1);
            return true;
        }else{
            return false;
        }
    }

}