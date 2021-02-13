  var form = document.querySelector('form');
  form.addEventListener( 'invalid',function(event){
        event.preventDefault();
  },true);

$(document).ready(function(){
	
	$('#sidebar_content').removeClass('sidebar_content2');
	
	$('#sidebar').fadeOut('slow');
 
	$('#toggle_sidebar').click(function(){

		$('#sidebar').fadeIn('slow');
		$('#sidebar_content').addClass('sidebar-content2');
		$('#sidebar_content').removeClass('sidebar-content');
	});
	$('#sidebar_close').click(function(){

		$('#sidebar').fadeOut('slow');
		$('#sidebar_content').removeClass('sidebar-content2');
		$('#sidebar_content').addClass('sidebar-content');
	});
 
	$('.sub-category-prev').slideUp('slow');

	
    $('#sidebar_span1').click(function() {

	 	$('#sidebar_sub_category1').slideToggle('slow');
	 	
		$('#sidebar_span1').toggleClass('sidebar-span');
        
		if($(this).next().is(':hidden') == true){

			//Añade la clase on en el botón
			$(this).addClass('on');

			//Abre el slide
		 }
	 });
    $('#sidebar_span2').click(function() {

	 	$('#sidebar_sub_category2').slideToggle('slow');
	 	
		$('#sidebar_span2').toggleClass('sidebar-span');
        
		if($(this).next().is(':hidden') == true){

			//Añade la clase on en el botón
			$(this).addClass('on');

			//Abre el slide
		 }
	 });
    $('#sidebar_span3').click(function() {

	 	$('#sidebar_sub_category3').slideToggle('slow');
	 	
		$('#sidebar_span3').toggleClass('sidebar-span');
        
		if($(this).next().is(':hidden') == true){

			//Añade la clase on en el botón
			$(this).addClass('on');

			//Abre el slide
	 	$('#sidebar_sub_category3').slideToggle('slow');
		 }
	 });
    $('#sidebar_span4').click(function() {

	 	$('#sidebar_sub_category4').slideToggle('slow');
	 	
		$('#sidebar_span4').toggleClass('sidebar-span');
        
		if($(this).next().is(':hidden') == true){

			//Añade la clase on en el botón
			$(this).addClass('on');

			//Abre el slide
		 }
	 });
    $('#sidebar_span5').click(function() {

	 	$('#sidebar_sub_category5').slideToggle('slow');
	 	
		$('#sidebar_span5').toggleClass('sidebar-span');
        
		if($(this).next().is(':hidden') == true){

			//Añade la clase on en el botón
			$(this).addClass('on');

	 	$('#sidebar_sub_category5').slideUp('slow');
		 }
	 });
	
});  