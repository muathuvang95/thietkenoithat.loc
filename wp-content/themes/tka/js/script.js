jQuery(document).ready(function($){
	$('form.navbar-form button[type="submit"]').on('click', function(e){
		e.preventDefault();
		var frm = $(this).parents('form');
		if(frm.hasClass('open')) {
			var input = frm.find('input[name="s"]');
			if(input.val()!='') {
				frm.submit();
			} else {
				frm.removeClass('open');
			}
		} else {
			frm.addClass('open');
		}
	});
	$('#back-top').on('click', function(e){
		$('html,body').stop().animate({
			scrollTop: 0
		}, 500);
		return false;
	});

	var sba = $('#sidebar-affix');
	var h1 = $('#footer').outerHeight(true);
	var h2 = $('.fw-portfolio-related').outerHeight(true);
	var h3 = h3 = $('.entry-footer').outerHeight(true);
	
	setTimeout(function(){
		sba.affix({
		  offset: {
		    top: function () {
		    	return this.top = sba.offset().top;
		    },
		    bottom: function () {
		      return this.bottom = h1+h2+h3+55;
		    }
		  }
		});
	}, 5000);
	
	$('.gallery').find('a').attr('data-gallery', 'galleries');

});