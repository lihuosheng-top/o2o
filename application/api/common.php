<?php
/**
 * Created by PhpStorm.
 * User: lihuosheng
 * Date: 2017/10/16
 * Time: 上午9:12
 */
function show($code,$message,$data)
{

    return json([
        'code'=>$code,
        'message'=>$message,
        'data'=>$data
    ]);


}