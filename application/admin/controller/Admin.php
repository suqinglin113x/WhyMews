<?php
/**
 * Created by PhpStorm.
 * User: yoyo
 * Date: 2017/10/12
 * Time: 15:03
 */
namespace app\admin\controller;
use think\Controller;

class Admin extends Controller {

    /**
     * 后台添加用户
     */
    public function add(){
//            halt($data);//相当于dump($data);die();//dump(input('post.'));相当于dump()
        if (request()->isPost()){
            $data = input('post.');
            $data['avator'] = request()->file('avator');
            $validate = validate('AdminUser');//加载验证类
            //检测参数
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }

            $salt = $this->getRandomString('4');//获取随机盐值
            $data['password'] = password_hash($data['password'].$salt, PASSWORD_BCRYPT);//加密处理
            $data['status'] = '0';//状态：0正常；1删除
            halt($data);
//            $data['create_time'] = date('Y-m-d H:i:s a', time());//创建时间
//            $data['update_time'] = date('Y-m-d H:i:s a', time());//修改时间
            try {
                $id = model('AdminUser')->add($data);
            }catch (\Exception $e){
                return $e->getMessage();
            }
            if(!isset($id)){

            }
        }else{
            return $this->fetch();
        }
    }
}