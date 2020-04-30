<?php

namespace App\File;
class DownloadFile
{
    /**
     * 文件下载
     * 应用场景:从服务器上下载文件
     * @param $absolute_url string 绝对路径
     * @param string $filename
     */
    public static function downloads($absolute_url, $filename = 'myDownload')
    {
        $url = iconv('UTF-8', 'gbk', $absolute_url);// 兼容中文名称文件下载
        $file = fopen($url, "r");
        header("Content-Type: application/octet-stream");
        header("Accept-Length: " . filesize($url));
        header("Content-Disposition: attachment; filename=" . $filename . "");
        echo fread($file, filesize($url));
        fclose($file);
    }
}