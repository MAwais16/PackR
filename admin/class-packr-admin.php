<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    PackR
 * @subpackage PackR/admin
 */


require_once(PACKR_BASE_PATH."includes/class-packr-db.php");
require_once PACKR_BASE_PATH."models/Order.php";
require_once PACKR_BASE_PATH."models/Voucher.php";

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    PackR
 * @subpackage PackR/admin
 * @author     Your Name <email@example.com>
 */

class PackR_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		PackR_DB::initiateActiveRecord(); //activate Active Record
	}

	/**
	 * Register the stylesheets for the admin area.
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

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/plugin-name-admin.css', array(), $this->version, 'all' );
		
		wp_enqueue_style( "boostrap-css", PACKR_BASE_URL. 'libraries/bootstrap/css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( "boostrap-theme", PACKR_BASE_URL. 'libraries/bootstrap/css/bootstrap-theme.min.css', array(), $this->version, 'all' );


	}

	/**
	 * Register the JavaScript for the admin area.
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

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/plugin-name-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( "boostrap-js", PACKR_BASE_URL. 'libraries/bootstrap/js/bootstrap.min.js', array('jquery'), $this->version, 'all' );

	}

	public function addAdminMenu(){
		add_menu_page( $this->plugin_name,$this->plugin_name, 'manage_options', $this->plugin_name.'-admin-menu', array($this,"getAdminPage"));
	}
	public function getAdminPage(){


		
		$columns=Order::connection()->columns(PACKR_DB_TABLE_NAME);

		$orders=Order::find('all',array('order' => 'id desc'));

		require_once ("partials/admin-display.php");

		$method=$_SERVER['REQUEST_METHOD'];
		if(is_super_admin() ){	

			$resp = array();
			if($method=="POST"){
				if(isset($_POST["type"]) && $_POST["type"]=="del"){
					try{
						$voucher = Voucher::find($_POST["voucher_id"]);
						$voucher->delete();
					}catch(Exception $ex){
						$resp['isError']=true;
						$resp['errorDescription']=$ex->getMessage();
					}
				}else if(isset($_POST["type"]) && $_POST["type"]=="save"){

					if(isset($_POST["voucher_code"]) && strlen($_POST["voucher_code"]) > 0){
						try{
							$voucher = new Voucher();
							$voucher->voucher_code=$_POST["voucher_code"];
							$voucher->voucher_count=$_POST["voucher_count"];
							$voucher->voucher_description_basic=$_POST["voucher_description_basic"];
							$voucher->voucher_description_professional=$_POST["voucher_description_professional"];

							$voucher->save();
							if($voucher->id>0){
								$resp['isError']=false;
								$resp['description']=false;
							}else{
								$resp['isError']=true;
								$resp['errorDescription']=__('Something went wrong while saving,please try again',$this->plugin_name);
							}
						}catch(Exception $ex){
							$resp['isError']=true;
							$resp['errorDescription']=$ex->getMessage();
						}
					}else{
						$resp['isError']=true;
						$resp['errorDescription']=__('Enter voucher code',$this->plugin_name);
					}
				}
			}
			
			require_once ("partials/admin-voucher.php");

			//load voucher records

			$columns=Voucher::connection()->columns(PACKR_DB_TABLE_VOUCHER);

			$vouchers=Voucher::find('all',array('order' => 'id desc'));

			require_once ("partials/admin-voucher-list.php");
				
		}
	}

}
