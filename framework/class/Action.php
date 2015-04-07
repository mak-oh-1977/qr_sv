<?php
 /*  * Actionクラス(abstract)
 * Action は一切の出力を行わない
 *
 * @package Action
 */
class Action {
    /**
     * abstract
     */
    function dispatch(&$context)
    {
        // 下位クラスでメソッドを実装しないとエラーにするための記述(abstract)
        die(get_class($this) . ":dispatchメソッドが実装されていません");
    }

	function dispHtml(&$context)
	{
        // 下位クラスでメソッドを実装しないとエラーにするための記述(abstract)
        die(get_class($this) . ":dispHtmlメソッドが実装されていません");
	}
    // その他Actionで共通な機能(フレームワークに関わる)があれば盛り込む
    /**
     * getRequest
     * 
     * @param $key
     * @param $row
     * @return void
     */
    function getRequest($key, $raw=0)
    {
        $value = $_REQUEST[$key];
        
        if (!$raw) {
            return htmlspecialchars($value);
        } else {
            return $value;
        }
    }


	function header()
	{
		header('');
	}
    /**
     * クラスが利用するテンプレート名の取得
     *
     * @param void
     *
     * @return string テンプレートファイル名
     */
    function getTemplateName()
    {
        $tmp = get_class($this);
        $tmp = preg_replace("/Action$/i", "", $tmp);
        return $tmp.".tpl";
    }
    
    /**
     * getSmarty
     * 
     * @param void
     * @return object smartyオブジェクト
     */
    function getSmarty()
    {
        // Smartyのオブジェクトを作成
        $smarty = new Smarty();

        $tmp = get_class($this);
        $tmp = preg_replace("/Action$/i", "", $tmp);

        // テンプレートの存在するディレクトリを指定
		$templateFile = APP_MODULE_DIR.$tmp."/";
        $smarty->template_dir = $templateFile;

        // Smartyのテンプレートのキャッシュファイル格納先を指定
        $smarty->compile_dir  = APP_TEMPLATE_COMPILE_DIR;

        
        return $smarty;
    }
    
    /**
     * Smartyのdisplayメソッドのラッパー関数
     * 
     * @param &$smarty
     * @param $template
     * @return void
     */
    function display(&$smarty, $template="")
    {
        if ($template == "") {
            $template = $this->getTemplateName();
        }
        $smarty->display($template);
    }
    // その他Viewで共通な機能(フレームワークに関わる)があれば盛り込む
}
?>
