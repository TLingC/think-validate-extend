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
use tlingc\think\validate\service\ValidateExtendService;

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
验证字段内容是否在集合中。字段内容可为集合中的一个或多个（以`,`号分隔）

例：设置规则 `inSet:black,white,red`
```
white,black -> pass
yellow,red -> fail
```
#### arrayValidate
验证数组内的元素是否能够通过指定验证器的验证场景。适合验证批量提交的使用相同验证规则的数据。

例：设置规则 `arrayValidate:app\validate\User,save`
```
//app\validate\User 有以下规则
protected $rule = [
    'name' => 'require',
    'gender' => 'require|in:0,1'
];

protected $scene = [
    'save' => ['name', 'gender']
];

//待验证数据
$data = [
  ['name' => 'name1', 'gender' => 0], //pass
  ['name' => 'name2', 'gender' => 2], //fail
  ['name' => 'name3'] //fail
];
```
#### string
验证字段是否为字符串

## 协议
MIT
