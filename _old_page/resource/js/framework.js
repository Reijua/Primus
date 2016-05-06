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
		$(".modal").not('[data-status="true"]').each(function(){
			if($(this).attr("data-status")===undefined){
				$(this).attr("data-status","true");
			}
			$(this).click(function(){
				$("body").append('<div class="modal-background"><div class="modal-box"><div class="modal-header"><div class="modal-column"><div class="modal-column-content task-bar">'+$(this).attr('data-title')+'</div></div><div class="modal-column"><div class="modal-column-content text-right"><i class="icon-remove"></i></div></div></div><div class="modal-content"></div></div></div>');
				var modalBackground = $(".modal-background");
				var modalBox = $(".modal-background .modal-box");
				var modalHeader = $(".modal-background .modal-box .modal-header");
				var modalCloseBtn = $(".modal-background .modal-box .modal-header .modal-column-content .icon-remove");
				var modalContent = $(".modal-background .modal-box .modal-content");				
				$(".modal-background").fadeIn(500);
				$(".modal-background .modal-box").css({'margin-left':'-'+$(".modal-box").outerWidth()/2+'px','margin-top':'-'+$(".modal-box").outerHeight()/2+'px'});			

				switch($(this).attr("data-type")){
					case 'text':
						modalContent.css({'margin':'1%','padding':'1%','width':'96%','height':'86%'});
						modalContent.html($(this).attr("data-source"));
					break;
					case 'url':
						$.post($(this).attr("data-source"),{},function (data) {
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
					$(".modal-background").fadeOut(500,function(){
						$(this).remove();
					});
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

	jQuery.fn.base64upload = function(options) {
		$(".base64-upload").not('[status="true"]').each(function(){
			if($(this).attr("status")===undefined){
				$(this).attr("status","true");
			}
			$(this).children(".control-panel").hide();
			$(this).children("input[type=file]").change(function(){
				var fd = new FormData();
				for (i = 0; i < $(this)[0].files.length;i++) {
					fd.append("file[]",$(this)[0].files[0]);
				};
				$.ajax({
						url: $(this).attr("data-url"),
						data: fd,
						type: 'POST',
						processData: false,
		  				contentType: false,
						success: function(data){
							v_data = $.parseJSON(data);
							if(v_data.hasOwnProperty('target') && v_data.hasOwnProperty('format') && v_data.hasOwnProperty('file_list') && v_data.error==false){
								media.initFilePreview({
									p_element_preview: v_data.target,
									p_format: v_data.format,
									p_file_list: v_data.file_list
								});
							}
							if(v_data.hasOwnProperty('message')){
								alert(v_data.message);
							}
						},
						error: function(){
							alert("ERROR");
						}						
					});
			});
		});

		
	};

	jQuery.fn.fileupload = function(options) {
		var settings = {
			'button_tag': '80%',
			'button_tag_after': '80%'
		};
   		if (settings){$.extend(settings, options);}


   		/*$("#select-file-btn").click(function(e){
		    $('#file').click();
		});
   		$('.file-upload :file').change(function(){
   			var file = this.files[0];
			 
			var fd = new FormData();
			fd.append("file", file);
			 
			var xhr = new XMLHttpRequest();
			xhr.open('POST', $('.file-upload').attr("upload-url"), true);			  
			xhr.upload.onprogress = function(e) {
				$(".file-upload .progress-bar").fadeIn(200);
			  	if (e.lengthComputable) {
			      var percentComplete = (e.loaded / e.total) * 100;
			      $(".file-upload .progress-bar .loader").animate({width:percentComplete+"%"},100);
			      if(percentComplete==100){
			      	$(".file-upload .progress-bar").fadeOut(500,function(){
			      		$(this).children(".bar").css({width:"0px"});
			      		$("#select-file-btn").text("Anderes Bild auswählen");
			      	});
			      }
			    }
			};			 
			xhr.onload = function() {
			    if (this.status == 200) {
			      var data = JSON.parse(this.response);
			      $(".file-upload .preview").html('<img src="'+data.url+'" height="100%" />');
			    }else{
			    	$(".file-upload .preview").html('ERROR');
			    };
			};			 
			xhr.send(fd);
   		});*/

	};

})(jQuery);