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
	var v_boolean_resize=null;
	var system = {
		v_is_progress : !1,
		sendRequest : function(options){
			var settings = {
				'p_form': null,
				'p_input' : "",
				'p_submit_btn': null,
				'p_submit_text': ""				
			};
			if (settings){$.extend(settings, options);}
			var v_form = settings.p_form;

			var v_data;
			if(!!window.FormData){
				v_data = new FormData();
				for (var i = 0; i < v_form.serializeArray().length; i++) {
					v_data.append(v_form.serializeArray()[i].name, v_form.serializeArray()[i].value);
				};
				if ($("#file").length > 0){
					for (i = 0; i < $("#file")[0].files.length; i++) {
						v_data.append("file[]",$("#file")[0].files[i]);
					};
				}
				if(settings.p_input != ""){
					v_data.append("input_box", settings.p_input);
				}
			}else{
				v_data = v_form.serialize();	
				if(settings.p_input != ""){
					if(v_data.length == 0){
						v_data = "input_box="+settings.p_input;
					}else{
						v_data = "&input_box="+settings.p_n
					}
				}			
			}
			$.ajax({
				type: (v_form.attr("methode") !== undefined ? v_form.attr("methode").toLowerCase() : "GET"),
				url: v_form.attr("data-url"),
				data: v_data,
				processData: false,
		  		contentType: false,
				success: function(data){
					v_data = $.parseJSON(data);
					if(v_data.hasOwnProperty('element_reset')){
						for (var i = 0; i < v_data.element_reset.length; i++) {
							document.getElementById(v_data.element_reset[i]).value="";
						};								
					}
					if(v_data.hasOwnProperty('element_focus')){
						document.getElementById(v_data.element_focus).focus();
					}							
					if(v_data.hasOwnProperty('message')){
						alert(v_data.message);
					}					
				},
				error: function(e){
					console.log(e);
					system.v_is_progress = !1;
					if(settings.p_submit_btn != null && settings.p_submit_text != ""){
						settings.p_submit_btn.text(settings.p_submit_text);
					}
				}
			}).done(function(data){
				v_data = $.parseJSON(data);
				system.v_is_progress = !1;
				if(settings.p_submit_btn != null && settings.p_submit_text != ""){
					settings.p_submit_btn.text(settings.p_submit_text);
				}
				if(v_form.attr("data-redirect")!==undefined && v_data.error==false){
					window.location=v_form.attr("data-redirect");
				}			
			});
		},
		resizeMenu : function(options){
			$("nav.menu .menu-wrapper").css({"height": ($(window).height() - $("nav.menu .menu-header").outerHeight())+"px"});
		},
		loadingAnimation : function(){
			return '<table style="width:100%; height:100%;" class="text-center"><tr><td style="vertical-align: middle;"><div class="loading-bar"><div class="points"><div class="point-1"></div><div class="point-2"></div><div class="point-3"></div></div></div><div style="margin: 10px 0;">Bitte warten...</div></td></tr></table>';
		},
		setContentProperty : function(options){
			var settings = {
				'p_min_height' : 0,
			};
			if (settings){$.extend(settings, options);}
			v_height = $(window).height() - ( $("header").outerHeight(true) + $("footer").outerHeight(true) );
			if(v_height > settings.p_min_height){
				$(".content-wrapper").css({"height" : v_height+"px"});
			}else{
				$(".content-wrapper").css({"height" : settings.p_min_height+"px"});
			}
		}
	}

	jQuery.fn.initFormSystem = function(options) {
		$("form").not('[data-status="true"]').each(function(event){
			$(this).submit(function(e){
				e.preventDefault();
			});
			var v_form=$(this);
			var v_submit_btn = $(this).find(".submit");
			if(v_form.attr("data-status")===undefined){
				v_form.attr("data-status","true")
			}

			if(system.v_is_progress == !1){
				v_submit_btn.click(function(){
					system.v_is_progress = !0;
					switch(v_form.attr("data-type")){
						case 'normal':
							var v_submit_text = v_submit_btn.text();
							v_submit_btn.text("Bitte warten...");;

							system.sendRequest({
								p_form: v_form,
								p_submit_btn: v_submit_btn,
								p_submit_text: v_submit_text
							});
						break;
						case 'confirm':
							if(confirm(v_form.attr("data-text"))){
								system.sendRequest({
									p_form: v_form
								});
							};
						break;
						case 'prompt':
							var v_input = prompt(v_form.attr("data-text"));
							if(v_input.trim() != ""){
								system.sendRequest({
									p_form: v_form,
									p_input: v_input
								});
							}
						break;
						default:
						break;
					}
					
				});
			}
		});
	}
	jQuery.fn.initFilePreview = function(options){
		var settings = {
			'p_target': '',
			'p_format': ''
		};
		if (settings){$.extend(settings, options);}
		var element = $(this);
		var reader = new FileReader();
		$(this).change(function(){
			$(settings.p_target).html("");
			for (var i = 0; i < $(this)[0].files.length; i++) {
				(function(file) {
			        var reader = new FileReader();  
			        reader.onload = function(e) {
						$(settings.p_target).append(settings.p_format.format(e.target.result));
			        }
			        reader.readAsDataURL(file);
			    })($(this)[0].files[i]);
			};
		});
	}

	jQuery.fn.initDynamicField = function(options){
		var settings = {
			'p_field': ''
		};
		if (settings){$.extend(settings, options);}

		v_content = $(this).children(".dynamic-content");

		if($(this).children(".dynamic-content").children().length == 0){
			v_content.append(settings.p_field);
		}

		$(this).children(".dynamic-content").children().find(".btn-delete").click(function(){
			$(this).parent().parent().parent().parent().parent().remove();
		});
		$(this).children(".dynamic-footer").children("span").click(function(){
			v_content.append(settings.p_field);
			v_content.children().find(".btn-delete").click(function(){
				$(this).parent().parent().parent().parent().parent().remove();
			});
		});
	}
	jQuery.fn.initMenu = function(){
		$("header nav ul li .icon-align-justify").click(function(){
			$("html,body").css({"overflow":"hidden"});
			$("nav.menu").stop().fadeIn(100, function(){
				$(this).animate({"right":"0px"},250);
			});			
		});
		$("nav.menu .menu-header ul.option-bar li .icon-remove").click(function(){
			$("nav.menu").stop().animate({"right":"-202px"},250, function(){
				$(this).fadeOut(100);				
			});
		});
		$("nav.menu .menu-wrapper").css({"height": ($(window).height() - $("nav.menu .menu-header").outerHeight())+"px"});
		$("nav.menu").css({"right":"-202px"}).fadeOut(0);

		$(window).resize(function(){
			clearTimeout(v_boolean_resize);
			v_boolean_resize = setTimeout(system.resizeMenu,500);
		});
	}

	jQuery.fn.initComponents = function(options){
		var settings = {
			'p_min_height' : 0,
		};
		if (settings){$.extend(settings, options);}
		system.setContentProperty({
			p_min_height : settings.p_min_height
		});

		$(window).resize(function(){
			clearTimeout(v_boolean_resize);
			v_boolean_resize = setTimeout(system.setContentProperty({
				p_min_height : settings.p_min_height
			}),500);
		});
		
	}

	jQuery.fn.initUI = function(options){
		v_window_resize = null;
		$(".column-right").html(system.loadingAnimation());
		$.post( "/ajax/application/get_content/", function(data) {
	  		$(".column-right").html(data);
	  		$(".column-right .application-content").css({"height": ($(".column-right").outerHeight(true) - $(".column-right .application-header").outerHeight(true))+"px"});
		});

		$(".container").css({"height":($(window).height() - $("header").outerHeight(true))+"px"});
		$(".column-right").css({"width": ($(window).width() - $(".container .column-left").outerWidth(true)) +"px"});

		$(".application-link").each(function(){
			$(this).click(function(){
				var v_id = $(this).attr("data-application");
				var v_category = $(this).attr("data-application-category");

				$(".column-right").html(system.loadingAnimation());

				$(".application-link").removeClass("active");
				$(this).addClass("active");

				$.post( "/ajax/application/get_content/"+v_category+"/"+v_id, function(data) {
					$(".column-right").html(data);
					$(".column-right .application-content").css({"height": ($(".column-right").outerHeight(true) - $(".column-right .application-header").outerHeight(true))+"px"});
				});
			});
		});
		$(window).resize(function(){
			clearTimeout(v_window_resize);
			$(".column-right").css({"width": ($(window).width() - $(".container .column-left").outerWidth(true))+"px"});
			$(".column-right .application-content").css({"height": ($(".column-right").outerHeight(true) - $(".column-right .application-header").outerHeight(true))+"px"});
			v_window_resize = setTimeout(function(){
				$(".container").stop().css({"height": ($(window).outerHeight(true) - $("header").outerHeight(true)) +"px"});
				$(".column-right").stop().css({"width": ($(window).width() - $(".container .column-left").outerWidth(true)) +"px"});
			$(".column-right .application-content").delay(100).css({"height": ($(".column-right").outerHeight(true) - $(".column-right .application-header").outerHeight(true))+"px"});
				
			},250);
		});
	}
})(jQuery);
