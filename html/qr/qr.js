$(function(){
	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
	$(document).ready(function(){

		$('#hp').attr('src',"http://chart.apis.google.com/chart?chs=150x150&cht=qr&chl=" + location.href);
			

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
						code: row['code'],
					});

					$('<td>', {text: row['code']})
							.appendTo(r);
					$('<td>').append('<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#qrdisp">表示</button>')
							.appendTo(r);
					$('<td>', {text: row['status']})
							.appendTo(r);
					$('<td>').append('<button class="btn btn-sm btn-info" id="reset">リセット</button>')
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
			width:300,
			height:200,
			buttons:{
				"OK":function(){
					if ($('#code').val().match(/[^0-9A-Za-z]+/)){
						alertDlg("入力エラー", "コードは半角英数のみです。");
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
	$(document).on("click", '#s_list tbody #reset', function() {

		var tr = $(this).closest('tr');
		var param = { 
			x:'qr', 
			ctrl:'reset',
			code:$(tr).attr('code'),
		};

		DbAccess('#db_msg', param, 
			function(ret){
				updateList();
			},
			function(ret){
				alertDlg("エラー", ret['info']);
			}

		);
	});

    // ダイアログ表示前にJavaScriptで操作する
	$('#qrdisp').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var tr = $(button).closest('tr');
		var code = $(tr).attr('code');
		var src = encodeURIComponent(location.href + "index.php?x=qr&ctrl=read&code=" + code);
		$("#qrimg").attr('src', "http://chart.apis.google.com/chart?chs=150x150&cht=qr&chl=" + src);
//		var recipient = button.data('whatever');
//		var modal = $(this);
//		modal.find('.modal-body .recipient').text(recipient);
		//modal.find('.modal-body input').val(recipient);
	});

	$('#qrdisp').on('click', '.modal-footer .btn-default', function(){
		updateList();

	});

	//////////////////////////////////////////////////////////////////////////
	//
	//	利用者情報変更
	//
	$(document).on("click", '#s_list button', function() {

/*
		var tr = $(this).closest('tr');
		var code = $(tr).attr('code');

		var dlg = $('<div/>', {title:'QRコード'})
			.append($('<img/>', {src:}));
			
		$(dlg).appendTo(document.body);


		$(dlg).dialog({
			autoOpen:true,
			modal:true,
			width:300,
			height:300,
			buttons:{
				"OK":function(){
					$(this).dialog("close");
					$(this).remove();
					updateList();
				},
			}
		});
*/
	});



	//------------------------------------------------------------------------
	//
	//*	共通関数等
	//
});
