<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/16
 * Time: 上午9:13
 */
namespace  app\api\controller;

use think\Controller;
use think\Request;

class Image extends  Controller{

    public function upload()
    {


        //使用全局对象,实例化一个文件操作对象,并调用file方法
        $file =Request::instance()->file('file');
        //将文件移动到某个文件目录下
        $info =$file->move('upload');
//        THIN
        if($info &&$info->getPathname())
        {
            return show(1,'success','/'.$info->getPathname());
        }
        return show(0,'上传失败');
    }

}