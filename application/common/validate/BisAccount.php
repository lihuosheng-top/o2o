<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/18
 * Time: 下午9:20
 */
namespace  app\common\validate;

use think\Validate;

class  BisAccount extends  Validate{
    protected  $rule =[
      'username'=>'require',
        'password'=>'require'
    ];

    protected  $message =[
      'username.require'=>'不能为空',
        'password.require'=>'不能为空'
    ];
    protected  $scene =[

        'add'=>['usernaem','password']
    ];




}