$(document).ready(function (){	

});
function MemberLogin(frm){
	if(validateForm(frm)){
		jQuery('body').showLoading();
		$('#'+frm.name).ajaxSubmit({url:SITEURL+'/home',beforeSubmit: function (formData, jqForm,options){
			var queryString = $.param(formData);
		},clearForm: false,resetForm: false,success: function (responseText, statusText, xhr, $form){
			jQuery('body').hideLoading();
			result = JSON.parse(responseText);						
			if (result["Status"] == "true") {
				window.location=result["Redirect"];
			} else {		
				$.Zebra_Dialog('<strong>'+result["Message"], {'type':'error','title':'Error'});
			}$('#'+frm.name)[0].reset();
		}});
	}return false;
}
function SubmitForm(frm){
	if(validateForm(frm)){
		jQuery('body').showLoading();
		$('#'+frm.name).ajaxSubmit({url:SITEURL+'/home',beforeSubmit: function (formData, jqForm,options){
			var queryString = $.param(formData);
		},clearForm: false,resetForm: false,success: function (responseText, statusText, xhr, $form){
			jQuery('body').hideLoading();
			result = JSON.parse(responseText);			
			if (result["Status"] == "true") {
				if(result["Redirect"]!=""){
					$.Zebra_Dialog('<strong>'+result["Message"], {'type':'confirmation','title':'Confirmation','buttons': ['OK'],'onClose':  function(caption){
						if(caption=='OK'){
							window.location=result["Redirect"];
						}
					}});
				}else{
					$.Zebra_Dialog('<strong>'+result["Message"], {'type':'confirmation','title':'Confirmation'});
				}
			} else {
				$.Zebra_Dialog('<strong>'+result["Message"], {'type':'error','title':'Error'});
			}
			
			$('#'+frm.name)[0].reset();
		}});
	}return false;
}