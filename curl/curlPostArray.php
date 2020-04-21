<?php

function asynch($data,$url)
{
    $ch = curl_init();//初始化
    $curl_opt = array(
        CURLOPT_URL=>$url,//设置需要获取的URL地址
        CURLOPT_RETURNTRANSFER=>1,//将curl_exec()获取的信息以文件流的形式返回，而不是直接输出,类似案例一的设置HTTP头
        CURLOPT_POST=>1,
//    CURLOPT_POSTFIELDS=>json_encode($data),
        CURLOPT_POSTFIELDS=>$data,
        CURLOPT_TIMEOUT=>1//设置cURL允许执行的最长秒数
    );
    curl_setopt_array($ch, $curl_opt);//为 cURL 传输会话批量设置选项
    $result['response'] = curl_exec($ch);//抓取URL并把它传递给浏览器 成功时返回 TRUE， 失败时返回 FALSE
    $result['httpCode'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);//获取一个cURL连接资源句柄的信息,CURLINFO_HTTP_CODE - 最后一个收到的HTTP代码
    var_dump(curl_error($ch));//显示错误原因
    curl_close($ch);//关闭cURL资源，并且释放系统资源
    return $result;
}
ignore_user_abort(true);//表示忽略与用户的断开
set_time_limit(0);//设定程式所允许执行的秒数无时间上的限制
//$data = file_get_contents("php://input");//接收json数据
$data = array('a' => 1, 'b' => 2, 'c' => 2);
$url='test.com/curl/bb.php';//接受curl请求的地址
$result = asynch($data,$url);
var_dump($result);

