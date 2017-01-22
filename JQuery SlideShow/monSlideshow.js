(function($) {

	$.fn.monSlideshow = function(options) {
		var defaults = {
			timePerAnimation : 1000,
			timePerSlide : 4000,
			showCaption : true,
			captionFadeTime : 200
		};
		var options = $.extend(defaults, options);

		return this.each( function() {
			var $this = $(this);

			if(options.timePerAnimation > options.timePerSlide)
				options.timePerSlide = options.timePerAnimation + 100;

			$this.css({
				width : '9999999px',
				position : 'relative',
				padding : 0,
				margin : 0
			});

			$this.children().css({
				float : 'left',
				margin : 0,
				padding : 0,
				listStyle : 'none'
			});

			$this.parent().css({
				overflow: 'hidden'
			});

			if(options.showCaption) {
				for(var i = 0; i<$this.children().length; i++){
					var $span = $('<span />').appendTo($this.children().eq(i));
					$span.html($span.prev().attr('title'));
				}
				setInterval( function() {
					$this.children().children('span').fadeOut(options.captionFadeTime);
					$this.delay(options.captionFadeTime).animate({
						'left' : '-' + $this.parent().width()
					},options.timePerAnimation, function() {
						$this.children().children('span').slideDown(options.captionFadeTime);
						$this.css('left',0).children(':first').appendTo($this);
					})
				},options.timePerSlide);
			} 
			else {
				setInterval( function() {
					$this.animate({
						'left' : '-' + $this.parent().width()
					},options.timePerAnimation, function() {
						$this.css('left',0).children(':first').appendTo($this);
					})
				},options.timePerSlide);
			}
		});
	}
})(jQuery);