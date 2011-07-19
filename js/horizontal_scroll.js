var total_width=0;
//this line of code prevents the flash of vertical to horzontal 
$().ready(function(){
	var count=$('.gallery_image').length + $('.html_contents').length;
	$('#images').css({'width':count*900});
});
$(window).load(function(){
	$('.gallery_image').each(function(){
		$(this).parent().css({'width':$(this).width()});
		total_width+=($(this).parent().outerWidth()+parseInt($(this).parent().css('margin-right'),10)+parseInt($(this).parent().css('margin-left'),10));
	});
	$('.html_contents').each(function(){
		$(this).parent().css({'width':$(this).width()});
		total_width+=($(this).parent().outerWidth()+parseInt($(this).parent().css('margin-right'),10)+parseInt($(this).parent().css('margin-left'),10));
	});
	$('#images').css({'width':total_width});
});