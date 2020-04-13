<?php
namespace tlingc\think\validate\service;

use think\Service;
use think\Route;
use think\Validate;

class ValidateExtendService extends Service
{
    public function boot(Route $route)
    {
        Validate::maker(function ($validate) {
            $validate->extend('json', function ($value) {
                json_decode($value);
                return (json_last_error() === JSON_ERROR_NONE);
            }, ':attribute JSON数据解析失败!');

            $validate->extend('money', function ($value) {
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
        });
    }
}