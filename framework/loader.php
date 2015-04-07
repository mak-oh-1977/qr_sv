<?php
/**
 * 必要ファイルのインクルードを自動で行う
 */

define("APP_BASE_DIR", dirname(__FILE__) . "/../");
define("APP_FRAMEWORK_DIR", APP_BASE_DIR . "framework/");
define("APP_FRAMEWORK_CLASS_DIR", APP_FRAMEWORK_DIR. "class/");

set_include_path(get_include_path() . PATH_SEPARATOR . APP_BASE_DIR . 'Classes/');


$_APP_REQUIRES = array(
    // フレームワーク関連のファイルを読み込む
    APP_FRAMEWORK_DIR.'config.php',
    APP_FRAMEWORK_CLASS_DIR.'Context.php',
    APP_FRAMEWORK_CLASS_DIR.'Controller.php',
    APP_FRAMEWORK_CLASS_DIR.'Action.php',
    APP_FRAMEWORK_CLASS_DIR.'Ajax.php',
    APP_FRAMEWORK_CLASS_DIR.'dbAccess.php',

    // Smartyの読み込み
	APP_BASE_DIR . 'Smarty/Smarty.class.php',
	APP_FRAMEWORK_CLASS_DIR.'mb_str_replace.php',

    APP_FRAMEWORK_DIR.'tracetime.php',

//	'tcpdf/config/lang/jpn.php',
//	'tcpdf/tcpdf.php',
);

foreach ($_APP_REQUIRES as $_APP_REQUIRE) {

        require($_APP_REQUIRE);
//printf("$_APP_REQUIRE:%6.2f msec秒かかりました\n", $time);
//    } else {
//        die("必要なファイル（{$_APP_REQUIRE}）が読み込めません");
//    }
}
?>
