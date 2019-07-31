<!-- 物件詳細 -->
<table>
  <tbody>
    <tr>
      <th>物件番号</th>
      <td>
        <? echo $key ?>
        <input type="hidden" id="pkey_<? echo $key ?>" name="pkey" value="<? echo $key ?>">
      </td>
    </tr>

    <tr>
      <th>物件登録日</th>
      <td>
        <? echo str_replace("-", "/", $val['REGIST_DATE']) ?>
        <input type="hidden" name="regist-date" value="<? echo $val['REGIST_DATE'] ?>">
      </td>
      <th>最終更新日</th>
      <td>
        <? echo str_replace("-", "/", $val['UPDATE_DATE']) ?>
        <input type="hidden" name="update-date" value="<? echo $val['UPDATE_DATE'] ?>">
      </td>
    </tr>

    <tr>
      <th>管理会社</th>
      <td>
        <? echo $val['COMPANY_NAME'] ?>
        <input type="hidden" name="company-name" value="<? echo $val['COMPANY_NAME'] ?>">
      </td>
      <th>TEL/FAX</th>
      <td><? echo $val['PHONE_NUMBER'] ?> /
          <input type="text" id="fax_number_<? echo $key ?>" name="fax-number" value="<? echo $val['FAX_NUMBER']?>">
          <input type="hidden" name="phone-number" value="<? echo $val['PHONE_NUMBER']?>">
      </td>
    </tr>

    <tr>
      <th>物件名称</th>
      <td>
        <input type="text" id="property_name_<? echo $key ?>" name="property-name" value="<? echo $val['PROPERTY_NAME']?>">
      </td>
      <th>号室</th>
      <td>
        <input type="text" name="room-number" id="room_number_<? echo $key ?>" value="<? echo $val['ROOM_NUMBER']?>">
      </td>
    </tr>

    <tr>
      <th>最寄り駅</th>
      <td>
        <? echo $val['TRAIN_ROUTE']?> <? echo $val['STATION_NAME'] ?>
        <input type="hidden" id="train_route_<?echo $key ?>" name="train-route" value="<? echo $val['TRAIN_ROUTE']?>">
        <input type="hidden" id="station_name_<?echo $key ?>" name="station-name" value="<? echo $val['STATION_NAME']?>">
      </td>
      <th>駅徒歩</th>
      <td><? echo $val['MINUTES_WALKING'].'分'?></td>
    </tr>

    <tr>
    <th>間取り </th>
    <td><? echo $val['FLOOR_PLAN'].'<br class="sp">' ?></td>
    <th>占有面積</th>
    <td><? if ($val['OCCUPIED_AREA']!= null) echo $val['OCCUPIED_AREA'].'㎡'?></td>
    </tr>

    <tr>
      <th>所在地</th>
      <td colspan="3"> <? echo $val['ADDRESS1'].$val['ADDRESS2'].$val['ADDRESS3'] ?>
        <p>
          <a href="https://www.google.com/maps/place/<? echo $val['ADDRESS1'].$val['ADDRESS2'].$val['ADDRESS3'] ?>" target="_blank">地図をひらく</a>
        </p>
        <input type="hidden" name="addresses" value="<? echo $val['ADDRESS1'].$val['ADDRESS2'].$val['ADDRESS3'] ?>">
      </td>
    </tr>

    <tr>
      <th>間取り詳細</th>
      <td colspan="3"><? echo $val['FLOOR_PLAN_OTHER'] ?></td>
    </tr>

    <tr>
      <th>現 況</th>
      <td><? echo $val['PROPERTY_STATUS']?></td>
      <th>入居時期</th>
      <td>
        <?php
          if ($val['PROPERTY_STATUS'] == '即') {
            echo $val['PROPERTY_STATUS'];
          } else if ($val['RESISTANCE_MONTH'] != null && $val['RESISTANCE_MONTH_DIVISION'] != null) {
            echo substr($val['RESISTANCE_MONTH'], 4) . '月' . $val['RESISTANCE_MONTH_DIVISION'];
          }
        ?>
      </td>
    </tr>

    <tr>
      <th>賃 料</th>
      <td>
        <? echo number_format($val['RENT']).'円'?>
        <input type="hidden" name="rent" value="<? echo number_format($val['RENT'])?>">
      </td>
      <th>管理費</th>
      <td><? echo number_format($val['MANAGEMENT_FEE'] + $val['COMMON_SERVISE_FEE']).'円'?></td>
    </tr>

    <tr>
      <th>敷/礼/保証金</th>
      <td><? echo number_format($val['DEPOSIT_MONEY_PRICE']).'円 / '.number_format($val['KEY_MONEY_PRICE']).'円 / '.number_format($val['GUARANT_MONEY_PRICE']).'円'?></td>
      <th>その他月額費用</th>
      <td><? if ($val['OTHER_FEE']) echo $val['OTHER_FEE'].'円' ?></td>
    </tr>

    <tr>
      <th>築年数</th>
      <td><? if ($val['BUILDING_YEAR'] != null ) echo substr($val['BUILDING_YEAR'],0,4).'年'.substr($val['BUILDING_YEAR'], 4).'月' ?></td>
      <th>構 造</th>
      <td>
        <? echo $val['BUILDING_TYPE'] ?>
        <input type="hidden" id="building_type_<?echo $key ?>" name="building-type" value="<? echo $val['BUILDING_TYPE']?>">
      </td>
    </tr>

    <tr>
      <th>ポイント</th>
      <td colspan="3">
        <textarea id="recommend_point_<? echo $key ?>" name="remarks-2" style="width: 95%; min-height: 50px;"><? echo $val['REMARKS_2'] ?></textarea>
        <div class="specialbox">
          <label for="recomend-point">
            <input type="checkbox" name="recommend-point-<? echo $key ?>" value="フリーレント"
              <? if (strpos($val['REMARKS_2'], "フリーレント") !== false) { echo "checked";} ?>>
                フリーレント
          </label>
          <label for="recomend-point">
            <input type="checkbox" name="recommend-point-<? echo $key ?>" value="敷金/礼金/保証金ゼロ"
              <? if (strpos($val['REMARKS_2'], "敷金/礼金/保証金ゼロ") !== false) { echo "checked";} ?>>
                敷金/礼金/保証金ゼロ
          </label>
          <label for="recomend-point">
            <input type="checkbox" name="recommend-point-<? echo $key ?>" value="バストイレ別"
              <? if (strpos($val['REMARKS_2'], "バストイレ別") !== false) { echo "checked";} ?>>
                バストイレ別
          </label>
          <label for="recomend-point">
            <input type="checkbox" name="recommend-point-<? echo $key ?>" value="洗面台独立"
              <? if (strpos($val['REMARKS_2'], "洗面台独立") !== false) { echo "checked";} ?>>
                洗面台独立
          </label>
          <br class="sp" class="sp">
          <label for="recomend-point">
            <input type="checkbox" name="recommend-point-<? echo $key ?>" value="2階以上"
              <? if (strpos($val['REMARKS_2'], "2階以上") !== false) { echo "checked";} ?>>
                2階以上
          </label>
          <label for="recomend-point">
            <input type="checkbox" name="recommend-point-<? echo $key ?>" value="フローリング"
              <? if (strpos($val['REMARKS_2'], "フローリング") !== false) { echo "checked";} ?>>
                フローリング
          </label>
          <br class="sp" class="sp">
          <label for="recomend-point">
            <input type="checkbox" name="recommend-point-<? echo $key ?>"  value="ペット可"
              <? if (strpos($val['REMARKS_2'], "ペット可") !== false) { echo "checked";} ?>>
                ペット可
          </label>
        </div>
      </td>
    </tr>

    <tr>
      <th>管理会社備考欄</th>
      <td colspan="3"><? echo $val['REMARKS_1'] ?></td>
    </tr>

    <tr>
      <th>AD</th>
      <td colspan="3">
        <div class="specialbox">
          <label for="special{val form/special/no}">
            <input type="radio" name="ad-flag-<? echo $key ?>" value="0"
              <? if ($val['AD_FLAG'] == 0) { echo "checked";} ?>> なし
          </label>
          <label for="special{val form/special/no}">
            <input type="radio" name="ad-flag-<? echo $key ?>" value="50"
              <? if ($val['AD_FLAG'] == 50) { echo "checked";} ?>> 50
          </label>
          <label for="special{val form/special/no}">
            <input type="radio" name="ad-flag-<? echo $key ?>" value="100"
              <? if ($val['AD_FLAG'] == 100) { echo "checked";} ?>> 100
          </label>
          <label for="special{val form/special/no}">
            <input type="radio" name="ad-flag-<? echo $key ?>" value="150"
              <? if ($val['AD_FLAG'] == 150) { echo "checked";} ?>> 150
          </label>
          <label for="special{val form/special/no}">
            <input type="radio" name="ad-flag-<? echo $key ?>" value="200"
              <? if ($val['AD_FLAG'] == 200) { echo "checked";} ?>> 200
          </label>
          <label for="special{val form/special/no}">
            <input type="radio" name="ad-flag-<? echo $key ?>" value="250"
              <? if ($val['AD_FLAG'] == 250) { echo "checked";} ?>> 250
          </label>
          <label for="special{val form/special/no}">
            <input type="radio" name="ad-flag-<? echo $key ?>" value="300"
            <? if ($val['AD_FLAG'] == 300) { echo "checked";} ?>> 300
          </label>
        </div>
      </td>
    </tr>

    <tr>
      <th>おすすめ</th>
      <td colspan="3">
        <div class="specialbox">
          <label for="reccommend-flag">
            <input type="radio" name="recommend-flag-<? echo $key ?>" value="0"
              <? if ($val['RECOMMEND_FLAG'] == 0) { echo "checked";} ?>> しない
          </label>
          <label for="reccommend-flag">
            <input type="radio" name="recommend-flag-<? echo $key ?>" value="1"
              <? if ($val['RECOMMEND_FLAG'] == 1) { echo "checked";} ?>> する
          </label>
        </div>
      </td>
    </tr>

    <tr>
      <th>自社メモ欄<br>（非公開）
      </th>
      <td colspan="3" class="private">
        <textarea rows="3" id="memo_<? echo $key ?>" name="memo" style="width: 95%;"><? echo $val['MEMO'] ?></textarea>
      </td>
    </tr>

    <tr>
      <th>公開</th>
      <td colspan="3">
        <div class="specialbox">
          <label for="release-flag">
            <input type="radio" id="release_flag_0_<? echo $key ?>" name="release-flag-<? echo $key ?>" value="0"
              <? if ($val['RELEASE_FLAG'] == 0) { echo "checked";} ?>> しない
          </label>
          <label for="release-flag">
            <input type="radio" id="release_flag_1_<? echo $key ?>"name="release-flag-<? echo $key ?>" value="1"
              <? if ($val['RELEASE_FLAG'] == 1) { echo "checked";} ?>> する
          </label>
        </div>
      </td>
    </tr>
    <input type="hidden" name="property-floor-number" value="<? echo $val['PROPERTY_FLOOR_NUMBER'] ?>">
  </tbody>
</table><? if ($val['RECOMMEND_FLAG'] == 1) { echo '<span class="option1">おすすめ</span>';} ?>
