<?php

/**
 * 远程GET请求（不获取内容）函数
 * @param string $host 域名
 * @param string $url 路径
 * @param array $param 传输数据
 * @return array 返回error_code
 */
function _sock_get($host, $url, $param)
{
    $port = parse_url($url, PHP_URL_PORT);//获取端口
    $port = $port ? $port : 80;
    $scheme = parse_url($url, PHP_URL_SCHEME);//获取协议 http https
    $path = parse_url($url, PHP_URL_PATH);//获取域名
    $query = isset($param) ? http_build_query($param) : '';//获取路径

    if ($scheme == 'https') {
        $host = 'ssl://' . $host;
    }

    $fp = fsockopen($host, $port, $error_code, $error_msg, 1);

    if (!$fp) {
        return array('error_code' => $error_code, 'error_msg' => $error_msg);
    } else {
        stream_set_blocking($fp, true);//开启非阻塞模式
        stream_set_timeout($fp, 1);//设置超时
        $header = "GET $path" . "?" . "$query" . " HTTP/1.1\r\n";
        $header .= "Host: $host\r\n";
        $header .= "Connection: close\r\n\r\n";//长连接关闭
        fwrite($fp, $header);
        //实现异步把下面注释掉，意思是不处理返回
//         $receive = '';
//         while (!feof($fp)) {
//         $receive .= fgets($fp, 128);
//         }
//         echo "<br />".$receive;
        usleep(2000); // 延时，防止在nginx服务器上无法执行成功
        fclose($fp);
        return array('error_code' => 0);
    }
}

ignore_user_abort(true);
set_time_limit(0);

//测试案例，发送get请求
$host = 'test.com';
$url = '/fsockopen/get_return.php';
$data = array(
    'jumpUrl' => 'test.com/fsockopen/get_return.php',//注意：回调URL也写在这里
    'fromUrl' => 'test.com/fsockopen/_sock_get.php',
    'msg' => 'this is a test',
);
$asyncData = _sock_get($host, $url, $data);
var_dump($asyncData);