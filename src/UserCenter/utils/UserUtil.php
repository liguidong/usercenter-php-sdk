<?php

namespace UserCenter\utils;

use UserCenter\config\Config;

class UserUtil extends AbstractUtil
{
    /**
     * 通过code 获取 token
     * @param $code
     * @return mixed
     */
    public function getToken($code)
    {
        return (new HttpUtil())->get('/authz/oauth/v20/token', [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'client_secret' => Config::getInstance()->getAppSecret()
        ]);
    }

    /**
     * 通过refresh_token 刷新 token
     * @param $refresh_token
     * @return mixed
     */
    public function refreshToken($refresh_token)
    {
        return (new HttpUtil())->get('/authz/oauth/v20/refresh_token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token,
        ]);
    }

    /**
     * 校验token
     * @param $token
     * @param $openid
     * @return mixed
     */
    public function checkToken($token,$openid)
    {
        return (new HttpUtil())->get('/authz/oauth/v20/check_token', [
            'openid' => $openid,
            'token' => $token,
        ]);
    }

    /**
     * 用户信息
     * @param $token
     * @param $openid
     * @return array
     */
    public function info($token, $openid)
    {
        return (new HttpUtil())->get('/api/user/info', ['access_token' => $token, 'openid' => $openid]);
    }

    /**
     * 用户身份信息
     * @param $token
     * @param $openid
     * @return array
     */
    public function identityInfo($token, $openid)
    {
        return (new HttpUtil())->get('/api/user/identityInfo', ['access_token' => $token, 'openid' => $openid]);
    }

    /**
     * 批量同步用户
     * @param $items array
     * @return array
     */
    public function batchSync($items)
    {
        foreach ($items as &$item) {
            if (isset($item['password'])) {
                $item['password'] = password_hash($item['password'], PASSWORD_BCRYPT);
            }
        }
        if (is_array($items)) {
            $items = json_encode($items, JSON_UNESCAPED_UNICODE);
        }
        return (new HttpUtil())->post('/api/user/batchSync', [
            'items' => $items,
        ]);
    }

    /**
     * 修改密码
     * @param $token
     * @param $openid
     * @param $password
     * @return mixed
     */
    public function modifyPwd($token, $openid, $password)
    {
        return (new HttpUtil())->post('/api/user/modifyPwd', [
            'access_token' => $token,
            'openid' => $openid,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        ]);
    }

    /**
     * 换绑手机号
     * @param $token
     * @param $openid
     * @param $mobile
     * @return array
     */
    public function bindMobile($token, $openid, $mobile)
    {
        return (new HttpUtil())->get('/api/user/bindMobile', [
            'access_token' => $token,
            'openid' => $openid,
            'mobile' => $mobile,
        ]);
    }

    /**
     * 换绑Email
     * @param $token
     * @param $openid
     * @param $email
     * @return array
     */
    public function bindEmail($token, $openid, $email)
    {
        return (new HttpUtil())->get('/api/user/bindEmail', [
            'access_token' => $token,
            'openid' => $openid,
            'email' => $email,
        ]);
    }

    /**
     * 修改用户资料
     * @param $token
     * @param $openid
     * @param $info
     * info支持字段为： nickname,gender,avatar,birthdate,realname,idType,idNumber
     * @return mixed
     */
    public function modifyInfo($token,$openid,$info)
    {
        return (new HttpUtil())->get('/api/user/modifyInfo', array_merge(['token' => $token, 'openid' => $openid], $info));
    }

    /**
     * 密码加密 bcrypt
     * @param $password
     * @return false|string|null
     */
    public function passwordEncrypt($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}