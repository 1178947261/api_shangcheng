<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/30 0030
 * Time: 11:52
 */

namespace app\api\base\model;
use think\Db;
use think\Exception;
use think\Log;
use think\Session;

abstract class BaseModel extends Base
{
    protected $versionField = "edit_version";

    /**
     * 带有乐观锁的修改
     * Power: Mikkle
     * Email：776329498@qq.com
     * @param $save_data　　　修改的数据
     * @param string $edit_pk  修改的ＩＤ字段名称
     * @param string $version_field　　乐观锁版本号字段名称
     * @return array
     */
    public function editDateWithLock($save_data,$edit_pk="",$version_field=""){
        if (empty($version_field)){
            $version_field = isset($this->versionField) ? $this->versionField : "edit_version";
        }
        if (empty($edit_pk)){
            $edit_pk = isset($this->editPk) ? $this->editPk : $this->getPk();
        }
        //判断PK字段是否存在
        if (!isset($save_data[$edit_pk])||!isset($save_data[$version_field])){
            return self::showReturnCodeWithOutData(1003,"参数缺失");
        }else{
            //设置升级检索条件 PK和版本号
            $map[$edit_pk] = $save_data[$edit_pk];
            $map[$version_field] = $save_data[$version_field];
            //剔除PK
            unset($save_data[$edit_pk]);
        }
        try{
            //检测版本字段
            if($this->hasColumn($version_field)){
                throw new Exception("乐观锁版本字段[$version_field]不存在");
            }
            $original_data = $this->where($map)->find();
            if (empty($original_data)){
                throw new Exception("此条信息已经变动了,请重新操作!");
            }
            foreach ($save_data as $item=>$value){
                if (isset($original_data[$item])){
                    //修改的数值不变时候 剔除
                    if ($original_data[$item]==$value){
                        unset( $save_data[$item]);
                    }elseif($item!=$version_field){
                        unset( $original_data[$item]);
                    }
                }else{
                    //修改的字段不存在 剔除
                    unset( $save_data[$item]);
                }
            }
            if(empty($save_data)){
                throw new Exception("修改的数值无变化");
            }
            //版本号升级
            $save_data[$version_field]=(int)$original_data[$version_field]+1;
            if (1!=$this->allowField(true)->save($save_data,$map)){
                throw new Exception("修改信息出错:".$this->getError());
            }
            //记录修改日志
            $this->saveEditLog($original_data,$save_data);
            return self::showReturnCodeWithOutData(1001);
        }catch (Exception $e){
            $msg=$e->getMessage();
            return self::showReturnCodeWithOutData(1003,$msg);
        }
    }
    /**
     * 判断字段是否存在
     * @param $column
     * @param string $table
     * @return bool
     */
    protected function hasColumn($column,$table=""){
        $table = isset($table)?$table:$this->table;
        if (empty($table)||$column){
            $this->error="hasColumn方法参数缺失";
            return false;
        }
        $sql = "SELECT * FROM information_schema.columns WHERE table_schema=CurrentDatabase AND table_name = '{$table}' AND column_name = '{$column}'";
        return $this->query($sql) ? true : false;
    }
    /**
     * 保存修改信息
     * @param $original_data
     * @param $save_data
     * @return bool
     */
    protected function saveEditLog($original_data, $save_data)
    {
        if (empty($original_data) && empty($save_data)) {
            $this->error = "保存的修改信息不存在";
            return false;
        }
        $log_data = [
            "model_data" => $this->name,
            "original_data" => $original_data,
            "save_data" => $save_data,
            "update_time" => time(),
        ];
        try {
            Db::table("update_log")->insert($log_data);
            return true;
        } catch (Exception $e) {
            $log_data["error"] = "保存修改信息出错";
            Log::write(json_encode($log_data), "error");
            return false;
        }
    }
    /**
     * 根据有Id修改信息 无Id 新增信息
     * #Date:
     * @param $data
     * @return false|int|string
     * @throws
     */
    public function editData($data){
        if (isset($data['id'])){
            if (is_numeric($data['id']) && $data['id']>0){
                $save = $this->allowField(true)->save($data,[ 'id' => $data['id']]);
            }else{
                $save  = $this->allowField(true)->save($data);
            }
        }else{
            $save  = $this->allowField(true)->save($data);
        }
        if ( $save == 0 || $save == false) {
            $res=[  'code'=> 500,  'msg' => '数据更新失败', ];
        }else{
            $res=[  'code'=> 200,  'msg' => '数据更新成功',  ];
        }
        return $res;
    }
}