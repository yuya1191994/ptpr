$(function() {
	$('#upload_csv_submit').on('click', function() {
		if ($("#upload_csv").val() == "") {
			alert("csvファイルを選択してください。");
		} else {
			let errFile = "";
			let prefixFileName = "bkkn_list_";
			let upload_files = document.getElementById("upload_csv").files;
			//本日日付に取得したcsvのみ許容する
			let today = new Date();
			let todayYmd = today.getFullYear().toString() +
						   ("0" + (today.getMonth() + 1)).slice(-2) +
						   ("0" + (today.getDate()     )).slice(-2);
			for (let i = 0; i < upload_files.length; i ++) {
				let thisFileName = upload_files[i].name;
				// csvファイル名に本日日付が入っていなければエラーとしてカウント
				if (!thisFileName.includes(prefixFileName + todayYmd)) {
					errFile += thisFileName + "\n";
				}
			}
			if (errFile == "") {
				$('#upload_csv_form').submit();
			} else {
				alert("本日取得したcsvファイルのみを選択して下さい。\nエラー対象ファイル :\n" + errFile);
			}
		}
	});

	$('[name^=recommend-point]').on('click', function() {
		  let thisPkey = $(this).attr('name').substr(-12);
		  let addRecommend = $(this).val();
		  if ($(this).prop('checked')) {
		    $('#recommend_point_' + thisPkey).text($('#recommend_point_' + thisPkey).text() + ',' + addRecommend);
		  } else {
		    let sliceLength = addRecommend.length;
		    $('#recommend_point_' + thisPkey).text($('#recommend_point_' + thisPkey).text().slice(0, -sliceLength - 1));
		  }

		  if ($('#recommend_point_' + thisPkey).val().indexOf(',') == 0) {
			  $('#recommend_point_' + thisPkey).text($('#recommend_point_' + thisPkey).text().substr(1));
		  }
		});

	$('[id^=upload_images').on('change', function() {
		if (!this.files.length) {
			return;
		}

		// 画像をプレビュー
		let files = $(this).prop('files');
		let thisId = $(this).attr('id');
		let thisKey = thisId.substr(-12);
		for (let i = 0; i < files.length; i ++) {
			let file = files[i];
			let fr = new FileReader();

			fr.onload = function(e) {
				let src = e.target.result;
				let img = '<div class="subimg private-dark">' +
							'<img src="' + src + '" class="subimg" name="property-images-' + thisKey + '">' +
							'<input type="button" class="delbtn" name="delete-image-btn-' + thisKey + '" value="削除">' +
						  '</div>';
				$('#sort_key_' + thisKey).after(img);
			}
			fr.readAsDataURL(file);
		}
		let upload_images = document.getElementById(thisId).files;
		for (let i = 0; i < upload_images.length; i ++) {
			let thisImageName = upload_images[i].name;
		}
	});

	$(document).on('click', '[name^=delete-image-btn]', function() {
		let thisKey = $(this).attr('name').substr(-12);
		let deleteImg = ($(this).parent('div'));
		if ($(this).prevAll('img').hasClass('saved')) {
			let src = $(this).prevAll('img').attr('src');
			let delImagePath = $('#delete_image_path_' + thisKey);
			delImagePath.val(delImagePath.val() + src + ';');
		}
		deleteImg.remove();
	});

	$(document).on('click', '[name^=property-images-]', function() {
		let thisId     = $(this).attr('name').substr(-12);
		let thisSrc    = $(this).attr('src');
		$('#property_image_main_' + thisId).attr('src', thisSrc);
	});


	$( ".sortImg" ).sortable({
		update: function() {
			let thisPkey   = $(this).attr('id').substr(-12);
			let imageElms  = $('[name=property-images-' + thisPkey + ']');
			let hiddenSortPath = $('#sort_image_path_' + thisPkey);
			hiddenSortPath.val("");
			for (let i = 0; i < imageElms.length; i ++) {
				let thisSrc = $(imageElms[i]).attr('src');
				hiddenSortPath.val(hiddenSortPath.val() + thisSrc + ';');
			}
		}
	});

	$('a[name=order-by]').on('click', function() {
		let thisId = $(this).attr('id').toUpperCase();
		$('input[type=hidden][name=order-by-condition]').val(thisId);
		$('input[type=submit][name=search-submit]').trigger('click');
	});

	$('input[type=radio][name=release-flag]').on('click', function() {
		let thisId = $(this).attr('id');
		let thisKey = thisId.substr(-12);
		if (thisId.indexOf('release_flag_1') != -1) {
			$('#propertyinfo_' + thisKey).removeClass('private');
		} else {
			$('#propertyinfo_' + thisKey).addClass('private');
		}
	});

	$('select[name=displayed-results-cnt]').on('change', function() {
		let thisVal = $(this).val();
		$('input[type=hidden][name=displayed-result-cnt]').val(thisVal);
		$('input[type=submit][name=search-submit]').trigger('click');
	});

	$('a[name^=displayed-result-]').on('click', function() {
		let thisVal = $(this).attr('name');
		$('input[type=hidden][name=specified-page]').val(thisVal.replace(/[^0-9]/g, ''));
		$('input[type=submit][name=search-submit]').trigger('click');
	});


	$('[id^=issue_view_request_form_]').on('click', function() {
		$(this).next('div').removeClass('hide');
	});

	$('[id^=issue_publication_request_form_]').on('click', function() {
		$(this).next('div').removeClass('hide');
	});

	$('[id^=issue_view_request_submit_]').on('click', function() {
		var thisKey = $(this).attr('id').substr(-12);
		var errMsg  = "";
		if ($('#fax_number_' + thisKey).val() == "") {
			errMsg += 'FAX番号を入力して下さい。\n';
		}
		if ($('#room_number_' + thisKey).val() == "") {
			errMsg += '号室を入力してください。\n';
		}
		if ($('#employee_list_view_request_' + thisKey).val() ==""){
			errMsg += '担当者名を選択してください。\n';
		}
		if (!$('#view_request_date_' + thisKey).val().match(/^20\d{2}-\d{2}-\d{2}T\d{2}:\d{2}$/)) {
			errMsg += '内見予約日時を入力してください。';
		}

		if (errMsg == "") {
			var fm      = document.getElementById('updateForm_' + thisKey);
			fm.method = "post";
			fm.target = "_blank";
			fm.action = "view/admin/view-request-sheet.php";
			fm.submit();
			$('#property_info_update_submit_' + thisKey).trigger('click');
		} else { alert(errMsg);	}
	});

	$('[id^=issue_publical_request_submit_]').on('click', function() {
		var thisKey = $(this).attr('id').substr(-12);
		var errMsg  = "";
		if ($('#fax_number_' + thisKey).val() == "") {
			errMsg += 'FAX番号を入力して下さい。\n';
		}
		if ($('#room_number_' + thisKey).val() == "") {
			errMsg += '号室を入力してください。\n';
		}
		if ($('#employee_list_publical_request_' + thisKey).val() ==""){
			errMsg += '送信者名を選択してください。\n';
		}

		if (errMsg == "") {
			var fm      = document.getElementById('updateForm_' + thisKey);
			fm.method = "post";
			fm.target = "_blank";
			fm.action = "view/admin/publication-request-sheet.php";
			fm.submit();
			$('#property_info_update_submit_' + thisKey).trigger('click');
		} else { alert(errMsg);	}
	});

	$('[id^=property_info_update_submit_]').on('click', function() {
		var thisKey = $(this).attr('id').substr(-12);

		// 物件情報の更新と新規画像の登録処理は分ける。
		var data = {
			"pkey" 			    : $('#pkey_' + thisKey).val(),
			"sort-image-path"   : $('#sort_image_path_' + thisKey).val(),
			"delete-image-path" : $('#delete_image_path_' + thisKey).val(),
			"fax-number"		: $('#fax_number_' + thisKey).val(),
			"property-name"	    : $('#property_name_' + thisKey).val(),
			"room-number"	    : $('#room_number_' + thisKey).val(),
			"remarks-2"		    : $('#recommend_point_' + thisKey).text(),
			"ad-flag"		    : $('[name=ad-flag-' + thisKey + ']:checked').val(),
			"recommend-flag"    : $('[name=recommend-flag-' + thisKey + ']:checked').val(),
			"memo"			    : $('#memo_' + thisKey).val(),
			"release-flag"	    : $('[name=release-flag-' + thisKey + ']:checked').val(),
			"train-route"		:$('#train_route_' + thisKey).val(),
			"station-name"		:$('#station_name_' + thisKey).val(),
			"building-type"		:$('#building_type_' + thisKey).val()
		}
		$.post({
		    url: "controller/updatePropertyController.php",
            async: true,
		    data: data,
		})
		.done(function(data, textStatus, jqXHR){
			if ($('#upload_images_' + thisKey).val() == "") {
				location.reload();
			} else {
				// 新規追加画像がある場合は、別窓で別途処理
				var fm      = document.getElementById('updateForm_' + thisKey);
				fm.method = "post";
				fm.target = "_blank";
				fm.action = "controller/uploadPropertyImageController.php";
				fm.submit();
				setTimeout(function(){ $('#property_info_update_submit_' + thisKey).trigger('click'); }, 300);
			}
	    })
	    .fail(function(XMLHttpRequest, textStatus, errorThrown){
	        alert(errorThrown);
	    });
	});

	$('[id^=property_info_delete_submit_]').on('click', function() {
		var thisKey = $(this).attr('id').substr(-12);
		if (window.confirm('物件番号' + thisKey + 'を削除します。\n本当によろしいですか？')) {
			var data = { "pkey" 	: $('#pkey_' + thisKey).val() }
			$.post({
				type: "POST",
				url: "controller/deletePropertyController.php",
				async: true,
				data: data,
			})
			.done(function(data, textStatus, jqXHR){
				$('#updateForm_' + thisKey).fadeOut(1000);
			})
			.fail(function(XMLHttpRequest, textStatus, errorThrown){
				alert(errorThrown);
			});
		}
	});
});