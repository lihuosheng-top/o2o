<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/19
 * Time: 上午8:23
 */

namespace  app\common\model;
use think\Model;

class  BisAccount extends  Model{

    public  function  add($data)
    {
        $data['status']=0;

        $this->save($data);
        //获取添加成功后的主键id
        return $this->id;
    }

    public function getAccountByusername($username)
    {
     $data=[
         'username'=>$username,

     ];
     return $this->where($data)->find();
    }

}