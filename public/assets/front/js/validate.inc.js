var VERR = new Array();
var VEXT = new Array();
var VMSG = {
    isBlank    : 'cannot be blank',
    isEmail    : 'is not a valid Email ID',
	isName     : 'should be more that four characters, can contain only letters and numbers and space',
	isPassword : 'should be alphanumeric and contain no space',
    isNumber   : 'should be number[0-9]',
	isMobile   : 'is not valid Mobile Number',
	isEmpty    : 'cannot be blank',
	isImage    : 'is not a image',
	isGreater  : 'should be greater than',
	isLess     : 'should be less than',
	isEqual    : 'should be same as your Password',
	isUrl      : 'is not a valid url',
	isDoc      : 'is not a document',					
};
function isBlank(val) {	var newval = val.replace(/^\s*|\s*$/g, '');	if(newval == "") return false; else return true;}
function isEmail(val) {if(val == ""){return true;}else{var newval = val.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/);	if(newval == -1) return false; else return true;}}
function isName(val) {if (val.length < 4) { return false; } else if(!val.match(/^[a-z0-9 ]+$/i)) { return false; } else { return true; }}
function isPassword(val) { var illegalChars = /^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9!@#$%^&*]{5,20}$/;if (val.length < 5) { return false;	} else if (!illegalChars.test(val)){return false;}else{return true;}}
function isNumber(val) {if(isNaN(val)) return false; else return true; }
function isMobile(val){	if (isNaN(val) || val.length != 10) { return false;	} else { return true; }}
function isEmpty(val) {	var newval = val.replace(/^\s*|\s*$/g, '');	if(newval == "") return false; else return true;}
function isImage(val){if(val == ""){return true;}else{var val=val.toLowerCase();if(val.match(/(?:gif|jpg|jpeg|png|bmp)$/)){return true;}else{return false;}}}
function isGreater(val1,val2) {	if(val1 <= val2) return true; else return false; }
function isLess(val1,val2) { if(val1 >= val2) return true; else return false; }
function isEqual(val1,val2) { if(val1 == val2) return true; else return false; }
function isUrl(val){if(val == ""){return true;}else{var newval = val.replace(/^\s*|\s*$/g, '');var regExp = /(http(s)?:\\)?([\w-]+\.)+[\w-]+[.com|.in|.org]+(\[\?%&=]*)?/;if (regExp.test(val)) return true;else return false;}}
function isDoc(val){if(val == ""){return true;}else{var val=val.toLowerCase();if(val.match(/(?:gif|jpg|png|bmp|doc|docx|xls|xlsx|pdf)$/)){return true;}else{return false;}}}
function callVfunc(func,elem){}
function validateForm(frm){	
	var flg = 0;
	var strV = frm.mxValidate.value;
	if(strV) {		
		VERR = jQuery.parseJSON($.URLDecode(strV));
		if(VEXT) {
			for (var prop in VEXT) {
				if (VEXT.hasOwnProperty(prop)) {
					VERR[prop] = VEXT[prop];
				}
			}
		}
				
		$(frm).find('p').remove();
		$.each(VERR, function(elem, strFuns) {
			if(strFuns){
				var arrFuns = strFuns.split(",");
				var obj = $(frm).find("[name='"+elem+"']");
				$.each(arrFuns, function(k, vFunc) {
					if(vFunc){						
						var strF = vFunc.split(":");
						fun = window[strF[0]]
						if(fun) {
							if(strF[1]){
								var func = window[strF[0]];
								if (typeof func == "function"){
									var tObj = $("#"+elem+"-set");																		
									if(tObj.length) {
										obj = tObj;										
										if(!func(obj,strF[1])){
											flg++; var sMsg = "";
											if(strF[1] > 1){ sMsg = " "+strF[1]+" "; }
											var msg = $("<p class='e'>"+VMSG[strF[0]]+sMsg+" "+obj.attr("title")+"</p>").hide();					
											var errorMsg=obj.attr("error-msg");											
											if (typeof errorMsg !== typeof undefined && errorMsg !== false) {
												var msg = $('<p class="e">'+ errorMsg +'</p>').hide();																	
											}											
											msg.appendTo(obj.parent()).slideDown();					
										}
										
									} else {
										var cObj = $(frm).find("[name='"+strF[1]+"']");
										if(cObj.length) {
											if(!func(obj.val(),cObj.val())){
												flg++;
												
												
												var msg = $('<p class="e">'+obj.attr("title")+" "+VMSG[strF[0]]+'</p>').hide();					
												var errorMsg=obj.attr("error-msg");											
												if (typeof errorMsg !== typeof undefined && errorMsg !== false) {
													var msg = $('<p class="e">'+ errorMsg +'</p>').hide();																	
												}											
												msg.appendTo(obj.parent()).slideDown();					
											}
										}
									}
								}
							} else {								
								if(obj.length) {									
									if(!fun(obj.val())){
										flg++;									
										var msg = $('<p class="e">'+obj.attr("title")+" "+VMSG[vFunc]+'</p>').hide();					
										var errorMsg=obj.attr("error-msg");											
										if (typeof errorMsg !== typeof undefined && errorMsg !== false) {
											var msg = $('<p class="e">'+ errorMsg +'</p>').hide();																	
										}										
										msg.appendTo(obj.parent()).slideDown();					
									}
								}
							}
						}										
					}
				});
			}
		});
	}
	if(flg == 0)
		return true;
	else
		return false;
}