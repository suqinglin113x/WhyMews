<?php
/**
 * Created by PhpStorm.
 * User: 启天
 * Date: 2017/10/17
 * Time: 17:49
 */
namespace app\common\validate;
use think\Validate;

class AdminUser extends Validate{

    protected $rule = [
        'username' => 'require|max:25',
        'password' => 'require|max:20',
        'phone' => 'number|max:11',
        'email' => 'email',
    ];
}