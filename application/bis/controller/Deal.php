<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/19
 * Time: 下午2:10
 */

namespace app\bis\controller;

class  Deal extends Base
{


    protected $obj;

    public function _initialize()
    {
        $this->obj = model('Deal');
    }

    public function index()
    {
        //用于登录用户信息
        $bis_id =$this->getLoaginUser()->bis_id;

        $deals = $this->obj->getAllNormalDeals(intval($bis_id));



//        print_r($deals);exit();
        return $this->fetch('', [
            'dealData' => $deals
        ]);

    }

    public function add()
    {
//当前登录用户的信息
        $bis_id = $this->getLoaginUser()->bis_id;

        if (request()->isPost()) {
            $data = input('post.');

            //数据校验
            $volidate = validate('Deal');

            $res = $volidate->scene('add')->check($data);
            if(!$res)
            {
                $this->error($volidate->getError());
            }



            //准备分类信息字符串,提供给category_path字段使用
            //先声明空字符串
            $se_categoreies_string ='';
            $se_single_categories_string='';

            if(!empty($data['se_category_id']))
            {
                $array =$data['se_category_id'];
                //选择分类,implode将字符拆分
                $se_single_categories_string =implode(',',$array);
                $se_categoreies_string =','.implode('|',$array);
            }

            //准备勾选了那些分店信息的数据
            $locationIds_string ='';

            if(!empty($data['location_ids']))
            {
                $locationIds_string =implode(',',$data['location_ids']);
            }


            $dealData =[
              'name'=>$data['name'],
                'city_id'=>$data['city_id'],
                'se_city_id'=>$data['se_city_id'],
                'city_path'=>$data['city_id'].','.$data['se_city_id'],

                'category_id'=>$data['category_id'],
                'se_category_id'=>$se_single_categories_string,

                'category_path'=>$data['category_id'].$se_categoreies_string,
                'bis_id'=>$bis_id,

                'location_ids'=>$locationIds_string,
                'image'=>$data['image'],
                'description'=>$data['description'],
                'start_time'=>strtotime($data['start_time']),
                'end_time'=>strtotime($data['end_time']),
                'origin_price'=>$data['origin_price'],
                'current_price'=>$data['current_price'],
                'total_count'=>$data['total_count'],
                'coupons_begin_time'=>strtotime($data['coupons_begin_time']),
                'coupons_end_time'=>strtotime($data['coupons_end_time']),
                'bis_account_id'=>$this->getLoaginUser()->id,
                'notes'=>$data['notes'],

            ];

            //入库操作

            $res =model('Deal')->save($dealData);
            if(!$res)
            {
                $this->error('添加失败');
            }
            else
            {
                $this->success('添加成功');
            }










        } else {
            //获取城市
            $cities = model('City')->getNormalCitiesByParentId();
            //获取分类
            $categories = model('category')->getAllFirstNomalCategories();
//获取当前登录的商户所有的店铺信息
            $locations = model('BisLocation')->where(['bis_id' => $bis_id])->select();

            return $this->fetch('', [
                'cities' => $cities,
                'categories' => $categories,
                'locations' => $locations
            ]);
        }


    }

    //编辑

    public function  detail()
    {

        //获取id
        $id =input('id',0,'intval');

//        print_r($id);

        //根据id获取deal信息
        $deal =$this->obj->get($id);






        $bis_id =$this->getLoaginUser()->bis_id;
        //获取城市
        $cities = model('City')->getNormalCitiesByParentId();
        //获取分类
        $categories = model('category')->getAllFirstNomalCategories();
//获取当前登录的商户所有的店铺信息
        $locations = model('BisLocation')->where(['bis_id' => $bis_id])->select();

        //获取二级城市分类

        $se_cities =model('City')->getNormalCitiesByParentId(intval($deal['city_id']));

        //获取citi_path里的人二级城市分类
        $city_path = $deal['city_path'];
        $se_city_id =$this->getSeCityIdByCityPath($city_path);

        print_r($se_city_id);

        return $this->fetch('', [
            'cities' => $cities,
            'categories' => $categories,
            'locations' => $locations,
            'deal'=>$deal,

            'se_cities'=>$se_cities,
            'se_city_id'=>$se_city_id
        ]);

    }


    //TODO:
    public function getSeCityIdByCityPath($city_path)
    {
        if(empty($city_path))
        {
            return '';
        }

        //9,18正则校验([9,18])
        if(preg_match('/,/',$city_path))
        {
            //把字符串按照某个字符分割形成数组
            $cityArray =explode(',',$city_path);
            $se_city_id =$cityArray[1];


            return $se_city_id;
        }


    }


}