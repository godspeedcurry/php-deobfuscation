<?php
function _kstr2($F���Ֆ){
    $e�貹��� = strlen($F���Ֆ);
    $B������� = '';
    $aֳ����� = ord($F���Ֆ[0]) - 30;
    for ($F���əؽ = 1; $F���əؽ < $e�貹���; $F���əؽ += 2) {
        if ($F���əؽ + 1 < $e�貹���) {
            $B������� .= chr(ord($F���Ֆ[$F���əؽ + 1]) + $aֳ�����);
            $B������� .= chr(ord($F���Ֆ[$F���əؽ]) + $aֳ�����);
        } else {
            $B������� .= chr(ord($F���Ֆ[$F���əؽ]) + $aֳ�����);
        }
    }
    return $B�������;
}