$(document).ready(function(){
	$('.slide-up-block').on('click', function(){
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$(this).next().slideUp();
		}else{
			$(this).addClass('active');
			$(this).next().slideDown();
		}
	});
});