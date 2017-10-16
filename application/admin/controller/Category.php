<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/11
 * Time: 下午8:38
 */

namespace  app\admin\Controller;

use think\Controller;

class  Category extends  Controller{

    public function  index()
    {
        //通过model获取分类数据
        $data =model('Category')->getFirstNomalCategories();

        //fetch到模板上了

        return $this->fetch('',[
           'categories'=>$data
        ]);
    }
}