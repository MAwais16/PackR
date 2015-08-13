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
					$_SESSION["user_package"]=$package;
					return $this->getSecondForm($http);
				}else{
					return $this->getFirstForm(true,__("Please select a Package","PackR"));
				}
			}else if($http->get("step")=="2"){
				//validate fields
				return $this->validateInput($http);


			}
			
		}else{
			return "method not supported";
		}
	}

	function validateInput(Http $http){
		$email=$http->get("email");
		$password=$http->get("password");
		$confirmPassword=$http->get("confirmPassword");
		$companyName=$http->get("companyName");
		$firstName=$http->get("firstName");
		$lastName=$http->get("lastName");
		$street=$http->get("street");
		$postalCode=$http->get("postalCode");
		$city=$http->get("city");
		$country=$http->get("country");
		$extraAddress=$http->get("extraAddress");
		$message=$http->get("message");

		$accountNumber=$http->get("accountNumber");
		$iban=$http->get("iban");
		$bic=$http->get("bic");

		$ustID=$http->get("ustID");

		$resp=array();

		
		if($this->isStrEmpty($email)){
			$resp['email'][0]=true;
			$resp['email'][1]=__("required","PackR");
		}else if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$resp['email'][0]=true;
			$resp['email'][1]=__("is invalid","PackR");
		}else{
			$resp['email'][0]=false;
			$resp['email'][2]=$email;
		}

		if($this->isStrEmpty($password)){
			$resp['password'][0]=true;
			$resp['password'][1]=__("required","PackR");
		}else if ($this->isStrEmpty($confirmPassword)) {
			$resp['confirmPassword'][0]=true;
			$resp['confirmPassword'][1]=__("required","PackR");
		}else if(!(strcmp($password, $confirmPassword)==1)){
			$resp['confirmPassword'][0]=true;
			$resp['password'][0]=true;
			$resp['confirmPassword'][1]=__("not matched","PackR");
			$resp['password'][1]=__("not matched","PackR");;
		}else{
			$resp['confirmPassword'][0]=false;
			$resp['password'][0]=false;
		}

		if($this->isStrEmpty($companyName)){
			$resp['companyName'][0]=true;
			$resp['companyName'][1]=__("required","PackR");
		}else{
			$resp['companyName'][0]=false;
			$resp['companyName'][2]=$companyName;
			
		}

		if($this->isStrEmpty($firstName)){
			$resp['firstName'][0]=true;
			$resp['firstName'][1]=__("required","PackR");
		}else{
			$resp['firstName'][0]=false;
			$resp['firstName'][2]=$firstName;
			
		}

		if($this->isStrEmpty($lastName)){
			$resp['lastName'][0]=true;
			$resp['lastName'][1]=__("required","PackR");
		}else{
			$resp['lastName'][0]=false;	
			$resp['lastName'][2]=$lastName;
			
		}

		if($this->isStrEmpty($street)){
			$resp['street'][0]=true;
			$resp['street'][1]=__("required","PackR");
		}else{
			$resp['street'][0]=false;
			$resp['street'][2]=$street;
			
		}

		if($this->isStrEmpty($city)){
			$resp['city'][0]=true;
			$resp['city'][1]=__("required","PackR");
		}else{
			$resp['city'][0]=false;
			$resp['city'][2]=$city;
			
		}

		if($this->isStrEmpty($postalCode)){
			$resp['postalCode'][0]=true;
			$resp['postalCode'][1]=__("required","PackR");
		}else{
			$resp['postalCode'][0]=false;
			$resp['postalCode'][2]=$postalCode;
			
		}


		//payment detail validation

		if($this->isStrEmpty($accountNumber)){
			$resp['accountNumber'][0]=true;
			$resp['accountNumber'][1]=__("required","PackR");
		}else{
			$resp['accountNumber'][0]=false;
			$resp['accountNumber'][2]=$accountNumber;
			
		}


		if($this->isStrEmpty($accountNumber)){
			$resp['bic'][0]=true;
			$resp['bic'][1]=__("required","PackR");
		}else{
			$resp['bic'][0]=false;
			$resp['bic'][2]=$bic;
			
		}

		if($this->isStrEmpty($accountNumber)){
			$resp['iban'][0]=true;
			$resp['iban'][1]=__("required","PackR");
		}else{
			$resp['iban'][0]=false;
			$resp['iban'][2]=$iban;
			
		}

		$process = true;
		foreach ($resp as $item) {
			//error_log("asdasd:".$item[0]);
			$process = $process && (!$item[0]);
		}

		if($process){
			//process data
		}else{

			return $this->getSecondForm($http,true,$resp);
		}

	}

	public function isStrEmpty($str){
		$str = trim($str);
		return !(strlen($str) > 0);
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

	function getSecondForm(Http $http,$error=false,$resp=array()){
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
			'bt_submit'=> __("Proceed to Order Summary","PackR"),
			'error'=>$error,
			'resp'=>$resp

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