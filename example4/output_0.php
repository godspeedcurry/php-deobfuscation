<?php

/* hello~ */
error_reporting(E_ALL ^ E_NOTICE);
define('¤–', '×Þ');
$var_0[¤–] = explode('|||', 'defined|||ROOT|||Forbidden Access Directly.|||REMOTE_ADDR|||HTTP_CDN_SRC_IP|||HTTP_CLIENT_IP|||HTTP_X_FORWARDED_FOR|||username|||isLogin|||role|||admin|||unserialize|||content|||id|||array_push|||toArray|||trim||||||notNull');
if (!$var_0[¤–][0]($var_0[¤–][0x1])) {
    die($var_0[¤–][0x2]);
}
class class_0
{
    static function getIp()
    {
        $var_1 =& $var_0[¤–];
        $var_2 = $var_3[$var_1[0x3]];
        if (isset($var_3[$var_1[0x4]])) {
            $var_2 = $var_3[$var_1[0x4]];
        } else {
            if (isset($var_3[$var_1[0x5]])) {
                $var_2 = $var_3[$var_1[0x5]];
            } else {
                if (isset($var_3[$var_1[0x6]])) {
                    $var_2 = $var_3[$var_1[0x6]];
                }
            }
        }
        return $var_2;
    }
    static function isLogin()
    {
        return !empty($var_4[$var_0[¤–][0x7]]);
    }
    static function isAdmin()
    {
        $var_5 =& $var_0[¤–];
        return self::{$var_0[¤–][0x8]}() && $var_4[$var_5[0x9]] === $var_5[0xa];
    }
    static function result2ContentArray($var_6)
    {
        $var_7 =& $var_0[¤–];
        $var_8 = [];
        foreach ($var_6 as $var_9) {
            if ($var_10 = $var_7[0xb]($var_9[$var_7[0xc]])) {
                $var_10->id = $var_9[$var_7[0xd]];
                $var_7[0xe]($var_8, $var_10->{$var_0[¤–][0xf]}());
            }
        }
        return $var_8;
    }
    static function notNull($var_11)
    {
        $var_12 =& $var_0[¤–];
        return isset($var_11) && $var_12[0x10]($var_11) !== $var_12[0x11] && $var_11 !== array();
    }
    static function _notNull($var_13)
    {
        foreach ($var_13 as $var_14) {
            if (!self::{$var_0[¤–][0x12]}($var_14)) {
                return !1;
            }
        }
        return !0;
    }
}