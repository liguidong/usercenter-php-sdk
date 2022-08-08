<?php

namespace UserCenter\utils;

use UserCenter\config\Config;

class AuthUtil
{
    /**
     * 生成鉴权sign
     * @param $params
     * @return string
     */
    static public function sign($params)
    {
        unset($params['sign']);
        ksort($params);
        $sign = Config::getInstance()->getAppSecret();
        foreach ($params as $k => $v) {
            $sign .= $k . $v;
        }
        $sign = md5($sign . Config::getInstance()->getAppSecret());

        return strtoupper($sign);
    }
}