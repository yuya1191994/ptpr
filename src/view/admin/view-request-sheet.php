<?php
include $_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/lib/tcpdf/tcpdf.php";
$w = ['日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日'];
$currentDate  = date('Y年m月j日');
$currentWeek  = date('w');
$currentWeek  = $w[$currentWeek];
$companyName  = $_POST['company-name'];
$propertyName = $_POST['property-name'];
$roomNumber   = $_POST['room-number'];
$employeeList = explode(';',$_POST['employee-list-view-request']);
$viewRequestDate = str_replace('T', ' ' ,$_POST['view-request-date']);
$viewRequestDay = date('Y年m月d日' ,strtotime($viewRequestDate));
$viewRequestWeek = date('w' ,strtotime($viewRequestDate));
$viewRequestWeek = $w[$viewRequestWeek];
$viewRequestTime = date('G:i' ,strtotime($viewRequestDate));
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
<th>担　当</th>
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
<th>担当携帯</th>
<td>$employeeList[2]</td>
</tr>
</table>

<br>
<div class="discription">
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;お世話になっております。<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;御社管理物件<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;『&nbsp;$propertyName  $roomNumber &nbsp;』<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;を、$viewRequestDay ($viewRequestWeek) $viewRequestTime 頃から<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ご案内させて頂ければと思いますので、よろしくお願いいたします。
<br><br>
<img src="../../../assets/images/namecards/$employeeList[1].png">
<br>
</div>
</div>
</body>
EOF;

$fileName = 'Naiken-irai_fax'.$faxNumber.'_tel'.$phoneNumber.'.pdf';
$tcpdf->writeHTML($html); // 表示htmlを設定
$tcpdf->Output($fileName, 'I'); // pdf表示設定