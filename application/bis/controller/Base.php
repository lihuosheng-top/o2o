<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/18
 * Time: 下午3:57
 */
namespace  app\bis\controller;

use think\Controller;

class Base extends  Controller
{

    //TODO:基类,防止直接敲代码直接登录
    public   $account;

    //初始化函数
    public function _initialize()
    {
        //检测登录情况,防止直接敲代码直接登录
        if(!$this->isLogin())
        {
           $this->redirect('login/index');
        }


    }


    public function isLogin()
    {
        $login_user =$this->getLoaginUser();
        if(!$login_user)
        {
           return false;
        }
        return true;
    }


    public function  getLoaginUser()
    {
        //懒加载
        //如果为空
        if(!$this->account)
        {
            $this->account =session('loginUser','','bis');
        }
        return $this->account;


    }

}