/******************************** For Validation  *********************************************************/
$.extend({URLEncode:function(c){var o='';var x=0;c=c.toString();var r=/(^[a-zA-Z0-9_.]*)/;
while(x<c.length){var m=r.exec(c.substr(x));if(m!=null && m.length>1 && m[1]!='')
{o+=m[1];x+=m[1].length;}else{if(c[x]==' '){o+='+';}
else{var d=c.charCodeAt(x);var h=d.toString(16);o+='%'+(h.length<2?'0':'')+h.toUpperCase();}x++;}}return o;},
URLDecode:function(s){var o=s;var binVal,t;var r=/(%[^%]{2})/;while((m=r.exec(o))!=null && m.length>1 && m[1]!='')
{b=parseInt(m[1].substr(1),16);t=String.fromCharCode(b);o=o.replace(m[1],t);}return o;}});
/******************************** FOR CKEDITOR  *********************************************************/
function  GetEditor()
{
	var config = 
	{
		enterMode : CKEDITOR.ENTER_BR, height:250,width:935, filebrowserBrowseUrl: SITEURL+'/lib/ckeditor/filemanager/browse-file.php',
		toolbar_Full:[
		['Bold','Italic','Underline','Strike'],['Styles','Format','Font','FontSize'],['TextColor','BGColor'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		'/',
		['Image','Table','HorizontalRule'],['NumberedList','BulletedList'],['Source'],
		['Link','Unlink','Anchor']]
		
	};$('.editor').ckeditor(config);
}
function  MiniEditor()
{
	var config = 
	{
		enterMode : CKEDITOR.ENTER_BR, height:150,width:620, filebrowserBrowseUrl: SITEURL+'/lib/ckeditor/filemanager/browse-file.php',
		toolbar_Full:[
		['Bold','Italic','Underline','Strike'],['Styles','Format','Font','FontSize'],['TextColor','BGColor'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		'/',
		['Image','Table','HorizontalRule'],['NumberedList','BulletedList'],['Source'],
		['Link','Unlink','Anchor']]
		
	};$('.editor').ckeditor(config);
}
function  ResponsiveEditor()
{
	var config = 
	{
		enterMode : CKEDITOR.ENTER_BR, height:200,filebrowserBrowseUrl: SITEURL+'/lib/ckeditor/filemanager/browse-file.php'		
	};
	config.removeButtons = 'Print,Preview,NewPage,Save,Templates,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField';
	$('.editor').ckeditor(config);
}
