<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {

        return $this->fetch();
    }

    public function welcome()
    {
        $res =\Map::getLngLat('贵港市平南县');
        print_r($res);
        return "欢迎来到o2o管理平台";

    }
}
