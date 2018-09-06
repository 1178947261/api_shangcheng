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
        $status = $this->save($list,['user_id'=>$userid]);
        return $status;
    }
    public function delete_Products($id,$user_id){
        $status = $this->where('id','=',$id)->where('user_id','=',$user_id)->delete();
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

}