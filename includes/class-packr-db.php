<?php

require_once PACKR_BASE_PATH.'libraries/activerecord/ActiveRecord.php';

class PackR_DB{

	
	public static function initiateActiveRecord() {
		

		$cfg = ActiveRecord\Config::instance();
		$cfg->set_model_directory(PACKR_BASE_PATH.'models/');
		
		$cfg->set_connections(
			array(
				'wp' => sprintf( 'mysql://%s:%s@%s/%s?charset=%s', DB_USER, DB_PASSWORD, DB_HOST, DB_NAME, DB_CHARSET ),
				)
			);
		$cfg->set_default_connection( 'wp' );

	}

}
