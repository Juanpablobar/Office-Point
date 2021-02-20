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

	
    $('#sidebar_span1').click(function() {

	 	$('#sidebar_sub_category1').slideToggle();
	 	
		$('#sidebar_span1').toggleClass('sidebar-span');
        
		if($(this).next().is(':hidden') == true){

			//Añade la clase on en el botón
			$(this).addClass('on');

			//Abre el slide
		 }
	 });
    $('#sidebar_span2').click(function() {

	 	$('#sidebar_sub_category2').slideToggle();
	 	
		$('#sidebar_span2').toggleClass('sidebar-span');
        
		if($(this).next().is(':hidden') == true){

			//Añade la clase on en el botón
			$(this).addClass('on');

			//Abre el slide
		 }
	 });
    $('#sidebar_span3').click(function() {

	 	$('#sidebar_sub_category3').slideToggle();
	 	
		$('#sidebar_span3').toggleClass('sidebar-span');
        
		if($(this).next().is(':hidden') == true){

			//Añade la clase on en el botón
			$(this).addClass('on');

			//Abre el slide
	 	$('#sidebar_sub_category3').slideToggle();
		 }
	 });
    $('#sidebar_span4').click(function() {

	 	$('#sidebar_sub_category4').slideToggle();
	 	
		$('#sidebar_span4').toggleClass('sidebar-span');
        
		if($(this).next().is(':hidden') == true){

			//Añade la clase on en el botón
			$(this).addClass('on');

			//Abre el slide
		 }
	 });
    $('#sidebar_span5').click(function() {

	 	$('#sidebar_sub_category5').slideToggle();
	 	
		$('#sidebar_span5').toggleClass('sidebar-span');
        
		if($(this).next().is(':hidden') == true){

			//Añade la clase on en el botón
			$(this).addClass('on');

	 	$('#sidebar_sub_category5').slideUp();
		 }
	 });
    $('#nav-toggle-responsive').click(function(){

	 	$('#sidebar_second').toggleClass('sidebar-second2');
	 	
		$('#header').toggleClass('header');
	 	
		$('#sidebar_second_black').fadeToggle();
	 	
	 });
	
});  