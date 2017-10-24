<?php
/**
 * Created by PhpStorm.
 * User: yoyo
 * Date: 2017/10/12
 * Time: 15:03
 */
namespace app\admin\controller;
use think\Controller;
use think\Request;
class Admin extends Controller {

    /**
     * 后台添加用户
     */
    public function add(){
      // halt($data);//相当于dump($data);die();//dump(input('post.'));相当于dump()
        if (request()->isPost()){
            $data = input('post.');

            // 获取表单上传文件 例如上传了001.jpg
            $img = collection(request()->file('avator'))->toArray();

            //获取图像信息将原图保持页面剪裁前的尺寸

            //用页面传的尺寸剪裁图片
            //调用剪裁方法处理图片并返回
            $image = \think\Image::open('./image.png');
            //将图片裁剪为150x150,从w,h处开始剪裁并保存为crop.png
            $crop = $image->crop(150, 150, $data['w'], $data['h']);
            $pub = new Pub();
            $data['avator'] = $pub->cropAvator($crop.'png');

            //上传剪裁好的图片并返回存储路径，保存至数据库
            $uploads = new Pub();
            $data['avator'] = $uploads->upload($img);

//            $data['avator'] = request()->file('avator');

            $validate = validate('AdminUser');//加载验证类
            //检测参数
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $salt = $this->getRandomString('4');//获取随机盐值
            $data['password'] = password_hash($data['password'].$salt, PASSWORD_BCRYPT);//加密处理
            $data['status'] = '0';//状态：0正常；1删除

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
