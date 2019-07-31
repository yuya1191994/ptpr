<?php
// 新着アイコン
if ($val['NEW_ARRIVAL_FLAG'] == 1) {
    echo '<span class="newicon">NEW</span>';
}
// キャッシュバックアイコン
if ($val['AD_FLAG'] > 0) {
    echo '<span class="adicon">&yen;' . number_format($val['AD_FLAG'] * 100) . 'キャッシュバック</span>';
}

if ($val['NEW_CONSTRUCTION_FLAG'] == 1) {
    // 新築アイコン
    echo '<span class="sintikuicon">新築</span>';
} else if (!empty($val['BUILDING_YEAR']) && (date("Y") - substr($val['BUILDING_YEAR'], 0, 4)) <= 5){
    // 築浅アイコン(築5年以内)
    echo '<span class="tikuasaicon">築浅</span>';
}