<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    PackR
 * @subpackage PackR/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    PackR
 * @subpackage PackR/includes
 * @author     Your Name <email@example.com>
 */

class PackR_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		PackR_Activator::createDbTable();

		
	}

	public static function createDbTable(){
		global $wpdb;
		$table_name = PACKR_DB_TABLE_NAME;

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			id int NOT NULL AUTO_INCREMENT UNIQUE,
			created_at timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
			email text NOT NULL,
			password text NOT NULL,
			company_name text NOT NULL,
			first_name text NOT NULL,
			last_name text NOT NULL,
			street text NOT NULL,
			city text NOT NULL,
			postal_code text NOT NULL,
			country_code text NOT NULL,
			extra_address text,
			message text,
			package text NOT NULL,
			account_name text NOT NULL,
			iban text NOT NULL,
			bic text NOT NULL,
			ust_id text,
			voucher_code text,
			
			PRIMARY KEY  (id)

			) $charset_collate;";

		require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

	}

}