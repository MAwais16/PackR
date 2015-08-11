<?php namespace PackR;

/** @var \Herbert\Framework\Shortcode $shortcode */


$shortcode->add(
	'PackR',
	__NAMESPACE__ . '\Controllers\FormController@getForm'
	);