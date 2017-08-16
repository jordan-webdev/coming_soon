(function($) {
	var imgs = [];
	$('#slider img').each( function () {
		imgs.push($(this));
	});
	
	var i = 0;
	
	slideShow(i);
	
	function slideShow(i) {
		if (i >= imgs.length) {
			i = 0;
		}
		$('#slider img').css({
			'z-index': 1
		});
		$('#slider img').animate({
			opacity: 0
		}, 750);
		$('#slider img:eq(' + i + ')').css({
			'z-index': 2
		});
		$('#slider img:eq(' + i + ')').animate({
			opacity: 1
		}, 750);
		
		var i = i + 1
		setTimeout( function () {
			slideShow(i);
		}, 8000)
		
	}
	
	$(document).ready(function () {
		 $('#the_content').html( $('#the_content').html().split('&nbsp;').join(' ') );
	});
	
} )(jQuery);
