<?php

namespace UserCenter\utils;

use UserCenter\config\Config;

abstract class AbstractUtil
{
    /**
     * @param $baseUrl
     * @param $appKey
     * @param $appSecret
     * @param $debug
     */
    public function __construct($baseUrl, $appKey, $appSecret, $debug = false)
    {
        Config::getInstance()->setBaseUrl($baseUrl);
        Config::getInstance()->setAppKey($appKey);
        Config::getInstance()->setAppSecret($appSecret);
        Config::getInstance()->setDebug($debug);
    }
}