
$(document).ready(function(){

	setTimeout(function(){ 
		$('.alert').fadeOut(5000);
	}, 3000);

// 	$(".select2_single").select2({
// 	    placeholder: "Select a state",
// 	    allowClear: true
// 	});

// 	$(".select2_multiple").select2({
// 	    maximumSelectionLength: 4,
// 	    placeholder: js_message.select2_multiple,
// 	    allowClear: true
// 	});
	
// 	if(published!==""){
// 	    $('#published').datepicker("setDate", published);  
// 	}

// 	$('#birthday').daterangepicker({
// 	    singleDatePicker: true,
// 	    calender_style: "picker_1",
// 	}, function (start, end, label) {
// 	    console.log(start.toISOString(), end.toISOString(), label);
// 	});
});

/**
 * Mở ckfinder
 */
function open_ckfinder(_obj){
	
	var finder = new CKFinder(); 
	var target = $(_obj).attr('data-target');
	var view = $(_obj).attr('data-view'); 
	finder.selectActionFunction = function (fileUrl, data) { 
		document.getElementById(target).value = fileUrl;
		$('#'+view).attr('src', fileUrl);
	}
	
	finder.popup();
	
}

function goBack() {
	window.history.back();
}

/**
 * Hiện lên popup confirm khi xóa dữ liệu
 */
// $( document ).on( "click", "a.btn-delete", function(e) { // jQuery 1.7+

// 	var _obj = $(this);
// 	_obj.parent().parent().addClass('selected');
// 	_obj.parent().parent().find('td:eq(0) div').addClass('checked');
	
// 	$.confirm({		
// 		confirm: function() {
// 			window.location = _obj.attr('href');
// 		},
// 		cancel: function() {
// 			_obj.parent().parent().removeClass('selected');
// 			_obj.parent().parent().find('td:eq(0) div').removeClass('checked');
// 		},
// 		close : function(){
// 			_obj.parent().parent().removeClass('selected');
// 			_obj.parent().parent().find('td:eq(0) div').removeClass('checked');
// 		},
// 		title: confirm.title,
// 		text: confirm.message,
// 		confirmButton: confirm.agree,
// 		cancelButton: confirm.cancel,
// 	});
	
// 	e.preventDefault();
// });
