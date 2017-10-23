<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
//状态
function status($status){
    if($status==1){
        return "<label class='label label-success radius'>正常</label>";
    }
     if($status==0)
    {
        return "<label class='label label-danger radius'>待审</label>";
    }
    if($status==-1)
    {
        return "<label class='label label-danger radius'>删除</label>";
    }
    if($status==2)
    {
        return "<label class='label label-danger radius'>不通过</label>";
    }

}

//分页
function pagination($pageObj)
{
    if(!$pageObj)
    {
        return '';
    }
    $result ="<div class='cl pd-5 bg-1 bk-gray mt-20 tp5-o2o'>".$pageObj->render()."</div>";
    return $result;
}

//网络请求的方法 :cURL

/**
 * @param $url 请求的url
 * @param int $typr 请求方式0是get 1是post
 * @param array $data 请求时的数据 (post时使用)
 */
function doCurl($url, $type=0, $data=[])
{
    //初始化curl
    $ch=curl_init();
    //设置相关的参数//set option
    //CURLOPT_UR 请求的链接
    //CURLOPT_RETURNTRANSFER 请求结果以文本流形式返回
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_HEADER,0);
    //CURLOPT_HEADE 是否返回http头部信息

    //判断请求方式

    if($type==1)
    {
        //post 请求
        curl_setopt($ch,CURLOPT_POST,$url);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);


    }
//执行Curl请求
    $res =curl_exec($ch);
    //关闭curl请求
    curl_close($ch);
    return $res;
}


//TODO:判断商品注册信息

function bisRegister($status)
{
    if($status==1)
    {

        $str ='审核通过';
    }
    else if($status==0)
    {
        $str='正在审核,稍后平台方向会向您发送邮件,请关注邮件';
    }
    else if($status ==2)
    {
        $str ='审核不通过,材料不符合要求,请重新提交';
    }
    else
    {
        $str ='该申请已经删除';
    }

    return $str;



}

//根据category_path处理二级分类信息


 function getCategoryDetailByPath($category_path)
 {
     if(empty($category_path))
     {
         return '';
     }

     if(preg_match('/,/',$category_path))
     {
         //先按照,号切割字符串(temp临时的,中间量的)
         $tempArray =explode(',',$category_path);
         // '5,10 |12|14' =>['5','10|12|14']
         $categoryID =$tempArray[0];
         $tempString =$tempArray[1];

         //按照 | 分割形成数组

         $temp_se_arr = explode('|',$tempString);

         //[10,12,14] 5分支下共有 10,12,14,16,18
         $allCategories =model('Category')->getAllFirstNomalCategories(intval($categoryID));
         //循环组合形成input标签字符串
         $htmlString ='';
         for($e=0;$e<count($allCategories);$e++)
         {
             $current =$allCategories[$e];
             //循环匹配temp_se_arr

             for($j=0;$j<count($temp_se_arr);$j++)
             {

                 $se_current =$temp_se_arr[$j];

                 //判断当前current_id的是否存在tem_se_arr中

                 if(in_array($current['id'],$temp_se_arr))
                 {
                     $htmlString .="<input type='checkbox'   value='".$current['id']."' checked>";
                     $htmlString .="<lable>".$current['name']."</lable>";
                 }
                 else{

                     $htmlString .="<input type='checkbox'  value='".$current['id']."'>";
                     $htmlString .="<lable>".$current['name']."</lable>";
                 }

             }


         }
         return $htmlString;


     }
     else
     {
      //    $categoryID =intval($category_path);
         return '';
     }
 }


 //判断是否是总店

 function  checkMain($is_main)
 {

     if($is_main==1){
         return "<label class='label label-success radius'>总店</label>";
     }
     else if($is_main==0)
     {
         return "<label class='label label-primary radius'>分店</label>";
     }
 }

 function getCityNameByCityId($city_id)
 {
     if(empty($city_id))
     {
         return '';
     }
     $city =model('City')->get($city_id);
     return $city->name;

 }

function getCategoryNameByCategoryId($category_id)
{
    if(empty($category_id))
    {
        return '';
    }
    $city =model('Category')->get($category_id);
    return $city->name;

}