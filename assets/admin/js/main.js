	function SendForm(frm){

		if(typeof(tinymce) != 'undefined'){
			tinyMCE.triggerSave();
		}
		
	 	ShowLoader();
		$.ajax({
			type: "POST",
			url: $(frm).attr('action'),
			data:$(frm).serialize(),
			beforeSend: function(data){return Validate(frm)},
			success: function(data){ShowResults(data, frm)},
            error: function(data, status){ShowAjaxError(data)},
			dataType: "json"
		});
	   return false;
	 }

	 function Validate(frm)
	 {
	 	if(!$.validationEngine){
	 		ShowLoader();
			return;
		}

		 var res =  $(frm).validationEngine('validate');
		 if(res){ ShowLoader();}
		 return res;
	 }

	 function ShowResults(data, frm)
	 {
	 	HideLoader();
	 	B.HideAlerts();
 		 	
 		if(data.login){
 			return HandleLogin(data);
 		}

		if(data.error){
			ShowError(data.error, data.container);
		}
		if(data.success){
			ShowSuccess(data.success, data.container);
			HidePopup();
		}
		if(data.redirect){
			window.location = data.redirect;
			
		}
		if(data.hash){
			window.location.hash=data.hash;
			return;
		}
		if(data.refresh){
			location.reload(true);
		}
		if(data.back){
			history.back();
		}
		if(data.list){
			$("#list").html(data.list);

			//set sort flags
			dir=$("#sort_dir").val();
			col=$("#sort_col").val();
			if(col){
				var s = dir=='desc' ? '&#9662;' : '&#9652;';
				$('a[onclick="Sort(\''+col+'\')"]').append(s);
			}
		}
		if(data.hide)
		{
			$(frm).hide();
		}
		if(data.callback){
			eval(data.callback);
		}
		if(data.reset){
			frm.reset();
		}
		if(data.popup){
            $("#modal").html(data.popup).modal();
            HideLoader();
        }
        if(data.hide_popup){
        	HidePopup();
        }

		$(".error, .err").html('');
		$(".border_red", frm).removeClass('border_red');
		if(data.errors){

			for(key in data.errors)
			{
				index = key.replace('[]', '');				
				$(".err_"+index, frm).html(data.errors[key]);
				$("[name='"+key+"']", frm).addClass('border_red');
			}

			$(".border_red:first", frm).focus();
		}
		if(data.count){
			$(".cart-count").text(data.count);
		}

	 }

	function ShowError(message, container)
	{
		if(container == null) {
			if($("#modal").is(":visible")){
				container = "#info";
			}
			else{
				container = "#message";
			}
		}
		$(container).hide().html(
			'<div class="alert alert-danger">'+
			'<button type="button" class="close">×</button>'+
			'<h4><i class="glyphicon glyphicon-remove-circle"></i> Error</h4>'+
				message+
			'</div>'
		).fadeIn(1000);
		HideLoader();
		InitObjects(container);
	}

	 function ShowSuccess(message, container)
	 {

	 	if(container == null) container = "#message";
        $(container).hide().html(
        	'<div class="alert alert-success">'+
        	'<button type="button" class="close">×</button>'+
        	'<h4><i class="glyphicon glyphicon-ok-sign"></i> Success</h4>'+
        		message+
        	'</div>'
        ).fadeIn(1000);
		InitObjects(container);
	 }
	 function ShowAjaxError(data)
	 {
	 	$("#debug").html('');
        alert("Ajax error occured: \nPage Status: " + data.status +"\nStatus Text: "+data.statusText);
		$("#debug").html(data.responseText);
		HideLoader();
	 }
	 function InitObjects(container)
	 {
        $(".alert .close").click(function(){$(this).parent().fadeOut('slow')});
		$("#debug").html('');

		if(container){
	    	$('html, body').animate({scrollTop: $(container).offset().top-100}, 500);	
		}

     }

	 function ShowLoader()
	 {	
	 	$("#loader").show();
	 }
	
	function HideLoader()
	{		
		$("#loader").hide();
	}

	function HidePopover()
	{
		$(".popover").hide();
	}

    function SimpleDelete(id, obj, url)
	{		
		ConfirmDelete.id = id;
		ConfirmDelete.obj = obj;
		ConfirmDelete.url = url;
		var content = '<button class="btn btn-primary" onclick="ConfirmDelete()">Yes</button> '+
					'<button class="btn btn-default" onclick="HidePopover()">No</button>';
		$(obj).prop('title', 'Are you sure?').popover({html:true, placement:'top', content:content, trigger:'manual'}).popover('show');
		
	}
	function ConfirmDelete()
	{
		var id = ConfirmDelete.id;
		var obj = ConfirmDelete.obj;
		var url = ConfirmDelete.url;
		
		$.post(
		url,
		{id:id, csrf:csrf},
		function(data){
			if(data.success){
				ShowSuccess(data.success);
				$(obj).parent().parent().fadeOut('500');
			}
			if(data.error){
				ShowError(data.error);
			}
		},
		"json"
		);	 	
	}

	function SimpleActivate(id, obj, url)
	{
		var ok = 'glyphicon-ok';
		var off = 'glyphicon-off';

		$.post(
			url,
			{id:id, csrf:csrf},
			function(data){
			 	if(data==1)
				{
					if($(obj).hasClass(ok)){
						$(obj).removeClass(ok);
						$(obj).addClass(off);
					}
					else{
						$(obj).removeClass(off);
						$(obj).addClass(ok);
					}				
				}
				else{
					$("#debug").html(data);
				}
				ShowResults(data);
			},
			"json"
		 );
	}

	function Sort(column)
	{
		dir=$("#sort_dir").val();
		col=$("#sort_col").val();
		if(col==column)
		{
			if(dir=="asc")
				dir="desc";
			else
				dir="asc";
		}
		$("#sort_col").val(column);
		$("#sort_dir").val(dir);
		SendFilter();
	}

	function SendFilter(frm){
		ShowLoader();
        if (frm == null) frm = $("#filter_form");
		SendForm(frm);
	}

	function Popup(uri, params)
	{	
		$("#modal").load(index_url+uri, params, function(){
			OpenPopup();			
		})
	} 

	function HidePopup()
	{
		$('#modal').modal('hide');
	}
	function OpenPopup()
	{
		$('#modal').modal();
	}

	function InitAutogrow()
	{
		//autogrow textareas and count chars
		var autogrow = $('textarea.autogrow');
		if(autogrow.size()){
			$.getScript(base_url+"assets/admin/js/charCount.js", function(data, textStatus, jqxhr) {
			   $(autogrow).autogrow();
			   	
			   	$.each(autogrow, function(){
					var limit = $(this).attr('maxlength');
					if(limit){
						$(this).charCount({allowed:limit})
					}	
				})
			});
		}
	}

	function HidePopover()
	{
		$(".popover").hide();
	}

	function Confirmation(btn) 
	{
		DoAction.href = $(btn).attr('href');
		DoAction.action = $(btn).data('action');
		DoAction.elm = btn;

		var content = '<button type="button" class="btn btn-primary" onclick="DoAction()">Yes</button> '+
					'<button type="button" class="btn btn-default" onclick="HidePopover()">No</button>';
		$(btn).prop('title', 'Are you sure?').popover({html:true, placement:'top',  container: 'body', content:content, trigger:'manual'}).popover('show');
		
		return false;
	}

	function DoAction() 
	{
		if(DoAction.href){
			window.location.href = DoAction.href;
		}		
		if(DoAction.action){
			window[DoAction.action](DoAction.elm);			
		}
		HidePopover();
	}

	function PopupWindow(url, title, w, h) {
	  if(!w){w=640;}
	  if(!h){h=480;}
	  var left = (screen.width/2)-(w/2);
	  var top = (screen.height/2)-(h/2);
	  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	} 


$(document).ready(function(){	



	//use some general shortcuts, for adding an item(F4), edit(F2), or cancel(Esc)
	var shortcuts = {115:'add', 113:'edit', 27: 'cancel'};
	$(document).bind('keydown', function(event) {			

		if(typeof(shortcuts[event.keyCode])!='undefined'){
			var href = $('#'+shortcuts[event.keyCode]).attr('href');
			if(href){
				document.location =href;		
			}
		}		
	});  

	//hide,show hints
	$("form .hint").hide();
	$("input, textarea, select", "form").on('focus', function(){
		$(this).parent().find('.hint').show();
	})
	.on('blur', function(){
		$(this).parent().find('.hint').hide();
	});
	
	
	InitObjects();

	InitAutogrow();	


	//click on save from modal
	$("#modal .save").click(function(){
		$("#modal form").submit();
	})
	
	$('#modal').on('hidden', function() {
    	$(this).removeData('modal');
	});


	//check hidden blocks
	var hash = window.location.hash;
	if($(hash).not("visible")){

		$(hash).addClass('collapse-in').removeClass('collapse');
	}

	

	//load masked input plugin if required
	var $mask = $('input[data-mask]');	
	if($mask.size()){
		$.getScript(base_url+"assets/admin/js/jquery.maskedinput-1.3.min.js", function(data, textStatus, jqxhr) {
			$mask.each(function(){
				$(this).mask($(this).attr('data-mask'));
			})
		   //$mask.mask($mask.attr('data-mask'));		
		});
	}

	//load chosen plugin if required
	var $chosen = $(".chosen");
	if($chosen.size()){
		//$('head').append('<link rel="stylesheet" href="'+base_url+'assets/js/chosen/chosen.css" type="text/css" />');

		$.getScript(base_url+"assets/js/jquery.chosen.min.js", function(data, textStatus, jqxhr) {
			$chosen.chosen();	   		
		});
	}

	//load jquery ui calendar
	var $date = $('.date');
        var $standard_date = $('.standard_date');
        var $date_of_birth = $('.date_of_birth');
	if($date.size() /*&& typeof(jQuery.ui) !='undefined'*/){
		
		//$('.date').datepicker({dateFormat: "dd M yy", changeMonth:true, changeYear: true, yearRange: "-100:+0"});		 	
		
		$('head').append('<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" type="text/css" />');
		$.getScript("//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js", function(data, textStatus, jqxhr) {
		 	$('.date').datepicker({dateFormat: "dd/mm/yy"});		 	
		});	
	}
        if($date_of_birth.size()){
		$('head').append('<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" type="text/css" />');
		$.getScript("//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js", function(data, textStatus, jqxhr) {
                        $('.date_of_birth').datepicker({dateFormat: "dd/mm/yy", changeMonth:true, changeYear: true, yearRange: "-100:+0",maxDate: 0});		 	
		});	
	}
        
        if($standard_date.size()){
		$('head').append('<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" type="text/css" />');
		$.getScript("//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js", function(data, textStatus, jqxhr) {
                        $('.standard_date').datepicker({dateFormat: "dd/mm/yy", changeMonth:true, changeYear: true, yearRange: "-20:+10"});		 	
		});	
	}

	
	//charcters count for simple inputs
	$('form .limited').each(function () {    
		$input = $(this);                                                                   
	    maxLength = $input.data('maxlength');
	    remaining = maxLength - $input.val().length;                               
	    $input.wrap("<div class='input-group'></div>");         
	  	$('<span class="input-group-addon" id="' + this.id + '-counter">'+maxLength+'</span>').insertAfter(this); 
	  	if($input.attr('autofocus')){
	  		$input.focus();
	  	}
	}); 

	$('form .limited').on('keyup', function() {                                                   
	  var $element = $(this),
	    maxLength = $element.data('maxlength');
	  	$("#" + this.id + "-counter").text(maxLength - $element.val().length);
	});


	// for comments not required, done with css
	/*$('.media').on('mouseenter', function(){
		$(".comm-options", $(this)).show();
	})
	.on('mouseleave', function(){
		$(".comm-options", $(this)).hide();
	})*/


});



//create namespace 
var B = B || {};

B.RelatedDropdowns = function(elm, dest_id, action_url, options_cache, params)
{

	var form = $(elm).closest("form");
	var dest = $(dest_id, form);
	var value = $(elm).val();

	if(!value){
		return $(dest).html('');
	}

	
	$(dest).attr('disabled',true).html('');
	$(dest).append('<option value="">Loading...</option>');

	if(!options_cache[value]){
		$.get(
			action_url,
			params,
			function(data){
				$(dest).attr('disabled',false).val('');
				var html="";
				for (var id in data){
					html+='<option value='+id+'>'+data[id]+'</option>';
				}
				options_cache[value] = html;
				$(dest).html(html);	
						
			},
			'json'
		);
	}
	else{
		$(dest).attr('disabled',false).val('');
		$(dest).html(options_cache[value]);	
	}	
	$(dest).trigger('change');
}


B.cities_cache = {};
B.SetCities = function(elm)
{			
	var action_url = index_url+'ajax/json_cities'; 		
	var params = {country_code: $(elm).val(), csrf: csrf};		
	B.RelatedDropdowns(elm, "[name=city_id]", action_url, B.cities_cache, params);
}


B.Collapse = function (obj){
	$(obj).closest('.in').collapse('hide');
	window.location.hash=''; //remove hash
	this.HideAlerts();
}

B.HideAlerts = function(){
	$(".alert-danger").parent().html('');
}


B.log = function(message, level) {
    if (window.console) {
        if (!level || level === 'info') {
            window.console.log(message);
        }
        else
        {
            if (window.console[level]) {
                window.console[level](message);
            }
            else {
                window.console.log('<' + level + '> ' + message);
            }
        }
    }
};

B.UpdateDropdown = function(dest, data){
	
	var html="";
	for (var id in data){
		html+='<option value="'+id+'">'+data[id]+'</option>';
	}
	
	$(dest).html(html);				
}


B.offset=0;
B.LoadMore = function(btn, limit, type){

	B.offset += limit;
	$.get(
		index_url + type,
		{offset:B.offset}, 
		function(data){			
			$(".items:visible").append(data);	
			var count =  $(btn).data('count');
			if(count <= B.offset+limit ){				
				$(btn).remove();
			}			
		}
	)
}

B.ActivateMenu = function(url)
{
	if(!url){
		url = location.origin + location.pathname;
	}

	$a = $("#sidebar .nav a[href='"+url+"']");
	if($a.length == 0)
	{		
		url = url.substr(0, url.lastIndexOf('/'));	
		if(url){
			return B.ActivateMenu(url);
		}
	}
	else{
		$a.closest('li').addClass('active');
		$a.closest('.has-sub').addClass('active');
	}			
}

B.Alert = function(message, title){

	$("#alert-modal").modal();
	$("#alert-message").html(message);
	if(title){
		$("#alert-title").html(title);
	}
}

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}