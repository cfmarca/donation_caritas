<?php namespace App\Controllers;

use App\Models\PersonModel;

class Person extends BaseController
{
	public function index()
	{
		$this->template('/person/new', array());
	}

	public function create()
	{
		$person = new PersonModel();

		$person->insert(
			[
				/* Create person */
				'person_firstname'=> $this->request->getPost('firstname'),
				'person_lastname'=> $this->request->getPost('lastname'),
				'person_email'=> $this->request->getPost('email'),
				'person_phone'=> $this->request->getPost('phone'),
				'person_country'=> $this->request->getPost('country'),
				'person_department'=> $this->request->getPost('department'),
				'person_location'=> $this->request->getPost('location')
			]
			);
	
			$this->template('/service/new', array());
	}


	function mostrar($country)
	{
		if ($country === "BOL")
		{
			echo "true";
			//$("#showDepartment").show();
			//$("#showLocation").show();
		}
		else
		{
			echo "false";
			//$("#showDepartment").hide();
			//$("#showLocation").hide();
		}
	}
	//--------------------------------------------------------------------

}