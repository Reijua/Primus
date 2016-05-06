/**
 * The nav stuff
 */
 var counter = 0;
(function( window ){
	
	'use strict';

	var body = document.body,
		mask = document.createElement("div"),
		togglePushTop = document.querySelector( ".toggle-push-top" ),
		pushMenuTop = document.querySelector( ".push-menu-top" ),
		activeNav
	;
	mask.className = "mask";

	
	/* push menu top */
	togglePushTop.addEventListener( "click", function(){
		counter= counter +1;
		if((counter%2)==0)
		{
			classie.remove( body, activeNav );
			activeNav = "";
			document.body.removeChild(mask);
		}else{
		classie.add( body, "pmt-open" );
		document.body.appendChild(mask);
		activeNav = "pmt-open";}
	} );


	/* hide active menu if close menu button is clicked */
	[].slice.call(document.querySelectorAll(".close-menu")).forEach(function(el,i){
		el.addEventListener( "click", function(){
			classie.remove( body, activeNav );
			activeNav = "";
			document.body.removeChild(mask);
		} );
	});


})( window );