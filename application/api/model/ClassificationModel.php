<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11 0011
 * Time: 16:11
 */
namespace app\api\model;
class ClassificationModel extends \app\api\base\model\Base{



    protected $pk = 'id';
    protected $table = 'classification';

    public function getClassification(){

       return $this->select();

    }



}