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
    		'form1Submit'=>$formButton,
    		'qLabel' => $q,
    		'term'=>$term,
    		'termInfo'=>$termInfo,
    		'form'=> "@PackR/form2.twig.html"
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