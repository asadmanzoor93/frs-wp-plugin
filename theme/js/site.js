
	jQuery(document).ready(function($) {
		
		// Your JavaScript goes here
		$(".menu-buton").click(function () {
			$(".nav").toggleClass("open");
			$("#header").toggleClass("mobile");
			$("body").toggleClass("scrolled");
			$(".menu-buton").toggleClass("show");
			$(".nav > li > .sub-menu").slideUp("fast");
			$(".nav > li:first-child > a span").removeClass("menu-drop");
	
			
		});
		// sticky header
		$(window).scroll(function() {
			if ($(this).scrollTop() > 85){  
				$('#header').addClass("sticky-header");
			}
			else{
				$('#header').removeClass("sticky-header");
			}
		});

		jQuery(".nav > li:first-child > a").wrapInner("<span></span>");


		$('.nav > li:first-child > a').click(function (event) {
			event.stopPropagation();
			$(".nav > li > .sub-menu").slideToggle("fast");
			$(".nav > li:first-child > a span").toggleClass("menu-drop");
		});
		$(".nav > li > .sub-menu").on("click", function (event) {
			event.stopPropagation();
		});

		$('.modal-dialog .first-step .button.start').click(function (event) {
			$(".modal-dialog .modal-body, .modal-dialog .modal-footer, .form-pagination").css({"display": "block"});
			$(".modal-dialog .first-step").css({"display": "none"});
		});

		$('#right-solution .col-lg-10 .solution-content .button').click(function (event) {
			$(".modal-dialog .first-step").css({"display": "block"});
			$(".modal-dialog .modal-body, .modal-dialog .modal-footer, .form-pagination, .last-step").css({"display": "none"});
		});
	});

