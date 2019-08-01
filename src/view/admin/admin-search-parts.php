<form action="" id="filtered_search" method="get">
  <table class="ta1">
    <tr>
      <th>物件番号</th>
      <td colspan="3">
        <input type="input" name="property-id" class="ws" placeholder="12桁の物件番号" value =
        "<? if (!empty($whereCondition['PROPERTY_ID'])) echo $whereCondition['PROPERTY_ID'];  ?>">
      </td>
    </tr>
    <tr>
      <th>AD</th>
      <td colspan="3">
        <div class="specialbox">
          <label for="ad-flag">
            <input type="checkbox" name="ad-flag[]" id="" value="0"
            <? if (!empty($whereCondition['AD_FLAG']) && in_array('0', $whereCondition['AD_FLAG'])) echo "checked";  ?>> なし
          </labe[]
          <label for="ad-flag">
            <input type="checkbox" name="ad-flag[]" id="" value="50"
            <? if (!empty($whereCondition['AD_FLAG']) && in_array('50', $whereCondition['AD_FLAG'])) echo "checked";  ?>> 50
          </label>
          <label for="ad-flag">
            <input type="checkbox" name="ad-flag[]" id="" value="100"
            <? if (!empty($whereCondition['AD_FLAG']) && in_array('100', $whereCondition['AD_FLAG'])) echo "checked";  ?>> 100
          </label>
          <label for="ad-flag">
            <input type="checkbox" name="ad-flag[]" id="" value="150"
            <? if (!empty($whereCondition['AD_FLAG']) && in_array('150', $whereCondition['AD_FLAG'])) echo "checked";  ?>> 150
          </label>
          <label for="ad-flag">
            <input type="checkbox" name="ad-flag[]" id="" value="200"
            <? if (!empty($whereCondition['AD_FLAG']) && in_array('200', $whereCondition['AD_FLAG'])) echo "checked";  ?>> 200
          </label>
          <label for="ad-flag">
            <input type="checkbox" name="ad-flag[]" id="" value="250"
            <? if (!empty($whereCondition['AD_FLAG']) && in_array('250', $whereCondition['AD_FLAG'])) echo "checked";  ?>> 250
          </label>
          <label for="ad-flag">
            <input type="checkbox" name="ad-flag[]" id="" value="300"
            <? if (!empty($whereCondition['AD_FLAG']) && in_array('300', $whereCondition['AD_FLAG'])) echo "checked";  ?>> 300
          </label>
        </div>
      </td>
    </tr>
    <tr>
      <th>その他</th>
      <td colspan="3">
        <div class="specialbox">
          <label for="new-arrival-flag">
            <input type="checkbox" name="new-arrival-flag[]" id="" value="1"
            <? if (!empty($whereCondition['NEW_ARRIVAL_FLAG']) && in_array('1', $whereCondition['NEW_ARRIVAL_FLAG'])) echo "checked";  ?>> 新着
          </label>
          <label for="room-photo">
            <input type="checkbox" name="room-photo[]" id="" value="1"
            <? if (!empty($whereCondition['ROOM_PHOTO']) && in_array('1', $whereCondition['ROOM_PHOTO'])) echo "checked";  ?>> 画像あり
          </label>
          <label for="room-photo">
            <input type="checkbox" name="room-photo[]" id="" value="0"
            <? if (!empty($whereCondition['ROOM_PHOTO']) && in_array('0', $whereCondition['ROOM_PHOTO'])) echo "checked";  ?>> 画像なし
          </label>
          <label for="release-flag">
            <input type="checkbox" name="release-flag[]" id="" value="1"
            <? if (!empty($whereCondition['RELEASE_FLAG']) && in_array('1', $whereCondition['RELEASE_FLAG'])) echo "checked";  ?>> 公開済み
          </label>
          <label for="release-flag">
            <input type="checkbox" name="release-flag[]" id="" value="0"
            <? if (!empty($whereCondition['RELEASE_FLAG']) && in_array('0', $whereCondition['RELEASE_FLAG'])) echo "checked";  ?>> 非公開
          </label>
        </div>
      </td>
    </tr>
  </table>
  <div class="c mb30">
    <input type="button" id="search_submit" name="search-submit" value="この条件で検索する" class="btn btn-blue">
    <input type="hidden" name="order-by-condition" value="<? if (!empty($orderByCondition)) echo $orderByCondition;  ?>">
    <input type="hidden" name="displayed-result-cnt" value="<? if (!empty($displayedResultCnt)) echo $displayedResultCnt;  ?>">
    <input type="hidden" name="specified-page" value="<? if (!empty($speciFiedPage)) echo $speciFiedPage;  ?>">
  </div>
</form>