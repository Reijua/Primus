
(function($) {
	var methodes = {
		initMenu : function(options){
			var settings = {
				'p_menu': null,
				'p_parent': null,
				'p_plugin':null,
				'p_element': "#menu-panel",
				'p_default_content': "#default-content",
				'p_application': "",
			};
			if (settings){$.extend(settings, options);}
			v_content="";
			for (var i = 0; i < settings.p_menu.length; i++) {
				if((settings.p_parent==null ? settings.p_menu[i].parent : settings.p_menu[i].id)==settings.p_parent){
					v_content+=(settings.p_parent==null ? '<h5>'+settings.p_menu[i].name+'</h5>' : '<table width="100%"><tr><td width="25%"><span id="menu-back-btn" menu-data="'+settings.p_menu[i].parent+'"><i class="icon-arrow-left"></i>Zurück</span></td><td width="50%" class="text-center"><strong>'+settings.p_menu[i].name+'</strong></td><td width="25%"></td></tr></table>');
					v_content+='<ul class="menu">';
					for (var j = 0; j < settings.p_menu.length; j++) {
						if(settings.p_menu[i].id==settings.p_menu[j].parent){
							switch(settings.p_menu[j].type){
								case "Application":
									v_content+='<li data-type="'+settings.p_menu[j].type+'" menu-data="'+settings.p_menu[j].id+'"><div id="text"><div class="small-icon" style="background-color:'+settings.p_menu[j].color+';"><img src="'+settings.p_menu[j].icon+'" /></div>'+settings.p_menu[j].name+'</div></li>';
								break;
								case "Directory":
									v_content+='<li data-type="'+settings.p_menu[j].type+'" menu-data="'+settings.p_menu[j].id+'"><div id="text"><div class="small-icon" style="background-color:'+settings.p_menu[j].color+';"><img src="'+settings.p_menu[j].icon+'" /></div>'+settings.p_menu[j].name+'</div><i class="icon-arrow-right"></i></li>';
								break;
								default:v_content+='<li data-type="Unknown"><div id="text"><div class="small-icon" style="background-color:'+settings.p_menu[j].color+';"><img src="'+settings.p_menu[j].icon+'" /></div>'+settings.p_menu[j].name+'</div></li>';;
							}					
						}				
					}
					v_content+='</ul>';
				}
			};
			$(settings.p_element).html(v_content);
			if(settings.p_parent!=null){
				$("#menu-back-btn").click(function(){
					v_menu_data=($(this).attr("menu-data")=="null" ? null : $(this).attr("menu-data"));
					for (var i = 0; i < settings.p_menu.length; i++) {
						if($(this).attr("menu-data")==settings.p_menu[i].id){
							if(settings.p_menu[i].parent==null){
									v_menu_data=null;
							}
						}
					};
					$("#menu-panel").animate({"width":"0px"},250,function(){
						methodes.initMenu({
							p_menu: settings.p_menu,
							p_parent: v_menu_data,
							p_plugin: settings.p_plugin,
							p_element: settings.p_element,
							p_application: settings.p_application
						});
					});
					$("#menu-panel").animate({"width":"280px"},250);
					
				});
			}
			$("ul.menu").children("li").click(function(){
				
				switch($(this).attr("data-type")){
					case "Application":
						methodes.initContent({
							p_application: settings.p_application,
							p_element: $(this),
							p_default_content: settings.default_content
						});
					break;
					case "Directory":
						p_menu_data=$(this).attr("menu-data");
						$("#menu-panel").animate({"width":"0px"},250,function(){
							methodes.initMenu({
								p_menu: settings.p_menu,
								p_parent: p_menu_data,
								p_plugin: settings.p_plugin,
								p_element: settings.p_element,
								p_application: settings.p_application,
								p_default_content: settings.default_content
							});
						});
						$("#menu-panel").animate({"width":"280px"},250);
					break;
				}				
			});
		},
		initContent : function(options){
			var settings = {
				'p_application': null,
				'p_element':null,
				'p_default_content': "#default-content"
				
			};
			if (settings){$.extend(settings, options);}
			$(".menu").children("li").children("#text").removeClass("active");
			if(settings.p_element==null){
				v_help = $("#menu-panel").children();
				
				settings.p_element=$(v_help[1]).children("li:first-child");
				
			}
			settings.p_element.children("#text").addClass("active");
			$.post("/ajax/plugin/content/"+settings.p_application+"/"+settings.p_element.attr("menu-data"),{},function (data) {
				$(settings.p_default_content).html(data);
			}).success(function () {}).error(function () {}).complete(function () {});
		}
	};

	jQuery.fn.initApplicationMenu = function(options) {
		var settings = {
			'visible': false,
			'application': null,
			'plugin':null,
			'menu_title': 'Menü',
			'default_content': '#default-content'
		};
   		if (settings){$.extend(settings, options);}

   		var v_data;
		var isAnimated=false;
		var modal_title=$(".modal-box .modal-header .task-bar").text();
		$(".modal-box .modal-header .task-bar").html("");
		$(".modal-box .modal-header .task-bar").append('<i class="icon-align-justify" id="menu-btn"></i>'+modal_title);
		$.post("/ajax/plugin/menu/"+settings.application,{},function (data) {
			$(".modal-content").append('<div class="column" id="menu-panel"></div>');
			v_data = $.parseJSON(data);
			methodes.initMenu({
				p_menu: v_data,
				p_parent: null,
				p_plugin: null,
				p_application: settings.application,
				p_default_content: settings.default_content
			});
			

		}).success(function () {}).error(function () {}).complete(function () {
			methodes.initContent({
				p_application: settings.application,
			});
			if(settings.visible){
				$("#menu-panel").show();
				$("#menu-panel").css({"width":"300px"});
			}else{
				$("#menu-panel").hide();
			}			
			$("#menu-btn").click(function(){
				if($("#menu-panel").is(":visible")){
					if (!isAnimated) {
						isAnimated=true;
						$("#menu-btn").removeClass('active');
						$("#menu-panel").animate({"width":"0px"},500,function(){
							$("#menu-panel").hide();
							isAnimated=false;
						});
					}
				}else{
					if(!isAnimated){
						isAnimated=true;
						$("#menu-btn").addClass('active');
						$("#menu-panel").show();
						$("#menu-panel").animate({"width":"280px"},500,function(){isAnimated=false});
					}
				}
			});
		});
	}
})(jQuery);