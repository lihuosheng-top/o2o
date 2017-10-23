<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/20
 * Time: 下午9:13
 */
namespace  app\bis\controller;

class  Index extends  Base
{
    public function  index()
    {
        return $this->fetch();
    }

}