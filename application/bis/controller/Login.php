<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/14
 * Time: 下午8:22
 */

namespace  app\bis\controller;

use think\Controller;

class  Login extends  Controller{

    public  function  index()
    {
        return $this->fetch();
    }
}