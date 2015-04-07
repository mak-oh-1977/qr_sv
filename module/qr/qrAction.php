<?php
	class qrAction extends Action 
	{
		//////////////////////////////////////////////////////////////////////////
		//
		//
		//
		function dispatch(&$context)
		{
		}

		//////////////////////////////////////////////////////////////////////////
		//
		//
		//
		function dispHtml(&$context)
		{
			//表示するルーチン

			// Smartyの作成と値の割り当て
			$smarty = $this->getSmarty();


			// 画面への出力
			$this->header();
			$this->display($smarty);
		}
	}
?>
