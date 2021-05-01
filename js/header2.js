var form = document.querySelector('form');
  form.addEventListener( 'invalid',function(event){
        event.preventDefault();
  },true);

$(document).ready(function(){
	
	$('#sidebar_content').removeClass('sidebar_content2');
	 
	$('#toggle_sidebar').click(function(){

		$('#sidebar').fadeIn();
		$('#sidebar_content').addClass('sidebar-content2');
		$('#sidebar_content').removeClass('sidebar-content');
	});
	$('#sidebar_close').click(function(){

		$('#sidebar').fadeOut();
		$('#sidebar_content').removeClass('sidebar-content2');
		$('#sidebar_content').addClass('sidebar-content');
	});
 
	$('.sub-category-prev').slideUp();

	
    $('.sidebar-plus').click(function() {

	 	
		$('.sidebar-plus').removeClass('sidebar-span');

		$('.sub-category-prev').slideUp('linear');
        
		if($(this).parent('div').parent('div').find('.sub-category-prev').is(':hidden') == true){

			$(this).parent('div').parent('div').find('.sub-category-prev').slideDown('linear');
			$(this).addClass('sidebar-span')
		 }
	 });
    $('#nav-toggle-responsive').click(function(){

	 	$('#sidebar_second').toggleClass('sidebar-second2');
	 	
		$('#header').toggleClass('header');
	 	
		$('#sidebar_second_black').fadeToggle();
	 	
	 });
	
});  