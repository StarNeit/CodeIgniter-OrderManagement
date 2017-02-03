<!--tinymce -->
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>

<script>
	
	var readonly = <?=isset($readonly) && $readonly ? 1 : 0?>

	tinymce.init({
		selector: "textarea#tinyeditor",
		theme: "modern",			
		autoresize_max_height: 1500,
		document_base_url : base_url,
	  	content_css : "assets/admin/css/editor.css",		
		plugins: [
			 "advlist autolink link image lists charmap print preview hr anchor pagebreak",
			 "searchreplace wordcount visualchars code fullscreen insertdatetime media nonbreaking",
			 "save contextmenu directionality emoticons template paste textcolor autoresize image table"
	   ],
	    toolbar: "undo redo bold italic| alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media code",	
      document_base_url : base_url,
	  	browser_spellcheck : true,
		contextmenu: false,
		readonly : readonly
	 }); 

</script>

