<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/13
 * Time: 下午3:29
 */

namespace app\common\model;

use think\Model;

class Deal extends Model
{

    //获取团购列表的信息
    public function getAllNormalDeals($bis_id = 0)
    {
        $data = [
            'status' => ['neq', -1],
            'bis_id' => $bis_id
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc',

        ];
        $res = $this->where($data)->order($order)->paginate(3);
        //查看最后执行的sql的语句($this指的是当前类下的实例model(),多个model叫做单例模式)
//        print_r($res);exit();

        return $res;

    }

    //admin的团购商品管理

    public function getDealsByCondition($data=[])
    {
//        $data['status']=1;

        $order =[
          'listorder'=>'desc',
            'id'=>'desc'

        ];
        return $this->where($data)->order($order)->paginate(3);
    }

    //

}