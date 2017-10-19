<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/19
 * Time: 上午8:41
 */

namespace  app\common\validate;

use think\Validate;

class Branch extends  Validate{

    protected  $rule =[
        'name'=>'require',
        'city'=>'require',
        'logo'=>'require',
        'address'=>'require',
        'tel'=>'require',
        'contact'=>'require',
        'open_time'=>'require',
        'content'=>'require',
        'category_id'=>'require',


    ];
    protected  $message=[
        'name.require'=>'店铺名不能为空',
        'city_id.require'=>'请选择城市',
        'logo.require'=>'请选择图片',
        'address.require'=>'请选择地址',
        'tel.require'=>'电话不能为空',
        'contact.require'=>'不能为空',
        'open_time.require'=>'营业时间不能为空',
        'content.require'=>'内容不能为空',
        'category_id.require'=>'请选择不能为空',
    ];
    protected $scene =[
        'add'=>[
            'name',
            'city_id',
            'logo',
            'address',



            'tel',
            'contact',
            'open_time',
            'content',
            'category_id',
        ]
    ];


}
