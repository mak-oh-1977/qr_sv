<?php /* Smarty version Smarty-3.1.19, created on 2015-04-05 21:11:40
         compiled from "/home/htdocs/module/common/nav_bar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6177108925521267ca18548-41765797%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a36f3b0cd8ecc77102646881ba754a8279d89acb' => 
    array (
      0 => '/home/htdocs/module/common/nav_bar.tpl',
      1 => 1423094962,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6177108925521267ca18548-41765797',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5521267ca21365_73309830',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5521267ca21365_73309830')) {function content_5521267ca21365_73309830($_smarty_tpl) {?><div class="navbar">

	<ul class="nav-left" id="nav_menu">
		<li>
			<span class="g_navi menu_btn" value="menu"><i class="icon-home icon-white"></i>メニュー
			</span>
		</li>
	</ul>
	<ul class="nav-left">
		<li><div id="db_msg"></div></li>
	</ul>

	<ul class="nav-right">

		<li class="dropdown">
			<a href="#" class="g_navi">
				<i class="icon-user icon-white"></i><?php echo $_SESSION['staff_name'];?>
<span class="caret"></span>
			</a>
			<dl class="dropdown-menu">
				<li><a href="index.php" class="g_navi ">ログアウト</a></li>
			</dl>
		</li>
	</ul>


</div>
<?php }} ?>
