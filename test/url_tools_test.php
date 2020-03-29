<?php

include_once __DIR__ . '/../src/UrlTools.php';

// 测试 获取当前URL地址
echo "测试 获取URL的scheme(协议):";
echo "<br/>";
echo \lirui\tools\UrlTools::getScheme();
echo "<hr>";

// 测试 获取当前URL地址
echo "测试 获取当前URL完整地址:";
echo "<br/>";
echo \lirui\tools\UrlTools::getCurrentURLAddress();
echo "<hr>";

// 测试 获取当前域名URL
echo "测试 获取当前域名URL地址（带端口号）:";
echo "<br/>";
echo \lirui\tools\UrlTools::getDomainName();
echo "<hr>";

// 测试 解析url并得到url中的参数
echo "测试 解析url并得到url中的参数: 参数:https://www.baidu.com?m=index&a=index&name=test123 如果不传参数 参数默认当前URL完整地址";
echo "<br/>";
$res = \lirui\tools\UrlTools::convertUrlQuery('https://www.baidu.com?m=index&a=index&name=test123');
echo "<pre>";
var_dump($res);
echo "</pre>";
echo "测试 解析url并得到url中的参数: 参数:无";
$res = \lirui\tools\UrlTools::convertUrlQuery();
echo "<pre>";
var_dump($res);
echo "</pre>";
echo "<hr>";
