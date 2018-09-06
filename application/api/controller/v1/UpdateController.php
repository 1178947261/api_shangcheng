<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/30 0030
 * Time: 15:49
 */

namespace app\api\controller\v1;
use think\Controller;
use think\facade\Config;
use think\Db;
use think\File;



class UpdateController extends Controller
{
    use Basetrait;
     public function uploadBase64($base64,$route=true){
        $aData = $base64 ?: 'no pic';
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $aData, $matches)) {
            $base64 = substr(strstr($aData, ','), 1);
            empty($aExt) && $aExt = $matches[2];
            if (!in_array($aExt, array('jpg', 'gif', 'png', 'jpeg'))){
                return self::showReturnCode(1003, '非法操作,上传照片格式不符。');
            }
        } else {
            $base64 = $aData;
        }

        $im = base64_decode($base64);
        if (empty($im) || strpos($im, '<?php') !== false) return self::showReturnCode(1003, '非法操作,上传照片格式不符。');
        $file_hash_md5 = md5($im);
        $file_hash_sha1 = sha1($im);
        $return=[
            "status_code"=>200,
            "message"=>"图片上传成功",
        ];
        $data['name'] = "image_".date("Ymdhisa", time())."_".self::createRandNum(6).".png";
        $data['path'] = self::getSavePath("images",false).DIRECTORY_SEPARATOR.$data['name'] ;
        $data['path'] = str_replace('\\', '/', $data['path']);
        $data['sha1'] = $file_hash_sha1;
        $data['size'] = strlen($im);
        $data['type'] = 'local';
        $data['create_time'] = time();
        $data['width'] = 0;
        $data['height'] = 0;
        $rs = file_put_contents(self::getSavePath("images").DIRECTORY_SEPARATOR.$data['name'] , $im);
        if(!$rs){
            return self::showReturnCode(1009, '保存文件失败');
        }
        $return['data']['path'] ="upload/".date("Y-m-d",time())."/".$data['name'];
        return $return;

    }
    /**
     * @param string $save_path
     * @param bool|true $is_record
     * @param array $rule
     * @param bool|true $route
     * @return array
     */
    static public function uploadPicture(File $file,$save_path="",$is_record=true ,$rule=[],$route=true) {

        $file_hash_md5 = $file->hash("md5");
        $file_hash_sha1 = $file->hash("sha1");
        $return=[
            "code"=>1001,
            "data"=>[
                "md5"=>$file_hash_md5,
            ],
            "msg"=>"图片上传成功",
        ];
        $save_path = self::getSavePath("images");
        $validate_rule = $rule ? $rule : Config::get("upload.upload_images_validate");
        $info = $file->validate($validate_rule)->move($save_path);

        if ( $info ) {
            $oinfo = $info->getInfo();
            $data['name'] = $oinfo['name'];
            $data['path'] = self::getSavePath("images",false).DIRECTORY_SEPARATOR.$info->getSaveName();
            $data['path'] = str_replace('\\', '/', $data['path']);
            $data['md5'] = $file_hash_md5;
            $data['sha1'] = $file_hash_sha1;
            $data['size'] = $oinfo['size'];
            $data['type'] = 'local';
            $data['create_time'] = time();
            $data['width'] = 0;
            $data['height'] = 0;
                if($route){
                    $return['data']['path'] = self::getRouteUrl($file_hash_md5,"images");
                }else{
                    $return['data']['path'] = $data['path'];
                }
                $return['data']['type'] = "images" ;
        } else {
            $return['code'] = 1040;
            $return['msg'] = $file->getError();
        }
        return $return;
    }

    /**
     * @param string $save_path
     * @param bool|true $is_record
     * @param array $rule
     * @return array
     */
    static public function uploadFile(File $file,$save_path="",$is_record=true,$rule=[],$route=true ) {
        $return=[
            "status_code"=>1001,
            "data"=>"",
            "message"=>"文件上传成功",
        ];


        $file_hash_sha1 = $file->hash("sha1");
        //判断数据库中是否存在

        $save_path = self::getSavePath("files");
        $validate_rule = $validate_rule = $rule ? $rule : Config::get("upload.upload_files_validate");
        $info = $file->validate($validate_rule)->move($save_path);
        if ($info) {
            $oinfo = $info->getInfo();

            $data['name'] = $oinfo['name'];

            $data['path'] = self::getSavePath("files", false) . DIRECTORY_SEPARATOR . $info->getSaveName();
            $data['path'] = str_replace('\\', '/', $data['path']);
            $data['sha1'] = $file_hash_sha1;
            $data['size'] = $oinfo['size'];
            $data['type'] = 'local';
            $data['create_time'] = time();
            if($route){
                    $return['data']['path'] = self::getRouteUrl($file_hash_sha1,"files");
            }else{
                    $return['data']['path'] = $data['path'];
                }
                $return['data']['type'] = "files" ;

        } else {
            $return['status_code'] = 1040;
            $return['message'] = $file->getError();
        }
        return $return;
    }
    /**
     * 获取保存路径
     * @param $type
     * @param bool $absolute_path
     * @param bool $date 是否按日期存放
     * @return string
     */
    static public function getSavePath($type,$absolute_path=true,$date=true){
        $root_path =$_SERVER['DOCUMENT_ROOT']."/tp5/public/";
        switch($type){
            case "images":
                $config_save_path = Config::get("upload.upload_images_path");
                if (!isset($save_path) && $config_save_path) {
                    $save_path = "{$root_path}{$config_save_path}";
                } elseif (!isset($save_path) && !$config_save_path) {
                    $save_path = "{$root_path}/upload/images";
                } else {
                    $save_path = "{$root_path}{$save_path}";
                }
                break;

            case "files":
                $config_save_path = Config::get("upload.upload_files_path");
                if (!isset($save_path) && $config_save_path) {
                    $save_path = "{$root_path}{$config_save_path}";
                } elseif (!isset($save_path) && !$config_save_path) {
                    $save_path = "{$root_path}/upload/files";
                } else {
                    $save_path = "{$root_path}{$save_path}";
                }
                break;
            default :
                $save_path = "{$root_path}/upload/others";
        }
        if ($date){
            $save_path=$save_path.date("Y-m-d",time());

        }
        if($absolute_path&&!is_dir($save_path)){
            @mkdir($save_path,0755,true);
        }
        return $save_path;
    }

    static public function getRouteUrl($md5,$type,$width=480,$height=600){
        switch($type){
            case "images":
                $save_path = "/upload/show_images/$md5/{$width}_{$height}";
                break;
            case "files":
                $save_path = "/upload/down_files/$md5";
                break;
            default :
                $save_path = "/upload/down_others/$md5";
        }
        return $save_path;
    }

    static public function getDownLoadUrl($md5,$type,$width=0,$height=0){
        switch($type){
            case "images":
                if($width>0&&$height>0){
                    $save_path = "/upload/down_images/$md5/{$width}_{$height}";
                }else{
                    $save_path = "/upload/down_images/$md5";
                }
                break;
            case "files":
                $save_path = "/upload/down_files/$md5";
                break;
            default :
                $save_path = "/upload/down_others/$md5";
        }

        return $save_path;
    }
}