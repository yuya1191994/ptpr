<?php
$hoge = $_GET['property-id'];
?>

<?php require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/view/user/user-header.php"); ?>
<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/util/seculityFunctions.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/DBHandle.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/csvHandle.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/propertyDetailReturn.php");
?>


    <!--PC用（801px以上端末）メニュー-->
    <nav id="menubar" class="nav-fix-pos">
      <ul class="inner">
<!--         <li><a href="./">ホーム<span>HOME</span></a></li> -->
<!--         <li><a href="./?act=list&kind=1">売買物件<span>BAIBAI</span></a></li> -->
<!--         <li><a href="./?act=list&kind=2">賃貸物件<span>CHINTAI</span></a></li> -->
<!--         <li><a href="./?act=list&kind=3">店舗物件<span>TENANT</span></a></li> -->
<!--         <li><a href="./?act=list&kind=4">駐車場物件<span>PARKING</span></a></li> -->
      </ul>
    </nav>

    <!--小さな端末用（900px以下端末）メニュー-->
    <nav id="menubar-s">
      <ul>
<!--         <li><a href="./">ホーム<span>HOME</span></a></li> -->
<!--         <li><a href="./?act=list&kind=1">売買物件<span>BAIBAI</span></a></li> -->
<!--         <li><a href="./?act=list&kind=2">賃貸物件<span>CHINTAI</span></a></li> -->
<!--         <li><a href="./?act=list&kind=3">店舗物件<span>TENANT</span></a></li> -->
<!--         <li><a href="./?act=list&kind=4">駐車場物件<span>PARKING</span></a></li> -->
      </ul>
    </nav>

    <div id="contents">
      <div class="inner">
        <div class="main">
          <section>
            <div class="list">
              <? if (empty($propertyJson)) { ?>
              <div class="c mb30">
                物件情報がありません。
              </div>
              <? } ?>
              <? foreach ($propertyJson as $key => $val) { ?>
              <form action="" id="propertyForm_<?echo $key ?>" method="post">
                <div id="propertyinfo_<? echo $key ?>" class="inlist <? if ($val['RELEASE_FLAG'] == 0) { echo "private"; } ?>">
                  <!-- ポイントラベル -->
                  <? require('view/attention-marks-parts.php') ?>
                  <div class="subimgs clearfix">
                  <!-- 内装画像 -->
                    <? require('view/user/user-property-images-list-parts.php')?>
                  </div>
                  <div class="property-details-table">
                  <!-- 物件情報詳細 -->
                  <? require('view/user/user-property-details-table-parts.php') ?>
                  </div>
                  <div class="c mb30">
                    <button type="button" id="inquiry_submit" class="btn btn-lg btn-success"><i class='fab fa-line'></i>この物件を問い合わせる<br>(LINEに移動)</button><br><br>
                    <button type="button" class="btn btn-danger">いいね！に追加</button>
<textarea name="inquiry-contents" class="hide">
物件番号 : <? echo $key?>

物件名 : <? echo $val['PROPERTY_NAME'].' '.$val['ROOM_NUMBER']?>

<? echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>
</textarea>
                  </div>
              </form>
              <iframe src="http://maps.google.co.jp/maps?q=<? echo $val['ADDRESS1'].$val['ADDRESS2'].$val['ADDRESS3']?>&output=embed&t=m&z=16&hl=ja" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>
              <? } ?>
          </section>
        </div>

        <div class="sub">

          <nav class="box">
            <h2>Menu</h2>
<!--             <ul class="submenu"> -->
<!--               <li><a href="./company.html">会社概要</a></li> -->
<!--               <li><a href="./recruit.html">採用情報</a></li> -->
<!--               <li><a href="./contact.html">お問い合わせ</a></li> -->
<!--               <li><a href="#">メニュー</a></li> -->
<!--               <li><a href="#">メニュー</a></li> -->
            </ul>
          </nav>

          <section class="box">

            <h2>新着物件情報</h2>

            <!--{each osusume}-->
            <div class="list">
<!--               <a href="act=bukken&id=val osusume/info_id"> -->
<!--                 <figure> -->
                  <!--{/def}-->
                  <!--{ndef osusume/image1_file}-->
<!--                   <img src="images/noimg.png" alt="val osusume/title"> -->
                  <!--{/ndef}-->
<!--                 </figure> -->
<!--                 <h4>ブランシェ鷺ノ宮</h4> -->
<!--                 <p>■西武池袋線 鷺ノ宮駅</p> -->
<!--                 <p>■練馬区中村南3-18-2</p> -->
<!--                 <p>■64,000円/15,000円</p> -->
<!--               </a> -->
            </div>
            <!--{/each}-->

          </section>

          <section class="box">
            <h2>運営会社</h2>
            <p>
              <strong>株式会社リテート</strong>&nbsp&nbsp&nbsp<span class="mini1">免許番号:東京都知事(1)第103485</span><br>
              <span class="mini1">東京都新宿区西新宿7-19-16 小田切ビル4F<br>
                TEL:<a href="tel:03-6908-8418">03-6908-8418</a> / FAX: 03-6747-6855<br>
              </span>
              <img src="../assets/images/athome.png" class="fl-sm">
            </p>
          </section>
        </div>
        <!--/.sub-->
      </div>
      <!--/.inner-->
    </div>
    <!--/#contents-->

<? require('view/footer-parts.php')?>