<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ＱＲコードデモ</title>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<script src="js/common.js"></script>
<script src="qr/qr.js"></script>

<meta http-equiv="Content-Style-Type" content="text/css">
<link href="css/reset.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.4/cerulean/bootstrap.min.css" rel="stylesheet">


</head>

<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">QR code demo</a>
			</div>
		</div>
	</nav>

	<div class="container theme-showcase" role="main">
		<div class="jumbotron">
			<div class="col-sm-8">
				<h1>QRコードデモ</h1>
			</div>
			<div class="col-sm-4">
				<img id="hp"></img>
			</div>
			<h3><a href="app/SampleQR.apk">アプリのインストール</a><h3>
		</div>

		
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<button class="btn btn-success" data-toggle="modal" data-target="#codeadd">追加する</button>
				<div class="clear"></div>
				<table class="table table-striped table-hover" id="s_list">
					<thead>
						<tr>
							<th>コード</th>
							<th>QR</th>
							<th>状態</th>
							<th>リセット</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>


	<div class="modal fade" id="codeadd" tabindex="-1">
		<div class="modal-dialog">

			<!-- 3.モーダルのコンテンツ -->
			<div class="modal-content">
				<!-- 4.モーダルのヘッダ -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="modal-label">コード追加</h4>
				</div>
				<!-- 5.モーダルのボディ -->
				<div class="modal-body">
				<table>
					<tr>
						<td class="td-r">コード</td>
						<td><input type="text" id="code" maxlength="20"></td>
					</tr>
				</table>
				</div>
				<!-- 6.モーダルのフッタ -->
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
				</div>
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

	<div class="modal fade" id="qrdisp" tabindex="-1">
		<div class="modal-dialog">

			<!-- 3.モーダルのコンテンツ -->
			<div class="modal-content">
				<!-- 4.モーダルのヘッダ -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="modal-label">QRコード</h4>
				</div>
				<!-- 5.モーダルのボディ -->
				<div class="modal-body">
				<img id="qrimg"></img>
				</div>
				<!-- 6.モーダルのフッタ -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html> 
