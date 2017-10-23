<?php
/**
 * Created by PhpStorm.
 * User: 启天
 * Date: 2017/10/18
 * Time: 13:55
 */
namespace app\common\model;

use think\Model;

class AdminUser extends Model {

    protected $autoWriteTimestamp = true;//开启器时间自动写入

    /**
     * 新增用户
     */
    public function add($data){
        //判断当前参数是否是数组
        if (!is_array($data)){
            exception('传递数据不合法');
        }
        //保存数据并返回该条记录id
        $this->allowField(true)->save($data);
        $result = $this->getLastSql();
        dump($result);exit();
//        return $this->id;
    }
}