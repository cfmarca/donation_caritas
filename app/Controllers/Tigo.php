<?php namespace App\Controllers;

class Tigo extends BaseController
{
    
	public function index()
	{
		$this->template('tigo/create', array());
    }

}

?>