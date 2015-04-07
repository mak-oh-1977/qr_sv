<?php
/**
 * コンテキストクラス
 *
 * @package Context
 */
class Context {
    var $_hash;
    
    /**
     * コンストラクタ
     * 
     * @param void
     *
     */
    function Context(){
    }
    
    /**
     * setter
     *
     * @param string name
     * @param string value
     *
     * @return void
     */
    function setAttributes($name,$value){
        $this->_hash[$name] = $value;
    }
    
    /**
     * getter
     *
     * @param string name
     *
     * @return string value
     */
    function getAttributes($name){
        return $this->_hash[$name];
    }
}
?>
