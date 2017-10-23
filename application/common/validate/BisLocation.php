<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/16
 * Time: 下午3:16
 */
namespace  app\common\validate;
use think\Validate;

class  BisLocation extends  Validate{
    protected $rule =[

        'tel'=>'require',
        'contact'=>'require',
        'open_time'=>'require',
        'content'=>'require',
        'category_id'=>'require',

    ];

    protected  $message=[
        'tel.require'=>'电话不能为空',
        'contact.require'=>'不能为空',
        'open_time.require'=>'营业时间不能为空',
        'content.require'=>'内容不能为空',
        'category_id.require'=>'请选择不能为空',
    ];
    protected $scene =[
        'tel',
        'contact',
        'open_time',
        'content',
        'category_id',
    ];
}