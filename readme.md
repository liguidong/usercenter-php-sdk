# CJRB用户中心

## 安装

```
composer require cjrb/usercenter-php-sdk
```

## 开始使用
```php
$response = (new UserUtil($baseUrl, $appKey, $appSecret))->getToken('code');
print_r($response);
```

更多接口请查阅
[接口文档](https://thoughts.aliyun.com/share/62d4b2b11e1eca001b40834c#title=用户中心技术文档)
或测试用例

![GitHub](https://camo.githubusercontent.com/029166d85f92969845201e59c3fcd8c8345556036155ff18140f6a9e796173a3/68747470733a2f2f696d672e736869656c64732e696f2f62616467652f6c6963656e73652d4d49542d677265656e)