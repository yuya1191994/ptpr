<?php require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/view/admin/admin-header.php"); ?>
<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/util/seculityFunctions.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/DBHandle.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/csvHandle.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/adminSearchConditions.php");

?>

<body id="top">
  <div id="container">
    <header>
      <div class="header-title">株式会社リテート 賃貸物件管理画面</div>
      <div class="r"><a href="controller/adminLogoutController.php" name="logout" class="cw">ログアウト</a></div>
    </header>

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
            <h2>新着物件をcsvファイルで一括登録</h2>
            <div class="c">
              <form action="action/uploadCsv.php" id="upload_csv_form" method="post" enctype="multipart/form-data">
                登録したい物件のcsvファイルをアップロードしてください。<br>
                <input type="file" id="upload_csv" name="upload-csv[]" accept="text/csv" multiple> <br>
                <div class="c mb30">
                  <input type="button" id="upload_csv_submit"
                    value="このファイルをアップロード" class="btn btn-blue">
                </div>
              </form>
              <? require('view/admin/admin-uploaded-files-parts.php') ?>
            </div>
          </section>

          <section id="new">
            <h2 id="search_box" class="close">条件検索</h2>
            <? require('view/admin/admin-search-parts.php') ?>
          </section>

          <section id="search_results">
            <h2>最新物件情報</h2>
            <div class="c">
              <a href="#" id="property_id_asc" name="order-by" class="
              <? if (empty($orderByCondition) || strpos($orderByCondition, 'PROPERTY_ID_ASC') !== false) echo "selected"; ?> ">
                物件番号順</a> |
              <a href="#" id="recommend_flag_desc" name="order-by" class="
              <? if (!empty($orderByCondition) && strpos($orderByCondition, 'RECOMMEND_FLAG_DESC') !== false) echo "selected"; ?>">
                おすすめ順</a> |
              <a href="#" id="regist_date_desc" name="order-by" class="
              <? if (!empty($orderByCondition) && strpos($orderByCondition, 'REGIST_DATE_DESC') !== false) echo "selected"; ?>">
                最新登録順</a> |
              <a href="#" id="update_date_desc" name="order-by" class="
              <? if (!empty($orderByCondition) && strpos($orderByCondition, 'UPDATE_DATE_DESC') !== false) echo "selected"; ?>">
                最新更新順</a> |
              <a href="#" id="company_name_asc" name="order-by" class="
              <? if (!empty($orderByCondition) && strpos($orderByCondition, 'COMPANY_NAME_ASC') !== false) echo "selected"; ?>
                ">管理会社順</a>
            </div>

            <!-- 表示件数 -->
            <? require('view/displayed-result-parts.php') ?>

            <!-- 物件情報 -->
            <div class="list clearfix">
            <? if (empty($propertyJson)) { ?>
              <div class="c mb30">
                物件情報がありません。
              </div>
            <? } ?>
            <? foreach ($propertyJson as $key => $val) { ?>
              <form action="" id="updateForm_<?echo $key ?>" method="post" enctype="multipart/form-data">
                <div id="propertyinfo_<? echo $key ?>" class="list inlist <? if ($val['RELEASE_FLAG'] == 0) { echo "private"; } ?>">
                  <!-- ポイントラベル -->
                  <? require('view/attention-marks-parts.php') ?>
                  <div class="subimgs clearfix">
                  <!-- 内装画像 -->
                    <? require('view/admin/admin-property-images-list-parts.php')?>
                  </div>
                  <div class="property-details-table">
                  <!-- 物件情報詳細 -->
                  <? require('view/admin/admin-property-details-table-parts.php') ?>
                  </div>
                  <div class="r mb30 fr clear">
                    <input type="button" id="property_info_update_submit_<? echo $key ?>" value="更新する" class="btn btn-blue">
                    <input type="button" id="property_info_delete_submit_<? echo $key ?>" value="削除する" class="btn btn-red">
                  </div>
                  <div class="l mb30 fl">
                      <!-- 掲載依頼書 -->
                      <input type="button" id="issue_publication_request_form_<? echo $key ?>" value="掲載依頼書作成" class="btn btn-green">
                      <div class="hide">
                        FAX送信者：
                        <select name="employee-list-publical-request" id="employee_list_publical_request_<? echo $key ?>">
                          <option value="">選択してください</option>
                          <?php $employeeMap = $DBHandle->selectEmployeeReturnJson();
                          foreach ($employeeMap as $employee) {
                              echo '<option value="'.$employee['EMPLOYEE_NAME'].';'.$employee['EMPLOYEE_YOMI'].';'.$employee['EMPLOYEE_CELLPHONE'].'">'
                                    .$employee['EMPLOYEE_NAME'].
                                   '</option>';
                          }?>
                        </select>
                        <input type="button" id = "issue_publical_request_submit_<? echo $key ?>" value="発行" class="btn">
                      </div>
                      <!-- 内見依頼書 -->
                      <input type="button" id ="issue_view_request_form_<? echo $key ?>" value="内見依頼書作成" class="btn btn-green">
                      <div class="hide">
                        内見担当者：
                        <select name="employee-list-view-request" id="employee_list_view_request_<? echo $key ?>">
                          <option value="">選択してください</option>
                          <?php $employeeMap = $DBHandle->selectEmployeeReturnJson();
                          foreach ($employeeMap as $employee) {
                              echo '<option value="'.$employee['EMPLOYEE_NAME'].';'.$employee['EMPLOYEE_YOMI'].';'.$employee['EMPLOYEE_CELLPHONE'].'">'
                                    .$employee['EMPLOYEE_NAME'].
                                   '</option>';
                          }?>
                        </select>
                        &nbsp;&nbsp;内見予約日時：<input type="datetime-local" name="view-request-date" id="view_request_date_<? echo $key ?>" value="<? echo date('Y-m-d') ?>T00:00" min="<? echo date('Y-m-d') ?>T00:00" max="<? echo date('Y-m-d', strtotime("+7 day")) ?>T00:00">
                        <input type="button" id = "issue_view_request_submit_<? echo $key ?>" value="発行" class="btn">
                      </div>
                  </div>
              </form>
            </div>
            <? } ?>
            </div>
            <!-- 表示件数 -->
            <? require('view/displayed-result-parts.php') ?>
          </section>
        </div>
      </div>
      <!--/.inner-->
    </div>
    <!--/#contents-->


    <div id="copyright">
      <small>Copyright&copy; <a href="./">株式会社リテート</a> All Rights
        Reserved.
      </small> <span class="pr"><a href="http://template-party.com/"
        target="_blank">《Web Design:Template-Party》</a></span>
    </div>
    <!--/#copyright-->
    </footer>

  </div>
  <!--/#container-->

  <p class="nav-fix-pos-pagetop">
    <a href="#">↑</a>
  </p>

  <!--メニュー開閉ボタン-->
  <div id="menubar_hdr" class="close"></div>
  <!--メニューの開閉処理条件設定　800px以下-->
  <script>
if (OCwindowWidth() <= 800) {
  open_close("menubar_hdr", "menubar-s");
}
</script>

</body>
</html>