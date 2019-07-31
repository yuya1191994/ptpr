<?php require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/view/user/user-header.php"); ?>
<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/DBHandle.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/csvHandle.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/userSearchConditions.php");
?>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<!--[if lt IE 10]>
<style>
#mainimg,.slide0,.slide1,.slide2,.slide3 {background: url(images/1.jpg) no-repeat center center;}
</style>
<![endif]-->


    <header>
      <h1 id="logo">
        <a href="./"><img src="images/" alt="ロゴ配置場所"></a>
      </h1>

      <!--スライドショー-->
      <aside id="mainimg">
        <div class="slide0">slide0</div>
        <div class="slide1">slide1</div>
        <div class="slide2">slide2</div>
        <div class="slide3">slide3</div>
      </aside>
      <!--スライドショー下部の装飾用画像-->
      <img src="../assets/images/123bg.png" alt="" id="kazari">
    </header>


    <!--PC用（801px以上端末）メニュー-->
    <nav id="menubar" class="nav-fix-pos">
<!--       <ul class="inner"> -->
<!--         <li><a href="./">ホーム<span>HOME</span></a></li> -->
<!--         <li><a href="./?act=list&kind=1">売買物件<span>BAIBAI</span></a></li> -->
<!--         <li><a href="./?act=list&kind=2">賃貸物件<span>CHINTAI</span></a></li> -->
<!--         <li><a href="./?act=list&kind=3">店舗物件<span>TENANT</span></a></li> -->
<!--         <li><a href="./?act=list&kind=4">駐車場物件<span>PARKING</span></a></li> -->
<!--       </ul> -->
    </nav>

    <!--小さな端末用（900px以下端末）メニュー-->
    <nav id="menubar-s">
<!--       <ul class="inner"> -->
<!--         <li><a href="./">ホーム<span>HOME</span></a></li> -->
<!--         <li><a href="./?act=list&kind=1">売買物件<span>BAIBAI</span></a></li> -->
<!--         <li><a href="./?act=list&kind=2">賃貸物件<span>CHINTAI</span></a></li> -->
<!--         <li><a href="./?act=list&kind=3">店舗物件<span>TENANT</span></a></li> -->
<!--         <li><a href="./?act=list&kind=4">駐車場物件<span>PARKING</span></a></li> -->
<!--       </ul> -->
    </nav>

    <div id="contents">
      <div class="inner">
        <div class="main">
          <section id="new">
            <h2 id="search_box">条件検索</h2>
            <? require('view/user/user-search-parts.php') ?>
          </section>

          <section>
            <h2>最新物件情報</h2>
            <div class="c">
              <a href="#" id="recommend_flag_desc" name="order-by" class="
              <? if (!empty($orderByCondition) && strpos($orderByCondition, 'RECOMMEND_FLAG_DESC') !== false) echo "selected"; ?>">
                おすすめ順</a> |
              <a href="#" id="update_date_desc" name="order-by" class="
              <? if (!empty($orderByCondition) && strpos($orderByCondition, 'UPDATE_DATE_DESC') !== false) echo "selected"; ?>">
                新着順</a> |
              <a href="#" id="ad_flag_desc" name="order-by" class="
              <? if (!empty($orderByCondition) && strpos($orderByCondition, 'AD_FLAG_DESC') !== false) echo "selected"; ?>">
                キャッシュバック順</a> |
              <a href="#" id="rent_asc" name="order-by" class="
              <? if (!empty($orderByCondition) && strpos($orderByCondition, 'RENT_ASC') !== false) echo "selected"; ?>">
                賃料安い順</a>
            </div>
            <!-- 表示件数 -->
            <? require('view/displayed-result-parts.php') ?>

            <div class="list">
              <? if (empty($propertyJson)) { ?>
              <div class="c mb30">
                物件情報がありません。
              </div>
              <? } ?>
              <? foreach ($propertyJson as $key => $val) { ?>
              <form action="property-detail.php" id="propertyForm_<?echo $key ?>" method="get">
                <div id="propertyinfo_<? echo $key ?>" class="inlist <? if ($val['RELEASE_FLAG'] == 0) { echo "private"; } ?>">
                  <!-- ポイントラベル -->
                  <? require('view/attention-marks-parts.php') ?>
                  <div class="subimgs clearfix">
                  <!-- 内装画像 -->
                    <? require('view/user/user-property-images-list-parts.php')?>
                  </div>
                  <div class="property-details-table">
                  <!-- 物件情報詳細 -->
                  <? require('view/user/user-property-table-parts.php') ?>
                  </div>
                  <div class="c mb30">
                    <button type="submit" id="property_info_update_submit_<? echo $key ?>" id="inquiry_submit" class="btn btn-success"><i class='fab fa-line'></i>詳細を見る</button>
                    <button type="button" id="property_info_delete_submit_<? echo $key ?>" class="btn btn-danger">いいね！に追加</button>
                  </div>
              </form>
              </div>
              <? } ?>
          </section>
          <!-- 表示件数 -->
            <? require('view/displayed-result-parts.php') ?>
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
<!--             </ul> -->
          </nav>

          <section class="box">

            <h2>新着物件情報</h2>
            <div class="list">
<!--               <a href="act=bukken&id=val osusume/info_id"> -->
<!--                 <figure> -->
<!--                   <img src="images/noimg.png" alt="val osusume/title"> -->
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
              <strong>株式会社リテート</strong><br>
              <span class="mini1">免許番号:東京都知事(1)第103485</span><br>
              <span class="mini1">東京都新宿区西新宿7-19-16 小田切ビル4F<br>
                代表: 小池 まさと, 坂本 康平<br>
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

