<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/18
 * Time: 下午8:24
 */

function show($code,$message,$data)
{
    return json([
       'code'=>$code,
        'message'=>$message,
        'data'=>$data

    ]);

}