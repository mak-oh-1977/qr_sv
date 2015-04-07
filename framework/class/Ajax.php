<?php
 /*  * Ajaxクラス(abstract)
 * Ajax は一切の出力を行わない
 *
 * @package Ajax
 */
class Ajax {
    /**
     * abstract
     */
    function dispatch(&$context)
    {
        // 下位クラスでメソッドを実装しないとエラーにするための記述(abstract)
        die("メソッドが実装されていません");
    }
    // その他Ajaxで共通な機能(フレームワークに関わる)があれば盛り込む

	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
	function SendResponse($arr)
	{
		$encode = json_encode($arr);

		header("Content-Type: text/html; charset=UTF-8");

		echo $encode;   //JSONを出力
	}

	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
	function excelDownload($file_name,$data,$header=null)
	{
		//ヘッダを付ける場合はarray(header1,header2)の形式で渡す
		if($header!=null)
		{
			array_unshift($data,$header);
		}

		//PHPのテンポラリに読み書きの準備をする
		$fp=fopen('php://temp','r+');
		foreach($data as $v)
		{
			//テンポラリにCSV形式で書き込む
			$this->_fputcsv($fp,$v);
		}
		//ファイルポインタを一番先頭に戻す
		rewind($fp);
		//ファイルポインタの今の位置から全てを読み込み文字列へ代入
		$csv=stream_get_contents($fp);
		//SJISに変える
		//ファイルポインタを閉じる
		fclose($fp);
		//渡されたファイル名の拡張子やパスを切り落とす
		$file_name=basename($file_name);
		//ダウンロードヘッダ定義
		header('Content-Disposition:attachment; filename="'.$file_name.'.csv"');
		header('Content-Type:application/octet-stream');
		header('Content-Length:'.strlen($csv));
		echo $csv;

		exit;
	}

	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
	function _fputcsv($fp, $data, $toEncoding='Shift-JIS', $srcEncoding='UTF-8') {

		$csv = '';
		foreach ($data as $col) {
			if (is_numeric($col)) {
				$csv .= $col;
			} else {
				$col = mb_convert_encoding($col, $toEncoding, $srcEncoding);
				$col = mb_str_replace('"', '""', $col, $toEncoding);
				$csv .= '"' . $col . '"';
			}
			$csv .= ',';
		}

		fwrite($fp, $csv);
		fwrite($fp, "\r\n");
	}

}
?>
