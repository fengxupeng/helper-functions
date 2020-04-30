<?php

namespace App\Encryption;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Parser;

class JwtEncryption
{
    /**
     * 根据手机号和用户ID创建一个token
     * @param $stri string 比如 phone . user_id
     * @param int $expireTime
     * @return string
     */
    public static function createHash($stri,$expireTime = 86400)
    {
        $time = time();
        $builder = new Builder();
        $token = $builder->identifiedBy('your project-Random', true)
            ->issuedAt($time) // 配置发行令牌的时间（iat声明）
            ->canOnlyBeUsedAfter($time) //配置令牌可以使用的时间（nbf声明）
//            ->expiresAt($time + $expireTime)// 设置过期时间
            ->withClaim("stri", $stri)
            ->getToken(new Sha256(), new Key($stri));
        return (String)$token;
    }

    /**
     * 检测Token是否过期与篡改
     * @param $token
     * @param $stri string
     * @return boolean
     */
    public static function validateHash($token, $stri)
    {
        $token = (new Parser())->parse((String)$token);
        $verify = $token->verify(new Sha256(), $stri);
        return $verify;
    }


}