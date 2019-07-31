<!-- 物件詳細 -->
<table>
<a href="#" class="property-title c"><? echo $val['PROPERTY_NAME']." ".$val['ROOM_NUMBER'] ?></a>
  <tbody>
    <tr>
      <th>賃料 / 管理費</th>
      <td>
        <? echo number_format($val['RENT']).'円 / '?>
        <? echo number_format($val['MANAGEMENT_FEE'] + $val['COMMON_SERVISE_FEE']).'円'?>
    </tr>

    <tr>
      <th>築年数</th>
      <td><? if ($val['BUILDING_YEAR'] != null ) echo substr($val['BUILDING_YEAR'],0,4).'年'.substr($val['BUILDING_YEAR'], 4).'月' ?></td>
    </tr>

    <tr>
      <th>最寄り駅</th>
      <td>
        <? echo $val['TRAIN_ROUTE']?> <? echo $val['STATION_NAME'].'駅 / 徒歩'.$val['MINUTES_WALKING'].'分'?></td>
    </tr>

    <tr>
      <th>間取り / 占有面積</th>
      <td><? echo $val['FLOOR_PLAN'].' / ' ?>
          <? if ($val['OCCUPIED_AREA']!= null) echo $val['OCCUPIED_AREA'].'㎡'?></td>
    </tr>

    <tr>
      <th>所在地</th>
      <td> <? echo $val['ADDRESS1'].$val['ADDRESS2'].$val['ADDRESS3'] ?></td>
    </tr>

    <tr>
      <th>敷/礼/保証金</th>
      <td><? echo number_format($val['DEPOSIT_MONEY_PRICE']).'円 / '.number_format($val['KEY_MONEY_PRICE']).'円 / '.number_format($val['GUARANT_MONEY_PRICE']).'円'?></td>
    </tr>

    <tr>
      <th>構 造</th>
      <td><? echo $val['BUILDING_TYPE'] ?></td>
    </tr>

    <tr>
      <th>更新日時</th>
      <td>
        <? echo str_replace("-", "/", $val['UPDATE_DATE']) ?>
      </td>
    </tr>

    <tr>
      <th>ポイント</th>
      <td><? echo $val['REMARKS_2'] ?></td>
    </tr>

    <input type="hidden" id="pkey_<? echo $key ?>" name="property-id" value="<? echo $key ?>">
  </tbody>
</table><? if ($val['RECOMMEND_FLAG'] == 1) { echo '<span class="option1">おすすめ</span>';} ?>
