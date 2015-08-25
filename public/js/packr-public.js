/*custom js*/



if(window.PackR == undefined){
    window.PackR = {};
}

PackR.selectedPackage="basic";

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
            jQuery(".voucher-price").text("39 €");
            PackR.selectedPackage="basic";
        }
    });

    jQuery('#radio-professional').change(function(){
        if (jQuery(this).is(':checked')) {
            jQuery(".voucher-price").text("69 €");
            PackR.selectedPackage="professional";
        }
    });

}

PackR.onVoucherSubmit=function(){

	var data = {
		'action': 'packr_voucher_validate',
		'voucher_code': jQuery("#voucher_code").val(),
		'package': PackR.selectedPackage
	};
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	jQuery.post(ajax_object.ajax_url, data, function(response) {
		var resp=JSON.parse(response);
		if(resp.valid){
			jQuery("#bt_voucher").hide();
			jQuery("#voucher_code").attr("disabled","disabled");
			jQuery(".voucher_result").removeClass("bg-danger");
			jQuery(".voucher_result").addClass("bg-success");
		}else{
			jQuery(".voucher_result").addClass("bg-danger");
			jQuery(".voucher_result").removeClass("bg-success");	
		}
		jQuery(".voucher_result").html(resp.desc);
		
	});
	return false; //so form is not submit
}

//called from footer-row.php
PackR.onReady=function(){
	
	jQuery(document).ready(function(){

		var modal=jQuery(".modals");
		jQuery(".modals").remove();
		jQuery("body").append(modal);

	});

}


