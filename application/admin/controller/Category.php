<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/11
 * Time: 下午8:38
 */

namespace  app\admin\Controller;

use think\Controller;

class  Category extends  Controller{
    //优化
    private  $obj;
    protected function  _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->obj = model('Category');
    }

    public function  index()
    {
        //获取parent_id 接收来自获取子栏目的ID
        //参数一:key ,参数二:默认值,参数三:类型转换
        $parent_id =input('parent_id',0,'intval');
        //通过model获取分类数据
        $data =$this->obj->getFirstNomalCategories($parent_id);
        //fetch到模板上了
        return $this->fetch('',[
           'categories'=>$data
        ]);
    }

    //TODO:修改状态的函数 (修改,删除功能)
    public  function  status()
    {
        //获取参数
        $data =input();
        //生成校验对象
        $validate = validate('Category');
        $res = $validate->scene('status')->check($data);
        if(!$res)
        {
            $this->error($validate->getError());
        }
        //TODO:进入数据库修改状态(修改和删除功能)
        //状态和条件
        $result = $this->obj->save(['status'=>$data['status']],['id'=>$data['id']]);
        if(!$result)
        {
            $this->error('更新失败');
        }
        $this->success('更新成功');

    }
    //TODO:添加分类

    public function  add()
    {
        $categories = $this->obj->getAllFirstNomalCategories();
        return $this->fetch('',
            [
                'categories'=>$categories
            ]);
    }

    //TODO:save

    public function save()
    {
        //获取前端发送过来的表单数据
        //判断请求的类型
        if(!request()->isPost())
        {
            $this->error('请求失败');
        }

        //校验数据

        $data =input('post.');
        $validate =validate('Category');
        $res =$validate ->scene('add')->check($data);
        if(!$res)
        {
            $this->error($validate->getError());
        }
        //添加到数据库
         $result =$this->obj->save($data);

        if(!$result)
        {
            $this->error('新增失败');
        }
        $this->success('新增成功');

    }

    public  function  edit()
    {
        $id=input('id',0,'intval');
        //根据数据库获取一行信息
        $category =$this->obj->get($id);

//        print_r($id);
        $data =$this->obj->getAllFirstNomalCategories();

        return $this->fetch('',[
           'category'=>$category,
            'categories'=>$data
        ]);
    }

    //TODO:编辑

    public function  update()
    {
        //校验数据
        $data =input();
        $validate =validate('Category');
        $res =$validate->scene('update')->check($data);

//        print_r($res);
        if(!$res)
        {
            $this->error($validate->getError());
        }
        //修改数据
        $res = $this->obj->save(
            ['name'=>$data['name'],
            'parent_id'=>$data['parent_id']],
            ['id'=>$data['id']]
        );
        if(!$res)
        {
            $this->error('跟新失败');
        }
        $this->success('更新成功');
    }

    //TODO:排序序号更新

    public function listorder()
    {
        $data =input('post.');
        $volidate =validate('Category');
        $res =$volidate->scene('listorder')->check($data);

        if(!$res)
        {
             $this->error($volidate->getError());
        }

        $result =$this->obj->save(
            ['listorder'=>$data['listorder']],
            ['id'=>$data['id']]
        );

        if(!$result)
        {
            $this->result($_SERVER['HTTP_REFERER'],0,'errer');
        }

        $this->result($_SERVER['HTTP_REFERER'],1,'success');


    }

    //TODO:测试图片的方法

    public function  test()
    {
        $res =\Map::staticImage('贵港市平南县');
        return $res;
    }


}