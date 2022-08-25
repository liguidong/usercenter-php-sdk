<?php

namespace UserCenter\utils;

use UserCenter\config\Config;

class HttpUtil
{

    public function get($uri, $params)
    {
        return $this->request($uri, 'get', $params);
    }

    public function post($uri, $params)
    {
        return $this->request($uri, 'post', $params);
    }

    private function _getUrl($uri, $method = 'get', $params = [])
    {
        $time                      = time();
        $query_params              = [];
        $query_params['appkey']    = $params['appkey'] = Config::getInstance()->getAppKey();
        $query_params['timestamp'] = $params['timestamp'] = $time;
        $query_params['sign']      = $params['sign'] = AuthUtil::sign($params);
        foreach ($params as &$value) {
            $value = urlencode($value);
        }
        if ($method == 'get') {
            $query_params = array_merge($params, $query_params);
        }

        $url          = Config::getInstance()->getBaseUrl() . $uri;
        $query_params = http_build_query($query_params, '', '&', PHP_QUERY_RFC3986);
        return $url . '?' . $query_params;
    }

    protected function request($request_uri, $method = 'get', $request_params = [], $timeout = 8)
    {
        $ch  = curl_init();
        $url = $this->_getUrl($request_uri, $method, $request_params);
        unset($request_params['appkey'], $request_params['timestamp'], $request_params['sign']);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);

        if (isset($request_params['files'])) {
            $params_file_path = $request_params['files'];
            $files['bin']     = class_exists('CURLFile') ? new \CURLFile($params_file_path) :
                ('@' . $params_file_path);
        }
        if ($method == 'post') {
            $headers = [
                'Content-Type: multipart/form-data'
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        if ($method == 'post') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, empty($files) ? $request_params : $files);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

        $result = curl_exec($ch);

        curl_close($ch);
        $ret = json_decode($result, true);

        //清理上传文件
        if (isset($params_file_path)) {
            unlink($params_file_path);
        }
        //后置操作
        $this->_after($url, $request_params, $method, $ret);

        return $ret;
    }

    /**
     * 后置操作
     * @param $url
     * @param $request_params
     * @param $method
     * @param $ret
     * @return void
     */
    private function _after($url, $request_params, $method, $ret)
    {
        if (Config::getInstance()->getDebug()) {
            $log_file = '/tmp/user_center_' . date('Ym') . '.log';
            @file_put_contents($log_file, '[time] ' . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
            @file_put_contents($log_file, '[url] ' . $url . PHP_EOL, FILE_APPEND);
            @file_put_contents($log_file, '[method] ' . $method . PHP_EOL, FILE_APPEND);
            @file_put_contents($log_file, '[params] ' . PHP_EOL, FILE_APPEND);
            @file_put_contents($log_file, var_export($request_params, true) . PHP_EOL, FILE_APPEND);
            @file_put_contents($log_file, '[response] ' . PHP_EOL, FILE_APPEND);
            @file_put_contents($log_file, var_export($ret, true) . PHP_EOL, FILE_APPEND);
            @file_put_contents($log_file, '-------------------------------' . PHP_EOL, FILE_APPEND);
        }
    }
}