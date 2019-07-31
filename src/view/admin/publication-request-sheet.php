<?php
include $_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/lib/tcpdf/tcpdf.php";

$w = ['日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日'];
$propertyId   = $_POST['pkey'];
$address      = $_POST['addresses'];
$rent         = $_POST['rent'];
$currentDate  = date('Y年m月j日');
$currentWeek  = date('w');
$currentWeek  = $w[$currentWeek];
$companyName  = $_POST['company-name'];
$propertyName = $_POST['property-name'];
$roomNumber   = $_POST['room-number'];
$employeeList = explode(';',$_POST['employee-list-publical-request']);
$phoneNumber  = $_POST['phone-number'];
$faxNumber    = $_POST['fax-number'];

$tcpdf = new TCPDF();
$tcpdf->AddPage();
$tcpdf->SetFont("kozgopromedium", "", 10);

$html = <<< EOF
<style>
body {
  font-size: 13px;
}
h1 {
  font-size: 30px;
}

img {
  width: 350px;
  display: inline;
  text-align: center;
}

.example table {
  width: 800px;
  border: 2px #000000 solid;
  border-collapse: collapse;
}

.example td {
  border: 1px #000000 dotted;
  padding: 10px 30px;
  text-align: left;
}

.example th {
  width: 100px;
  border: 1px #000000 dotted;
  padding: 10px 0;
  text-align: center;
}

.discription {
  border: 0.5px solid;
  width: 100%;
}

.r {
  text-align: right;
}
</style>

<body>
<h1>送付状</h1>
<div class="example">
$companyName   御中<br><br>
<table>
<tr>
<th>送信日</th>
<td>　$currentDate ($currentWeek) </td>
</tr>
<tr>
<th>会社名</th>
<td>株式会社リテート</td>
</tr>
<tr>
<th>住　所</th>
<td>〒160 - 0023 東京都新宿区西新宿7-19-5 小田切ビル402</td>
</tr>
<tr>
<th>免許番号</th>
<td>東京都知事免許(1) 第103485号</td>
</tr>
<tr>
<th>送信者</th>
<td>$employeeList[0]</td>
</tr>
<tr>
<th>ＴＥＬ</th>
<td>03-6908-8418</td>
</tr>
<tr>
<th>ＦＡＸ</th>
<td>03-6747-6855</td>
</tr>
<tr>
<th>送信者携帯</th>
<td>$employeeList[2]</td>
</tr>
</table>

<br>
<div class="discription">
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;拝啓<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;時下ますますご清栄のこととお慶び申し上げます。<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;早速ではございますが、御社管理物件<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;『&nbsp; $propertyName  $roomNumber &nbsp;』<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;につきまして、弊社の自社ホームページへ広告掲載させて頂きたく思います。<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;掲載依頼書を１通お送りさせて頂きますので、ご査収御願い申し上げます。
<br><br>
<img src="../../../assets/images/namecards/$employeeList[1].png">
<br>
<div class="r">敬具</div>
</div>
</div>
</body>
EOF;
$tcpdf->writeHTML($html); // 表示htmlを設定

$tcpdf->AddPage();
$tcpdf->SetFont("kozgopromedium", "", 10);

$html2 = <<< EOF
<style>
body {
  font-size: 12px;
}
img {
  width: 900px;
}

.r {
  text-align: right;
}

.c {
  text-align: center;
}

h1 {
  text-align: center;
}

h2 {
  text-align: center;
}

.example table {
  width: 800px;
  border: none;
  border-collapse: collapse;
}

.example td {
  border: 1px #000000 solid;
  padding: 0 10px;
}

.example th {
  width: 100px;
  border: 1px #000000 solid;
  padding: 3px 0;
  text-align: center;
}

.discription {
  border: 1px #000000 solid;
}


</style>
<body>
<div class="r">$currentDate ($currentWeek)</div>
<div>
（元付業者）<br>
<u>$companyName </u>御中
</div>
<img src="../../../assets/images/publication-request.png"><br>
<h1>元付業者への広告掲載・宣伝告知等承諾申込書</h1>
<br><br>
次のレインズ登録物件（登録番号： <u>$propertyId</u> ）の広告掲載・宣伝告知等を致したいので、<br>ご承諾をいただきたく申込みいたします。
<br>
<div class="example">
<table>
<tr>
<th>物　件<br>種　別</th>
<td>（売買）　□土地　　□戸建　　□マンション　　□事業用全部　　□事業用一部<br>
（賃貸）　■居住用　　□事業用
</td>
</tr>
<tr>
<th>物件所在地</th>
<td>$address</td>
</tr>
<tr>
<th>価格（賃料）</th>
<td>$rent 円</td>
</tr>
<tr>
<th>広告・宣伝の<br>種　類</th>
<td>□新聞折込　　□新聞広告　□雑誌　□ダイレクトメール<br>
■ホームページ　（自社サイト「プチプラちんたい」 https://ptpr.tokyo）□その他</td>
</tr>
</table>
</div>
<div class="discription">
<h2>　承　諾　書　</h2>
<div class="c">
申し込みのあった上記物件の広告掲載・宣伝告知を行うことを承諾いたします。<br>
但し、売主(貸主)から広告掲載又は宣伝告知の利用提供の停止等の申し出があった時は、<br>
直ちに広告掲載・宣伝告知を取りやめて下さい。<br>
<br>
（特記事項）他の不動産業者から問合せがあった場合、当該物件を紹介しないこと。
</div>
<div class="r">&emsp;&emsp;&emsp;&emsp;年&emsp;&emsp;月&emsp;&emsp;日<br><br>
（承諾者）&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<br>
<u>商&emsp;号&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u><br><br>
<u>担当者&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;印</u>
</div>
</div>
<br>
□&emsp;上記物件は、購入（賃借）希望者と交渉中であり広告掲載・宣伝告知等されることを<br>
&emsp;&emsp;承諾できません。承諾する場合は、改めて連絡の上対応いたします。
<div class="r">
<u>（担当者）&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;印</u>
</div>
</body>
EOF;

$fileName = 'Keisai-irai_fax'.$faxNumber.'_tel'.$phoneNumber.'.pdf';
$tcpdf->writeHTML($html2); // 表示htmlを設定
$tcpdf->Output($fileName, 'I'); // pdf表示設定