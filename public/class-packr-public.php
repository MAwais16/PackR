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
				
				if($http->has("package")){
					$_SESSION["PackR_package"]=$http->get("package");
					//return $this->getSecondForm($http);
				}else{
					$_SESSION['PackR_step']=1;
					return $this->getFirstForm(true,__("Please select a Package","PackR"));
				}
			}else if($_SESSION['PackR_step']=="2"){
				//return $this->validateInput($http);
			}else if($_SESSION['PackR_step']=="3"){
				/*
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
				}*/
			}else{
				$_SESSION['PackR_step']=1;
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

		$_SESSION['PackR_step']=1;
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

	public function packr_voucher_validate_callback() {
		$resp=$this->validateVoucher($_POST['voucher_code'],$_POST['package']);
		echo json_encode($resp);
		wp_die();
	}


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



/*
	public function getForm(){

		$_SERVER['REQUEST_METHOD'];
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
*/

}