<?php
/**
 * Created by PhpStorm.
 * User: AKTJ
 * Date: 2019/9/23
 * Time: 12:38
 */
header("Content-type: text/html; charset=utf-8");
//得到post过来的数据
$post=$_POST;
//设定保存的文件名
$file  = 'save2.txt';
//将post过来的数据存到文件中
file_put_contents($file, $post,FILE_APPEND);