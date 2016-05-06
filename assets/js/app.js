$(document).ready(function() {
	$(window).on('scroll', function() {
		if ($(window).scrollTop() > 10) {
			$('.navbar').addClass('navbar-scrolled');
		} else {
			$('.navbar').removeClass('navbar-scrolled');
		}
	});

	$(window).bind('resize', function() { setPadder() });
	$(window).on('focus', function() { setPadder() });

	function setPadder() {
		var navbar = $('.navbar:not(.navbar-second)');
		var navbarSec = $('.navbar-second');
		var padder = $('#padder');

		// #padder does not exist
		if (padder.length == 0) {
			return;
		}

		var y = 0;

		// .navbar-second does exist
		if (navbarSec.length != 0) {
			y = navbarSec.outerHeight() + navbarSec.offset().top;
			navbarSec.css('top', (navbar.outerHeight() - 1) + 'px');
		} else {
			y = navbar.outerHeight();
		}
		
		// prevent oversized padder
		if(y > 350)
			y = 350;
		
		padder.css('height', y + 'px');
	}

	setPadder();

	var resetModalContent = $('#pr-modal-content').html();
	$('.load-modal').click(function(e) {
		e.stopImmediatePropagation();

		var source = $(this).data('source');
		
		$('#pr-modal-content').html(resetModalContent);
		$('#pr-modal').modal('show');

		$.ajax({
			type: 'POST',
			url: source,
			data: {},
			success: function(data) {
				$('#pr-modal-content').addClass('modal-lg');
				$('#pr-modal-content').html(data);
				$('#pr-modal').modal('handleUpdate');
			}
		});

		return false;
	});
});