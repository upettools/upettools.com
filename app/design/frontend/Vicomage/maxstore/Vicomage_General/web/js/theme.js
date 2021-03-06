/******************** Js Custom ***********************/

define([
		"jquery",
		'parallax'
	],
	function($) {
		"use strict";

	//ScrollTop
	$('#backtotop').hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 350) {
            $('#backtotop').show();
        }
        else{
            $('#backtotop').hide();
        }
        return false;
    });
	$(document).ready(function($) {
		$('#backtotop').click(function(e) {
			$('html,body').animate({scrollTop:0}, 500);
			return false;
			e.preventDefault();
		});
	});
	
	$(window).scroll(function(){
		var side_header_height = $(".page-header.header-type7 .header-content").innerHeight();
		var window_height = $(window).height();
		if(side_header_height-window_height<$(window).scrollTop()){
			if(!$(".page-header.header-type7 .header-content").hasClass("fixed-bottom"))
				$(".page-header.header-type7 .header-content").addClass("fixed-bottom");
		}
		if(side_header_height-window_height>=$(window).scrollTop()){
			if($(".page-header.header-type7 .header-content").hasClass("fixed-bottom"))
				$(".page-header.header-type7 .header-content").removeClass("fixed-bottom");
		}
	});
	
	// ==== Display navigation header-type5 ====
    $("#btn-bar").on('click', function (e) {
        e.preventDefault();
        $('.siderbarmenu').addClass('siderbarmenu-active');
		return false;
    });
	 $(".siderbarmenu .btn-close").on('click', function (e) {
        e.preventDefault();
        $('.siderbarmenu').removeClass('siderbarmenu-active');
		return false;
    });

	//parallax
	$(document).ready(function($) {
		$(".header-search .dropdown-toggle").on('click', function (e) {
			e.preventDefault();
			$(this).next('.dropdown-switcher').toggleClass('active');
			$('.header-search #search').focus();
		});
	});
	
	$('.page-header .header.links').clone().appendTo('#store\\.links');
	
	//parallax
    $(document).ready(function($) {
		if($('.bg-parallax').length >0){
			$('.bg-parallax').each(function(){
				$(this).parallax("50%",0.1);
			})  
		}	
	});
});

