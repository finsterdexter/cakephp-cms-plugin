<?php echo $javascript->link('tiny_mce/tiny_mce', false); ?>
<?php echo $javascript->link('tiny_mce/plugins/tinybrowser/tb_tinymce.js.php?', false); ?>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,style,table,advhr,advimage,advlink,iespell,media,searchreplace,print,contextmenu,paste,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",
		// Theme options
		theme_advanced_buttons1 : "bold,italic,strikethrough,|,justifyleft,justifyright,justifyfull,|,formatselect,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,media,cleanup,help,code",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "/css/editor.css",

		// Drop lists for link/image/media/template dialogs
		// template_external_list_url : "lists/template_list.js",
		// external_link_list_url : "lists/link_list.js",
		// external_image_list_url : "lists/image_list.js",
		// media_external_list_url : "lists/media_list.js",

		file_browser_callback : "tinyBrowser"
	});
</script>
