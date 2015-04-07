<?php


session_cache_limiter('private, must-revalidate');
// メインの実行ファイル
// 必要ライブラリの読み込み 


require('../framework/loader.php'); 


//$trc = new TraceTime;
//$trc->Start();

// メインルーチンの実行
Controller::execute();

//$trc->End("Controller::execute");

?> 
