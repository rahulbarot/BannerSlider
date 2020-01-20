define([
    'jquery',
	'slick'
], function ($) {
    'use strict';

    function slider(config) {
    	let sliderConfig = config.sliderConfig;
    	// console.log(sliderConfig);
	    jQuery(document).ready(function () {
			jQuery(".awesome-banners").slick({
				dots: sliderConfig.dots,
				infinite: sliderConfig.infinite,
				slidesToShow: sliderConfig.slidesToShow,
				slidesToScroll: sliderConfig.slidesToScroll,
				fade: true,
				speed: 900,
				autoplay: true,
    			autoplaySpeed: 3000,
				cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
				touchThreshold: 100,
				responsive: [
					{
						breakpoint: 1280,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
		});
    }
    return slider;

});