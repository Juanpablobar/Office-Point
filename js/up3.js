$(document).ready(function(){
 	$("#button_search").click(function(){
	$("#search").toggleClass("nav-search2");
	}); 
	$('.up').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});
	$(window).scroll(function(){
		if( $(this).scrollTop() > 0 ){
			$('#up').addClass('up2');
			$('#up').removeClass('up');
		} else {
			$('#up').addClass('up');
			$('#up').removeClass('up2');
		}
	});
	

});