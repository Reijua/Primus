 $(function() {
	var $window = $(window);
	var $element = $("#navbar-side-box");

	if ($element.length != 0) {
		var offset = $element.offset().top;
		
	    $window.scroll(function() {
			if($window.width() < 900)
			{
				var sub = 180-(120-$window.width()/10); //prevent touching the footer on smaller size (higher footer)
				if(($(document).height() - $(window).height() - $(window).scrollTop()) < $element.height()+sub/2) //Bottom is near
				{
					$element.addClass('navbar-side-box-sticky-bottom');
					$element.removeClass('navbar-side-box-sticky');
				}
				else if($window.scrollTop() > offset-sub*3.2) // Top is gone
				{
					$element.addClass('navbar-side-box-sticky');
					$element.removeClass('navbar-side-box-sticky-bottom');
				}		
				else // Basic sticky middle menu
				{
					$element.removeClass('navbar-side-box-sticky');
					$element.removeClass('navbar-side-box-sticky-bottom');
				}
			}
			else
			{
				if(($(document).height() - $(window).height() - $(window).scrollTop()) < $element.height()-170) //Bottom is near (je kleiner die Zahl, desto früher kommts hier rein)
				{
					$element.addClass('navbar-side-box-sticky-bottom');
					$element.removeClass('navbar-side-box-sticky');
				}
				else if($window.scrollTop() > offset-390) // Top is gone (je kleiner die Zahl, desto früher kommts hier rein)
				{
					$element.addClass('navbar-side-box-sticky');
					$element.removeClass('navbar-side-box-sticky-bottom');
				}		
				else // Basic sticky middle menu
				{
					$element.removeClass('navbar-side-box-sticky');
					$element.removeClass('navbar-side-box-sticky-bottom');
				}
			}
	    });
	}
});
 
 
 // Cache selectors outside callback for performance. 
 /*$(function() {
   var $window = $(window);
   var $stickyEl = $('#navbar-side-box');
   var elTop = $stickyEl.offset().top; -> offset

   $window.scroll(function() {
	   alert($window.scrollTop() + ':' + elTop);
        $stickyEl.toggleClass('navbar-side-box-sticky', $window.scrollTop() > elTop);
    });
 }*/
 
 /* $(function() {
    var offset = $("#navbar-side-box").offset();
    var topPadding = 15;

    $(window).scroll(function() {
        if ($(window).scrollTop()+400 > offset.top) 
		{
            $("#navbar-side-box").stop().animate({
                marginTop: -230
            });
        } else {
            $("#navbar-side-box").stop().animate({
                marginTop: 0
            });
        }   
    });
});

 */
/*
$(function() {

    var offset = $("#sidebar").offset();
    var topPadding = 15;

    $(window).scroll(function() {
    
        if ($(window).scrollTop() > offset.top) {
        
            $("#sidebar").stop().animate({
            
                marginTop: $(window).scrollTop() - offset.top + topPadding
            
            });
        
        } else {
        
            $("#sidebar").stop().animate({
            
                marginTop: 0
            
            });
        
        }
        
            
    });

}); https://css-tricks.com/scrollfollow-sidebar/
*/