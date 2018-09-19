<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/30 0030
 * Time: 11:55
 */
namespace app\api\base\model;

use think\Model;

abstract class Base extends Model
{

    static public function createRandNum($num=8){
        return substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, $num);
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

    static public function showReturnCodeWithOutData($code = '', $msg = '',$erros='')
    {
        return self::showReturnCode($code,[],$msg,$erros);

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
        '422' => '您无权访问,请登陆', ////非法的请求  无授权查看
        '415' => '内容类型是错误的', //
        '422' => '数据验证错误', //
    ];


}