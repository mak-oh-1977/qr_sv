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
						code: row['code'],
					});

					$('<td>', {text: row['code']}).append('<button class="list_btn qr">QR</button>')
							.appendTo(r);
					$('<td>', {text: row['status']})
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
	$(document).on("click", '#s_list tr', function() {

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


	//////////////////////////////////////////////////////////////////////////
	//
	//	利用者情報変更
	//
	$(document).on("click", '#s_list button', function() {

		var tr = $(this).closest('tr');
		var code = $(tr).attr('code');

		var src = encodeURIComponent(location.href + "index.php?x=qr&ctrl=read&code=" + code);
		var dlg = $('<div/>', {title:'QRコード'})
			.append($('<img/>', {src:"http://chart.apis.google.com/chart?chs=150x150&cht=qr&chl=" + src}));
			
		$(dlg).appendTo(document.body);


		$(dlg).dialog({
			autoOpen:true,
			modal:true,
			width:400,
			height:350,
			buttons:{
				"OK":function(){
					$(this).dialog("close");
					$(this).remove();
					updateList();
				},
			}
		});

	});



	//------------------------------------------------------------------------
	//
	//*	共通関数等
	//
});
