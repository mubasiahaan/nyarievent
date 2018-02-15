(function() {

	$(document).ready(function() {

		var options = {
			ovalWidth: 240,
			ovalHeight: 50,
			offsetX: 10,
			offsetY: 325,
			angle: 0,
			activeItem: 0,
			duration: 350,
			className: 'itemgold'
		}

		var carousel = $('.carouselgold').CircularCarousel(options);

		/* Fires when an item is about to start it's activate animation */
		carousel.on('itemBeforeActive', function(e, item) {
			$(item).css('box-shadow', '0 0 15px yellow');
		});

		/* Fires after an item finishes it's activate animation */
		carousel.on('itemActive', function(e, item) {
			$(item).css('box-shadow', '0 0 10px white');
		});

		/* Fires when an active item starts it's de-activate animation */
		carousel.on('itemBeforeDeactivate', function(e, item) {
			$(item).css('box-shadow', '0 0 15px yellow');
		})

		/* Fires after an active item has finished it's de-activate animation */
		carousel.on('itemAfterDeactivate', function(e, item) {
			$(item).css('box-shadow', '');
		})

		
		/* Previous button */
		$('.controls .previous').click(function(e) {
			carousel.cycleActive('previous');
			e.preventDefault();
		});

		/* Next button */
		$('.controls .next').click(function(e) {
			carousel.cycleActive('next');
			e.preventDefault();
		});

		/* Manaully click an item anywhere in the carousel */
		$('.carouselgold .itemgold').click(function(e) {
			var index = $(this).index('li');
			carousel.cycleActiveTo(index);
			e.preventDefault();
		});
	
	});

})();