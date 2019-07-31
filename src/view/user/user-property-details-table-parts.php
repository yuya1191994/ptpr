<!-- 物件詳細 -->
<table>
<a href="#" class="property-title c"><? echo $val['PROPERTY_NAME']." ".$val['ROOM_NUMBER'] ?></a><br>
  <tbody>
    <tr>
      <th>物件番号</th>
      <td>
        <? echo $key ?>
      </td>
    </tr>

    <tr>
      <th>物件登録日</th>
      <td>
        <? echo str_replace("-", "/", $val['REGIST_DATE']) ?>
      </td>
      <th>最終更新日</th>
      <td>
        <? echo str_replace("-", "/", $val['UPDATE_DATE']) ?>
      </td>
    </tr>

    <tr>
      <th>物件名称</th>
      <td>
        <? echo $val['PROPERTY_NAME']?>
      </td>
      <th>号室</th>
      <td>
        <? echo $val['ROOM_NUMBER']?>
      </td>
    </tr>

    <tr>
      <th>最寄り駅</th>
      <td>
        <? echo $val['TRAIN_ROUTE']?> <? echo $val['STATION_NAME'] ?></td>
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
      <th>間取り詳細</th>
      <td colspan="3"><? echo $val['FLOOR_PLAN_OTHER'] ?></td>
    </tr>

    <tr>
      <th>所在地</th>
      <td colspan="3"> <? echo $val['ADDRESS1'].$val['ADDRESS2'].$val['ADDRESS3'] ?>
      </td>
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
          } else {
              echo "相談";
          }
        ?>
      </td>
    </tr>

    <tr>
      <th>賃 料</th>
      <td>
        <? echo number_format($val['RENT']).'円'?>
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
      <td><? echo $val['BUILDING_TYPE'] ?></td>
    </tr>

    <tr>
      <th>ポイント</th>
      <td colspan="3"> <? echo $val['REMARKS_2'] ?> </td>
    </tr>

  </tbody>
</table><? if ($val['RECOMMEND_FLAG'] == 1) { echo '<span class="option1">おすすめ</span>';} ?>
