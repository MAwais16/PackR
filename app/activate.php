<?php

/** @var  \Herbert\Framework\Application $container */
/** @var  \Herbert\Framework\Http $http */
/** @var  \Herbert\Framework\Router $router */
/** @var  \Herbert\Framework\Enqueue $enqueue */
/** @var  \Herbert\Framework\Panel $panel */
/** @var  \Herbert\Framework\Shortcode $shortcode */
/** @var  \Herbert\Framework\Widget $widget */

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('packr_orders', function($table)
{
    $table->increments('id');
    $table->string('email');
    $table->string('password');
    
    $table->string('company_name');
    $table->string('first_name');
    $table->string('last_name');
    $table->string('street');
    $table->string('city');
    $table->string('postal_code');
    $table->string('country_code');
    
    $table->string('account_number');
    $table->string('iban');
    $table->string('bic');

	$table->string('voucher_code');

    $table->timestamps();	//Adds created_at and updated_at columns


});