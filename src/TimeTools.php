<?php

namespace lirui\tools;


class TimeTools
{
    /**
     * @description 获取当前时间(格式化)
     * @param string $date_default_timezone_set
     * @param string $format
     * @return string
     */
    public static function now(string $date_default_timezone_set = 'Asia/Shanghai', string $format = 'Y-m-d H:i:s'): string
    {
        date_default_timezone_set($date_default_timezone_set);
        return date($format, time());
    }

    /**
     * @description 通过城市缩写获取 获取当前时间(格式化)
     * @param string $country 默认cn 可选：cn中国上海|jpn日本东京|usa美国纽约|uk英国伦敦|aus澳大利亚悉尼|can加拿大多伦多
     * @param string $fromat
     * @return string
     */
    public static function nowByCountry(string $country = 'cn', string $format = 'Y-m-d H:i:s'): string
    {
        $country = $country ? strtolower($country) : '';
        switch ($country) {
            case 'cn' :
                $date_default_timezone_set = 'Asia/Shanghai';
                break;
            case 'jpn':
                $date_default_timezone_set = 'Asia/Tokyo';
                break;
            case 'usa':
                $date_default_timezone_set = 'America/New_York';
                break;
            case 'uk':
                $date_default_timezone_set = 'Europe/London';
                break;
            case 'aus':
                $date_default_timezone_set = 'Australia/Sydney';
                break;
            case 'can':
                $date_default_timezone_set = 'America/Toronto';
                break;
            default:
                $date_default_timezone_set = 'Asia/Shanghai';
                break;
        }

        return self::now($date_default_timezone_set, $format);
    }

    /**
     * @description 得到某天凌晨零点的时间戳
     * @param string $str 默认today 可选：today|yesterday|tomorrow|month_first|year_first
     * @return int
     */
    public static function getSomeZeroTimeStamp($str = 'today')
    {

        switch ($str) {
            case 'today':   // 今天凌晨零点的时间戳
                return strtotime(date("Y-m-d"), time());
                break;
            case 'yesterday':   // 昨天 即 今天凌晨零点的时间戳 减去 一天的秒数
                return strtotime(date("Y-m-d"), time()) - 3600 * 24;
                break;
            case 'tomorrow':    // 明天 即 今天凌晨零点的时间戳 加上 一天的秒数
                return strtotime(date("Y-m-d"), time()) + 3600 * 24;
                break;
            case 'month_first': // 这个月第一天凌晨零点的时间戳
                return strtotime(date("Y-m"), time());
                break;
            case 'year_first':  // 这一年第一天凌晨零点的时间戳
                return strtotime(date("Y-01"), time());
                break;
            default:   // 默认为今天凌晨零点的时间戳
                return strtotime(date("Y-m-d"), time());
                break;
        }

    }

    /**
     * @description 友好时间显示
     * @param $time 时间戳
     * @param string $lang $lang 语言, cn 中文, en 英文
     * @return bool|string
     */
    public static function getFriendDate($time, $lang = 'cn'): string
    {
        if (!$time || !strtotime($time)) {
            return '';
        }
        $f_date = '';
        $d = time() - intval($time);
        $ld = $time - mktime(0, 0, 0, 0, 0, date('Y')); //得出年
        $md = $time - mktime(0, 0, 0, date('m'), 0, date('Y')); //得出月
        $byd = $time - mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')); //前天
        $yd = $time - mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')); //昨天
        $dd = $time - mktime(0, 0, 0, date('m'), date('d'), date('Y')); //今天
        $td = $time - mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')); //明天
        $atd = $time - mktime(0, 0, 0, date('m'), date('d') + 2, date('Y')); //后天
        if ($lang == 'cn') {
            if ($d <= 10) {
                $f_date = '刚刚';
            } else {
                switch ($d) {
                    case $d < $atd:
                        $f_date = date('Y年m月d日', $time);
                        break;
                    case $d < $td:
                        $f_date = '后天' . date('H:i', $time);
                        break;
                    case $d < 0:
                        $f_date = '明天' . date('H:i', $time);
                        break;
                    case $d < 60:
                        $f_date = $d . '秒前';
                        break;
                    case $d < 3600:
                        $f_date = floor($d / 60) . '分钟前';
                        break;
                    case $d < $dd:
                        $f_date = floor($d / 3600) . '小时前';
                        break;
                    case $d < $yd:
                        $f_date = '昨天' . date('H:i', $time);
                        break;
                    case $d < $byd:
                        $f_date = '前天' . date('H:i', $time);
                        break;
                    case $d < $md:
                        $f_date = date('m月d日 H:i', $time);
                        break;
                    case $d < $ld:
                        $f_date = date('m月d日', $time);
                        break;
                    default:
                        $f_date = date('Y年m月d日', $time);
                        break;
                }
            }
        } else {
            if ($d <= 10) {
                $f_date = 'just';
            } else {
                switch ($d) {
                    case $d < $atd:
                        $f_date = date('Y-m-d', $time);
                        break;
                    case $d < $td:
                        $f_date = 'the day after tomorrow' . date('H:i', $time);
                        break;
                    case $d < 0:
                        $f_date = 'tomorrow' . date('H:i', $time);
                        break;
                    case $d < 60:
                        $f_date = $d . 'seconds ago';
                        break;
                    case $d < 3600:
                        $f_date = floor($d / 60) . 'minutes ago';
                        break;
                    case $d < $dd:
                        $f_date = floor($d / 3600) . 'hour ago';
                        break;
                    case $d < $yd:
                        $f_date = 'yesterday' . date('H:i', $time);
                        break;
                    case $d < $byd:
                        $f_date = 'the day before yesterday' . date('H:i', $time);
                        break;
                    case $d < $md:
                        $f_date = date('m-d H:i', $time);
                        break;
                    case $d < $ld:
                        $f_date = date('m-d', $time);
                        break;
                    default:
                        $f_date = date('Y-m-d', $time);
                        break;
                }
            }
        }
        return $f_date;
    }

    /**
     * @desc 获取当前时间的前7天
     * @return array
     */
    public static function getLast7Days(): array
    {

        $begin = strtotime(date('Y-m-d', strtotime('-6 days')));  // ? 7天前
        $today_time = strtotime(date('Y-m-d'));  // ? 7天前
        $now_time = time();
        $weeks_arr = array();
        $weeks_arr['date'] = array();
        $weeks_arr['weeks'] = array();
        $weeks_arr['day'] = array();
        $weeks_array = array("日", "一", "二", "三", "四", "五", "六"); // 先定义一个数组
        $day_second = 3600 * 24;
        for ($i = $begin; $i < $now_time; $i = $i + $day_second) {
            if ($i != $today_time) {
                array_push($weeks_arr['date'], $i);
            } else {
                array_push($weeks_arr['date'], $now_time);
            }
            array_push($weeks_arr['weeks'], '星期' . $weeks_array[date('w', $i)]);
            array_push($weeks_arr['day'], date('Y-m-d', $i));
        }
        return $weeks_arr;
    }

    /**
     * @desc 获取星期几的信息
     * @param $time 时间戳
     * @param string $lang 语言, cn 中文, en 英文
     * @return mixed
     */
    public static function getWeekDay($time, $lang = 'cn'): string
    {
        if (!$time || !strtotime($time)) {
            return '';
        }

        if ($lang == 'cn') {
            $week_array = array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六");
            return $week_array[date("w", $time)];
        } else {
            return date("l"); // date("l") 可以获取英文的星期比如Sunday
        }
    }


    /**
     * @desc 获取月份
     * @param $time 时间戳
     * @param string $lang cn 中文, en 英语
     * @return string
     */
    public static function getMonth($time, $lang = 'cn')
    {
        if (!$time || !strtotime($time)) {
            return '';
        }

        if ($lang == 'cn') {
            $month_arr = array(
                '1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'
            );
        } else {
            $month_arr = array(
                'Jan.', 'Feb.', 'Mar.', 'Apr.', 'May.', 'Jun.', 'Jul.', 'Aug.', 'Sept.', 'Oct.', 'Nov.', 'Dec.'
            );
        }
        $month = date('n', $time);
        return $month_arr[$month - 1];
    }
}