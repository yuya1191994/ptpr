<?php
// 物件総件数 = $propertiesCnt
// 現在のページ数 = $currentPage
// 現在選択中の表示件数 = $displayedResultCnt
// 総ページ数
$totalPage = ceil($propertiesCnt / $displayedResultCnt);
?>
<div class="displayed-result-box">
  <span style="text-align: left;">
  表示件数：
  <select name="displayed-results-cnt">
    <option value="10" <?if ($displayedResultCnt == 10) echo "selected"?>>10件</option>
    <option value="20" <?if ($displayedResultCnt == 20) echo "selected"?>>20件</option>
    <option value="30" <?if ($displayedResultCnt == 30) echo "selected"?>>30件</option>
    <option value="40" <?if ($displayedResultCnt == 40) echo "selected"?>>40件</option>
    <option value="50" <?if ($displayedResultCnt == 50) echo "selected"?>>50件</option>
  </select>
  </span>
  <div class="r" style="float: right;">
    <? if ($currentPage != 1) { ?>
      <a href="#" name="displayed-result-0">＜＜ 最初のページ</a>&nbsp;
      <a href="#" name="displayed-result-<? echo $currentPage - 1 ?>">＜ 前へ</a>&nbsp;
    <? } else { ?>
      ＜＜ 最初のページ&nbsp;＜ 前へ&nbsp;
    <? } ?>

    <? for ($i = 1; $i < $totalPage + 1; $i ++) { ?>
        <a href="#" name="displayed-result-<? echo $i ?>" class="<?if ($currentPage == $i) echo "selected"?>"><? echo $i ?></a>&nbsp;
    <? } ?>
    <? if ($currentPage != $totalPage) {?>
      <a href="#" name="displayed-result-<? echo $currentPage + 1 ?>">次へ＞</a>&nbsp;
      <a href="#" name="displayed-result-<? echo $totalPage ?>"> 最後のページ＞＞</a>&nbsp;
    <? } else { ?>
      次へ＞&nbsp;最後のページ＞＞&nbsp;
    <? } ?>
  </div>
</div>
<?php
$nowDisplayedFirst = (($currentPage - 1) * $displayedResultCnt) + 1;
$nowDisplayedEnd   = ($currentPage * $displayedResultCnt)
?>
<? if (!empty($propertyJson)) { ?>
  <div class="c">全<? echo $propertiesCnt ?>件中 <? echo $nowDisplayedFirst."-"; echo ($nowDisplayedEnd < $propertiesCnt) ? $nowDisplayedEnd : $propertiesCnt; ?>件 表示中</span></div>
<? } ?>