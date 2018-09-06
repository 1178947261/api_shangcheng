<?php
namespace app\api\controller\v1;
use think\Controller;
/**
 * Created by PhpStorm.
 * Power by Mikkle
 * QQ:776329498
 * Date: 2017/4/12
 * Time: 13:28
 */
trait  Basetrait
{

    public $user_id=10;

    public function __construct()
    {

    }

    static public function showReturnCode($code = '', $data = [], $msg = '',$errors='')
    {
        $return_data = [
            'status_code' => '500', // 自定义的异常码
            'message' => '未定义消息',
            'data' => isset($data)?$data:'',
            'errors'=>$errors,

        ];
        if (empty($code)) return $return_data;
        $return_data['status_code'] = $code;
        if(!empty($msg)){
            $return_data['message'] = $msg;
        }else if (isset(self::$return_code[$code]) ) {
            $return_data['message'] = self::$return_code[$code];
        }
        return $return_data;
    }

    static public function showReturnCodeWithOutData($code = '', $msg = '')
    {
        return self::showReturnCode($code,[],$msg);

    }

    /**
     * 数据库字段 网页字段转换
     * @param $array 转化数组
     * @return 返回数据数组
     */
    public  function buildParam($array)
    {
        $data=[];
        if (is_array($array)){
            foreach( $array as $item=>$value ){
                $data[$item] = $this->request->param($value);

            }
        }
        return $data;
    }
    static public $return_code = [
        '200' => '操作成功',
        '201' => '创建成功', //非法的请求方式 非ajax
        '204' => '删除成功', //如参数不完整,类型不正确
        '400' => '无法解析', //未登录 或者 未授权
        '403' => '您无权访问,请登陆', ////非法的请求  无授权查看
        '415' => '内容类型是错误的', //
        '422' => '数据验证错误', //
    ];


    /**
     * 创建随机数
     * Power by Mikkle
     * QQ:776329498
     * @param int $num  随机数位数
     * @return string
     */
    static public function createRandNum($num=8){
        return substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, $num);
    }
    /*
    * 通过创建随机数
    */
    static public function createSerialNumberByName($name){
        return self::createSerialNumberByRedis(__FUNCTION__.$name);
    }

    /*
     * 通过前缀创建随机数
     */
    static public function createSerialNumberByPrefix($prefix){
        return ((string)$prefix).self::createSerialNumberByRedis(__FUNCTION__.$prefix);
    }



    static public function createSerialNumberByRedis( $num=24){
        if ((int)$num<24){
            $num = 24;
        }
        return  ((string)self::getTimeInt()).substr(((string) (1*pow(10,($num-14) )+Redis::instance()->incre("createSerialNumber") )) ,1);
    }

    static public function createNumberString( $length=10 ){
        $len=1;
        $prefix="1";
        return (string) (1*pow(10,($length-$len)) +Redis::instance()->incre("createNumberString_{$prefix}") );
    }

    static public function createNumberStringByPrefix( $prefix  ,$length=12 ){
        $len=strlen($prefix);
        $str = (string) (1*pow(10,($length-$len)) +Redis::instance()->incre("createNumberString_{$prefix}") );
        return  $prefix . substr($str,1);
    }


}