<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/23
 * Time: 下午4:17

 */
namespace app\index\controller;
use think\captcha\Captcha;
use think\Controller;

class Register extends Controller
{
    public function register()
    {

        return $this->fetch();

    }
}
