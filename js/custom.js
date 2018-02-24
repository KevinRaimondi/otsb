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

$(function() {
	$("#btnPasswordinput").click(function(){
		var pass_input = document.getElementById("passwordinput");
		if (pass_input.type === "password") {
			pass_input.type = "text";
			$(this).removeClass("fa-eye").addClass("fa-eye-slash")
		} else {
			pass_input.type = "password";
			$(this).removeClass("fa-eye-slash").addClass("fa-eye")
		}
	});
});

$(function() {
	$("#btnPasswordinputConfirm").click(function(){
		var pass_input = document.getElementById("passwordinputConfirm");
		if (pass_input.type === "password") {
			pass_input.type = "text";
			$(this).removeClass("fa-eye").addClass("fa-eye-slash")
		} else {
			pass_input.type = "password";
			$(this).removeClass("fa-eye-slash").addClass("fa-eye")
		}
	});
});

$(document).ready(function(){
	$("#btnLimpar").click(function(){
		$("#usuario").val("");
		$("#email").val("");
		$("#passwordinput").val("");
		$("#passwordinputConfirm").val("");
		$("#token").val("");
		$("#filebutton").val("");
		$("#mensagem").text("");
	});

});

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('.imgCircle')
			.attr('src', e.target.result)
			.width(150)
			.height(150);
		};
		reader.readAsDataURL(input.files[0]);
	}
}

$(function() {
	$("#close-toast").click(function(){
		var toast = document.getElementById("toast-container");
		toast.style.visibility = 'hidden';
	});
});