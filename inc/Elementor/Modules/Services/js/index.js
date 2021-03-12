jQuery('document').ready(function($){

	// Services Slider
	if( $('.services-slider').length) {
		$('.services-slider').owlCarousel({
		    loop:true,
		    nav:true,
		    navText : ["<div class='prev-slide'></div>","<div class='next-slide'></div>"],
		   	items: 3,
		   	margin: 30,
		   	dots: false,
		   	responsive : {
			   	0 : {
			       items: 1,
			    },
			    // breakpoint from 480 up
			    480 : {
			       items: 1,
			    },
			    // breakpoint from 768 up
			    768 : {
			       items: 2,
			    },
			    1024 : {
			       items: 3,
			    }
			}
		});
	}


});