<?php

include_once __DIR__ . '/../src/TimeTools.php';


// 测试 获取当前时间(格式化)
echo "测试 获取当前时间(格式化): 参数：date_default_timezone_set(默认 Asia/Shanghai) fromat(默认 Y-m-d H:i:s)";
echo "<br/>";
echo \lirui\tools\TimeTools::now();
echo "<hr>";

// 测试 获取当前时间(格式化)
echo "测试 获取当前时间(格式化): 参数：country(默认cn 可选：cn中国上海|jpn日本东京|usa美国纽约|uk英国伦敦|aus澳大利亚悉尼|can加拿大多伦多) fromat(默认 Y-m-d H:i:s)";
echo "<br/>";
echo \lirui\tools\TimeTools::nowByCountry('aus');
echo "<hr>";


