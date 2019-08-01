<?php
$areas = [ "千代田区", "中央区", "港区", "新宿区", "文京区", "台東区", "墨田区", "江東区", "品川区", "目黒区", "大田区",
    "世田谷区", "渋谷区", "中野区", "杉並区", "豊島区", "北区", "荒川区", "板橋区", "練馬区", "足立区", "葛飾区", "江戸川区"
];

$rails = ["----あ行----","池上線","伊勢崎線","五日市線","井の頭線","宇都宮線","青梅線","大井町線","大江戸線","小田急線","----か行----","銀座線",
    "京王線","京王高尾線","京急空港線","京成押上線","京成金町線","京成本線","京浜急行線","京浜東北線","京葉線","国分寺線","----さ行----","埼京線",
    "埼玉高速線","相模原線","湘南新宿宇","湘南新宿高","上越新幹線","常磐緩行線","常磐線","西武池袋線","西武新宿線","西武多摩川","西武拝島線",
    "西武山口線","西武有楽町","世田谷線","総武線","総武中央線","----た行----","高崎線","多摩湖線","多摩線","多摩モノレ","中央線","千代田線",
    "つくばＥＸ","田園都市線","東海道線","東急多摩川","東京モノレ","東西線","東武亀戸線","東武東上線","東北新幹線","東横線","都営浅草線",
    "都営新宿線","都営三田線","都電荒川線","----な行----","成田空港線","南武線","南北線","日暮里舎人","----は行----","八高線","半蔵門線","日比谷線",
    "副都心線","北総線","北陸新幹線","----ま行----","丸ノ内線","丸ノ内方南","武蔵野線","目黒線","----や行----","山形新幹線","山手線","有楽町線",
    "ゆりかもめ","横須賀線","横浜線","----ら行----","りんかい線"
];

$rents = ["3.0","3.5","4.0","4.5","5.0","5.5","6.0","6.5","7.0","7.5","8.0","8.5","9.0","9.5","10.0"];
?>

<form action="index.php#search_box" id="filtered_search" method="get">
<table class="ta1">
  <tr>
    <th>フリーワード<br>検索</th>
    <td colspan="3">
      <input type="input" name="free-word" value="<? if (!empty($whereCondition['FREE_WORD'])) echo $whereCondition['FREE_WORD'] ?>" class="ws" placeholder="町名・駅名など(部分一致)"> <br>
      <label for="and-or-search"><input type="radio" name="and-or-search" value="and"
      <? if (empty($whereOption["FREE_WORD"]) || (isset($whereOption["FREE_WORD"]) && $whereOption["FREE_WORD"] == "and")) echo "checked" ?>>
        and検索 </label>
      <label for="and-or-search"><input type="radio" name="and-or-search" value="or"
      <? if (isset($whereOption["FREE_WORD"]) && $whereOption["FREE_WORD"] == "or") echo "checked" ?>>
        or検索 </label>
    </td>
  </tr>
    <tr>
    <th>特定のワードを除く</th>
    <td colspan="3">
      <input type="input" name="free-word-minus" value="<? if (!empty($whereCondition['FREE_WORD_MINUS'])) echo $whereCondition['FREE_WORD_MINUS'] ?>" class="ws" placeholder="シェアハウスなど(部分一致)"> <br>
      (and検索)
  </tr>
  <tr>
    <th>地域</th>
    <td colspan="3">
      <select name="address1">
        <option value="">▼区を選択して下さい（※未選択可）</option>
        <? foreach ($areas as $area) {?>
          <option value="<?echo $area ?>"
          <? if (!empty($whereCondition["ADDRESS1"]) && $area == $whereCondition["ADDRESS1"]) echo "selected" ?>>
            <? echo $area ?>
          </option>
        <? } ?>
      </select>
    </td>
  </tr>
  <tr>
    <th>路線</th>
    <td colspan="3">
      <select name="train-route">
        <option value="">▼路線を選択して下さい（※未選択可）</option>
        <? foreach ($rails as $rail) { ?>
          <option value="<?echo $rail ?>"
          <? if (!empty($whereCondition["TRAIN_ROUTE"]) && $rail == $whereCondition["TRAIN_ROUTE"]) echo "selected" ?>>
            <? echo $rail ?></option>
        <? } ?>
      </select>
    </td>
  </tr>
  <tr>
    <th>駅徒歩</th>
    <td colspan="3">
      <label for="minutes-walking"><input type="radio" name="minutes-walking" value=""
        <? if (!isset($whereCondition["MINUTES_WALKING"])) echo "checked" ?>>指定なし </label>
      <label for="minutes-walking"><input type="radio" name="minutes-walking" value="5"
        <? if (isset($whereCondition["MINUTES_WALKING"]) && $whereCondition["MINUTES_WALKING"] == '5') echo "checked" ?>>5分 </label>
      <label for="minutes-walking"><input type="radio" name="minutes-walking" value="10"
        <? if (isset($whereCondition["MINUTES_WALKING"]) && $whereCondition["MINUTES_WALKING"] == '10') echo "checked" ?>>10分 </label>
      <label for="minutes-walking"><input type="radio" name="minutes-walking" value="15"
        <? if (isset($whereCondition["MINUTES_WALKING"]) && $whereCondition["MINUTES_WALKING"] == '15') echo "checked" ?>>15分 </label>
      <label for="minutes-walking"><input type="radio" name="minutes-walking" value="20"
        <? if (isset($whereCondition["MINUTES_WALKING"]) && $whereCondition["MINUTES_WALKING"] == '20') echo "checked" ?>>20分 </label>
    </td>
  </tr>
  <tr>
    <th>築年数</th>
    <td colspan="3">
      <label for="building-year"><input type="radio" name="building-year" value=""
        <? if (!isset($whereCondition["BUILDING_YEAR"])) echo "checked" ?>>指定なし </label>
      <label for="building-year"><input type="radio" name="building-year" value="1"
        <? if (isset($whereCondition["BUILDING_YEAR"]) && $whereCondition["BUILDING_YEAR"] == '1') echo "checked" ?>>新築 </label>
      <label for="building-year"><input type="radio" name="building-year" value="<?echo (date('Y')-3).'00'?>"
        <? if (isset($whereCondition["BUILDING_YEAR"]) && $whereCondition["BUILDING_YEAR"] == (date('Y')-3).'00') echo "checked" ?>>3年 </label>
      <label for="building-year"><input type="radio" name="building-year" value="<?echo (date('Y')-5).'00'?>"
        <? if (isset($whereCondition["BUILDING_YEAR"]) && $whereCondition["BUILDING_YEAR"] == (date('Y')-5).'00') echo "checked" ?>>5年 </label>
      <br class="sp">
      <label for="building-year"><input type="radio" name="building-year" value="<?echo (date('Y')-10).'00'?>"
        <? if (isset($whereCondition["BUILDING_YEAR"]) && $whereCondition["BUILDING_YEAR"] == (date('Y')-10).'00') echo "checked" ?>>10年 </label>
      <label for="building-year"><input type="radio" name="building-year" value="<?echo (date('Y')-15).'00'?>"
        <? if (isset($whereCondition["BUILDING_YEAR"]) && $whereCondition["BUILDING_YEAR"] == (date('Y')-15).'00') echo "checked" ?>>15年 </label>
      <label for="building-year"><input type="radio" name="building-year" value="<?echo (date('Y')-20).'00'?>"
        <? if (isset($whereCondition["BUILDING_YEAR"]) && $whereCondition["BUILDING_YEAR"] == (date('Y')-20).'00') echo "checked" ?>>20年 </label>
      <label for="building-year"><input type="radio" name="building-year" value="<?echo (date('Y')-25).'00'?>"
        <? if (isset($whereCondition["BUILDING_YEAR"]) && $whereCondition["BUILDING_YEAR"] == (date('Y')-25).'00') echo "checked" ?>>25年 </label>
      <label for="building-year"><input type="radio" name="building-year" value="<?echo (date('Y')-30).'00'?>"
        <? if (isset($whereCondition["BUILDING_YEAR"]) && $whereCondition["BUILDING_YEAR"] == (date('Y')-30).'00') echo "checked" ?>>30年 </label>
    </td>
  </tr>
  <tr>
    <th>賃料で検索</th>
    <td colspan="3">
      <select name="rent-from" class="w50px">
        <option value="-1"></option>
        <? foreach ($rents as $rent) { ?>
          <option value="<?echo $rent * 10000 ?>"
          <? if (!empty($_GET['rent-from']) && $rent * 10000 == $_GET['rent-from']) echo "selected" ?>>
            <? echo $rent ?>
          </option>
        <? } ?>
      </select>
      万円 〜
      <select name="rent-to" class="w50px">
        <option value="500000"></option>
        <? foreach ($rents as $rent) { ?>
          <option value="<?echo $rent * 10000 ?>"
          <? if (!empty($_GET['rent-to']) && $rent * 10000 == $_GET['rent-to']) echo "selected" ?>>
            <? echo $rent ?>
          </option>
        <? } ?>
      </select>
      万円
    </td>
  </tr>
  <!--{def form/special}-->
  <tr>
    <th rowspan="2">間取りで検索</th>
    <th colspan="1">部屋数</th>
      <td colspan="2">
        <label for="madori-room">
          <input type="checkbox" name="madori-room[]" id="" value="1"
          <? if (isset($_GET['madori-room']) && in_array('1', $_GET['madori-room'])) echo "checked" ?>> 1
        </label>
        <label for="madori-room">
          <input type="checkbox" name="madori-room[]" id="" value="2"
          <? if (isset($_GET['madori-room']) && in_array('2', $_GET['madori-room'])) echo "checked" ?>> 2
        </label>
        <label for="madori-room">
          <input type="checkbox" name="madori-room[]" id="" value="3"
          <? if (isset($_GET['madori-room']) && in_array('3', $_GET['madori-room'])) echo "checked" ?>> 3
        </label>
      </td>
    </tr>
    <tr>
    <th colspan="1">間取り</th>
    <td colspan="2">
      <!--{each form/special}-->
      <div class="specialbox">
        <label for="madori-type">
          <input type="checkbox" name="madori-type[]" id="" value="R"
          <? if (isset($_GET['madori-type']) && in_array('R', $_GET['madori-type'])) echo "checked" ?>> R&nbsp;&nbsp;&nbsp;&nbsp;
        </label>
        <label for="madori-type">
          <input type="checkbox" name="madori-type[]" id="" value="K"
          <? if (isset($_GET['madori-type']) && in_array('K', $_GET['madori-type'])) echo "checked" ?>> K&nbsp;&nbsp;&nbsp;&nbsp;
        </label>
        <label for="madori-type">
          <input type="checkbox" name="madori-type[]" id="" value="DK"
          <? if (isset($_GET['madori-type']) && in_array('DK', $_GET['madori-type'])) echo "checked" ?>> DK&nbsp;
        </label>
        <br class="sp">
        <label for="madori-type">
          <input type="checkbox" name="madori-type[]" id="" value="LK"
          <? if (isset($_GET['madori-type']) && in_array('LK', $_GET['madori-type'])) echo "checked" ?>> LK&nbsp;&nbsp;
        </label>
        <label for="madori-type">
          <input type="checkbox" name="madori-type[]" id="" value="LDK"
          <? if (isset($_GET['madori-type']) && in_array('LDK', $_GET['madori-type'])) echo "checked" ?>> LDK
        </label>
        <br class="sp">
        <label for="madori-type">
          <input type="checkbox" name="madori-type[]" id="" value="SLK"
          <? if (isset($_GET['madori-type']) && in_array('SLK', $_GET['madori-type'])) echo "checked" ?>> SLK
        </label>
        <lavel for="madori-type">
          <input type="checkbox" name="madori-type[]" id="" value="SLDK"
          <? if (isset($_GET['madori-type']) && in_array('SLDK', $_GET['madori-type'])) echo "checked" ?>> SLDK
        </label>
      </div>
    </td>
  </tr>

  <tr>
    <th>構造で検索</th>
    <td colspan="3">
      <!--{each form/special}-->
      <div class="specialbox">
        <label for="building-type">
          <input type="checkbox" name="building-type[]" id="" value="木"
          <? if (isset($whereCondition['BUILDING_TYPE']) && in_array('木', $whereCondition['BUILDING_TYPE'])) echo "checked" ?>> 木造
        </label>
        <label for="building-type">
          <input type="checkbox" name="building-type[]" id="" value="鉄"
          <? if (isset($whereCondition['BUILDING_TYPE']) && in_array('鉄', $whereCondition['BUILDING_TYPE'])) echo "checked" ?>> 鉄骨
        </label>
        <label for="building-type">
          <input type="checkbox" name="building-type[]" id="" value="R"
          <? if (isset($whereCondition['BUILDING_TYPE']) && in_array('R', $whereCondition['BUILDING_TYPE'])) echo "checked" ?>> コンクリート
        </label>
      </div> <!--input type="hidden" name="special{val form/special/value}" value="{val form/special/value}"-->
    </td>
  </tr>

  <tr>
    <th>こだわり検索</th>
    <td colspan="3">
      <!--{each form/special}-->
      <div class="specialbox">
        <label for="remarks-2">
          <input type="checkbox" name="remarks-2[]" id="" value="バストイレ別"
          <? if (isset($whereCondition['REMARKS_2']) && in_array('バストイレ別', $whereCondition['REMARKS_2'])) echo "checked" ?>> バストイレ別
        </label>
        <label for="remarks-2">
          <input type="checkbox" name="remarks-2[]" id="" value="洗面台独立"
          <? if (isset($whereCondition['REMARKS_2']) && in_array('洗面台独立', $whereCondition['REMARKS_2'])) echo "checked" ?>> 洗面台独立
        </label>
        <br class="sp">
        <label for="remarks-2">
          <input type="checkbox" name="remarks-2[]" id="" value="2階以上"
          <? if (isset($whereCondition['REMARKS_2']) && in_array('2階以上', $whereCondition['REMARKS_2'])) echo "checked" ?>> 2階以上
        </label>
        <label for="remarks-2">
          <input type="checkbox" name="remarks-2[]" id="" value="フローリング"
          <? if (isset($whereCondition['REMARKS_2']) && in_array('フローリング', $whereCondition['REMARKS_2'])) echo "checked" ?>> フローリング
        </label>
        <br class="sp">
        <label for="remarks-2">
          <input type="checkbox" name="remarks-2[]" id="" value="ペット可"
          <? if (isset($whereCondition['REMARKS_2']) && in_array('ペット可', $whereCondition['REMARKS_2'])) echo "checked" ?>> ペット可
        </label>
      </div> <!--input type="hidden" name="special{val form/special/value}" value="{val form/special/value}"-->
    </td>
  </tr>
</table>
<div class="c mb30">
  <button type="button" id="search_submit" name="search-submit" class="btn btn-lg btn-success"><i class='fab fa-line'></i>この条件で検索する</button>
  <input type="hidden" name="order-by-condition" value="<? if (!empty($orderByCondition)) echo $orderByCondition;  ?>">
  <input type="hidden" name="displayed-result-cnt" value="<? if (!empty($displayedResultCnt)) echo $displayedResultCnt;  ?>">
  <input type="hidden" name="specified-page" value="<? if (!empty($speciFiedPage)) echo $speciFiedPage;  ?>">
</div>
</form>