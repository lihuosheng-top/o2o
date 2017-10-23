<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/21
 * Time: 上午8:47
 */

namespace  app\bis\controller;

use think\Controller;

class  Base extends  Controller
{

    //TODO:基类,防止直接在地址栏直接敲地址跳过登录界面直接进入商户中心

    public $account;

    //初始化函数

    public  function  _initialize()
    {
        //检测登录情况,防止敲地址直接登录
        if(!$this->isLogin())
        {
            $this->redirect('login/index');
        }

    }


    public function isLogin()
    {
        $login_user =$this->getLoginUser();
        if(!$login_user)
        {
            return false;
        }
        return true;
    }

    //为下面要用到做准备
    public function getLoginUser()
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