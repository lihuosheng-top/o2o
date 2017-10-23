<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/18
 * Time: 下午4:53
 */
namespace  app\bis\controller;


class  Location extends  Base
{

    protected $obj;

    public function _initialize()
    {
        $this->obj =model('BisLocation');
    }

    public  function index()
    {

        $bis_id =$this->getLoaginUser()->bis_id;
        $locationData =$this->obj->where(['bis_id'=>$bis_id])->paginate(3);

        return $this->fetch('',[
            'locationData'=>$locationData
        ]);
    }

    public function  add()
    {

        if(request()->isPost())
        {
            //入库操作
            $data =input('post.');

            //数据校验

            $validate =validate('Branch');
            $res = $validate->scene('add')->check($data);
            if(!$res)
            {
                $this->error($validate->getError());
            }

            //获取当前用户的bis_id
            $bis_id =$this->getLoaginUser()->bis_id;
            $locationResult = \Map::getLngLat($data['address']);
            if (!$locationResult || $locationResult['result']['precise'] == 0) {

                $this->error('地理信息不精确,请重新填写');
            }


            //准备分类信息字符串,提供给category_path字段使用
            //先声明空字符串
            $se_categoreies_string ='';

            if(!empty($data['se_category_id']))
            {
                $array =$data['se_category_id'];
                //选择分类,implode将字符拆分
                $se_categoreies_string =','.implode('|',$array);
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

                'bis_id'=>$bis_id,
                'open_time'=>$data['open_time'],
                'content'=>$data['content'],
                'is_main'=>1,
                'api_address'=>$data['address'],
                'city_id'=>$data['city_id'],
                'city_path'=>$data['city_id'].','.$data['se_city_id'],
                'category_id'=>$data['category_id'],
                'category_path'=>$data['category_id'].$se_categoreies_string,
//                'bank_info'=>$data['bank_info']
            ];

            //存入数据库

            $res =$this->obj->add($locationData);
            if(!$res)
            {
                $this->error('门店信息添加失败');
            }
            else{

                $this->success('门店添加成功');
            }

        }
        else
        {
//获取城市信息
            $cities = model('City')->getNormalCitiesByParentId();
            $category = model('Category')->getAllFirstNomalCategories();
            return $this->fetch('', [
                'city' => $cities,
                'category' => $category
            ]);
        }


    }

    //状态

    public function  status()
    {

        $status = input('status',0,'intval');
        $id = input('id',0,'intval');
        $res =$this->obj->save(['status'=>$status],['id'=>$id]);
        if(!$res)
        {
            $this->error('下架失败');
        }
        $this->success('下架成功');

    }


    //编辑
    public function detail()
    {

        $id =input('id',0,'intval');
        //根据id获取bisLoacation的信息
        $res =$this->obj->get($id);
        $cities = model('City')->getNormalCitiesByParentId();
        $categories =model('category')->getAllFirstNomalCategories();

        //获取二级城市分类

        $se_cities =model('City')->getNormalCitiesByParentId(intval($res['city_id']));

        //获取citi_path里的人二级城市分类
        $city_path = $res['city_path'];
        $se_city_id =$this->getSeCityIdByCityPath($city_path);

        //获取城市信息
        return $this->fetch('',[
            //
            'locationData'=>$res,
            'cities'=>$cities,
            'categories'=>$categories,
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