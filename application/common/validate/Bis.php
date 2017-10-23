<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/16
 * Time: 下午3:16
 */
namespace  app\common\validate;
use think\Validate;

class  Bis extends  Validate{
    protected $rule =[

        'name'=>'require|max:50',
        'city_id'=>'require',
        'se_city_id'=>'require',
        'email'=>'require',
        'logo'=>'require',
        'licence_logo'=>'require',
        'description'=>'require',
        'bank_info'=>'require',
        'bank_name'=>'require',
        'bank_user'=>'require',
        'faren'=>'require',
        'faren_tel'=>'require'

    ];

    protected  $message=[
      'name.require'=>'名字不能为空',
        'city_id.require'=>'所属省份不能为空',
        'se_city_id.require'=>'选择城市不能为空',
        'name.max'=>'长度不能超过20',
        'email.require'=>'邮箱不能为空',
        'logo.require'=>'缩裂图不能为空',
        'licence_logo.require'=>'营业制证不能为空',
        'description.require'=>'描述不能为空',
        'bank_info.require'=>'银行卡号不能为空',
        'bank_name.require'=>'银行名字不能为空',
        'bank_user.require'=>'银行用户人姓名不能为空',
        'faren.require'=>'法人姓名不能为空',
        'faren_tel.require'=>'法人电话不能为空'
    ];

    protected $scene =[

        'add'=>[
            'name',
            'city_id',
            'se_city_id',
            'email',
            'logo',
            'licence_logo',
            'description',
            'bank_info',
            'bank_name',
            'bank_user',
            'faren',
            'faren_tel'
        ]
    ];
}