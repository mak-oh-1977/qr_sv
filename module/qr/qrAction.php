<?php
	class qrAction extends Action 
	{
		//////////////////////////////////////////////////////////////////////////
		//
		//
		//
		function dispatch(&$context)
		{
		}

		//////////////////////////////////////////////////////////////////////////
		//
		//
		//
		function dispHtml(&$context)
		{
			//�\�����郋�[�`��

			// Smarty�̍쐬�ƒl�̊��蓖��
			$smarty = $this->getSmarty();


			// ��ʂւ̏o��
			$this->header();
			$this->display($smarty);
		}
	}
?>
