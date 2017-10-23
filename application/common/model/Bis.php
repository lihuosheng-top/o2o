<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/16
 * Time: 下午4:42
 */
namespace  app\common\model;

use think\Model;

class Bis extends Model{

//    protected  $autoWriteTimestamp =true;

public function  add($data)
{
    $data['status'] =0;
    $this->save($data);
    //获取添加成功后的主键id
    return $this->id;


}


public function  getByStatus($status)
{
    $data =[
      'status'=>$status
    ];
    $order=[
        'listorder'=>'desc',
        'id'=>'desc'
    ];

    //页数
    return $this->where($data)->order($order)->paginate(5);
}


//TODO:获取基本信息

public function  getBisById($id)
{
    $data =[
        'city_id'=>$id
    ];
    return $this->where($data)->find();
}




}

