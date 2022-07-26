<?php

namespace UserCenter\tests\utils;

use UserCenter\utils\UserUtil;

/**
 * 测试调用
 */
class TestUtil
{
    private $baseUrl = 'http://api.abc.com';
//    private $baseUrl = 'http://10.15.82.102:9529';

    private $appKey = '822226955566989696';

    private $appSecret = 'oAz2ACQwMzIyMjIwQjEaMeg1UDYkdH';

    public function getToken()
    {
        $response = (new UserUtil($this->baseUrl, $this->appKey, $this->appSecret))->getToken('2f7db09947674402a005374023140771');
        print_r($response);
    }

    public function getUserInfo()
    {
        $response = (new UserUtil($this->baseUrl, $this->appKey, $this->appSecret))->info('bearer-92cf26f3-66ae-4681-b08f-f492e3ded5f4');
        print_r($response);
    }

    public function getIdentityInfo()
    {
        $response = (new UserUtil($this->baseUrl, $this->appKey, $this->appSecret))->identityInfo('bearer-92cf26f3-66ae-4681-b08f-f492e3ded5f4');
        print_r($response);
    }

    public function batchSync()
    {
        $response = (new UserUtil($this->baseUrl, $this->appKey, $this->appSecret))
            ->batchSync([
                ['username' => '123', 'mobile' => '13899990000', 'password' => '123456'],
                ['username' => '1234', 'mobile' => '13899991111', 'password' => '123456'],
            ]);
        print_r($response);
    }

    public function modifyPwd()
    {
        $response = (new UserUtil($this->baseUrl, $this->appKey, $this->appSecret))
            ->modifyPwd('bearer-92cf26f3-66ae-4681-b08f-f492e3ded5f4', 'openid', 'password');
        print_r($response);
    }

    public function bindMobile()
    {
        $response = (new UserUtil($this->baseUrl, $this->appKey, $this->appSecret))
            ->bindMobile('bearer-92cf26f3-66ae-4681-b08f-f492e3ded5f4', 'openid', '13099998888');
        print_r($response);
    }
}
