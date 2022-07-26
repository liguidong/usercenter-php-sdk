<?php

namespace UserCenter\utils;

use UserCenter\config\Config;

abstract class AbstractUtil
{
    /**
     * @param $baseUrl
     * @param $appKey
     * @param $appSecret
     */
    public function __construct($baseUrl,$appKey,$appSecret)
    {
        Config::getInstance()->setBaseUrl($baseUrl);
        Config::getInstance()->setAppKey($appKey);
        Config::getInstance()->setAppSecret($appSecret);
    }
}