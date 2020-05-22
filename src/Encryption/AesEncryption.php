<?php

namespace App\Encryption;
class Encryption
{
    /**
     * AES, 128 CBC模式加密数据
     * @param string $str
     * @param string $sign_key
     * @param string $sign_vi
     * @return string
     */
    public static function encrypt($str, $sign_key = '12f862d21d3ceafb', $sign_vi = '0000000000000000')
    {
//         $str = $this->addPKCS7Padding($str);
        $encrypt_str = openssl_encrypt($str, 'AES-128-CBC', $sign_key,
            OPENSSL_RAW_DATA, $sign_vi);
        return base64_encode($encrypt_str);
    }


    /**
     * AES, 128 CBC模式加密数据解密方法
     * @param string $str
     * @param $sign_key string
     * @param $sign_vi string
     * @return string
     */
    public static function decrypt($str, $sign_key = '12f862d21d3ceafb', $sign_vi = '0000000000000000')
    {
        //AES, 128 CBC模式加密数据
        $str = base64_decode($str);
        $encrypt_str = openssl_decrypt($str, 'AES-128-CBC', $sign_key,
            OPENSSL_RAW_DATA, $sign_vi);
//         $encrypt_str = $this->stripPKSC7Padding($encrypt_str);
        return $encrypt_str;
    }

    /**
     * 填充算法
     * Warning :mcrypt_get_block_size This function has been DEPRECATED as of PHP 7.1.0 and REMOVED as of PHP 7.2.0. Relying on this function is highly discouraged.
     * @param string $source
     * @return string
     */
    public static function addPKCS7Padding($source)
    {
        $source = trim($source);
        $block = mcrypt_get_block_size('rijndael-128', 'cbc');
        $pad = $block - (strlen($source) % $block);
        if ($pad <= $block) {
            $char = chr($pad);
            $source .= str_repeat($char, $pad);
        }
        return $source;
    }

    /**
     * 移去填充算法
     * @param string $source
     * @return string
     */
    public static function stripPKSC7Padding($source)
    {
        $char = substr($source, -1);
        $num = ord($char);
        $source = substr($source, 0, -$num);
        return $source;
    }



}