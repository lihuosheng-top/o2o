<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/11
 * Time: 下午8:42
 */

namespace app\common\model;

use think\Model;

class  Category extends  Model{
    //获取所有的一级分类

    public  function  getFirstNomalCategories()
    {
        //条件

        $data =[
            'status'=>['neq',-1],
            'parent_id'=>0
        ];

        //排序属性

        $order =[
            'listorder'=>'desc',
            'id'=>'desc',
        ];
        return $this->where($data)->order($order)->paginate();

    }

}