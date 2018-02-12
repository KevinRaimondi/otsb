(function ($) {

	new WOW().init();

	jQuery(window).load(function() {
		jQuery("#preloader").delay(100).fadeOut("slow");
		jQuery("#load").delay(100).fadeOut("slow");
	});


	//jQuery to collapse the navbar on scroll
	$(window).scroll(function() {
		if ($(".navbar").offset().top > 50) {
			$(".navbar-fixed-top").addClass("top-nav-collapse");
		} else {
			$(".navbar-fixed-top").removeClass("top-nav-collapse");
		}
	});

	//jQuery for page scrolling feature - requires jQuery Easing plugin
	$(function() {

		$('.navbar-nav li a').on('click', function(event) {

			if( $(this).is('a:not([href^="#"])') || $(this).attr("href") == '#' ) {
				return;
			}
			var $anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top
			}, 1500, 'easeInOutExpo');
			event.preventDefault();
		});

		$('.page-scroll a').on('click', function(event) {
			var $anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top
			}, 1500, 'easeInOutExpo');
			event.preventDefault();
		});

	});

})(jQuery);

$(document).ready(function(){
	$("#btnMoreGames").click(function(){
		var x = document.getElementById("divMoreGames");
		if (x.style.display === "none") {
			x.style.display = "block";
			$("#btnMoreGames").css("display", "none");
		} 

	});

});

$(document).ready(function(){
	$("#btnLimpar").click(function(){
		var x = document.getElementById("mensagem");
		$("#usuario").text("");
		$("#email").text("");
		$("#mensagem").text("");
	});

});