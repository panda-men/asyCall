<?php

header("Content-type: text/html; charset=utf-8");
set_time_limit(0);
ignore_user_abort(true);//设置与客户机断开是否会终止执行
//fastcgi_finish_request();//提高请求的处理速度
//$post=$_POST;
$data = $_REQUEST;//得到post过来的数据
echo '<pre>';
print_r($data);
echo '</pre>';
//设定保存的文件名
$file = '_sock_post.txt';
//将post过来的数据存到文件中
file_put_contents($file, $data, FILE_APPEND);