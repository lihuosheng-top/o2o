<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/11
 * Time: 下午3:59
 */

namespace  app\admin\controller;

use think\Controller;

class Index extends Controller{

    public function index(){

        //index/index.php
        return $this->fetch();
    }


    public function welcome()
    {
//        EXTEND_PATH
       $res = \Map::getLngLat('大连市沙河口区软件园3号楼');
        print_r($res);
        return "欢迎来到o2o管理平台";
    }


}