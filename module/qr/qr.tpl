<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ＱＲコードデモ</title>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<script src="js/jquery.js"></script>
<script src="js/jquery-ui.js"></script>


<script src="js/common.js"></script>
<script src="qr/qr.js"></script>

<meta http-equiv="Content-Style-Type" content="text/css">
<link href="css/reset.css" rel="stylesheet">
<link href="css/custom-theme/jquery-ui.css" rel="stylesheet" />
<link href="css/common.css" rel="stylesheet">
<link href="qr/qr.css" rel="stylesheet">




</head>

<body>


	<div class="hero-unit">
		<h2>QRコードデモ</h2>
		<p><a href="app/SampleQR.apk">アプリのインストール</a></p>
	</div>
		
	<div class="row-fluid">
		<div class="span8 spanCenter">
			<button class="toolbtn btn_green" id="qr_add"><i class="icon-plus icon-white"></i>追加する</button>
			<div class="clear"></div>
			<div class="table-box">
				<table class="table table-bordered data-list" id="s_list">
					<thead>
						<tr>
							<th>コード</th>
							<th>状態</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<div id="qr_dlg" title="コード追加" style="display:none">
		<input type="hidden" id="staff_id">

		<table>
			<tr>
				<td class="td-r">コード</td>
				<td><input type="text" id="code" maxlength="20"></td>
			</tr>
		</table>
	</div>

</body>
</html> 
