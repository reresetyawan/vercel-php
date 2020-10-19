tinyMCE.init({
	mode : "textareas",
	//mode : "exact",
	//elements : "loko",
	theme : "advanced",

	plugins : "youtubeIframe,advcode,syntaxhl,pagebreak,style,layer,table,save,advhr,advimage,advlink,insertdatetime,preview,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave,print,media",

	// Theme options
	theme_advanced_buttons1 : "save,|,newdocument,|,bold,|,italic,|,underline,|,strikethrough,|,blockquote,|,justifyleft,|,justifycenter,|,justifyright,|,justifyfull,|,bullist,|,numlist,|,link,|,unlink,|,image,|,inserttime,|,media,|,ltr,|,rtl",
	theme_advanced_buttons2 : "tablecontrols,|,charmap,|,hr,|,undo,|,redo,|,preview,|,sub,|,sup,|,pagebreak,|,nonbreaking,|,fullscreen,code", // template,
	theme_advanced_buttons3 : "forecolor,|,backcolor,fontselect,fontsizeselect,styleselect,|,search,|,replace,|,cut,|,copy,|,paste,|,youtubeIframe,|,advcode,|,syntaxhl",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	file_browser_callback : 'openKCFinder',
	
	// Example content CSS (should be your site CSS)
	//content_css : "../style.css",

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "../tiny_mce/lists/template_list.js",
	theme_advanced_resizing : true
	
	
});

function openKCFinder(field_name, url, type, win) {
    tinyMCE.activeEditor.windowManager.open({
        file: '../kcfinder/browse.php?opener=tinymce&type=' + type,
        title: 'KCFinder',
        width: 700,
        height: 500,
        resizable: "yes",
        inline: true,
        close_previous: "no",
        popup_css: false
    }, {
        window: win,
        input: field_name
    });
    return false;
}
