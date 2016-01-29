$(window).load(function(){
	
	// Banner Slider Start

	new fwslider().init({
		duration: "1000", /* Fade Speed (miliseconds) */
		pause:    "6000"  /* Autoslide pause between slides (miliseconds)*/
	});

	// Banner Slider End
	
	//-----------------------------------------------------------------------------
	
	// Mobile Navigation Start
	
	$(".nav-trigger").click(function(){
		$("nav.main").slideToggle();
	});
	
	// Mobile Navigation End
	
	//-----------------------------------------------------------------------------
	
	// Dropdown Menu Start
	
	if ($(window).width() > 979) {
		
		$("nav.main ul li").hover(function(){
			$(this).children("ul").slideToggle("fast");
		});
	
	}
	
	$("nav.main li:last-child").addClass("last");

	// Dropdown Menu End
	
	//-----------------------------------------------------------------------------
	
	// Blog Dropdown Start
	
	$(".blog-nav li").hover(function(){
		$(this).children("ul").slideToggle("fast");
	});

	$(".blog-nav li:last-child").addClass("last");

	// Blog Dropdown End
	
	//-----------------------------------------------------------------------------
	
	// Tables Start
	
	$("tr:odd").addClass("odd");

	// Tables End
		
	//-----------------------------------------------------------------------------
	
	// Tabs Start
	
	$(".tabs").tabs({ selected: 0 });

	// Tabs End
	
	//-----------------------------------------------------------------------------
	
	// Accordion Start
	
	$(".accordion").accordion({
		active: false,
		collapsible: true
    });

	// Accordion End
	
	//-----------------------------------------------------------------------------
	
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


