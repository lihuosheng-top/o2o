<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/12
 * Time: 下午8:07
 */

namespace app\admin\validate;

use think\Validate;

class Category extends Validate
{
    //TODO:设置规格$rule
    //设置规则,后面还需要设置场景
    protected $rule = [
        //必须是数字,必须是1 0 -1
        'status' => 'number|in:1,0,-1',
        'name' => 'require|max:15',
        'parent_id' => 'number',
        'id' => 'number',
        'listorder' => 'number'
    ];

    //TODO:验证信息$message
    protected $message = [
        'status.number' => '状态必须是数字',
        'status.in' => '状态取值范围错误',
        'name.require'=>'名字必须,不能为空',
        'name.max'=>'名字长度不能超过15',
        'parent_id.number'=>'ID必须是数字',
        'id.number'=>'必须是数字',
        'listorder.number'=>'排序号必须是数字'
    ];
    //TODO:设置场景
    protected $scene =[
      'add'=>['name','parent_id'],
        'status'=>['status','id'],
        'update'=>['name','id','parent_id'],
        'listorder'=>['id','listorder']
    ];


}