<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/9
 * Time: 15:08
 */

namespace app\index\common;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
class JWT
{

    private static $instance;

    private $issuer;
    private $aud;
    private $secret = '4f1g23a12aa';


    public static function get_Instance()
    {
        if(!self::$instance) self::$instance = new self();
        return self::$instance;
    }

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    public function setIssuer($issuer)
    {
        $this->issuer = $issuer;
        return $this;
    }

    public function getIssuer()
    {
        return $this->issuer;
    }

    public function setAudience($audience)
    {
        $this->aud = $audience;
        return $this;
    }

    public function getAudience()
    {
        return $this->aud;
    }


    public function encode($uid)
    {
        return $token = (new Builder())->setIssuer($this->issuer) // Configures the issuer (iss claim)
        ->setAudience($this->aud) // Configures the audience (aud claim)
        ->setId($this->secret, true) // Configures the id (jti claim), replicating as a header item
        ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
        ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
        ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
        ->set('uid', $uid) // Configures a new claim, called "uid"
        ->getToken(); // Retrieves the generated token
    }


    public function detest()
    {
    }

    
    public function decode($token)
    {
        return $token = (new Parser())->parse((string) $token);
    }

    public function validate()
    {

    }
    
    
}