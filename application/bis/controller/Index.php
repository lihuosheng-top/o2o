<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/17
 * Time: 下午2:37
 */
namespace  app\bis\controller;


class  Index extends  Base{
    //这个继承Base
    public function index()
    {
        return $this->fetch();

    }
}