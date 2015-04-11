<?php
/**
 * コントローラー
 *
 * @package Controller
 */
class Controller {
    static function execute()
    {
		$context = new Context();

		$cmd = Controller::getTargetName($target);

/*
		session_start();
		if ($target != APP_DEFAULT_ACTION)
		{
//print "<P>";
//print_r($_SESSION);
			if (!isset($_SESSION["login_time"])){
				exit("ログインしていません");

			}
		}
*/
		switch($cmd){
			case 'x':
	//error_log("AjaxDispatch(" . $target . ")\n", 3, '/var/tmp/hms.log');
				/**
				* actionのフェーズ(Actionを実行)
				*/
				Controller::Ajax_dispatch($context, $target);
				break;
			case 'm':
				/**
				* actionのフェーズ(Actionを実行)
				*/
				if ($target == '')
					$target = $_SESSION['LAST_MODULE'];
				else
					$_SESSION['LAST_MODULE'] = $target;

				Controller::Action_dispatch($context, $target);
				break;
			default:
				break;

		}
	}

	static function getTargetName(&$target)
	{
		if (isset($_REQUEST['x']))
		{
			$cmd = 'x';
			$target = $_REQUEST['x'];

		}
		else
		{
			$cmd = APP_ACTION_ARG;
            if (isset($_REQUEST[APP_ACTION_ARG]))
			{
				$target = $_REQUEST[APP_ACTION_ARG];
			}
			else
			{
				$target = APP_DEFAULT_ACTION;
			}
	
		}

		// 対象Actionクラス名、ファイル名を決定
		if ($target != "") 
		{
			$target = str_replace("_", "/", $target);
			$target = preg_replace("/[^0-9a-zA-Z_]/", "", $target);
		}
		return $cmd;
	}

    /**
     * 適切なActionを実行する
     * 
     * @param &$context
     * @param $target 対象のAction名
     * @return string Viewの名前
     */
	static function Action_dispatch(&$context, $target="")
	{
		$File  = APP_MODULE_DIR . $target . "/" . $target."Action.php";
		$Class = $target."Action";

		// 対象ファイル読み込み
		if ($File != "" && is_readable($File) && is_file($File)) {
			include_once($File);
		}
		// 対象クラスインスタンス作成
		if (class_exists($Class)) {
			$o = new $Class;
		}
		// 対象クラスのdispatchメソッド実行
		if (method_exists($o,"dispatch")) {
			$o->dispatch($context);
		}
		// 対象クラスのdispatchメソッド実行
		if (method_exists($o,"dispHtml")) {
			$o->dispHtml($context);
		}
	}

    /**
     * 適切なViewを実行する
     * 
     * @param &$context
     * @param $target 対象のView名
     * @return void
     */
	static function Ajax_dispatch(&$context, $target="")
	{
		$E = error_reporting();
		if(($E & E_STRICT) == E_STRICT) error_reporting($E ^ E_STRICT);


		$File  = APP_MODULE_DIR . $target . "/" . $target . "Ajax.php";
		$Class = $target."Ajax";

		// 対象ファイル読み込み
		if ($File != "" && is_readable($File) && is_file($File)){
			include_once($File);
		}

		// 対象クラスインスタンス作成
		if (class_exists($Class)) {
			$x = new $Class;
		}
		else
		{
			echo "undefined class:" . $Class;
		}

		// 対象クラスのdispatchメソッド実行
		if (method_exists($x,"dispatch")) {
			$x->dispatch($context);
		}

		// error_reportingを元に戻す
		error_reporting($E);
	}
}
?>
