/*custom js*/



if(window.PackR == undefined){
    window.PackR = {};
}

PackR.initRadiosClick=function(){
	jQuery(".package").click(function(){
		jQuery(this).find("input[type=radio]").prop("checked",true);
		jQuery(".packImg").css("opacity",0.4);
		jQuery(this).find(".packImg").css("opacity","1");
	});
}


