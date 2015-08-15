<?php namespace PackR\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class Order extends Eloquent {
	   
    //protected $table = $table_prefix.'packr_orders';

	public function __construct(){
		$this->table=$table_prefix.'packr_orders';
	}
}
