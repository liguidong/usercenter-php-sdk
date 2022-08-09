![logo.png](https://s2.loli.net/2022/08/05/NR3hvjk7A2OI1fD.png)

# CJRB用户中心

📦 一个 PHP 用户中心 SDK，用于集团内各平台用户信息互联互通。

![php](https://img.shields.io/badge/php-5.4-brightgreen)![composer](https://img.shields.io/badge/composer-1.1.0-brightgreen)![GitHub](https://camo.githubusercontent.com/029166d85f92969845201e59c3fcd8c8345556036155ff18140f6a9e796173a3/68747470733a2f2f696d672e736869656c64732e696f2f62616467652f6c6963656e73652d4d49542d677265656e)

## 环境要求

- PHP >= 5.4.0
- [Composer](https://getcomposer.org/) >= 1.1.0

## 安装

此UserCenter PHP SDK 可以使用[Composer](https://getcomposer.org/)安装，执行此命令：

```
composer require cjrb/dawuhan-php-usercenter-sdk
```

## 开始使用

> 注意：此版本的UserCenter SDK for PHP 需要PHP5.4 或更高版本

通过code获取AccessToken的简单示例：

```php
$response = (new UserUtil($baseUrl, $appKey, $appSecret))->getToken('code');
print_r($response);
```

更多接入信息请查阅 [接口文档](https://thoughts.aliyun.com/share/62d4b2b11e1eca001b40834c#title=用户中心技术文档) ，SDK更多使用方法请查看 [测试用例](/tests/TestUtil.php)





## SDK功能完成

* 用户
  - [x] 获取AccessToken
  - [x] 刷新Token
  - [x] 校验Token
  - [x] 获取用户信息
  - [x] 获取用户身份信息
  - [x] 批量同步用户信息
  - [x] 修改密码
  - [x] 换绑手机
  - [x] 换绑邮箱
  - [x] 修改用户资料
  - [x] 密码加密
  
* 订单
  - [ ] 获取订单列表
  - [ ] 新增订单
  - [ ] 更新订单
* 其他
  - [x] sign生成



## License

*  [MIT](/LICENSE.md)

## 安全漏洞

如果您发现安全问题，请直接通过 [liguidong94@gmail.com](mailto:liguidong94@gmail) 联系维护人员。