<?php
/**
 * Created by PhpStorm.
 * User: 启天
 * Date: 2017/10/23
 * Time: 14:05
 */

namespace app\admin\controller;


use think\Controller;

class Pub extends Controller{

    /**
     * 剪裁头像
     */
   /* public function cutAvator(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $targ_w = $targ_h = 150;
            $jpeg_quality = 90;

            $src = 'uploads/pool.jpg';
            $img_r = imagecreatefromjpeg($src);
            $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

            imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
            $targ_w,$targ_h,$_POST['w'],$_POST['h']);

            header('Content-type: image/jpeg');
            $avator = imagejpeg($dst_r,null,$jpeg_quality);
            return $avator;
        }
    }*/
   public function cropAvator(){

   }

   /**
    * 上传
    */
    public function upload($file){
        // 获取表单上传文件 例如上传了001.jpg
//        $file = request()->file('image');

        // 验证图片格式大小，移动到框架应用根目录/uploads/avator 目录下
        if($file){
            $info = $file->validate(['size'=>3145728,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'uploads' . DS . 'avator');
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                return $info->getExtension();
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                return $info->getSaveName();
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                return $info->getFilename();
            }else{
                // 上传失败获取错误信息
                return $file->getError();
            }
        }
    }
}