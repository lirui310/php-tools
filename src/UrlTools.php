<?php


namespace lirui\tools;


class UrlTools
{
    /**
     * @description 获取URL的scheme(协议)
     * @return string
     */
    public static function getScheme(): string
    {
        $slhttp = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        return $slhttp;
    }

    /**
     * @description 获取当前URL完整地址
     * @return string
     */
    public static function getCurrentURLAddress(): string
    {
        $pageURL = self::getScheme();
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    /**
     * @description 获取当前域名URL地址(带端口号)
     * @return string
     */
    public static function getDomainName(): string
    {
        $pageURL = 'http';
        if (!empty($_SERVER['HTTPS'])) {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"];
        }
        return $pageURL;
    }


    /**
     * @desc 解析url并得到url中的参数
     * @param string $url
     * @return array
     */
    public static function convertUrlQuery(string $url = ''): array
    {
        if (empty($url)) $url = self::getCurrentURLAddress();
        $arr = parse_url($url);
        $params = array();
        $query_arr = ($arr && isset($arr['query']) && !empty($arr['query'])) ? explode('&', $arr['query']) : [];
        if ($query_arr) {
            foreach ($query_arr as $param) {
                $item = array();
                $item = ($param && !empty($param)) ? explode('=', $param) : [];
                if ($item) $params[$item[0]] = $item[1];
            }
        }
        return $params;
    }
}