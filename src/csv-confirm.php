<?php require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/view/admin/admin-header.php"); ?>
<body id="top">

  <div id="container">
    <header>
      <div class="header-title">csv一括更新 確認画面</div>
    </header>

    <div id="contents">
      <div class="inner">
        <div class="main">
          <section>
            <div class="c">
            <form action="controller/csvSubmitController.php" method="post">
              <? require('view/admin/csv-confirm-parts.php') ?>
              <br>
              予想される新着物件数： <span style="color: blue;"><? echo $insertCnt ?>件</span><br>
              予想される募集終了物件： <span style="color: red;"><? echo $deleteCnt ?>件</span><br>
              <br><br>
              上記の数値が異常に高い場合は、<span style="color: red;">アップロードしたcsvファイルが適切でない可能性があります。</span><br>
              問題なさそうな場合のみ、一括登録をしてください。<br><br>
              <input type="hidden" name="insert-files" value="<? echo $_POST['insert-files'] ?>">
              <input type="hidden" name="delete-property-cnt" value="<? echo $deleteCnt ?>">
              <input type="submit" class="btn" value="以上内容で間違いないので一括登録する">
            </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</body>
</html>