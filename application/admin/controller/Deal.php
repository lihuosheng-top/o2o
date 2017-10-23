<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/11
 * Time: 下午3:59
 */

namespace  app\admin\controller;

use think\Controller;

class Deal extends Controller{

    protected $obj ;
    protected function _initialize()
    {
        $this->obj =model('Deal');
    }





    public function index(){

        $data=input('post.');

        if(empty($data))
        {
            $data=[
              'category_id'=>0,
                'city_id'=>0,
                'start_time'=>'',
                'end_time'=>'',
                'name'=>'',
            ];
        }


        //组合起来
        $con_data = [];
        //判断是否存在条件,看那边的name

        if(!empty($data['category_id']))
        {
            $con_data['category_id'] =$data['category_id'];
        }


        if(!empty($data['city_id']))
        {
            $con_data['se_city_id'] =$data['city_id'];
        }
        //开始时间

        if(!empty($data['start_time']))
        {
            $con_data['start_time'] =[
                //大于
              'gt',strtotime($data['start_time'])

            ];
        }
        //结束时间
        if(!empty($data['end_time']))
        {
            $con_data['end_time'] =[
                //大于
                'gt',strtotime($data['end_time'])

            ];
        }
        //
        if(!empty($data['start_time'])&&!empty($data['end_time']))
        {
            //判断开始开始结束时间的大小
            if(strtotime($data['start_time'])>strtotime($data['end_time']))
            {
                $con_data['start_time'] =[
                    //大于
                    'gt',strtotime($data['end_time'])
                ];

                $con_data['end_time'] =[
                    //大于
                    'lt',strtotime($data['start_time'])

                ];
                $temp =$data['start_time'];
                $data['start_time'] =$data['end_time'];
                $data['end_time'] =$temp;

            }

        }

        //名称
        if(!empty($data['name']))
        {
            $con_data['name']=[
              'like','%'.$data['name'].'%'
            ];
        }



        //用于登录用户信息,修改状态值
            $deals =$this->obj->getDealsByCondition($con_data);

            //分类信息:获取主分类的一级分类
        $categories = model('Category')->getAllFirstNomalCategories();
            //获取二级城市
        $se_cities =model('City')->getAllSeCities();

        print_r($data);

        return $this->fetch('',[
            'deals'=>$deals,
            'se_cities'=>$se_cities,
            'categories'=>$categories,
            'data'=>$data
        ]);
    }

    public function  status()
    {
        $id =input('id',0,'intval');

        $status =input('status',0,'intval');

        //修改状态
        $res =$this->obj->save(['status'=>$status],['id'=>$id]);
        if(!$res)
        {
            $this->error('状态更新失败');
        }
        else
        {
            $this->success('状态更新成功');
        }

    }




    //商户团购商品审核方法
    public function verify(){

        $data=input('post.');

        if(empty($data))
        {
            $data=[
                'category_id'=>0,
                'city_id'=>0,
                'start_time'=>'',
                'end_time'=>'',
                'name'=>'',
            ];
        }


        //组合起来
        $con_data = [];
        //判断是否存在条件,看那边的name

        if(!empty($data['category_id']))
        {
            $con_data['category_id'] =$data['category_id'];
        }


        if(!empty($data['city_id']))
        {
            $con_data['se_city_id'] =$data['city_id'];
        }
        //开始时间

        if(!empty($data['start_time']))
        {
            $con_data['start_time'] =[
                //大于
                'gt',strtotime($data['start_time'])

            ];
        }
        //结束时间
        if(!empty($data['end_time']))
        {
            $con_data['end_time'] =[
                //大于
                'gt',strtotime($data['end_time'])

            ];
        }
        //
        if(!empty($data['start_time'])&&!empty($data['end_time']))
        {
            //判断开始开始结束时间的大小
            if(strtotime($data['start_time'])>strtotime($data['end_time']))
            {
                $con_data['start_time'] =[
                    //大于
                    'gt',strtotime($data['end_time'])
                ];

                $con_data['end_time'] =[
                    //大于
                    'lt',strtotime($data['start_time'])

                ];
                $temp =$data['start_time'];
                $data['start_time'] =$data['end_time'];
                $data['end_time'] =$temp;

            }

        }

        //名称
        if(!empty($data['name']))
        {
            $con_data['name']=[
                'like','%'.$data['name'].'%'
            ];
        }
        //设置status的条件(数据库-查询构造器-查询语句)

        $con_data['status'] =[

//            'in',[0]

            'exp','IN[1,0]'
        ];


        //用于登录用户信息,修改状态值
        $deals =$this->obj->getDealsByCondition($con_data);

        //分类信息:获取主分类的一级分类
        $categories = model('Category')->getAllFirstNomalCategories();
        //获取二级城市
        $se_cities =model('City')->getAllSeCities();

        print_r($data);

        return $this->fetch('',[
            'deals'=>$deals,
            'se_cities'=>$se_cities,
            'categories'=>$categories,
            'data'=>$data
        ]);
    }




}