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
		var copyContent = $('[name=inquiry-contents]').val();
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
});

function inquiryCopy(string) {
	  // 空div 生成
	  var tmp = document.createElement("div");
	  // 選択用のタグ生成
	  var pre = document.createElement('pre');

	  // 親要素のCSSで user-select: none だとコピーできないので書き換える
	  pre.style.webkitUserSelect = 'auto';
	  pre.style.userSelect = 'auto';

	  tmp.appendChild(pre).textContent = string;

	  // 要素を画面外へ
	  var s = tmp.style;
	  s.position = 'fixed';
	  s.right = '200%';

	  // body に追加
	  document.body.appendChild(tmp);
	  // 要素を選択
	  document.getSelection().selectAllChildren(tmp);

	  // クリップボードにコピー
	  var result = document.execCommand("copy");

	  // 要素削除
	  document.body.removeChild(tmp);

	  return result;
}
