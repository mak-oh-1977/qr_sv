<?php
// 今回のアプリのActionで共通で利用する機能はこのクラス内に記述
//データベースに接続する
//ADOdbのインスタンスを作成
//require_once('MDB2.php');

class dbAccess {    
	private $DB;
	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
    function open()
    {
		$dsn = 'sqlite:' . APP_BASE_DIR . 'db/db.sqlite';

		try{
		    $this->DB = new PDO($dsn);
		}catch (PDOException $e){
		    print('Connection failed:'.$e->getMessage());
		    die();
		}

		return $this->DB;
    }

	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
	function beginTransaction()
	{
		$this->DB->beginTransaction();
	}

	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
	function commit()
	{
		$this->DB->commit();
	}

	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
	function selectData($sql, $data = null)
	{
		$stmt = $this->DB->prepare($sql);
		if (!$stmt)
		{
			$res = array(
				"res" => "NG",
				"info" => $stmt->errorInfo(),
				"sql" => $sql,
				"data" => $data
			);
			return $res;
		}
		
		if ($stmt->execute($data) == false)
		{
			$res = array(
				"res" => "NG",
				"info" => $stmt->errorInfo(),
				"sql" => $sql,
				"data" => $data
			);
			return $res;
		}
		$rows = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			array_push($rows, $row);
		}
		
		$res = array(
			"res" => "OK",
			"rows" => $rows
		);

		return $res;
	}

	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
	function selectOne($sql, $data = null)
	{
		$stmt = $this->DB->prepare($sql);
		if (!$stmt)
		{
			$res = array(
				"res" => "NG",
				"info" => $stmt->errorInfo(),
				"sql" => $sql,
				"data" => $data
			);
			return $res;
		}
		
		if ($stmt->execute($data) == false)
		{
			$res = array(
				"res" => "NG",
				"info" => $stmt->errorInfo(),
				"sql" => $sql,
				"data" => $data
			);
			return $res;
		}
		$rows = array();
		$row = $stmt->fetch(PDO::FETCH_NUM);

		$res = array(
			"res" => "OK",
			"value" => $row[0],
		);

		return $res;
	}

	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
	function execute($sql, $data = null)
	{
		$stmt = $this->DB->prepare($sql);
		if (!$stmt)
		{
			$res = array(
				"res" => "NG",
				"info" => $this->DB->errorInfo(),
				"sql" => $sql,
				"data" => $data
			);
			return $res;
		}
		
		if ($stmt->execute($data) == false)
		{
			$res = array(
				"res" => "NG",
				"info" => $stmt->errorInfo(),
				"sql" => $sql,
				"data" => $data
			);
			return $res;
		}

		$res = array(
			"res" => "OK",
			"id" => $this->DB->lastInsertId(),
			"row_num" => $stmt->rowCount()
		);

		return $res;
	}

	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
	function backup($sqlfile)
	{
		$output = array();
		$cmd = MYSQL_DIR . "/bin/mysqldump -u apollon -papollon apollon > $sqlfile";
		exec($cmd, $output);

		return $output;
	}

	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
	function restore($sqlfile)
	{
		$output = array();
		$cmd = MYSQL_DIR . "/bin/mysql -u apollon --password=apollon apollon < $sqlfile";
		exec($cmd, $output);
		
		return $output;
	}
	

}

