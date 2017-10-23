<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/13
 * Time: 下午2:50
 */

namespace app\bis\controller;

use think\Controller;

class  Register extends Controller
{

    public function index()
    {
//        return $this->fetch();

        //获取城市

        $cities = model('City')->getNormalCitiesByParentId();
        $category = model('Category')->getAllFirstNomalCategories();

        return $this->fetch('', [
            'city' => $cities,
            'category' => $category
        ]);

    }

    public function getregister()
    {
//input 获取输入数据,支持默认值,过滤
        $parent_id = input('post.id', 0, 'intval');

        //实例化model
        $res = model('City')->getNormalCitiesByParentId($parent_id);

//        console.log($res);
        if (!$res) {
//            return $this->error('失败');
            return $this->result('', 0, '失败');
        }

//        return $this->success('成功',0,$res);
        return $this->result($res, 1, '成功');
    }

    public function getcategories()
    {
        $parent_id = input('post.id', 0, 'intval');
        $res = model('Category')->getAllFirstNomalCategories($parent_id);

        if (!$res) {
            return $this->result('', 0, '失败');
        }
        return $this->result($res, 1, 'success');
    }

    //申请按钮触发方法
    public function regist()
    {// html_entity_decode   htmlentities
        $data = input('post.','','htmlentities');
//        print_r($data);exit();
        //到此显示输入数据


        //检验商户数据

        $validateAccount =validate('BisAccount');
        $res =$validateAccount->scene('add')->check($data);
        if(!$res)
        {
            $this->error($validateAccount->getError());
        }

        //检测该商户是否已经存在

        if(model('BisAccount')->getAccountByusername($data['username']))
        {
            $this->error('商户不存在');
        }

        //数据校验bis

        $validate = validate('Bis');
        $res = $validate->scene('add')->check($data);
        if (!$res) {
            $this->error($validate->getError());

        }
        //数据校验bislocation

        $validateLocation =validate('BisLocation');

        $res =$validateLocation->scene('add')->check($data);
        if(!$res)
        {
            $this->error($validateLocation->getError());
        }


        //判断地理信息位置是否正确

        $locationResult = \Map::getLngLat($data['address']);
//        print_r($validate);
//        print_r($locationResult);
//$locationResult['result']['precise'] == 0 不精确,模糊
        if (!$locationResult || $locationResult['result']['precise'] == 0) {

            $this->error('地理信息不精确,请重新填写');
        }

        //准备数据提交

        $bisData =[
//            htmlentities()防止输入XSS攻击<script>
//          'name'=>$data['name'],
            'name'=>$data['name'],
            'email'=>$data['email'],
            'logo'=>$data['logo'],
            'licence_logo'=>$data['licence_logo'],
            'description'=>$data['description'],
            'city_id'=>$data['city_id'],
            'city_path'=>$data['city_id'].','.$data['se_city_id'],
            'bank_info'=>$data['bank_info'],
            'bank_name'=>$data['bank_name'],
            'bank_user'=>$data['bank_name'],
            'faren'=>$data['faren'],
            'faren_tel'=>$data['faren_tel']
        ];

        //提交到数据库

//add方法被封装在model Big里面
//        $res =model('Bis')->add($bisData);
//
//        if(!$res)
//        {
//            $this->error('添加失败');
//        }
//        $this->success('添加成功');

//把上一步测试res改为bisID

        //提交数据表,上传到数据库
        $bisId =model('Bis')->add($bisData);

        //准备分类信息字符串,提供给category_path字段使用
        //先声明空字符串
        $se_categoreies_string ='';

        if(!empty($data['se_category_id']))
        {
            $array =$data['se_category_id'];
            //选择分类,implode将字符拆分
            $se_categoreies_string =implode('|',$array);
        }



        //准备bislocation表的数据
        $locationData =[
          'name'=>$data['name'],
            'logo'=>$data['logo'],
            'address'=>$data['address'],
            'tel'=>$data['tel'],
            'contact'=>$data['contact'],
            'xpoint'=>empty($locationResult['result']['location']['lng']) ? '':$locationResult['result']['location']['lng'],


            'ypoint'=>empty($locationResult['result']['location']['lat']) ? '':$locationResult['result']['location']['lat'],

            'bis_id'=>$bisId,
            'open_time'=>$data['open_time'],
            'content'=>$data['content'],
            'is_main'=>1,
            'api_address'=>$data['address'],
            'city_id'=>$data['city_id'],
            'city_path'=>$data['city_id'].','.$data['se_city_id'],
            'category_id'=>$data['category_id'],
            'category_path'=>$data['category_id'].','.$se_categoreies_string,
            'bank_info'=>$data['bank_info']
        ];

        //存入数据库

        $res =model('BisLocation')->add($locationData);

//        if(!$res)
        if(!$res)
        {
            $this->error('失败');
        }


        //mt_rand()随机生成code:四位整数
        $data['code']= mt_rand(1000,10000);
        //准备商户信息
        $accountData =[
            'username'=>$data['username'],
            'password'=>md5($data['password'].$data['code']),
            //为了存储不存在的,防止
            'code'=>$data['code'],
            'bis_id'=>$bisId,
            'is_main'=>1
        ];

//商品信息存入数据库
        $res =model('BisAccount')->add($accountData);
        if(!$res)
        {
            $this->error('申请失败');
        }

        //发送邮件通知

        $title ='商城申请入驻审核通知';
        $url =request()->domain().url('bis/register/waitting',
                ['id'=> $bisId]);
        $content ='您的店铺信息正在审核中,<a href="'.$url.'"   target="_blank">点击查看状态</a>';

        \phpmailer\Email::send($data['email'],$title,$content);
        $this->success('申请成功',url('register/waitting',['id'=>$bisId]));

    }

    public function  waitting($id)
    {
        if(empty($id))
        {
            return '';
        }
        //根据id获取bis的信息

        $detail =model('Bis')->get($id);
        return $this->fetch('',
            [
                'detail'=>$detail
            ]);
    }
}