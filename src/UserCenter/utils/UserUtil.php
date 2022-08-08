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
     * 用户信息
     * @param $token
     * @return mixed
     */
    public function info($token)
    {
        return (new HttpUtil())->get('/api/user/info', ['access_token' => $token]);
    }

    /**
     * 用户身份信息
     * @param $token
     * @return mixed
     */
    public function identityInfo($token)
    {
        return (new HttpUtil())->get('/api/user/identityInfo', ['access_token' => $token]);
    }

    /**
     * 批量同步用户
     * @param $items array
     * @return void
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
            'password' => $password,
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
        return (new HttpUtil())->get('/api/user/modifyInfo', array_merge(['token'=>$token],$info));
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