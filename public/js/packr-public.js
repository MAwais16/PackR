/*custom js*/



if(window.PackR == undefined){
    window.PackR = {};
}

PackR.initRadiosClick=function(){
	
	jQuery("#radio-basic").prop("checked",true);
	jQuery("#radio-professional").parent().parent().siblings(".packImg").css("opacity",0.4);
	jQuery(".package").click(function(){
		jQuery(this).find("input[type=radio]").prop("checked",true);
		jQuery(".packImg").css("opacity",0.4);
		jQuery(this).find(".packImg").css("opacity","1");
		jQuery(this).find("input[type=radio]").change();
	});

	jQuery('#radio-basic').change(function(){
        if (jQuery(this).is(':checked')) {
            jQuery(".voucher-price").text("39 Euro");
        }
    });

    jQuery('#radio-professional').change(function(){
        if (jQuery(this).is(':checked')) {
            jQuery(".voucher-price").text("69 Euro");
        }
    });

}


