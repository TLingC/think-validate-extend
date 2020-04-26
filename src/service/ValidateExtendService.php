<?php
namespace tlingc\think\validate\service;

use think\Service;
use think\Route;
use think\Validate;

use think\exception\ValidateException;

class ValidateExtendService extends Service
{
    public function boot(Route $route)
    {
        Validate::maker(function ($validate) {
            $validate->extend('json', function ($value) {
                if(empty($value)) return true;
                json_decode($value);
                return (json_last_error() === JSON_ERROR_NONE);
            }, ':attribute JSON数据解析失败!');

            $validate->extend('money', function ($value) {
                if(empty($value)) return true;
                $res = preg_match('/((^[1-9]\d*)|^0)(\.\d{0,2}){0,1}$/', $value);
                return ($res != 0);
            }, ':attribute 金额输入不合法!');

            $validate->extend('inSet', function ($value, $set) {
                if(empty($value)) return true;
                if (is_string($set)) {
                    $set = explode(',', $set);
                }
                $value = explode(',', $value);
                if(sizeof($value) != sizeof(array_unique($value))) return false;
                return empty(array_diff($value, $set));
            }, ':attribute 集合输入不合法!');

            $validate->extend('arrayValidate', function ($value, $rule, $data, $name, $desc) {
                if(empty($value)) return true;
                $rule = explode(',', $rule);

                $i = 0;
                if(count($value) == count($value, 1)) $value = [$value];
                foreach($value as $item) {
                    try {
                        Validate($rule[0])
                            ->scene($rule[1])
                            ->check($item);
                    } catch (ValidateException $e) {
                        return $name . '[' . $i . ']' . $e->getError();
                    }
                    $i++;
                }
                return true;
            }, ':attribute 数组验证未通过!');
            
            $validate->extend('string', function ($value) {
                if(empty($value)) return true;
                return is_string($value);
            }, ':attribute 必须是字符串!');

            $validate->extend('keyEq', function ($value, $set) {
                if(empty($value)) return true;
                if (is_string($set)) {
                    $set = explode(',', $set);
                }
                $keys = array_keys($value);
                return (empty(array_diff($keys, $set)) && empty(array_diff($set, $keys)));
            }, ':attribute 数组键值不合法!');
        });
    }
}