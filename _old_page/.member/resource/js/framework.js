if(!Array.isArray) {
  Array.isArray = function (vArg) {
    return Object.prototype.toString.call(vArg) === "[object Array]";
  };
}

String.prototype.format = function()
{
	var v_params=(Array.isArray(arguments[0]) == true? arguments[0] : arguments);
	var v_content = this;
	for (var i=0; i < v_params.length; i++){
		var v_replacement = '{' + i + '}';
		v_content = v_content.replace(v_replacement, v_params[i]);
	}
	return v_content;
};

(function($) {
	var	c_window_resize = null;
	var media = {
		initFilePreview : function(options){
			var settings = {
				'p_element_preview': '',
				'p_format': '',
				'p_file_list': null
				
			};
   			if (settings){$.extend(settings, options);}

   			$(settings.p_element_preview).children().remove();
   			v_format = settings.p_format;
			for (var i = 0; i < settings.p_file_list.length; i++) {
				$(settings.p_element_preview).append(v_format.format(settings.p_file_list[i]));
			}

		}
	};

	jQuery.fn.tabs = function() {
		$(".tabs").each(function(){
			v_total_width = 10;
			$(this).children("nav").children("ul").children().each(function(){
				v_total_width += $(this).outerWidth();
			});
			$(this).children("nav").children("ul").css({"width" : v_total_width+"px"});
			$(this).children("nav").children("ul").children().eq(0).addClass("active");
			$(this).children(".content").children().hide();
			$(this).children(".content").children("#"+$(this).children("nav").children("ul").children("li.active").attr("data-tab")).show();
			$(this).children("nav").children("ul").children("li").click(function(){
				$(this).parent().children().removeClass("active");
				$(this).addClass("active");
				$(this).parent().parent().parent().children(".content").children().hide();
				$(this).parent().parent().parent().children(".content").children("#"+$(this).attr("data-tab")).show();
			});
		});
	};



	jQuery.fn.checkbox = function() {
		$(".check-box").not('[status="true"]').each(function(){
			if($(this).attr("status")===undefined){
				$(this).attr("status","true");
			}
			$(this).append('<div class="box"><div class="check"></div></div><div class="text">'+$(this).children("input").attr("text")+'</div>');
			if($(this).children("input").attr("checked")=="checked"){
				$(this).children(".box").children(".check").show();
			}
			$(this).click(function(){
				if($(this).children(".box").children(".check").is(":hidden")){
					$(this).children(".box").children(".check").fadeIn(200);
					$(this).children("input").attr("checked","checked");
				}else{
					$(this).children(".box").children(".check").fadeOut(200);
					$(this).children("input").removeAttr("checked");
				}
			});
		});
	};

	jQuery.fn.radiobox = function() {
		$(".radio-box").each(function(){
			$(this).append('<div class="box"><div class="select"></div></div><div class="text">'+$(this).children("input").attr("text")+'</div>');
			if($(this).children("input").attr("checked")=="checked"){
				$(this).children(".box").children(".select").show();
			}
			$(this).click(function(){
				$(".radio-box").children('input[name="'+$(this).children("input").attr("name")+'"]').parent().children(".box").children(".select").stop().fadeOut(200);
				$(".radio-box").children('input[name="'+$(this).children("input").attr("name")+'"]').prop("checked",false);
				$(this).children(".box").children(".select").stop().fadeIn(200);
				$(this).children("input").prop("checked",true);
			});
		});
	};

	jQuery.fn.spoiler = function() {
		$(".spoiler").each(function(){
			var isClosed=true;
			$(this).children("button").html($(this).attr("spoiler-open"));
			$(this).children(".spoiler-content").children().hide();
			$(this).children(".spoiler-content").children(":first-child").show();
			$(this).children("button").click(function(){
				if(isClosed==true){
					$(this).parent().children(".spoiler-content").slideUp(500,function(){
						$(this).children().show();
					}).slideDown(500);
					$(this).text($(this).parent().attr("spoiler-close"));
					isClosed=false;
				}else{
					$(this).parent().children(".spoiler-content").slideUp(500,function(){
						$(this).children().hide();
						$(this).children(":first-child").show();
					}).slideDown(500);
					$(this).text($(this).parent().attr("spoiler-open"));
					isClosed=true;
				}
				
			});

		});
	};

	jQuery.fn.modal = function(options){
		var settings = {
			'default_width': '80%',
			'default_height': '80%'
		};
   		if (settings){$.extend(settings, options);}
		$(".modal").not('[data-status="true"]').each(function(){
			if($(this).attr("data-status")===undefined){
				$(this).attr("data-status","true");
			}
			$(this).click(function(){
				$("body").append('<div class="modal-background"><div class="modal-box"><div class="modal-header"><div class="modal-column"><div class="modal-column-content task-bar">'+$(this).attr('data-title')+'</div></div><div class="modal-column"><div class="modal-column-content text-right"><i class="icon-remove"></i></div></div></div><div class="modal-content"><table style="width:100%"><tr><td class="text-center" style="vertical-align:middle;">Bitte warten...</td></tr></table></div></div></div>');
				var modalBackground = $(".modal-background");
				var modalBox = $(".modal-background .modal-box");
				var modalHeader = $(".modal-background .modal-box .modal-header");
				var modalCloseBtn = $(".modal-background .modal-box .modal-header .modal-column-content .icon-remove");
				var modalContent = $(".modal-background .modal-box .modal-content");				
				modalBackground.fadeIn(500);
				switch($(this).attr("data-type")){
					case 'text':
						modalContent.css({'margin':'1%','padding':'1%','width':'96%','height':'86%'});
						modalContent.html($(this).attr("data-source"));
					break;
					case 'url':
						$.post($(this).attr("data-source"),{},function (data){
							modalContent.css({'height':(modalBox.outerHeight()-modalHeader.outerHeight())+'px'});
							modalContent.html(data);
						}).success(function () {}).error(function () {}).complete(function () {});
					break;
					case 'youtube':
						modalContent.html('<iframe width="100%" height="100%" src="http://www.youtube.com/embed/'+$(this).attr("data-source")+'/?theme=light&showinfo=0" frameborder="0" allowfullscreen></iframe>');
					break;
					case 'vimeo':
						modalContent.html('<iframe src="//player.vimeo.com/video/'+$(this).attr("data-source")+'?title=0&amp;byline=0&amp;portrait=0" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
					break;
				}
				modalCloseBtn.click(function(){
					modalBackground.fadeOut(500,function(){
						$(this).remove();
					});
				});
				$(window).resize(function(){
					clearTimeout(c_window_resize);
					c_window_resize = setTimeout(function(){
							modalContent.animate({'height':(modalBox.outerHeight()-modalHeader.outerHeight())+'px'},200);
					},300);					
				});
			});
			$(document).keydown(function(e){
				if(e.keyCode==27 && $(".modal-background").is(":visible")){
					$(".modal-background").fadeOut(500,function(){
						$(this).remove();
					});
				}
			});
		});
	};
})(jQuery);