$(window).load(function(){
	
	// Banner Slider Start

	new fwslider().init({
		duration: "1000", /* Fade Speed (miliseconds) */
		pause:    "6000"  /* Autoslide pause between slides (miliseconds)*/
	});

	// Banner Slider End
	
	// Dropdown Menu Start
	
	$(".nav-trigger").click(function(){
		$("nav.main").slideToggle();
	});
	
	if ($(window).width() > 979) {
		
		$("nav.main ul li").hover(function(){
			$(this).children("ul").slideToggle("fast");
		});
	
	}
	
	$("nav.main li:last-child").addClass("last");

	// Dropdown Menu End
	
	// Back To Top Start
	
	$(window).scroll(function() {
		$('.back-to-top').stop().animate({
			opacity: $(window).scrollTop() > 0 ? '0.5' : '0'
		}, 800);
	});
	
	$('.back-to-top').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});
	// Back To Top End
	
});


