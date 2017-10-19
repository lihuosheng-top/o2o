<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/19
 * Time: 下午7:27
 */

namespace  app\common\model;

use think\Model;

class  Bis extends  Model{
    public function add($data)
    {
        $data['status'] =0;
        $this->save($data);
        //获取添加成功后的主键Id
        return $this->id;

    }

}