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

    public function refreshToken()
    {
        $response = (new UserUtil($this->baseUrl, $this->appKey, $this->appSecret))->refreshToken('2f7db09947674402a005374023140771');
        print_r($response);
    }

    public function checkToken()
    {
        $response = (new UserUtil($this->baseUrl, $this->appKey, $this->appSecret))->checkToken('2f7db09947674402a005374023140771','748908935037059072');
        print_r($response);
    }

    public function getUserInfo()
    {
        $response = (new UserUtil($this->baseUrl, $this->appKey, $this->appSecret))->info('748908934999310336-741216953560989696-28ac3428c74c455ab442acf07847236a','748908934999310336');
        print_r($response);
    }

    public function getIdentityInfo()
    {
        $response = (new UserUtil($this->baseUrl, $this->appKey, $this->appSecret))->identityInfo('bearer-92cf26f3-66ae-4681-b08f-f492e3ded5f4','123123');
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
            ->modifyPwd('bearer-e842819a-f442-41f4-bdec-007dc3c318d0', '748908935037059072', '123123');
        print_r($response);
    }

    public function bindMobile()
    {
        $response = (new UserUtil($this->baseUrl, $this->appKey, $this->appSecret))
            ->bindMobile('bearer-92cf26f3-66ae-4681-b08f-f492e3ded5f4', 'openid', '13099998888');
        print_r($response);
    }

    public function bindEmail()
    {
        $response = (new UserUtil($this->baseUrl, $this->appKey, $this->appSecret))
            ->bindEmail('bearer-e842819a-f442-41f4-bdec-007dc3c318d0', '748908935037059072', 'liguidong94@gmail.com');
        print_r($response);
    }

    public function modifyInfo()
    {
        $response = (new UserUtil($this->baseUrl, $this->appKey, $this->appSecret))
            ->modifyInfo('bearer-e842819a-f442-41f4-bdec-007dc3c318d0', '748908935037059072', [
                'nickname' => '飞天小女警',
                'gender' => 2,
                'avatar' => 'https://t8.baidu.com/it/u=2580395625,86315079&fm=74&app=80&size=f256,256&n=0&f=JPEG&fmt=auto?sec=1659718800&t=0a0d9dd00be4efa2555498f2d95d611d',
                'birthdate' => '1996-06-07',
                'realname' => '南希',
                'idType' => 1,
                'idNumber' => '110225199606076127',
            ]);
        print_r($response);
    }

    public function deleteUser()
    {
        $response = (new UserUtil($this->baseUrl, $this->appKey, $this->appSecret))
            ->deleteUser('13899990000');
        print_r($response);
    }

    public function passwordEncrypt()
    {
        $response = (new UserUtil($this->baseUrl, $this->appKey, $this->appSecret))
            ->passwordEncrypt('123456');
        print_r($response);
    }
}
