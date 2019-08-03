<?php
defined("BASE_PATH") or exit('Access Denied');
//项目自定义帮助助手函数

/////////////////start tph3 使用、//////////////
define('MODULE_PATH', BASE_PATH);
define('MODULE_NAME', 'tph3');
define('APP_NAME', 'tph3');
if (!function_exists('U')) {
    /**
     * 采有TP5最新助手函数特性实现函数简写方式 M
     * URL组装 支持不同URL模式
     * @param string $url URL表达式，格式：'[模块/控制器/操作#锚点@域名]?参数1=值1&参数2=值2...'
     * @param string|array $vars 传入的参数，支持数组和字符串
     * @param string|boolean $suffix 伪静态后缀，默认为true表示获取配置值
     * @param boolean $domain 是否显示域名
     * @return string
     */
    function  U($url='',$vars='',$suffix=true,$domain=false) 
    {
       return $url;
    }
}


///////////end  tph3  使用///////////////