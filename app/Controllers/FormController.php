<?php namespace PackR\Controllers;

//https://github.com/christabor/css-progress-wizard

/** @var \Herbert\Framework\Http $http */

use \Herbert\Framework\Http;
use PackR\Helper;
use PackR\Models\Order;
//use \Herbert\Framework\Notifier;


class FormController{
	public $logoSrc;
	
	public function getForm(Http $http){
		$this->logoSrc =Helper::assetUrl("/images/vislog_logo.png");
		if(strcasecmp($http->method(), "GET")==0){
			return $this->getFirstForm();
		}else if(strcasecmp($http->method(), "POST")==0){
			if($_SESSION['PackR_step']=="1"){
				if($http->has("package")){
					$_SESSION["PackR_package"]=$http->get("package");
					return $this->getSecondForm($http);
				}else{
					$_SESSION['PackR_step']=1;
					return $this->getFirstForm(true,__("Please select a Package","PackR"));
				}
			}else if($_SESSION['PackR_step']=="2"){
				return $this->validateInput($http);
			}else if($_SESSION['PackR_step']=="3"){
				
				if($http->get("terms")=="terms"){
					if($http->get("privacy")=="privacy"){
						
						//error_log("as=".Order::all());
						//return $this->getThirdForm($http);
						return $this->getForthForm($http);
					}else{
						return $this->getThirdForm($http,true,__("Please agree to Privacy Policy.","PackR"));
					}
				}else{
					return $this->getThirdForm($http,true,__("Please agree to Terms & conditions.","PackR"));
				}
			}else{
				$_SESSION['PackR_step']=1;
				return $this->getFirstForm();
			}
			
		}else{
			return "method not supported";
		}
	}







	public function getForthForm(Http $http,$err=false,$errDetail=""){

		$_SESSION['PackR_step']=4;
		$steps= $this->getSteps(4);

		//saving order from session

		$order = new Order;
		$order->email=$_SESSION["PackR_email"];
		$order->password=$_SESSION["PackR_password"];
		$order->company_name=$_SESSION["PackR_companyName"];
		$order->first_name=$_SESSION["PackR_firstName"];
		$order->last_name=$_SESSION["PackR_lastName"];
		$order->street=$_SESSION["PackR_street"];
		$order->postal_code=$_SESSION["PackR_postalCode"];
		$order->city=$_SESSION["PackR_city"];
		$order->country_code=$_SESSION["PackR_country"];
		$order->extra_address=$_SESSION["PackR_extraAddress"];

		$order->message=$_SESSION["PackR_message"];

		$order->account_number=$_SESSION["PackR_accountNumber"];
		$order->bic=$_SESSION["PackR_bic"];
		$order->iban=$_SESSION["PackR_iban"];
		$order->ust_id=$_SESSION["PackR_ustID"];

		$order->package=$_SESSION["PackR_package"];

		try{
			$order->save();
			if($order->id>0){
				return view('@PackR/form-base.twig.html', [
					'logoSrc'=>$this->logoSrc,
					'steps'   => $steps,
					'form'=> "@PackR/form4.twig.html",
					'error'=> false,
					'errorDescription'=>"",
					'title'=>__("Thank you!","PackR"),
					'desc1'=>__("Dear ","PackR"),
					'cname'=>$_SESSION['PackR_firstName']." ".$_SESSION['PackR_lastName'],
					'desc2'=>__("thank you for your order.","PackR")
					]);
			}else{
				return $this->getSecondForm($http,true,__("Ops, something went wrong, please try again","PackR"));
			}
		}catch(Exception $ex){
			return $this->getSecondForm($http,true,__("Ops, something went wrong, please try again","PackR"));
		}	

	}

	public function getThirdForm(Http $http,$err=false,$errDetail=""){
		$_SESSION['PackR_step']=3;
		$steps= $this->getSteps(3);

		$tax = 7;
		
		$price=39;


		$imgSrc=Helper::assetUrl("/images/basic.png");
		$package=$_SESSION['PackR_package'];
		if($package=="basic"){
			$price = 39;
			$imgSrc=Helper::assetUrl("/images/basic.png");
		}else{
			$price = 69;
			$imgSrc=Helper::assetUrl("/images/professional.png");
		}

		$taxPrice=$price*($tax/100);



		return view('@PackR/form-base.twig.html', [
			'logoSrc'=>$this->logoSrc,
			'steps'   => $steps,
			'form'=> "@PackR/form3.twig.html",
			'error'=> $err,
			'errorDescription'=>$errDetail,

			'title'=>__("Your order overview","PackR"),
			'title2'=>__("Billing Address","PackR"),

			'companyName'=>$_SESSION['PackR_companyName'],
			'firstName'=>$_SESSION['PackR_firstName'],
			'lastName'=>$_SESSION['PackR_lastName'],
			'street'=>$_SESSION['PackR_street'],
			'postalCode'=>$_SESSION['PackR_postalCode'],
			'city'=>$_SESSION['PackR_city'],
			'country'=>$_SESSION['PackR_country'],
			'email'=>$_SESSION['PackR_email'],

			
			'titleProduct'=>__("Product","PackR"),
			'productVal'=>$package,
			'productVal1'=>__("Vislog basic version subscription","PackR"),
			'productVal2'=>__("/year","PackR"),
			'productImageSrc'=>$imgSrc,


			'titlePrice'=>__("Price","PackR"),
			'priceVal'=>$price." €",

			'titleTax'=>__("Tax","PackR"),
			'taxVal'=>$tax."%",

			'titleTotalPrice'=>__("Total Price","PackR"),
			'totalPriceVal'=>$price." €",

			'titleShipping'=>__("Shipping","PackR"),
			'shippingVal'=>"0.00 €",

			'titleTotalNet'=>__("Total Net","PackR"),
			'totalNetVal'=>"$price €",

			'titlePlusVat'=>__("plus $tax % vat","PackR"),
			'plusVatVal'=>"$taxPrice €",

			'titleTotalGross'=>__("Total Gross","PackR"),
			'totalGrossVal'=>$price+$taxPrice." €",

			'title3'=>__("Payment","PackR"),

			'sepaTitle'=>__("SEPA Link (opens in new window)","PackR"),
			'sepaLink'=>"http://www.google.com",
			
			'iAgree1p1'=>__("I agree to the","PackR"),
			'iAgree1p2'=>__("Terms & Conditions","PackR"),
			'iAgree1p3'=>__(". ","PackR"),
			'iAgree1Link'=>"/termsandcondition",

			'iAgree2p1'=>__("I agree to the","PackR"),
			'iAgree2p2'=>__("Privacy Policy","PackR"),
			'iAgree2p3'=>__(". ","PackR"),
			'iAgree2Link'=>"/privacypolicy",
			
			'bt_submit' => __("Confirm & Finish"),

			]);




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
	}else if(!(strcmp($password, $confirmPassword)==0)){
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


	$resp['extraAddress'][0]=false;
	$resp['extraAddress'][2]=$extraAddress;

	$resp['ustID'][0]=false;
	$resp['ustID'][2]=$ustID;

	$process = true;
	foreach ($resp as $item) {
		$process = $process && (!$item[0]);
	}

	if($process){
		$_SESSION["PackR_email"]=$email;
		$_SESSION["PackR_password"]=wp_hash_password($password);
		$_SESSION["PackR_companyName"]=$companyName;
		$_SESSION["PackR_firstName"]=$firstName;
		$_SESSION["PackR_lastName"]=$lastName;
		$_SESSION["PackR_street"]=$street;
		$_SESSION["PackR_postalCode"]=$postalCode;
		$_SESSION["PackR_city"]=$city;
		$_SESSION["PackR_country"]=$country;
		$_SESSION["PackR_extraAddress"]=$extraAddress;
		$_SESSION["PackR_message"]=$message;

		$_SESSION["PackR_accountNumber"]=$accountNumber;
		$_SESSION["PackR_bic"]=$bic;
		$_SESSION["PackR_iban"]=$iban;
		$_SESSION["PackR_ustID"]=$ustID;

		return $this->getThirdForm($http);

	}else{
		return $this->getSecondForm($http,true,$resp);
	}

}


public function isStrEmpty($str){
	$str = trim($str);
	return !(strlen($str) > 0);
}

public function getFirstForm($err=false,$errDetail=""){
	$_SESSION['PackR_step']=1;
	$steps= $this->getSteps(1);

	$q= __("Which version of vislog you would like to you use?","PackR");

	$term= __("Period of Validity","PackR");
	$termInfo= __("The subscription is initially for one year and will be automatically extended for another year unless written notice is given within 4 weeks before year ends","PackR");

	$formButton=__("Go to Address & Payment","PackR");

	return view('@PackR/form-base.twig.html', [
		'logoSrc'=>$this->logoSrc,
		'steps'   => $steps,
		'form1Submit'=>$formButton,
		'qLabel' => $q,
		'term'=>$term,
		'termInfo'=>$termInfo,
		'form'=> "@PackR/form1.twig.html",
		'error'=> $err,
		'errorDescription'=>$errDetail,
		'basicImageSrc'=>Helper::assetUrl("/images/basic.png"),
		'profImageSrc'=>Helper::assetUrl("/images/professional.png"),
		'voucherLabel'=>__("Voucher:","PackR"),
		'voucherPlaceHolder'=>__("(inserted)","PackR"),
		'voucherPriceText1'=>__("Monthly Price: 0 Euro, for first ","PackR"),
		'voucherPriceMonth'=>__("6 Monate","PackR"),
		'voucherPriceText2'=>__(", then","PackR"),
		'voucherPrice2'=>__("39 €","PackR"),
		'title4'=>__("Details","PackR"),
		'priceTag'=>__("ab","PackR"),
		'priceTagVal'=>__("39 €","PackR"),

		]);
}

function getSecondForm(Http $http,$error=false,$resp=array()){
	$_SESSION['PackR_step']=2;
	$steps= $this->getSteps(2);

	$title=__("Address & Payment","PackR");
	$titleDescription = __("Please fill in your billing, address and your payment details.","PackR");

	return view('@PackR/form-base.twig.html', [
		'steps'   => $steps,
		'logoSrc'=>$this->logoSrc,
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
		'lastNameLabel'=> __("Last Name","PackR"),
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