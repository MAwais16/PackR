<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    PackR
 * @subpackage PackR/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    PackR
 * @subpackage PackR/public
 * @author     awais <awaisakhtar16@yahoo.com>
 */

require_once(PACKR_BASE_PATH."includes/class-packr-db.php");
require_once PACKR_BASE_PATH."models/Order.php";


class PackR_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		PackR_DB::initiateActiveRecord(); //activate Active Record
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/packr-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name."-progress-wizard", plugin_dir_url( __FILE__ ) . 'css-progress-wizard-master/css/progress-wizard.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name."-publicjs", plugin_dir_url( __FILE__ ) . 'js/packr-public.js', array( 'jquery' ), $this->version, false );

		//for using ajax
		wp_localize_script( $this->plugin_name."-publicjs", 'ajax_object',array('ajax_url' => admin_url( 'admin-ajax.php')));


	}

	/**
	*function to handle PackR short code in content to generate the forms.
	*
	*
	*@author Awais
	*/

	public function handleShortCode(){
		//echo "yes its working";
		$method=$_SERVER['REQUEST_METHOD'];
		if($method=="GET"){
			$this->getFirstForm();
		}else if($method=="POST"){
			if($_SESSION['PackR_step']=="1"){
				if(isset($_POST["package"])){
					$_SESSION["PackR_package"]=$_POST["package"];
					$this->getSecondForm();
				}else{
					$_SESSION['PackR_step']="1";
					return $this->getFirstForm(true,__("Please select a Package","PackR"));
				}
			}else if($_SESSION['PackR_step']=="2"){
				$this->validateSecondForm();
			}else if($_SESSION['PackR_step']=="3"){
				$this->validateThirdForm();
			}else{
				return $this->getFirstForm();
			}

		}else{
			_e("method not supported!",$this->plugin_name);
		}

	}

	/**
	*function to get the parameters from post request
	*
	* @param      string    $param       The name of the post parameter.
	*/

	private function get($param){
		if(isset($_POST[$param])){
			return $_POST[$param];
		}else{
			return "";
		}
	}


	/**
	*function to draw the very first form
	*
	*
	*/
	public  function getFirstForm($error=false,$errorDescription=""){

		//error_log('mysql://'.DB_USER.':'.DB_PASSWORD.'@'.DB_HOST.'/'.DB_NAME);

		$_SESSION['PackR_step']="1";
		$steps= $this->getSteps(1);
		$form="form1.php";
		require_once("partials/form-base.php");
	}


	/**
	*function its empty or nto
	*
	*@param string 	$str 	The variable to check
	*/
	public function isStrEmpty($str){
		$str = trim($str);
		return !(strlen($str) > 0);
	}



	/**
	*function to generates steps headers
	*
	*
	*/
	private	function getSteps($step=0){
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

	/**
	*function to to handle ajax request validating voucher
	*
	*/

	public function packr_voucher_validate_callback() {
		$resp=$this->validateVoucher($_POST['voucher_code'],$_POST['package']);
		echo json_encode($resp);
		wp_die();
	}

	/**
	*function to validate voucher and generate resulting json string
	*
	*/
	private function validateVoucher($vc,$package){
		if(isset($vc)){
			$end=" <i class='voucher-price'> 39 €</i>";
			if($package=="basic"){
				$end=" <i class='voucher-price'> 39 €</i>";
			}else{
				$end=" <i class='voucher-price'> 69 €</i>";
			}

			if($vc=="EarlyBird2015"){
				$_SESSION['PackR_voucherCode']=$vc;
				return  array("valid"=>true,"desc"=>__("Monthly Price: 0 Euro, for first 6 Months then ",$this->plugin_name).$end);	//6months
			}else if($vc=="Supporter2015"){
				$_SESSION['PackR_voucherCode']=$vc;
				return  array("valid"=>true,"desc"=>__("Monthly Price: 0 Euro, for first 3 Months then ",$this->plugin_name).$end); //3 months
			}else{
				return  array("valid"=>false,"desc"=>__("Invalid voucher code",$this->plugin_name));
			}
		}
	}

	/**
	*function to generate second form
	*
	*/
	private function getSecondForm($error=false,$resp=array()){
		$_SESSION['PackR_step']=2;
		$steps= $this->getSteps(2);
		$form="form2.php";
		require_once("partials/form-base.php");
	}

	/**
	*validating second form
	*
	*/

	private function validateSecondForm(){

		$email=$this->get("email");
		$password=$this->get("password");
		$confirmPassword=$this->get("confirmPassword");
		$companyName=$this->get("companyName");
		$firstName=$this->get("firstName");
		$lastName=$this->get("lastName");
		$street=$this->get("street");
		$postalCode=$this->get("postalCode");
		$city=$this->get("city");
		$country=$this->get("country");
		$extraAddress=$this->get("extraAddress");
		$message=$this->get("message");

		$accountOwner=$this->get("accountOwner");
		$iban=$this->get("iban");
		$bic=$this->get("bic");

		$ustID=$this->get("ustID");

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

		if($this->isStrEmpty($accountOwner)){
			$resp['accountOwner'][0]=true;
			$resp['accountOwner'][1]=__("required","PackR");
		}else{
			$resp['accountOwner'][0]=false;
			$resp['accountOwner'][2]=$accountOwner;
		}


		if($this->isStrEmpty($bic)){
			$resp['bic'][0]=true;
			$resp['bic'][1]=__("required","PackR");
		}else{
			$resp['bic'][0]=false;
			$resp['bic'][2]=$bic;
		}

		if($this->isStrEmpty($iban)){
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

			$_SESSION["PackR_accountOwner"]=$accountOwner;
			$_SESSION["PackR_bic"]=$bic;
			$_SESSION["PackR_iban"]=$iban;
			$_SESSION["PackR_ustID"]=$ustID;

			$this->getThirdForm();
			//echo "weheh";

		}else{
			$this->getSecondForm(true,$resp);
		}

	}


/**
*for third form
*
*/

private function getThirdForm($error=false,$errorDescription=""){
	$_SESSION['PackR_step']=3;
	$steps= $this->getSteps(3);
	$tax = 19;
	$price=39;

	$imgSrc=PACKR_BASE_URL. '/public/images/basic.png';

	$package=$_SESSION['PackR_package'];
	if($package=="basic"){
		$price = 39;
		$imgSrc=PACKR_BASE_URL. '/public/images/basic.png';
	}else{
		$price = 69;
		$imgSrc=PACKR_BASE_URL. '/public/images/professional.png';
	}

	$taxPrice=$price*($tax/100);

	$form="form3.php";
	require_once("partials/form-base.php");

}

private function validateThirdForm(){
	if($this->get("terms")=="terms"){
		if($this->get("privacy")=="privacy"){
			if($this->get("sepa")=="sepa"){
				$this->getForthForm();
			}else{
				$this->getThirdForm(true,__("Please agree to SEPA Terms & Conditions.",$this->plugin_name));
			}
		}else{
			$this->getThirdForm(true,__("Please agree to Privacy Policy.",$this->plugin_name));
		}
	}else{
		$this->getThirdForm(true,__("Please agree to Terms & conditions.",$this->plugin_name));
	}
}

private function getForthForm(){
	$_SESSION['PackR_step']=4;
	$steps= $this->getSteps(4);

	//save all the data in table;
	$order = new Order();

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

	$order->account_name=$_SESSION["PackR_accountOwner"];
	$order->bic=$_SESSION["PackR_bic"];
	$order->iban=$_SESSION["PackR_iban"];
	$order->ust_id=$_SESSION["PackR_ustID"];
	$order->package=$_SESSION["PackR_package"];
	$order->voucher_code=$_SESSION["PackR_voucherCode"];

	try{
		$order->save();
		if($order->id>0){

			$form="form4.php";
			require_once("partials/form-base.php");

		}else{
			$this->getSecondForm(true,__("Ops, something went wrong, please try again","PackR"));
		}
	}catch(Exception $ex){
		$this->getSecondForm(true,__("Ops, something went wrong, please try again","PackR"));
	}

}




}