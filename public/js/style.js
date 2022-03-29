$(function (){
	var today = new Date();
	var year = today.getFullYear();
	var month = ("0"+(today.getMonth() + 1)).slice(-2);
	var day =  ("0"+today.getDate()).slice(-2);

    today = year + "-" + month + "-" + day;

	$("#input-date").attr('min', today);
});

function inputDateControll() {
	var date = $("#input-date").val();
	var notify_date = [
		$("#input-notify-date-1"),
		$("#input-notify-date-2"),
		$("#input-notify-date-3")
	];

	notify_date.forEach(function(value){
		value.attr('max', date)
	});

}

function displayControll (text) {
	$(`#${text}`).toggle();

	if (text == "logout-form") {
		$('#link-logout-triangle').toggleClass('active');
	}
}

function taskComplete (text, id) {
	$(`#${text}`).toggle();
	$('.input-complete-id').attr('value', id);
	console.log($('.input-complete-id').val());
}

function inputNotifyCheck(){
	var check_count = 0;
	
	$(".form-notify ul li").each(function(){
		var parent_checkbox = $(this).children("input[type='checkbox']");

		if(parent_checkbox.prop('checked')){
			check_count = check_count+1;
		}
	});

	if(check_count > 2){
		$(".form-notify ul li").each(function(){
			if(!$(this).children("input[type='checkbox']").prop('checked')){
				$(this).children("input[type='checkbox']").prop('disabled',true);
			}
		});
	}else{
		$(".form-notify ul li").each(function(){
			if(!$(this).children("input[type='checkbox']").prop('checked')){
				$(this).children("input[type='checkbox']").prop('disabled',false);
			}
		});
	}
	return false;
}

// function form_check() {
// 	let flag = true;
// 	for (let i=1; i<=3; i++) {
// 		if ($(`#input-notify-date-${i}`).val()) {
// 			if (!$(`#input-notify-time-${i}`).val()) {
// 				flag = false;
// 				// $(`#notify-date-error-${i}`).css("display") = "block";
// 			}
// 		}
// 		if ($(`#input-notify-time-${i}`).val()) {
// 			if (!$(`#input-notify-date-${i}`).val()) {
// 				flag = false;
// 				alert('no');
// 			}
// 		}
// 	}
// 	return flag;
// }
