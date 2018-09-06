<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/30 0030
 * Time: 15:57
 */
return [

    //上传目录
    'upload_path'=>'/upload',

    //上传图片文件路径
    'upload_images_path'=>'/upload/images',
    'upload_images_validate'=>[
        'size'=>1024*1024*5,
        'ext'=>'jpg,png,gif'
    ],

    "upload_files_path"=>'/upload/files',
    //存储上传图片文件的数据表名称
    'upload_files_validate'=>[
        'size'=>1024*1024*5,
        'ext'=>'doc,rar,7z'
    ],



];