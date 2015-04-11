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

				case 'edit':
					$this->edit();
					break;

				case 'del':
					$this->delete($_POST['staff_id']);
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
select * from qr 
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
		function edit()
		{
			$dbObj = new dbAccess();
			$dbObj->open();

			$dbObj->beginTransaction();

			$sql = <<<SQL_END
update staff set code=?, name=?, password=?, type=?, memo=? where id=?
SQL_END;

			$param = array(
				$_POST['code'],
				$_POST['name'],
				$_POST['password'],
				$_POST['type'],
				$_POST['memo'],
				$_POST['staff_id']);

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
		function delete($id)
		{
			$dbObj = new dbAccess();
			$dbObj->open();

			$dbObj->beginTransaction();

			$sql = <<<SQL_END
delete from staff where id = ?
SQL_END;

			$res = $dbObj->execute($sql, array($_POST['staff_id']));
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
