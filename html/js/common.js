$(function(){
	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
	$(document).ready(function(){


	});
	//////////////////////////////////////////////////////////////////////////
	//
	//
	//
	$(document).on("click", '.menu_btn', function(e) {

		var v = $(this).attr("value");

		SendForm(v);
	});

});

//////////////////////////////////////////////////////////////////////////
//
//	フォーム送信
//
//	module:送信先モジュール名
//	values:パラメータ配列
//
function SendForm(module, values)
{
	var f;
	f = $('<form/>', {action: 'index.php', method: 'post'})
		.append($('<input/>', {type:'hidden', name:'m', value:module}));

	for(var i in values)
	{
		var v = values[i];
		$(f).append($('<input/>', {type:'hidden', name:v.name, value:v.value}))
	}

	$(f).appendTo(document.body)
		.submit();

};


//////////////////////////////////////////////////////////////////////////
//
//
//
function ShowMsg(msg_id, msg, loading)
{
	$(msg_id).empty();
	if (loading == true)
	{
		$(msg_id).append($('<img>', {id:"processingImg", src:"img/loading.gif"}));
	}

	$(msg_id).append($('<span>')
			.css('color', 'white')
			.text(msg));
}

//////////////////////////////////////////////////////////////////////////
//
//
//
function DbAccess(msg, param, ok_cb, ng_cb)
{
	ShowMsg(msg,"サーバー処理中です。。。", true);

	$.post(
		"index.php", 
		param, 
		function(ret){
			var ar = eval(ret);
			if (ret["res"] == "OK")
			{
				ShowMsg(msg, "完了しました");
				if (typeof(ok_cb) == 'function')
					ok_cb(ret);
			}
			else
			{
				ShowMsg(msg,"");
				if (typeof(ng_cb) == 'function')
				{
					ng_cb(ret);
					return;
				}

				alertDlg("エラー", ret["msg"] + "<br>" + ret['info']);
			}
		},
		"json"
	);

}

//////////////////////////////////////////////////////////////////////////
//
//
//
function confirmDlg(title_txt, msg, ok_cb, cancel_cb)
{
	var dlg = $('<div/>', {title:title_txt})
		.append($('<p/>', {text:msg}))
		.append($('<div/>', {id:'msg'})
	);
	$(dlg).appendTo(document.body);

	var btn = $(this);
	$(dlg).dialog({
		autoOpen:true,
		modal:true,
		width:400,
		minHeight:150,
		maxHeight:500,
		buttons:{
			"OK":function(){
				var dlg = $(this);

				$(dlg).dialog("close"); 
				$(dlg).remove();

				ok_cb();
			},
			"キャンセル":function(){ 
				$(this).dialog("close"); 
				$(this).remove();

				if (typeof(cancel_cb) == 'function')
				{
					cancel_cb();
				}
			}
		}
	});
}

//////////////////////////////////////////////////////////////////////////
//
//
//
function alertDlg(title_txt, msg, ok_cb)
{
	var dlg = $('<div/>', {title:title_txt})
		.append($('<p/>').html(msg))
		.append($('<div/>', {id:'msg'})
	);
	$(dlg).appendTo(document.body);

	var btn = $(this);
	$(dlg).dialog({
		autoOpen:true,
		modal:true,
		width:400,
		minHeight:150,
		maxHeight:500,
		buttons:{
			"OK":function(){
				var dlg = $(this);

				$(dlg).dialog("close"); 
				$(dlg).remove();

				if (typeof(ok_cb) == 'function')
				{
					ok_cb();
				}
			},
		}
	});
}




