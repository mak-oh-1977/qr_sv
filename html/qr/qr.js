$(function(){
	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
	$(document).ready(function(){

		updateList();
	});




	//------------------------------------------------------------------------
	//
	//*	ユーザーリスト更新
	//

	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
	function updateList()
	{
		var param = { 
			x:'qr', 
			ctrl:'list',
		};

		DbAccess('#db_msg', param, 
			function(ret){
				$('#s_list tbody').empty();

				for(var i = 0; i < ret['rows'].length; i++)
				{
					var row = ret['rows'][i];

					var r = $('<tr>', {	
						staff_id: row['id'],
						code: row['code'],
						name: row['name'],
						password: row['password'],
						type: row['type'],
						memo: row['memo'],
					});

					$('<td>', {text: row['code']})
							.appendTo(r);
					$('<td>', {text: row['name']})
							.appendTo(r);

					$('#s_list tbody').append(r);
				}
			}
		);
		
	}


	//------------------------------------------------------------------------
	//
	//*	ユーザーリスト処理
	//

	//------------------------------------------------------------------------
	//
	//**	テーブル上部ボタン
	//

	//////////////////////////////////////////////////////////////////////////
	//
	//	追加ボタン
	//
	$('#qr_add').click(function(){

		$('#qr_dlg input').val('');

		$("#qr_dlg").dialog({
			title:'コード追加',
			autoOpen:true,
			modal:true,
			width:600,
			height:400,
			buttons:{
				"OK":function(){
					if ($('#code').val().match(/[^0-9A-Za-z]+/)){
						alertDlg("入力エラー", "スタッフコードは半角英数のみです。");
						return;
					}


					var param = { 
						x:'qr', 
						ctrl:'add',
						code:$('#code').val(),
					};

					DbAccess('#db_msg', param, 
						function(ret){
							$("#qr_dlg").dialog("destroy");
							updateList();
						},
						function(ret){
							alertDlg("エラー", ret['info']);
						}

					);
				},
				"キャンセル":function(){ 
					$(this).dialog("destroy"); 
				}
			}
		});
	});

	//------------------------------------------------------------------------
	//
	//**	テーブルクリック
	//


	//////////////////////////////////////////////////////////////////////////
	//
	//	利用者情報変更
	//
	$(document).on("click", '#s_list tbody tr', function() {

		var tr = $(this);
		$('#staff_dlg #staff_id').val($(tr).attr('staff_id'));
		$('#staff_dlg #code').val($(tr).attr('code'));
		$('#staff_dlg #password').val($(tr).attr('password'));
		$('#staff_dlg #name').val($(tr).attr('name'));
		$('#staff_dlg #memo').val($(tr).attr('memo'));
		$('#staff_dlg input[type=checkbox]').prop('checked', false);
		$('#staff_dlg input[type=checkbox]').removeAttr('disabled');

		if ($(tr).attr('type') & 0x1)
			$('#chk_1').prop('checked', true);
		if ($(tr).attr('type') & 0x10)
			$('#chk_2').prop('checked', true);
		if ($(tr).attr('type') & 0x20)
			$('#chk_3').prop('checked', true);
		if ($(tr).attr('type') & 0x40)
			$('#chk_4').prop('checked', true);

		$("#staff_dlg").dialog({
			title:'スタッフ変更',
			autoOpen:true,
			modal:true,
			width:600,
			height:400,
			buttons:{
				"OK":function(){
					if ($('#code').val().match(/[^0-9A-Za-z]+/)){
						alertDlg("入力エラー", "スタッフコードは半角英数のみです。");
						return;
					}

					var type = 0;
					var chkbox = $('#staff_dlg :checkbox');
					for(var i = 0; i < $(chkbox).length; i++)
					{
						var a = $(chkbox).eq(i);
						if($(a).prop('checked'))
						{
							type |= parseInt($(a).attr('v'));
						}
					}

					if (type === 0){
						alertDlg("入力エラー", "いずれかのアクセス権限を選択してください");
						return;
					}

					var param = { 
						x:'staff', 
						ctrl:'edit',
						staff_id:$('#staff_dlg #staff_id').val(),
						code:$('#staff_dlg #code').val(),
						password:$('#staff_dlg #password').val(),
						name:$('#staff_dlg #name').val(),
						memo:$('#staff_dlg #memo').val(),
						type:type,
					};

					DbAccess('#db_msg', param, 
						function(ret){
							$('#staff_dlg').dialog("destroy");
							updateStaffList();
						},
						function(ret){
							if (ret['info']['1'] == "1062")
							{
								alertDlg("エラー", "スタッフコードが重複しています");
							}
							else
							{
								alertDlg("エラー", ret['info']);
							}
						}
					);
				},
				"削除":function(){ 
					$(this).dialog("destroy"); 
					deleteStaff(
							$('#staff_dlg #staff_id').val(), 
							$('#staff_dlg #name').val());
				},
				"キャンセル":function(){ 
					$(this).dialog("destroy"); 
				},
			}
		});

	});


	//////////////////////////////////////////////////////////////////////////
	//
	//	利用者削除
	//
	function deleteStaff(id, name){

		var dlg = $('<div/>', {title:'利用者削除確認'})
			.append($('<p/>', {text:name + 'を削除しますか？', 'class':'summary'}));
		$(dlg).appendTo(document.body);


		$(dlg).dialog({
			autoOpen:true,
			modal:true,
			width:450,
			height:220,
			buttons:{
				"はい":function(){
					var dlg = $(this);

					var param = { 
						x:'staff', 
						ctrl:'del',
						staff_id:id,
					};

					DbAccess('#db_msg', param, 
						function(ret){
							$(dlg).dialog("close");
							$(dlg).remove();
							updateStaffList();
						}
					);
				},
				"いいえ":function(){
					$(this).dialog("close");
					$(this).remove();
				}
			}
		});
	}

	//------------------------------------------------------------------------
	//
	//*	共通関数等
	//
});
