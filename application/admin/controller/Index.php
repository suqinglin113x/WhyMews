<?php
/**
 * Created by PhpStorm.
 * User: yoyo
 * Date: 2017/10/10
 * Time: 14:55
 */
namespace app\admin\controller;
use think\Controller;

class Index extends Controller {
    /**
     * 后台首页
     */
    public function index(){
        return $this->fetch();
    }

    public function welcome(){
        return $this->fetch();
    }
}
