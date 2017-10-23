<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/13
 * Time: 下午2:50
 */
namespace  app\bis\controller;


use think\Controller;
use think\Session;

class Login extends Controller {
    public function  index()
    {

        //判断session

        if(session('loginUser','','bis'))
        {
            //如果有存值则直接跳转
            $this->redirect('index/index');
        }


        //判断请求来自form,post请求

        if(request()->isPost())
        {
            $data =input('post.');
            //TODO:去common\validate\bisAccount
            //校验数据

            $validate =validate('BisAccount');

            $res =$validate->scene('login')->check($data);

            if(!$res)
            {
                $this->error($validate->getError());
            }
            //根据用户名获取用户名

            $result =model('BisAccount')->get([
                'username'=>$data['username'],
            ]);
            if(!$result)
            {
                $this->error('该用户不存在或发生未知错误');
            }
            //匹配密码

            if($result->password!=md5($data['password'].$result->code))
            {
                $this->error('登录失败');
            }

            //存在sessiion

            session('loginUser',$result,'bis');

            $this->success('登录成功',url('bis/index/index'));

        }
        else{


        }




        return $this->fetch();
    }


    public function  logout()
    {
        //session置空
        Session::delete('loginUser','bis');
        //跳回登录界面
//this表示controller对象
        $this->redirect('login/index');

    }


    //测试
    public function test()
    {


        //测试邮件
        $to ='1061525487@qq.com';
        $title ='测试一下';
        $content ='10年,<a style="color: red;font-size: 30px"  target="_blank">点击查看</a>';
        $res= \phpmailer\Email::send($to,$title,$content);

        if(!$res)
        {
            $this->error('邮件发送失败');
        }
        $this->success('成功发送邮箱','login/index');
    }




}