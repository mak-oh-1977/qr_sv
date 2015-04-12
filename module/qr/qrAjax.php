<?php
	class qrAjax extends Ajax {
		//////////////////////////////////////////////////////////////////////////
		//
		//
		//
		function dispatch(&$context){
			// mysqlpassAction の処理を記述

			if (isset($_REQUEST["ctrl"]))
				$ctrl = $_REQUEST["ctrl"];

			switch($ctrl)
			{

				case 'list':
					$this->qrlist();
					break;

				case 'add':
					$this->add();
					break;


				case 'reset':
					$this->reset($_REQUEST['code']);
					break;

				case 'read':
					$this->read($_REQUEST['code']);

					$res = array('res' => 'OK');
					$this->SendResponse($res);

					break;

				default:
					break;
			}
		}
		//------------------------------------------------------------------------
		//
		//*	利用者情報
		//

		//////////////////////////////////////////////////////////////////////////
		//
		//
		//
		function qrlist()
		{
			$dbObj = new dbAccess();
			$dbObj->open();

			$sql = <<<SQL_END
select 
	code,
	case status
		when 0 then '読んでません'
		when 1 then '読みました'
		else '???'
	end as status
from qr 
SQL_END;
			$res = $dbObj->selectData($sql);

			$this->SendResponse($res);
			return ;
		}

		//////////////////////////////////////////////////////////////////////////
		//
		//
		//
		function add()
		{
			$dbObj = new dbAccess();
			$dbObj->open();

			$dbObj->beginTransaction();

			$sql = <<<SQL_END
insert into qr (code, status) values(?,0)
SQL_END;

			$param = array(
				$_POST['code']
				);

			$res = $dbObj->execute($sql, $param);

			if ($res['res'] == "NG")
			{
				$this->SendResponse($res);
				return ;
			}

			$dbObj->commit();

			$this->SendResponse($res);

			return ;
		}
		//////////////////////////////////////////////////////////////////////////
		//
		//
		//
		function reset($code)
		{
			$dbObj = new dbAccess();
			$dbObj->open();

			$dbObj->beginTransaction();

			$sql = <<<SQL_END
update qr set status = 0 where code=?
SQL_END;

			$res = $dbObj->execute($sql, array($code));
			if ($res['res'] == "NG")
			{
				$this->SendResponse($res);
				return ;
			}

			$dbObj->commit();

			$this->SendResponse($res);

			return ;
		}

		//////////////////////////////////////////////////////////////////////////
		//
		//
		//
		function read($code)
		{
			$dbObj = new dbAccess();
			$dbObj->open();

			$dbObj->beginTransaction();

			$sql = <<<SQL_END
update qr set status=1 where code=?
SQL_END;

			$res = $dbObj->execute($sql, array($code));
			if ($res['res'] == "NG")
			{
				$this->SendResponse($res);
				return ;
			}

			$dbObj->commit();

			$this->SendResponse($res);

			return ;
		}

	}
?>
