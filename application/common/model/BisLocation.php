<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/19
 * Time: 下午8:09
 */

namespace  app\common\model;
use think\Model;

class BisLocation extends  Model{
    public function  add($data)
    {
        $data['status']=0;
        $this->save($data);

        //获取添加成功后的主键id
        return $this->id;

    }


    public function  getLoactionById($id)
    {
        $data=[
            'bis_id'=>$id,
            'is_main'=>1
        ];
        return $this->where($data)->find();
    }



}

