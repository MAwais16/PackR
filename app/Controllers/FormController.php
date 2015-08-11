<?php namespace PackR\Controllers;


class FormController{

	public function getForm(){
		return view('@PackR/form.twig', [
    		'title'   => 'My Demo',
    		'content' => 'Congrats'
		]);
	}
} 