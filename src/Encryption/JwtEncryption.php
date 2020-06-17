<?php

namespace App\Encryption;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

/**
 * 使用前 composer require lcobucci/jwt
 * Class JwtEncryption
 * @package App\Encryption
 */
class JwtEncryption
{
    /**
     * Create token
     * @param $stri string 比如 phone . user_id
     * @param $identify string eg:Random string
     * @param int $expireTime
     * @return string
     */
    public static function createHash($stri, $identify, $expireTime = 0)
    {
        $time = time();
        if ($expireTime) {
            $expireTime = $time + $expireTime;
        }
        $builder = new Builder();
        $token = $builder->identifiedBy($identify, true)
            ->issuedAt($time)// 配置发行令牌的时间（iat声明）
            ->canOnlyBeUsedAfter($time)//配置令牌可以使用的时间（nbf声明）
            ->expiresAt($expireTime)// 设置过期时间
            ->withClaim("stri", $stri)
            ->getToken(new Sha256(), new Key($stri));
        return (String)$token;
    }

    /**
     * 检测Token是否过期与篡改
     * @param $token
     * @param $stri string
     * @param $identify
     * @return boolean
     */
    public static function validateHash($token, $stri, $identify)
    {
        $token = (new Parser())->parse((String)$token);
        $verify = $token->verify(new Sha256(), (string)$stri);
        $validationData = new ValidationData();
        $validationData->setId($identify);
        return $token->validate($validationData);
    }


}