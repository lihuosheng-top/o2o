<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/23
 * Time: 下午4:17
 */
namespace app\index\controller;

use think\Controller;

class Login extends Controller
{
    public function login()
    {
        return $this->fetch();

    }
}
