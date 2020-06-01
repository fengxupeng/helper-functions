<?php

namespace App\File;

class Upload
{
    /**
     * excel文件上传
     * @param $uploadName
     * @param $path
     */
    public static function uploadFile($uploadName, $path)
    {
        $type = [
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];
        if (!is_dir($path)) {
            mkdir($path, 0777);
        }
        $uploadFile = $_FILES[$uploadName];
        if (in_array($uploadFile['type'], $type) && $uploadFile["error"] == 0) {
            $filename = date('YmdHisl', time());
            // 关键代码
            move_uploaded_file($uploadFile['tmp_name'], $path . $filename);
        }
    }

}