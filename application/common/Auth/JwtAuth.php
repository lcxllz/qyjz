<?php
namespace App\Common\Auth;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\ValidationData;
//链式调用class JwtAuth{
class JWTAuth
{
    private static $instance;
    private $token;
    private $uid;
    private $secrect='*&%$@#@#!#!^&^%*^';//这里是随便写的一串编码
    private $decodeToken;
    /**
     * 获取jwtAuth句柄
     * @return JwtAuth
     */
    public static function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        //构成单例
    }

    private function __clone()
    {
        //构成单例
    }


    public function encode(){

    $config = $container->get(Configuration::class);
    assert($config instanceof Configuration);

       $now = time();
       $this->token = $config->builder() 
            // Configures the issuer (iss claim) 
            ->issuedBy($this->iss)     
            // Configures the audience (aud claim) 
            ->permittedFor($this->aud) 
            // Configures the id (jti claim) 
            ->identifiedBy('4f1g23a12aa',true) 
            // Configures the time that the token was issue (iat claim) 
            ->issuedAt($now)   //发布token时间
            // Configures the time that the token can be used (nbf claim) 
            ->canOnlyBeUsedAfter($now->modify('+1 minute')) 
            // Configures the expiration time of the token (exp claim) 
            ->expiresAt($now->modify('+1 hour'))    //token有效期1小时.
            // Configures a new claim, called "uid" 
            ->withClaim('uid', $this->uid) 
            // Configures a new header, called "foo" 
            ->withHeader('foo', 'bar') 
            // Builds a new token 
            ->getToken($config->signer(), $config->signingKey());

            return $this;   // 返回的$this->token是一个类
    }

    //将token输出成字符串
    public function getToken(){
        return (string)$this->token;
    }

    /**
     * 设置TOKEN
     * @param $token
     * @return $this
     */
    public function setToken($token){
        $this->token=$token;
        return $this;
    }
    public function setUid($uid){
        $this->uid=$uid;
        return $this;
    }
    public function getUid($uid){
        return  $this->uid;
    }

    // 用户发来的token,需要做decode
    public function decode(){
       if(!$this->decodeToken){
            // 把字符串数据转换为一个新的token对象
            $this->decodeToken = (new Parser())->parse((string)$this->token);  
            $this->uid = $this->decodeToken->getClaim('uid');
       }
       return $this->decodeToken;
    }
    // 创建验证器( 验证基本数据 )
    public function validate(){
       $data = new ValidationData();
       $data->setIssuer($this->iss);
       $data->setId('4f1g23a12aa');
       $data->setAudience($this->aud);
       return $this->decode()->validate($data);
    }
    // 验证密钥 (验证$secrect是否一致.)
    public function verify(){
       $result = $this->decode()->verify(new Sha256(),$this->secrect);
       return $result;
    }
}
