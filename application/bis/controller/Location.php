<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/21
 * Time: 上午9:07
 */

namespace  app\bis\controller;

use think\Controller;

class  Location extends  Controller
{
    public function  index()
    {
        return $this->fetch();

    }

    public function add()
    {
        $cities =model('City')->getNormalCitiesByParentId();
        $category = model('Category')->getAllFirstNomalCategories();

        return $this->fetch('',[
            'city'=>$cities,
            'category'=>$category
        ]);
    }
    public function  getlocation()
    {
        $parent_id =input('post.id',0,'intval');

        //实例化model

        $res =model('City')->getNormalCitiesByParentId($parent_id);

        if(!$res)
        {
            return $this->result('',0,'失败');
        }

        return $this->result($res,1,'成功');
    }

}