<?php

namespace UserCenter\config;

class Config
{
    /**
     * @var null
     */
    private static $_instance = NULL;

    /**
     * @var string 服务端API地址
     */
    private static $baseUrl = 'https://api.abc.com';

    /**
     * @var string 应用ID
     */
    private static $appKey = '';

    /**
     * @var string 应用秘钥
     */
    private static $appSecret = '';

    /**
     * 是否开启debug
     * @var bool
     */
    private static $debug = false;


    private function __construct()
    {
    }

    /**
     * @return Config|null
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @return void
     */
    public function __clone()
    {
        die('Clone is not allowed.' . E_USER_ERROR);
    }

    public function setBaseUrl($url)
    {
        self::$baseUrl = $url;
    }

    public function getBaseUrl()
    {
        return self::$baseUrl;
    }

    public function setAppKey($appKey)
    {
        self::$appKey = $appKey;
    }

    public function getAppKey()
    {
        return self::$appKey;
    }

    public function setAppSecret($appSecret)
    {
        self::$appSecret = $appSecret;
    }

    public function getAppSecret()
    {
        return self::$appSecret;
    }

    public function setDebug($debug)
    {
        self::$debug = $debug;
    }

    public function getDebug()
    {
        return self::$debug;
    }
}