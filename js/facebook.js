jQuery(document).ready(function($){
	if($.cookie('popup_user_login') != 'yes'){
	$('#fanback').delay(100).fadeIn('medium');
	$('#fanclose, #fan-exit').click(function(){
	$('#fanback').stop().fadeOut('medium');
	});
	}
	$.cookie('popup_user_login', 'yes', { path: '/', expires: 7 });
});