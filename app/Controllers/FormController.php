<?php namespace PackR\Controllers;

//https://github.com/christabor/css-progress-wizard

/** @var \Herbert\Framework\Http $http */

use \Herbert\Framework\Http;
//use \Herbert\Framework\Notifier;

class FormController{

	
	public function getForm(Http $http){
		if(strcasecmp($http->method(), "GET")==0){
			return $this->getFirstForm();
		}else if(strcasecmp($http->method(), "POST")==0){
			if($http->get("step")=="1"){
				if($http->has("package")){
					return $this->getSecondForm($http);
				}else{
					return $this->getFirstForm(true,__("Please select a Package","PackR"));
				}
			}else{

			}
			
		}else{
			return "method not supported";
		}
	}
	
	public function getFirstForm($err=false,$errDetail=""){
		$steps= $this->getSteps(1);
		

		$q= __("Which version of vislog you would like to you use?","PackR");

		$term= __("Period of Validity","PackR");
		$termInfo= __("The subscription is initially for one year and will be automatically extended for another year unless written notice is given within 4 weeks before year ends","PackR");
		
		$formButton=__("Go to Address & Payment","PackR");

		return view('@PackR/form-base.twig.html', [
    		'steps'   => $steps,
    		'form1Submit'=>$formButton,
    		'qLabel' => $q,
    		'term'=>$term,
    		'termInfo'=>$termInfo,
    		'form'=> "@PackR/form1.twig.html",
    		'error'=> $err,
    		'errorDescription'=>$errDetail
		]);
	}

	function getSecondForm(Http $http,$err=false,$errDetail=""){
		$steps= $this->getSteps(2);

		$title=__("Address & Payment","PackR");
		$titleDescription = __("Please fill in your billing, address and your payment details.","PackR");

		return view('@PackR/form-base.twig.html', [
    		'steps'   => $steps,

    		'title'=>$title,
    		'titleDescription' => $titleDescription,
    		'form'=> "@PackR/form2.twig.html",
    		'titleAccount'=> __("Account","PackR"),
    		'emailLabel'=> __("Email","PackR"),
    		'passwordLabel'=> __("Password","PackR"),
    		'confirmPasswordLabel'=> __("Confirm Password","PackR"),
    		'title2'=> __("Billing and Shipping Address","PackR"),
    		'companyNameLabel'=> __("Company Name","PackR"),
    		'firstNameLabel'=> __("First Name","PackR"),
    		'streetLabel'=> __("Street Address","PackR"),
    		'postalCodeLabel'=> __("Postal Code","PackR"),
    		'cityLabel'=> __("City","PackR"),
    		'extraAddLineLabel'=> __("Extra address line (Optional)","PackR"),
    		'tittleMessageBox'=> __("Message","PackR"),
    		'textArealabel'=> __("write your message here","PackR"),
    		'title3'=> __("Payment","PackR"),
			'paymentM1'=> __("SEPA Direct Debit","PackR"),
			'accountNumberLabel'=> __("Account Number","PackR"),
			'ibanLabel'=> __("IBAN","PackR"),
			'bicLabel'=> __("BIC","PackR"),
			'foreignLic'=> __("UST-IdNr. (for foreign corporate clients)","PackR"),
			'bt_submit'=> __("Proceed to Order Summary","PackR")
    		
		]);

	}

	function getSteps($step=0){
		$arr= array(
			array(__("Select Product","PackR"),false),
			array(__("Account & Billing","PackR"),false),
			array(__("Overview","PackR"),false),
			array(__("Confirmation","PackR"),false)
		);

		for($i=0;$i<$step;$i++){
			$arr[$i][1]=true;
		}

		return $arr;
	}

} 