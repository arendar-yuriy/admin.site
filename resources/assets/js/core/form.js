//Скрипт предупреждает пользователя о изменении данных в форме и возможносте их потери при переходе
$(document).ready(function(){
	
	if( typeof(CKEDITOR) !== "undefined" ){
		//Остлеживание изменений в ckeditor
		CKEDITOR.on('instanceReady',function(){
			$(document).find(".ckeditor").each(function() { 
				var editorName = $(this).attr("id");
				if($("#"+editorName).attr("cf")){
					CKEDITOR.instances[editorName].on('change', function() {
						$("#"+editorName).addClass("modified");
					});
				}
			}); 
		});
	}

	//Задать изменения
	function set_modified(e){
	  var el = window.event ? window.event.srcElement : e.currentTarget;
	  $(el).addClass("modified");
	}

	function init(){

	  for (var i = 0; oCurrForm = document.forms[i]; i++){
	    for (var j = 0; oCurrFormElem = oCurrForm.elements[j]; j++){

	      //Вешаем обработчики на изменение полей, помеченных как cf
	      if (oCurrFormElem.getAttribute("cf")){
	    	  
	        if (oCurrFormElem.addEventListener) 
	        	oCurrFormElem.addEventListener("change", set_modified, false);
	        else if (oCurrFormElem.attachEvent) 
	        	oCurrFormElem.attachEvent("onchange", set_modified);
	      }
	    }
	  }
	}
	
	init();

	function checkModified(){
		if($(document).find(".modified").length > 0)
			return true;
		else
			return false;
	}
	
	$(window).bind('beforeunload', function(event){
		if(checkModified()){
			return "There is no saved data. Are you sure you want to leave the page?";
		}
    });

	$(".nav.nav-tabs a").click(function(event){
		if(!$(this).parent().hasClass("active")){
			if(checkModified()){
				event.preventDefault();
				el = this;
				message = "There is no saved data. Are you sure you want to leave the page?";
				if (confirm(message)){
					$(document).find(".modified").each(function() {
						$(this).removeClass("modified");
					});
					$(el).click();
					//window.location.href = $(el).attr("href");
				}

  				return false;
			}
		}
	})
});
