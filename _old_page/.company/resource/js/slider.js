(function($) {
	var slideInterval;
	var methodes={
		initThumbholder : function (options){
			var settings = {
				'e_slider' : null,
				'p_image_holder': '#image-holder',
				'p_thumb_holder':'#thumb-holder',
				'p_durotation':500,
				'p_timeout': 5000,
			};
			if (settings){$.extend(settings, options);}
			$(settings.e_slider).children(settings.p_image_holder).children().each(function(){
				$(settings.p_thumb_holder).append('<div id="thumb" thumb-data="'+$(this).index()+'"></div>');
				$(this).css({'z-index':''+$(this).index()});
			});

			$(settings.e_slider).children(settings.p_thumb_holder).css({"width":(32*settings.e_slider.children().length)+"px","margin-left":"-"+(32*settings.e_slider.children().length/2)+"px"});
			$(settings.e_slider).children(settings.p_thumb_holder).children(":first-child").addClass("active");
			$(settings.e_slider).children(settings.p_image_holder).children().hide();
			$(settings.e_slider).children(settings.p_image_holder).children(":first-child").show();

			$(settings.e_slider).children(settings.p_thumb_holder).children().click(function(){
				if($(this).attr("class") != "active"){
					var v_element=$(this).attr("thumb-data");
					v_element=$(this).parent().parent().children(settings.p_image_holder).children()[v_element];
					$(this).parent().parent().children(settings.p_image_holder).children().fadeOut((settings.p_durotation/2));
					$(v_element).fadeIn(settings.p_durotation);
					$(this).parent().children().removeClass("active");
					$(this).addClass("active");
					clearInterval(slideInterval);
					slideInterval = setInterval(function(){
						var v_max_images = $(settings.e_slider).children(settings.p_image_holder).children().length;
						var v_current_thumb = $(settings.e_slider).children(settings.p_thumb_holder).children(".active").attr("thumb-data");

						$(settings.e_slider).children(settings.p_thumb_holder).children().removeClass("active");
						if((v_current_thumb+1) >= v_max_images){
							$(settings.e_slider).children(settings.p_thumb_holder).children(":first-child").addClass("active");
							v_current_thumb=0;
						}else{
							$(settings.e_slider).children(settings.p_thumb_holder).children().eq(v_current_thumb+1).addClass("active");
							v_current_thumb+=1;
						}			
						$(settings.e_slider).children(settings.p_image_holder).children().fadeOut((settings.p_durotation/2));
						$(settings.e_slider).children(settings.p_image_holder).children().eq(v_current_thumb).fadeIn(settings.p_durotation);			
			        },settings.p_timeout); 
				}

			});			
		}
	}
   jQuery.fn.initSlider = function(options) {
		var settings = {
			'p_timeout': 5000,
			'p_durotation': 600,
			'is_pager': true,
			'p_image_holder':"#image-holder",
			'p_thumb_holder':"#thumb-holder"
		};
		if (settings){$.extend(settings, options);}
		var v_height = $(window).height() - 100;
		$(this).css({"height":v_height+"px"});

		v_col_left_top=(v_height - $(".column-left").height())/2;
		$(".column-left").css({"top":v_col_left_top+"px"});
		v_col_right_top=(v_height - $(".column-right").height())/2;
		$(".column-right").css({"top":v_col_left_top+"px"});

		var max_slider=$(this).children().length;
		var e_slider = $(this);
		if(settings.is_pager==true){
			methodes.initThumbholder({
				e_slider: e_slider,
				p_pager_name: settings.p_thumb_holder,
				p_timeout: settings.p_timeout,
				p_durotation: settings.p_durotation
			});
		}
		slideInterval = setInterval(function(){
			var v_max_images = $(e_slider).children(settings.p_image_holder).children().length;
			var v_current_thumb = $(e_slider).children(settings.p_thumb_holder).children(".active").attr("thumb-data");

			$(e_slider).children(settings.p_thumb_holder).children().removeClass("active");
			if((v_current_thumb+1) >= v_max_images){
				$(e_slider).children(settings.p_thumb_holder).children(":first-child").addClass("active");
				v_current_thumb=0;
			}else{
				$(e_slider).children(settings.p_thumb_holder).children().eq(v_current_thumb+1).addClass("active");
				v_current_thumb+=1;
			}			
			$(e_slider).children(settings.p_image_holder).children().fadeOut((settings.p_durotation/2));
			$(e_slider).children(settings.p_image_holder).children().eq(v_current_thumb).fadeIn(settings.p_durotation);			
        },settings.p_timeout); 
		
		
		
   }
})(jQuery);