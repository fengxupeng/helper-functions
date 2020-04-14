<?php
namespace App;
/**
 * CREATE TABLE `network_log` (
 * `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
 * `msg` text COMMENT '提示',
 * `request` text COMMENT '请求主体(json)',
 * `response` text COMMENT '响应主体(json)',
 * `mtime` varchar(64) DEFAULT '' COMMENT '创建时间,精确到微秒',
 * `type` tinyint(4) DEFAULT '0' COMMENT '类型',
 * PRIMARY KEY (`id`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='网络日志';
 * 日志表插入一条数据
 */
class NetworkLog
{
    public static function insLog($request = [], $response = [], $msg = 'errormsg', $type = 0, $model = 'NetworkLog')
    {
        $model = new $model();
        $model->request = is_array($request) ? json_encode($request, JSON_UNESCAPED_UNICODE) : $request;
        $model->response = is_array($response) ? json_encode($response, JSON_UNESCAPED_UNICODE) : $response;
        $model->msg = is_array($msg) ? json_encode($msg, JSON_UNESCAPED_UNICODE) : $msg;
        $model->mtime = Helper::microt();
        $model->type = $type;
        $model->save();
    }
}