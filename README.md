# think-validate-extend
[![](https://img.shields.io/packagist/v/tlingc/think-validate-extend.svg)](https://packagist.org/packages/tlingc/think-validate-extend)
[![](https://img.shields.io/packagist/dt/tlingc/think-validate-extend.svg)](https://packagist.org/packages/tlingc/think-validate-extend)
[![](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE.md)

ThinkPHP 6.0 验证规则扩展包

## 安装
```
composer require tlingc/think-validate-extend
```

## 使用
### 添加服务
应用目录下 `service.php` 添加：
```php
use tlingc\validate\service\ValidateExtendService;
return [
    ValidateExtendService::class,
];
```
### 验证规则

#### json
验证字段是否为有效的JSON字符串
#### money
验证字段是否为有效的金额（正数且小数点后最多两位）
#### inSet
验证字段内容是否在集合中

例：设置规则 `inSet:black,white,red`
> white,black -> pass
> yellow,red -> fail

## 协议
MIT