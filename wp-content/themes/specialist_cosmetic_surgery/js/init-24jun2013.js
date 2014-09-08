
jQuery(document).ready(function($){
							
	jQuery("select").uniform();	
	jQuery('.single-post .menu-main-navigation-container ul li.current_page_parent').addClass('single-active');
	jQuery('.archive .menu-main-navigation-container ul li.current_page_parent').addClass('single-active');
	jQuery("#searchform input[type='text']").val("Search");
	jQuery("#searchform input[type='submit']").val("");		
	jQuery("p.form-submit input[type='submit']").val("Post");
	jQuery("#primary p.contact-submit input[type='submit']").val("Submit");	
	jQuery("#alo_easymail_widget_form input#opt_name[type='text']").val("your@email.com");
	jQuery("#alo_easymail_widget_form input#opt_email[type='text']").val("Your Name");	
	jQuery("#comments").has('ol.commentlist').attr('class','commentsborder');			
	jQuery('#secondary-right .widget ul li:last').addClass('last');
	jQuery('#secondary-left .widget ul li:last').addClass('last');
	jQuery('#secondary-right aside:last').addClass('lastsidebar');
	jQuery('#secondary-left aside:last').addClass('lastsidebar');
	jQuery("#alo_easymail_widget_form input[type='submit']").val("Join");	
	jQuery('.gallery').find("br").remove();
	jQuery('.gallery dl:nth-child(4n+4)').addClass('last');	
	jQuery('#contact-form-10 div:last').addClass('last');	
	jQuery('body.blog #primary article:last').addClass('last');
	jQuery('body.archive #primary article:last').addClass('last');
	jQuery('body.single #primary article:last').addClass('last');
	jQuery('body.search-results #primary article:last').addClass('last');	
	jQuery('input[type="text"],input[type="password"], textarea').each(function() {	
	var default_value = this.value;	
	jQuery(this).focus(function() {
	if(this.value == default_value) {
	this.value = '';
	}
	});
	jQuery(this).blur(function() {
	if(this.value == '') {
	this.value = default_value;
	}
	});
	});
	
	
	var config = {   
	 sensitivity: 3, 
	 interval: 20,  
	 over: doOpen, 
	 timeout: 100, 
	 out: doClose  
	 };
	 
	 function doOpen() {
	 jQuery(this).addClass("hover");
	 jQuery('ul:first',this).stop(true, true).slideDown('fast');
	 }
	 function doClose() {
	 jQuery(this).removeClass("hover");
	 jQuery('ul:first',this).stop(true, true).slideUp('fast');
	 }
	
	
	
	var window_width = $(window).width();
	if (window_width > 767){
  jQuery("#access ul.sf-menu li").hoverIntent(config);
	$('ul#menu-main-navigation li.dl-back' ).remove();
	}
	jQuery('ul.sf-menu li').each(function(){
			if(jQuery(this).children('ul.sub-menu').length > 0)
				jQuery(this).prepend('<span></span>');
		});
			
		jQuery('body .gform_wrapper ul li:nth-child(1) span.ginput_left').addClass('firstname');
		jQuery('body .gform_wrapper ul li:nth-child(1) span.ginput_right').addClass('lastname');
	
		jQuery('#third .textwidget').addClass('third-last');
		var window_width = $(window).width();
		if (window_width < 767){
				jQuery('.dl-menuwrapper nav').attr('id','navSelect');	
		} else { 
				jQuery('.dl-menuwrapper nav').attr('id','access');	
		}
		
		
		
		if (window_width < 767){
			jQuery('#secondary-right .widget_categories ul').wrap('<div class="textwidget">');
			jQuery('#secondary-right .widget_nav_menu  div').addClass('textwidget');
			
			
			jQuery('#secondary-right .widget').on('click','h3.widget-title',function(){
			var par= $(this).next('.textwidget');
				 if($(par).hasClass('open')){
					$(this).next('.textwidget').slideUp();
					$(par).removeClass('open');
					$(this).removeClass('open');
							 }else{
					$('.textwidget').slideUp().prev('h3').removeClass('open');	
						$('.textwidget').slideUp().removeClass('open');	
					
					$(this).next('.textwidget').slideDown();
					$(par).addClass('open');
					$(this).addClass('open');
				}
			 });
		
			jQuery('#colophon .footer-top-wrapper .widget div').addClass('testtextwidget');
			jQuery('#colophon .footer-top-wrapper .widget').on('click','h3.widget-title',function(){
			var par= $(this).next('.testtextwidget');
			var rrrr= $(this).next('h3');
				 if($(par).hasClass('open')){
					
					$(this).next('.testtextwidget').slideUp();
					$(par).removeClass('open');
					$(this).removeClass('open');
							 }else{
								
						$('.testtextwidget').slideUp().prev('h3').removeClass('open');	
						$('.testtextwidget').slideUp().removeClass('open');	
						$(this).next('.testtextwidget').slideDown();
					$(par).addClass('open');
					$(this).addClass('open');
				}
		 });
					jQuery('.menu-main-navigation-container ul#menu-main-navigation').addClass('dl-menu');	
					
					jQuery('.dl-menuwrapper nav div').removeClass('menu-main-navigation-container');
					jQuery('ul#menu-main-navigation').removeClass('menu sf-menu').addClass('dl-menu');	
								
					jQuery('ul.dl-menu li ul').removeClass('sub-menu').addClass('sub-nav');
			jQuery('ul.dl-menu').find("span").remove();
				//jQuery('ul.dl-menu li ul').prepend( '<li class="dl-back"><a href="#">back</a></li>' );				
					
					
		}
		
	

});

