<?php

class ColumnNameConst
{

    // 従業員情報のプライマリキー
    const EMPLOYEE_LIST_KEY = 'EMPLOYEE_ID';

    // 従業員情報の物理名
    const EMPLOYEE_LIST_PYSICAL_NAMES =  [
        'EMPLOYEE_ID', 'EMPLOYEE_NAME', 'EMPLOYEE_YOMI', 'EMPLOYEE_JOB', 'EMPLOYEE_CELLPHONE'
    ];


    // 物件情報のプライマリキー
    const ROOM_INFO_PRIMARY_KEY = 'PROPERTY_ID';

    // 物件情報の物理名
    const ROOM_INFO_PYSICAL_NAMES = [
        'PROPERTY_ID',
        'COMPANY_NAME',
        'PHONE_NUMBER',
        'PREF',
        'ADDRESS1',
        'ADDRESS2',
        'ADDRESS3',
        'PROPERTY_NAME',
        'ROOM_NUMBER',
        'TRAIN_ROUTE',
        'STATION_NAME',
        'MINUTES_WALKING',
        'PROPERTY_STATUS',
        'RESISTANCE_WHEN',
        'RESISTANCE_MONTH',
        'RESISTANCE_MONTH_DIVISION',
        'RENT',
        'GUARANT_MONEY_PRICE',
        'GUARANT_MONEY_MONTH',
        'KEY_MONEY_PRICE',
        'KEY_MONEY_MONTH',
        'DEPOSIT_MONEY_PRICE',
        'DEPOSIT_MONEY_MONTH',
        'OCCUPIED_AREA',
        'MANAGEMENT_FEE',
        'COMMON_SERVISE_FEE',
        'OTHER_FEE',
        'FLOOR_PLAN',
        'FLOOR_PLAN_OTHER',
        'BUILDING_TYPE',
        'PROPERTY_FLOOR_NUMBER',
        'BUILDING_YEAR',
        'NEW_CONSTRUCTION_FLAG',
        'REMARKS_1',
        'REMARKS_2',
        'FAX_NUMBER',
        'ROOM_PHOTO',
        'RELEASE_FLAG',
        'AD_FLAG',
        'NEW_ARRIVAL_FLAG',
        'RECOMMEND_FLAG',
        'FAVORITE_CNT',
        'MEMO',
        'REGIST_DATE',
        'UPDATE_DATE',
        'FREE_WORD'
    ];

    // DBの論理名
    const ROOM_INFO_LOGICAL_CONST = [
        '物件番号',
        '会員名',
        '代表電話番号',
        '都道府県名',
        '所在地名1',
        '所在地名2',
        '所在地名3',
        '建物名',
        '部屋番号',
        '沿線略称（1）',
        '駅名（1）',
        '徒歩（分）1（1）',
        '現況',
        '入居時期',
        '入居年月（西暦）',
        '入居旬',
        '賃料',
        '保証金1（額）',
        '保証金2（ヶ月）',
        '礼金1（額）',
        '礼金2（ヶ月）',
        '敷金1（額）',
        '敷金2（ヶ月）',
        '使用部分面積',
        '管理費',
        '共益費',
        'その他月額費用金額1',
        '間取タイプ（1）',
        '間取りその他（1）',
        '建物構造',
        '所在階',
        '築年月（西暦）',
        '新築フラグ',
        '備考1',
        '備考2',
        'FAX番号',
        '画像データ',
        '掲載フラグ',
        'ADフラグ',
        '新着フラグ',
        'おすすめフラグ',
        'いいね数',
        'メモ',
        '登録日',
        '最終更新日',
        'フリーワード検索'
    ];

    // csvファイル抽出で使用する必要カラム番号
    const USE_COLUMN = [
        0,
        4,
        5,
        14,
        15,
        16,
        17,
        18,
        19,
        22,
        23,
        24,
        35,
        37,
        38,
        39,
        48,
        52,
        53,
        57,
        59,
        60,
        61,
        74,
        92,
        95,
        100,
        130,
        161,
        170,
        174,
        176,
        177,
        189,
        190
    ];

    const NEED_CONVERT_COLUMN = [
        "現況",
        "入居時期",
        "入居句",
        "間取タイプ（1）",
        "建物構造"
    ];
}