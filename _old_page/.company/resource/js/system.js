function number_format(number, decimals, dec_point, thousands_sep) {
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
	prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
	dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
	s = '',
	toFixedFix = function(n, prec) {
		var k = Math.pow(10, prec);
		return '' + (Math.round(n * k) / k).toFixed(prec);
	};
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}
	return s.join(dec);
}

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
				type: (v_form.attr("methode") !== undefined ? v_form.attr("methode").toUpperCase() : "GET"),
				url: v_form.attr("form-url"),
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
					if(v_form.attr("form-redirect")!==undefined && v_data.error==false){
						window.location=v_form.attr("form-redirect");
					}
				},
				error: function(){
					alert("ERROR");
				}
			});
		},
		initDock : function(options){
			var settings = {
				'p_content': null,
				'p_dock_id': null
			};
			if (settings){$.extend(settings, options);}
			dock.initComponents({
				p_content : settings.p_content,
				p_dock_id : settings.p_dock_id
			});

		}
	}
	var dock = {
		initComponents : function(options){
			var settings = {
				'p_content': null,
				'p_dock_id': null
			};
			if (settings){$.extend(settings, options);}
			$(settings.p_content).append('<div id="dock-holder"><ul></ul></div>');
			$.ajax({
				type: "POST",
				url: "/ajax/dock/menu/",
				success: function(data){
					v_menu = $.parseJSON(data);
					
					for (var i = 0; i < v_menu.length; i++) {
						$(settings.p_content).children("#dock-holder").children("ul").append('<li class="'+(settings.p_dock_id==v_menu[i].id ? 'active' : '' )+'" data="'+v_menu[i].id+'" >'+v_menu[i].name+'</li>');
					};
					$("#content-wrapper #content-holder").html('<div class="loading"><div class="point-1"></div><div class="point-2"></div><div class="point-3"></div></div><div class="text-center"><br />Ladet...</div>');
					$.ajax({
						type: "POST",
						url: "/ajax/dock/content/"+$(settings.p_content).children("#dock-holder").children("ul").children(".active").attr("data"),
						success: function(data){
							$("#content-wrapper #content-holder").html(data);
						},
						error: function(){
							alert("ERROR");
						}
					});

					$(settings.p_content).children("#dock-holder").children("ul").children("li").click(function(){
						$("#content-wrapper #content-holder").html('<div class="loading"><div class="point-1"></div><div class="point-2"></div><div class="point-3"></div></div><div class="text-center"><br />Ladet...</div>');
						$(this).parent().children().removeClass("active");
						$(this).addClass("active");
						v_link = $(this).attr("data");
						$.ajax({
							type: "POST",
							url: "/ajax/dock/content/"+v_link,
							success: function(data){
								$("#content-wrapper #content-holder").html(data);
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
		},
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
			alert($(this)[0].files.length);
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
	jQuery.fn.initFormSystem = function(options) {
		$("form").not('[status="true"]').each(function(event){
			var v_form=$(this);
			if(v_form.attr("status")===undefined){
				v_form.attr("status","true")
			}
			$(this).submit(function(e){
				e.preventDefault();
			});

			$(this).find("#submit").click(function(){
				switch(v_form.attr("form-type")){
					case 'normal':
						system.sendRequest({
							p_form: v_form
						});
					break;
					case 'confirm':
						if(confirm(v_form.attr("form-message"))){
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

	jQuery.fn.initDynamicFields= function(options){
		var settings = {
			'p_field' : ''
		};
		if (settings){$.extend(settings, options);}
		var v_field = $(this).children('table').children(1).html();
		if($(this).children("table").length==0){
			$(this).append('<table width="100%" cellpadding="0" cellspacing="0"></table>');
			$(this).children("table").append(settings.p_field);
		}
		
		
		$(this).children("table").find("tr").children("td").children("span").click(function(){
			$(this).attr("status","true");
			$(this).parent().parent().remove();
		});
		$(this).append('<span>Feld hinzufügen</span>');
		$(this).children('span').click(function(){
			$(this).parent().children("table").append(settings.p_field);
			$(this).parent().children("table").find("tr:last-child").children("td").children("span").click(function(){
				$(this).attr("status","true");
				$(this).parent().parent().remove();
			});
		});
	}

	jQuery.fn.initSammary= function(options){
		var settings = {
			'p_prefix': ""
		};
		if (settings){$.extend(settings, options);}
		$(this).change(function(){
			v_output = "";
			switch($(this).get(0).tagName.toUpperCase()){
				case "INPUT":
					v_output = $(this).val();
				break;
				case "SELECT":
					if($(this).val()!=0){
						v_output = $(this).children('[value="'+$(this).val()+'"]').text();
					}					
				break;
			}
			$("."+settings.p_prefix+"_"+$(this).attr("id")).text(v_output);
		});
	}
	jQuery.fn.initDock = function(options){
		var settings = {
			'p_dock_id': null
		};
		if (settings){$.extend(settings, options);}
		system.initDock({
			p_dock_id: settings.p_dock_id,
			p_content : "#dock-wrapper"
		});
	}

	jQuery.fn.initLightbox = function(options){
		var settings = {};
		if (settings){$.extend(settings, options);}

		$(".lightbox").each(function(){
			$(this).click(function(){

				var v_image = new Image();
				var v_window_height = $(window).height();
				var v_max_image_height = v_window_height - 60;

				v_image.src = $(this).attr("lightbox-data");

				$("html, body").css({'overflow':'hidden'});
				$("body").append('<div class="lightbox-background"><div class="lightbox-header"><ul><li><i class="icon-close"></i></li></ul></div><img src="https://duckduckgo.com/l2.retina.gif" alt="Vorschau"/></div>');
				$(".lightbox-background").children("img").css({"max-height":v_max_image_height+"px"});
				$(".lightbox-background").fadeIn(500,function(){
					$(this).children("img").load(function(){
						$(".lightbox-background").children("img").animate({'top':'50%','left':'50%','margin-top':'-'+($(".lightbox-background").children("img").height()/2)+'px', 'margin-left':'-'+($(".lightbox-background").children("img").width()/2)+'px'},500);
					}).attr("src",v_image.src);
				});

				$(".lightbox-background .lightbox-header ul li i.icon-close").click(function(){
					$(".lightbox-background").fadeOut(500,function(){
						$(this).remove();
						$("html, body").css({"overflow":"auto"});
					});
				});
				$(document).keydown(function(e){
					if(e.keyCode==27 && $(".lightbox-background").is(":visible")){
						$(".lightbox-background").fadeOut(500,function(){
							$(this).remove();
							$("html, body").css({"overflow":"auto"});
						});
					}
				});
			});
		});
	}

	jQuery.fn.initMobileMenu = function(options){
		var settings = {
			'p_content': null
		};
		if (settings){$.extend(settings, options);}
		$("nav.mobile-menu ul").children("li").children("ul").slideUp(0);
		$("nav.mobile-menu ul").children("li").click(function(){
			if($(this).children("ul").length) {
				if($(this).children("ul").is(":hidden")){
					$(this).addClass("active");
					$(this).children("ul").slideDown(500);
				}else{
					$(this).removeClass("active");
					$(this).children("ul").slideUp(500);
				}
			}
		});
		$("nav.mobile-menu").hide();
		$("header nav.mobile-bar ul li .icon-points").click(function(){
			if($("nav.mobile-menu").is(":hidden")){
				$(this).addClass("active");
				$("nav.mobile-menu").stop().slideDown(500);				
			}else{
				$(this).removeClass("active");
				$("nav.mobile-menu").stop().slideUp(500);
			}
			
		});
		$(window).resize(function(){
			if($("nav.mobile-menu").is(":visible")){
				if($(window).width()>700){
					if($("header nav.mobile-bar ul li .icon-points").hasClass("active")){
						$("nav.mobile-menu").slideUp(500);
						$("header nav.mobile-bar ul li .icon-points").removeClass("active");
					}				
				}
			}
		});
	}
})(jQuery);
