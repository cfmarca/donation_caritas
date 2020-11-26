<?php namespace App\Controllers;

class Atc extends BaseController
{
    
	public function index()
	{
		$this->template('atc/create', array());
    }

}

?>