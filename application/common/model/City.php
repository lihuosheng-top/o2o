<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/14
 * Time: 下午8:50
 */

namespace  app\common\model;
use think\Model;

class City extends Model{
    //TODO:获取一级分类的城市

    public function  getNormalCitiesByParentId($parent_id=0)
    {
        $data =[
          'status'=>['neq',-1],
            'parent_id'=>$parent_id,

        ];
        $order =[
          'id'=>'asc'
        ];
        return $this->where($data)->order($order)->select();
    }
}
