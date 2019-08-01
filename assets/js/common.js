$(function() {
	$('[name^=property-images-]').on('click', function() {
		let thisId     = $(this).attr('name').substr(-12);
		let thisSrc    = $(this).attr('src');
		$('#property_image_main_' + thisId).attr('src', thisSrc);
	});

	$('a[name=order-by]').on('click', function() {
		let thisId = $(this).attr('id').toUpperCase();
		$('input[type=hidden][name=order-by-condition]').val(thisId);
		$('button[name=search-submit]').trigger('click');
	});

	$('select[name=displayed-results-cnt]').on('change', function() {
		let thisVal = $(this).val();
		$('input[type=hidden][name=displayed-result-cnt]').val(thisVal);
		$('button[name=search-submit]').trigger('click');
	});

	$('a[name^=displayed-result-]').on('click', function() {
		let thisVal = $(this).attr('name');
		$('input[type=hidden][name=specified-page]').val(thisVal.replace(/[^0-9]/g, ''));
		$('button[name=search-submit]').trigger('click');
	});

	$('#inquiry_submit').on('click', function() {
		let copyContent = $('[name=inquiry-contents]').val();
		if (inquiryCopy(copyContent)) {
			alert(
				"以下の物件情報をクリップボードにコピーしました。\n公式LINEのトークルームにてそのまま貼り付けて送信してください。\n" +
				"--------------------\n" +
				copyContent + "\n" +
				"--------------------"
			);
			window.open ('https://line.me/R/ti/p/%40295ybpst', 'newtab');
		}
	});

	$('#search_submit').on('click', function() {
		var data = {
			"free-word"				: $('[name=free-word]').val(),
			"and-or-search"			: $('[name=and-or-search]').val(),
			"free-word-minus"		: $('[name=free-word-minus]').val(),
			"address1" 				: $('[name=address1]').val(),
			"train-route"			: $('[name=train-route]').val(),
			"minutes-walking"		: $('[name=minutes-walking]').val(),
			"building-year"			: $('[name=building-year]').val(),
			"rent-from"				: $('[name=rent-from]').val(),
			"rent-to"				: $('[name=rent-to]').val(),
			"madori-room"			: $('[name=madori-room]').val(),
			"madori-type"			: $('[name=madori-type]').val(),
			"building-type"			: $('[name=building-type]').val(),
			"remarks-2"				: $('[name=remarks-2]').val(),
			"order-by-condition"	: $('[name=order-by-condition]').val(),
			"displayed-result-cnt"	: $('[name=displayed-result-cnt]').val(),
			"specified-page"		: $('[name=specified-page]').val()
		}
		$.get({
		    url: "action/userSearchConditions.php",
            async: true,
		    data: data,
		})
		.done(function(data, textStatus, jqXHR){
			if (data == "") {
				// TODO 将来的にはajaxで物件の順番を書き替えるようにする
				var fm      = document.getElementById('filtered_search');
				fm.method = "get";
				fm.action = "index.php#search_box";
				fm.submit();
			} else {
				alert(data);
			}
	    })
	    .fail(function(XMLHttpRequest, textStatus, errorThrown){
	        alert(errorThrown);
	    });
	});

	$('[id^=property_detail_link_]').on('click', function() {
		let thisKey = $(this).attr('id').substr(-12);
		$('#property_info_update_submit_' + thisKey).trigger('click');
	});
});

/*
 * 物件情報をクリップボードにコピーする
 */
function inquiryCopy(string) {
	  // 空div 生成
	  let tmp = document.createElement("div");
	  // 選択用のタグ生成
	  let pre = document.createElement('pre');

	  // 親要素のCSSで user-select: none だとコピーできないので書き換える
	  pre.style.webkitUserSelect = 'auto';
	  pre.style.userSelect = 'auto';

	  tmp.appendChild(pre).textContent = string;

	  // 要素を画面外へ
	  let s = tmp.style;
	  s.position = 'fixed';
	  s.right = '200%';

	  // body に追加
	  document.body.appendChild(tmp);
	  // 要素を選択
	  document.getSelection().selectAllChildren(tmp);

	  // クリップボードにコピー
	  let result = document.execCommand("copy");

	  // 要素削除
	  document.body.removeChild(tmp);

	  return result;
}
