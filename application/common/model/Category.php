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
    //TODO:自动写入时间戳,2个地方都可以
    protected $autoWriteTimestamp =true;
    //TODO:获取所有的一级分类
    public  function  getFirstNomalCategories($parent_id =0)
    {
        //条件
        $data =[
            'status'=>['neq',-1],
            'parent_id'=>$parent_id
        ];

        //排序属性

        $order =[
            'listorder'=>'desc',
            'id'=>'desc',
        ];
        return $this->where($data)->order($order)->paginate();
    }

    public function getAllFirstNomalCategories($parent_id=0)
    {
        //条件
        $data =[
          'status'=>['neq',-1],
            'parent_id'=>$parent_id

        ];
        //排序属性
        $order =[
          'listorder'=>'desc',
            'id'=>'desc'
        ];
        return $this->where($data)->order($order)->select();
    }

}