<?php
// フレームワークの設定ファイル

// Action, View 切り替え用CGI引数名
define("APP_ACTION_ARG", "m");

/**
 * Action 関連の設定
 */
// デフォルトの Action 名
define("APP_DEFAULT_ACTION", "qr");


define("APP_MODULE_DIR", APP_BASE_DIR. "module/");

define("IMG_FILE_DIR", $_SERVER['DOCUMENT_ROOT'] . "/imgfiles/");

define("MYSQL_DIR", "c:/xampp/mysql/");

define("BACKUP_DIR", APP_BASE_DIR. "files/");

/**
 * テンプレートディレクトリの設定
 */
define("APP_TEMPLATE_COMPILE_DIR", APP_BASE_DIR . "template/");

date_default_timezone_set('Asia/Tokyo');

?>
