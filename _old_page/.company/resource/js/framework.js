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

	jQuery.fn.tooltip = function() {
		$("*").mouseover(function(event){
			if ($(this).attr('tooltip-text') !== undefined) {
   				$("body").append('<div class="tooltip"><div class="tooltip-content">'+$(this).attr('tooltip-text')+'</div><div class="tooltip-arrow"></div></div>');
   				var p = $(this).offset();
				$(".tooltip").css({'top':p.top+'px','left':p.left+'px','margin-top':'-'+($(".tooltip").innerHeight())+'px'});
				$(".tooltip").fadeIn(500);
			}
		}).mouseout(function(){
			if($(".tooltip").length){
				$(".tooltip").fadeOut(500);
				$(".tooltip").delay(500).remove();
			}			
		});
	};

	jQuery.fn.accordion = function() {
		$(".accordion").each(function(){
			$(this).children(".accordion-section").children(".accordion-header").click(function(){
				if($(this).parent().children(".accordion-body").is(":hidden")){
					$(this).children("i.icon-plus").remove();
					$(this).append('<i class="icon-minus"></i>');
					$(this).parent().children(".accordion-body").slideDown(250);
				}else{
					$(this).children("i.icon-minus").remove();
					$(this).append('<i class="icon-plus"></i>');
					$(this).parent().children(".accordion-body").slideUp(250);
				}
			});
		});
	};

	jQuery.fn.tabs = function() {
		$(".tab-system").each(function(){
			$(this).children("ul").children("li:first-child").addClass("active");
			$(this).children(".tab-content").hide();
			$(this).children("#"+$(this).children("ul").children("li:first-child").attr("tab-content")).show();
			$(this).children("ul").children("li").click(function(){
				$(this).parent().children().removeClass("active");
				$(this).addClass("active");
				$(this).parent().parent().children(".tab-content").hide();
				$(this).parent().parent().children("#"+$(this).attr("tab-content")).show();
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

	jQuery.fn.selectbox = function() {
		$(".select-box").each(function(){
			var element = "#"+$(this).attr("select-box");
			$(this).append('<div class="select-title"><div class="text"></div><div class="arrow"><i class="icon-caret-down"></i></div></div><div class="option-box"></div>');
			$(this).children("select").children().each(function(){
				$(this).parent().parent().children(".option-box").append('<div class="option" value="'+$(this).val()+'">'+($(this).attr("data-image")!==undefined?'<img src="'+$(this).attr("data-image")+'" />':'')+''+$(this).text()+'</div>');
				if($(element).val()==$(this).parent().parent().children(".option-box").children(":last-child").attr("value")){
					$(this).parent().parent().children(".option-box").children(":last-child").addClass("active");
					$(this).parent().parent().children(".select-title").children(".text").html($(this).parent().parent().children(".option-box").children(":last-child").html());
				}
			});
			$(this).click(function(){
				if($(this).children(".option-box").is(":visible")){
					$(this).children(".select-title").children(".arrow").html('<i class="icon-caret-down"></i>');
					$(this).children(".option-box").hide();
				}else{
					$(this).children(".select-title").children(".arrow").html('<i class="icon-caret-up"></i>');
					$(this).children(".option-box").show();
				}				
			});
			$(this).children(".option-box").children().click(function(){
				$(this).parent().parent().children(".select-title").children(".text").html($(this).html());
				$(this).parent().children().removeClass("active");
				$(this).addClass("active");
				$(element).val($(this).attr("value"));
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
		$(".modal").not('[status="true"]').each(function(){
			if($(this).attr("status")===undefined){
				$(this).attr("status","true");
			}
			$(this).click(function(){
				$("html, body").css({"overflow":"hidden"});
				$("body").append('<div class="modal-background"><div class="modal-box"><div class="modal-header"><div class="modal-column"><div class="modal-column-content task-bar">'+$(this).attr('modal-title')+'</div></div><div class="modal-column"><div class="modal-column-content text-right"><i class="icon-remove"></i></div></div></div><div class="modal-content"></div></div></div>');
				var modalBackground = $(".modal-background");
				var modalBox = $(".modal-background .modal-box");
				var modalHeader = $(".modal-background .modal-box .modal-header");
				var modalCloseBtn = $(".modal-background .modal-box .modal-header .modal-column-content .icon-remove");
				var modalContent = $(".modal-background .modal-box .modal-content");				
				$(".modal-background").fadeIn(500);
				$(".modal-background .modal-box").css({'margin-left':'-'+$(".modal-box").outerWidth()/2+'px','margin-top':'-'+$(".modal-box").outerHeight()/2+'px'});			

				switch($(this).attr("modal-type")){
					case 'text':
						modalContent.css({'margin':'1%','padding':'1%','width':'96%','height':'86%'});
						modalContent.html($(this).attr("modal-data"));
						modalCloseBtn.click(function(){
							$(".modal-background").fadeOut(500,function(){
								$(this).remove();
								$("html, body").css({"overflow":"auto"});
							});
						});
					break;
					case 'url':
						$.post($(this).attr("modal-data"),{},function (data) {
							modalContent.css({'height':(modalBox.outerHeight()-modalHeader.outerHeight())+'px'});
							modalContent.html(data);
						}).success(function () {}).error(function () {}).complete(function () {});
						modalCloseBtn.click(function(){
							$(".modal-background").fadeOut(500,function(){
								$(this).remove();
								$("html, body").css({"overflow":"auto"});
							});
						});
					break;
					case 'youtube':
						modalContent.html('<iframe width="100%" height="100%" src="http://www.youtube.com/embed/'+$(this).attr("modal-data")+'/?theme=light&showinfo=0" frameborder="0" allowfullscreen></iframe>');
						modalCloseBtn.click(function(){
							$(".modal-background").fadeOut(500,function(){
								$(this).remove();
								$("html, body").css({"overflow":"auto"});
							});
						});
					break;
					case 'vimeo':
						modalContent.html('<iframe src="//player.vimeo.com/video/'+$(this).attr("modal-data")+'?title=0&amp;byline=0&amp;portrait=0" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
						modalCloseBtn.click(function(){
							$(".modal-background").fadeOut(500,function(){
								$(this).remove();
								$("html, body").css({"overflow":"auto"});
							});
						});
					break;
				}
				
			});
			$(document).keydown(function(e){
				if(e.keyCode==27 && $(".modal-background").is(":visible")){
					$(".modal-background").fadeOut(500,function(){
						$(this).remove();
						$("html, body").css({"overflow":"auto"});
					});
				}
			});
		});
	};

})(jQuery);