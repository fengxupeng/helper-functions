<?php

class Convert
{

    /**
     * 获取当天零点零分零秒的时间戳
     * @return false|int
     */
    public static function mktimeManual()
    {
        $start = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        return $start;
    }


    /**
     * 取某个月份开始和结束时间的时间戳
     * eg: var_dump(transformsMonth("2020-02-02 12:12:12"));
     * @param $time
     * @return array
     */
    public static function transformsMonth($time)
    {
        $start = date('Y-m-01 00:00:00', strtotime($time));
        $end = date('Y-m-t 23:59:59', strtotime($time));
        return ['start' => strtotime($start), 'end' => strtotime($end)];
    }

}
