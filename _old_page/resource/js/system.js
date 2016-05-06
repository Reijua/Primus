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
	var gallery = {
		is_animated : false,
		loadImage : function(options){
			var settings = {
				'p_item' : null
			};
			if (settings){$.extend(settings, options);}
			$(".lightbox").children(".lightbox-content").find("img").load(function(){
				$(".lightbox").children(".lightbox-content").find("img").stop().animate({"top":"50%", "left":"50%","margin-top":"-"+($(".lightbox").children(".lightbox-content").find("img").height()/2)+"px" ,"margin-left":"-"+($(".lightbox").children(".lightbox-content").find("img").outerWidth()/2)+"px"},250);
			}).attr("src",settings.p_item);
		}
	}
	var system = {
		sendRequest : function(options){
			var settings = {
				'p_form': null
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
			}else{
				v_data = v_form.serialize();				
			}

			$.ajax({
				type: (v_form.attr("methode") !== undefined ? v_form.attr("methode").toLowerCase() : "GET"),
				url: v_form.attr("data-url"),
				data: v_data,
				processData: false,
		  		contentType: false,
				success: function(data){
					console.log(data);
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
					if(v_form.attr("data-redirect")!==undefined && v_data.error==false){
						window.location=v_form.attr("data-redirect");
					}
				},
				error: function(e){
					alert('AJAX hat leider einen Fehler');
					console.log(e);
				}
			});
		},
		resizeMenu : function(options){
			$("nav.menu .menu-wrapper").css({"height": ($(window).height() - $("nav.menu .menu-header").outerHeight())+"px"});
		},
		initDock : function(options){
			var settings = {
				'p_content': null
			};
			if (settings){$.extend(settings, options);}
			dock.initComponents({
				p_content : settings.p_content
			});

		}
	}
	var dock = {
		initComponents : function(options){
			var settings = {
				'p_content': null
			};
			if (settings){$.extend(settings, options);}
			$(settings.p_content).append('<div class="dock-content"><nav><ul></ul></nav></div>');
			$.ajax({
				type: "POST",
				url: "/ajax/dock/menu/",
				success: function(data){
					v_menu = $.parseJSON(data);
					
					for (var i = 0; i < v_menu.length; i++) {
						$(settings.p_content).children(".dock-content").children("nav").children("ul").append('<li class="'+v_menu[i].type+'" data="'+v_menu[i].id+'"><i class="'+v_menu[i].icon+'"></i><span class="mobile-hidden">'+v_menu[i].name+'</span></li>');
					};
					$("header section .content i.icon-menu").click(function(){
						if($(settings.p_content).is(":hidden")){
							$(settings.p_content).show(function(){
								$("html, body").css({"overflow":"hidden"});
								$(this).animate({"width":"250px"},300);
								$(".site-wrapper").animate({"left":"250px"},300);
							});
						}else{
							$("html, body").css({"overflow":"auto"});
							$(".site-wrapper").animate({"left":"0px"},300);
							$(settings.p_content).animate({"width":"0px"},300,function(){
								$(this).hide();
							});
						}
						
					});

					$(settings.p_content).children(".dock-content").children("nav").children("ul").children("li").click(function(){
						$(this).parent().children().removeClass("active");
						$(this).addClass("active");
						v_link = $(this).attr("data");
						$.ajax({
							type: "POST",
							url: "/ajax/dock/content/"+v_link,
							success: function(data){
								$(".desktop").html(data);
							},
							error: function(){
								alert("ERROR");
							}
						});
					});
				},
				error: function(){
					alert("ERROR");
				}
			});
			$(settings.p_content).animate({"width":"0px"},300,function(){
				$(this).hide();
			});
		},
	}
	jQuery.fn.initFormSystem = function(options) {
		$("form").not('[data-status="true"]').each(function(event){
			var v_form=$(this);
			if(v_form.attr("data-status")===undefined){
				v_form.attr("data-status","true")
			}
			$(this).submit(function(e){
				e.preventDefault();
			});
			$(this).find(".submit").click(function(){
				switch(v_form.attr("data-type")){
					case 'normal':
						system.sendRequest({
							p_form: v_form
						});
					break;
					case 'confirm':
						if(confirm(v_form.attr("data-question"))){
							system.sendRequest({
								p_form: v_form
							});
						};
					break;
					default:
					break;
				}
				
			});
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
	jQuery.fn.initDock = function(option){
		system.initDock({
			p_content : ".dock-wrapper"
		});
	}

	jQuery.fn.initItemSlider = function(options) {
		var settings = {};
		if (settings){$.extend(settings, options);}

		//Static Variables
		v_btn_left = $(this).children(".left-btn");
		v_btn_right = $(this).children(".right-btn");
		v_element_content = $(this).children(".item-content"); 

		v_selected_item = 0;
		v_last_position = 0;
		v_last_item = 0;

		v_total_width = 0;
		a_item = $(this).children(".item-content").children(".item-list").children();

		if(v_element_content.outerWidth(true) < 600){
			$(this).children(".item-content").children(".item-list").children().css({"width":v_element_content.outerWidth(true)+"px"});
		}else{
			$(this).children(".item-content").children(".item-list").children().css({"width":(v_element_content.outerWidth(true)/2)+"px"});
		}
			

		a_item.each(function(){
			v_total_width += $(this).outerWidth(true);
		});

		v_element_content.children(".item-list").css({"width": v_total_width+"px"});

		$(this).children(".right-btn").click(function(){
			$(this).parent().children(".item-content").stop().animate({scrollLeft: $(this).parent().children(".item-content").scrollLeft()+v_element_content.outerWidth()+"px"},500,function(){
				if(v_total_width - $(this).parent().children(".item-content").scrollLeft() == $(this).parent().children(".item-content").width()){
					v_btn_right.fadeOut(500);
				}
				if($(this).parent().children(".item-content").scrollLeft()!=0){
					v_btn_left.fadeIn(500);
				}
			});
		});
		$(this).children(".left-btn").click(function(){
			$(this).parent().children(".item-content").stop().animate({scrollLeft: $(this).parent().children(".item-content").scrollLeft()-v_element_content.outerWidth()+"px"},500,function(){
				if(v_total_width != ($(this).parent().children(".item-content").scrollLeft() + $(this).parent().children(".item-content").width())){
					v_btn_right.fadeIn(500);
				}
				if($(this).parent().children(".item-content").scrollLeft()==0){
					v_btn_left.fadeOut(500);
				}
			});
		});
		if($(this).children(".item-content").scrollLeft()==0){
			v_btn_left.hide();
		}
		if (v_element_content.width() == v_total_width) {
			v_btn_right.hide();
		};

		$(window).resize(function(){
			setTimeout(function() {
				v_total_width = 0;
				v_element_content.stop().animate({scrollLeft:"0"},100,function(){
					if(v_total_width > (v_element_content.scrollLeft() + v_element_content.width())){
						v_btn_right.fadeIn(500);
					}else{
						v_btn_right.fadeOut(250);
					}
					if(v_element_content.scrollLeft()==0){
						v_btn_left.fadeOut(250);
					}
				});
				if(v_element_content.outerWidth(true) < 600){
					v_element_content.children(".item-list").children().css({"width":v_element_content.outerWidth(true)+"px"});
				}else{
					v_element_content.children(".item-list").children().css({"width":(v_element_content.outerWidth(true)/2)+"px"});
				}
				a_item.each(function(){
					v_total_width += $(this).outerWidth(true);
				});
				v_element_content.children(".item-list").css({"width": v_total_width+"px"}); d
			}, 500);
		});
	}

	jQuery.fn.initMenu = function(options){
		$("header nav ul li .icon-align-justify").click(function(){
			$("html,body").css({"overflow":"hidden"});
			$("nav.menu").stop().fadeIn(100, function(){
				$(this).animate({"right":"0px"},250);
			});
			
		});
		$("nav.menu .menu-header ul.option-bar li .icon-remove").click(function(){
			$("nav.menu").stop().animate({"right":"-202px"},250, function(){
				$(this).fadeOut(100,function(){
					$("html,body").css({"overflow":"visible"});
				});				
			});
		})
		$("nav.menu .menu-wrapper").css({"height": ($(window).height() - $("nav.menu .menu-header").outerHeight())+"px"});
		$("nav.menu").animate({"right":"-202px"},250, function(){
			$(this).fadeOut(100);
		});
		
		

		$(window).resize(function(){
			clearTimeout(v_boolean_resize);
			v_boolean_resize = setTimeout(system.resizeMenu,500);
		});
	}

	jQuery.fn.initGallery = function(){
		$(".gallery").each(function(){
			$(this).children(".gallery-content").children(".gallery-item").click(function(){
				var a_images = new Array();
				var v_current_index = $(this).index();
				var v_background = $(this).parent().parent().attr("data-background");				

				$(this).parent().children().each(function(){
					v_image = $(this).attr("data-image");
					a_images.push(v_image);
				});

				$("body").append('<div class="lightbox"><div class="lightbox-header"><ul><li><i class="icon-remove"></i></li></ul></div><div class="lightbox-content"><img src="" alt="Vorschau" /></div><div class="lightbox-btn-next"><i class="icon-angle-right"></i></div></div>');
				switch(v_background){
					case 'black': $(".lightbox").addClass("black");
					break;
					case 'white': $(".lightbox").addClass("white");
					break;
					default: $(".lightbox").addClass("transparent");
					break;
				}

				switch(Math.floor((Math.random() * 4) + 1)){
					case 1: $(".lightbox").children(".lightbox-content").find("img").css({"top":"-100%", "left":"-100%"});
					break;
					case 2: $(".lightbox").children(".lightbox-content").find("img").css({"top":"-100%", "left":"100%"});
					break;
					case 3: $(".lightbox").children(".lightbox-content").find("img").css({"top":"100%", "left":"100%"});
					break;
					case 4: $(".lightbox").children(".lightbox-content").find("img").css({"top":"100%", "left":"-100%"});
					break;
				}
				$(".lightbox").fadeIn(500,function(){
					$("html, body").css({"overflow":"hidden"});
					$(this).children(".lightbox-content").css({"height":($(".lightbox").height() - $(".lightbox").children(".lightbox-header").height())+"px"});
					gallery.loadImage({
						p_item : a_images[v_current_index]
					});
				});

				$(".lightbox").children(".lightbox-header").children("ul").children("li").children("i.icon-remove").click(function(){
					$(".lightbox").fadeOut(500,function(){
						$(this).remove();
						$("html, body").css({"overflow":"auto"});
					});
				});

				$(".lightbox").children(".lightbox-content").find("img").click(function(){
					if(gallery.is_animated == false){
						gallery.is_animated = true;
						v_current_index++;
						if(v_current_index >= a_images.length){
							v_current_index = 0;
						}
						switch(Math.floor((Math.random() * 4) + 1)){
							case 1: $(".lightbox").children(".lightbox-content").find("img").animate({"top":"-100%", "left":"-100%", "margin-top":"0px", "margin-left":"0px"},200, function(){
										gallery.loadImage({p_item : a_images[v_current_index]});	
									}).load(function(){
										gallery.is_animated = false;
									});
							break;
							case 2: $(".lightbox").children(".lightbox-content").find("img").animate({"top":"-100%", "left":"100%", "margin-top":"0px", "margin-left":"0px"},200, function(){
										gallery.loadImage({p_item : a_images[v_current_index]});
									}).load(function(){
										gallery.is_animated = false;
									});;									
							break;
							case 3: $(".lightbox").children(".lightbox-content").find("img").animate({"top":"100%", "left":"100%", "margin-top":"0px", "margin-left":"0px"},200, function(){
										gallery.loadImage({p_item : a_images[v_current_index]});
									}).load(function(){
										gallery.is_animated = false;
									});;									
							break;
							case 4: $(".lightbox").children(".lightbox-content").find("img").animate({"top":"100%", "left":"-100%", "margin-top":"0px", "margin-left":"0px"},200, function(){
										gallery.loadImage({p_item : a_images[v_current_index]});
									}).load(function(){
										gallery.is_animated = false;
									});;									
							break;
						}
					}
				});
				$(document).keydown(function(e){
					if(e.keyCode==27 && $(".lightbox").is(":visible")){
						$(".lightbox").fadeOut(500,function(){
							$(this).remove();
							$("html, body").css({"overflow":"auto"});
						});
					}
					if(e.keyCode==39 && $(".lightbox").is(":visible") && gallery.is_animated == false){
						gallery.is_animated = true;
						v_current_index++;

						if(v_current_index >= a_images.length){
							v_current_index = 0;
						}
						switch(Math.floor((Math.random() * 4) + 1)){
							case 1: $(".lightbox").children(".lightbox-content").find("img").animate({"top":"-100%", "left":"-100%", "margin-top":"0px", "margin-left":"0px"},200, function(){
										gallery.loadImage({p_item : a_images[v_current_index]});	
									}).load(function(){
										gallery.is_animated = false;
									});
							break;
							case 2: $(".lightbox").children(".lightbox-content").find("img").animate({"top":"-100%", "left":"100%", "margin-top":"0px", "margin-left":"0px"},200, function(){
										gallery.loadImage({p_item : a_images[v_current_index]});
									}).load(function(){
										gallery.is_animated = false;
									});;									
							break;
							case 3: $(".lightbox").children(".lightbox-content").find("img").animate({"top":"100%", "left":"100%", "margin-top":"0px", "margin-left":"0px"},200, function(){
										gallery.loadImage({p_item : a_images[v_current_index]});
									}).load(function(){
										gallery.is_animated = false;
									});;									
							break;
							case 4: $(".lightbox").children(".lightbox-content").find("img").animate({"top":"100%", "left":"-100%", "margin-top":"0px", "margin-left":"0px"},200, function(){
										gallery.loadImage({p_item : a_images[v_current_index]});
									}).load(function(){
										gallery.is_animated = false;
									});;									
							break;
						}
						
					}
					if(e.keyCode==37 && $(".lightbox").is(":visible") && gallery.is_animated == false){
						gallery.is_animated = true;
						v_current_index--;
						if(0 > v_current_index){
							v_current_index = a_images.length-1;
						}
						switch(Math.floor((Math.random() * 4) + 1)){
							case 1: $(".lightbox").children(".lightbox-content").find("img").animate({"top":"-100%", "left":"-100%", "margin-top":"0px", "margin-left":"0px"},200, function(){
										gallery.loadImage({p_item : a_images[v_current_index]});	
									}).load(function(){
										gallery.is_animated = false;
									});									
							break;
							case 2: $(".lightbox").children(".lightbox-content").find("img").animate({"top":"-100%", "left":"100%", "margin-top":"0px", "margin-left":"0px"},200, function(){
										gallery.loadImage({p_item : a_images[v_current_index]});
									}).load(function(){
										gallery.is_animated = false;
									});;									
							break;
							case 3: $(".lightbox").children(".lightbox-content").find("img").animate({"top":"100%", "left":"100%", "margin-top":"0px", "margin-left":"0px"},200, function(){
										gallery.loadImage({p_item : a_images[v_current_index]});
									}).load(function(){
										gallery.is_animated = false;
									});;									
							break;
							case 4: $(".lightbox").children(".lightbox-content").find("img").animate({"top":"100%", "left":"-100%", "margin-top":"0px", "margin-left":"0px"},200, function(){
										gallery.loadImage({p_item : a_images[v_current_index]});
									}).load(function(){
										gallery.is_animated = false;
									});;									
							break;
						}
					}
				});
			});
		});
	}
})(jQuery);
