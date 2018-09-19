<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 16:34
 */
namespace app\api\model;
class ProductsModel extends  \app\api\base\model\Base {



    // 设置当前模型对应的完整数据表名称
    protected $table = 'products';
    protected $pk = 'id';

    public function profile()
    {
        return $this->hasMany('ProductskusModel','product_id');
    }

    public function add_Products($list){
        $list_Array=$this->add_array($list);
        $status=$this->insertGetId($list_Array);
        $list['product_id']=$status;
        UserGoodsModel::add_number_goods($list['user_id']); //增加商品数量
        return $status;
    }
    public function add_array($list){
        $data=[
            'title'=>$list['title'],
            'description'=>$list['description'],
            'image'=>$list['image'],
            'price'=>$list['price'],
            'stock'=>$list['stock'],
            'user_id'=>$list['user_id'],
            'classification'=>$list['classification'],
            'create_time'=>time(),
            'update_time'=>time()
        ];
        return $data;
    }

    public function updata_Products($list,$userid){
        //限制更新字段
        $status = $this->allowField(['title','description','image','show_image','classification','stock','price'])->save($list,['user_id'=>$userid]);
        return $status;
    }

    /**
     * @param $id
     * @param $user_id
     * @return bool
     * @throws \think\exception\PDOException
     * 删除商品大类
     */
    public function delete_Products($id,$user_id){
        $this->startTrans();
        try {
         $status = $this->where('id','=',$id)->where('user_id','=',$user_id)->delete();
         $products = new  ProductskusModel();
         $products->delete_Products_skus($id);
            $this->commit();
        } catch (\Exception $e) {
            // 回滚事务
            $this->rollback();
        }
        UserGoodsModel::lower_number_goods($user_id);
        return $status;
    }
    public function get_Products($user_id){
        $list = $this->where('user_id','=',$user_id)->paginate(10);
        return $list;
    }

    /**
     * @param $user_id
     * @return \think\Paginator
     * @throws \think\exception\DbException
     * 所有人获取商品列表
     */
    public function get_Products_list($list=[]){
        $where =[
            'on_sale'=>1
        ];
        if (empty($list)){
            $list = $this->with('profile')->where($where)->paginate(10);
        }else{
            if (empty($list['order'])){
                if (!empty($list['type'])){
                    $list = $this->with('profile')->where($where)->where('classification','=',$list['type'])->paginate(10);
                }
            }else{
                if (!empty($list['type'])){
                    $order =$list['order'];
                    $sort = $list['sort'];
                    $list = $this->with('profile')->where($where)->where('classification','=',$list['type'])->order($order,$sort)->paginate(10);
                }else{

                    $list = $this->with('profile')->where($where)->group('classification')->paginate(10);
                }


            }
        }
        return $list;
    }

    public function search_Products_list($list=[]){
        $search = $list['title'];
        $list = $this->whereLike('title',"%$search%")->paginate(10);
        return $list;
    }

    public  static  function is_chek($userid,$Products_id){
        $data = [

            'user_id'=>$userid,
            'id'=>$Products_id
        ];
        $chek = self::where($data)->find();
        if (empty($chek)){
            return false;
        }
        return true;

    }
    /**
     * 减少库存
     */
    public function reduce_stock_Products($id,$sku_id){
        $this->where('id',$id)->lock(true)->find();
        $is_num['stock']= $this->where('id',$id)->field('stock')->find()->toArray();
        if ($is_num['stock']['stock'] > 0){
            $this->where('id', $id)->setDec('stock', 1);
            $ProductskusModel=new ProductskusModel();
           $boole= $ProductskusModel->reduce_stock_Products_sku($sku_id);
           return $boole;
        }else{
            return false;
        }

    }

    /**
     * @param $id
     * @return bool
     *  下架商品
     */

    public function xiajiashangpin($id)
    {
        $where   = [
            'id'      => $id,
        ];
        $on_sale = 2;
        $data = [
            'on_sale' => $on_sale,
        ];
        $s = $this -> where($where)->update($data);
        return $s === false ? false : true;

    }
    /**
     * @param $user_id
     * @return float|string
     * 获取商品数量
     */
    public function shangpin_nums($user_id)
    {
        $where = [
            'user_id' => $user_id,
        ];
        return $this->where($where)->count('user_id');
    }
    /**
     *
     *
     */
    public function get_choiceness_show(){
        $data = $this->where('choiceness','=',1)->order('id','desc')->paginate(5);
        return $data;
    }

    public function get_Recommend_show()
    {
        $data = $this->where('recommend','=',1)->order('id','desc')->paginate(5);
        return $data;

    }
}