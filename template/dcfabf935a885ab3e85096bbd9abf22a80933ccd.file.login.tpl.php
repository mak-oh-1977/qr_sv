<?php /* Smarty version Smarty-3.1.19, created on 2015-04-05 20:52:15
         compiled from "/home/htdocs/module/login/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1920661766552121ef5ffed3-59101635%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dcfabf935a885ab3e85096bbd9abf22a80933ccd' => 
    array (
      0 => '/home/htdocs/module/login/login.tpl',
      1 => 1423094964,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1920661766552121ef5ffed3-59101635',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_552121ef6b74d0_86985088',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_552121ef6b74d0_86985088')) {function content_552121ef6b74d0_86985088($_smarty_tpl) {?><!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アポロン・旅ぷらざ実績配信システム</title>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.js"></script>

<script src="js/common.js"></script>
<script src="login/login.js"></script>

<meta http-equiv="Content-Style-Type" content="text/css">
<link href="css/reset.css" rel="stylesheet">
<link href="css/custom-theme/jquery-ui.css" rel="stylesheet" />
<link href="css/common.css" rel="stylesheet">
<link href="login/login.css" rel="stylesheet">
</head>
<body>
	<div class="container">

		<div class="form-signin">

			<table id="login_tbl">
				<tr>
					<th>スタッフコード</th>
					<td><input type="text" class="input-block-level" name="u_id"></td>
				</tr>
				<tr>
					<th>パスワード</th>
					<td><input type="password" class="input-block-level"  name="passwd"></td>
				</tr>
				<tr>
					<td></td>
				<td><button class="toolbtn btn_blue" id="button">ログイン</button></td>
				</tr>
			</table>
			<div id="msg"></div>
		</div>
	</div>
</body>
</html> 

<?php }} ?>
