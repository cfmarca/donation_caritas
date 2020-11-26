<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$this->template('index', array());
	}

	public function bcpqr()
	{
		$this->template('bcpqr/create', array());
	}

	public function bnbqr()
	{
		$this->template('bnbqr/bew', array());
	}

	//--------------------------------------------------------------------

}
