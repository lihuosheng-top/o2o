<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/20
 * Time: 下午9:13
 */
namespace  app\bis\controller;

use think\Controller;

class  Index extends  Controller
{
    public function  index()
    {
        return $this->fetch();
    }

}