<?php namespace App\Controllers;

use App\Models\BnbqrModel;

class Bnbqr extends BaseController
{
	public function index()
	{
		$this->template('/bnbqr/new', array());
	}

	public function create($expiration, $singleuse, $qrimage)
	{
		$bnbqr = new BnbqrModel();

		$bnbqr->insert(
			[
				/* Insertando datos qrbnb */
				'bnbqr_coin'=> $this->request->getPost('coin'),
				'bnbqr_amount'=> $this->request->getPost('amount'),
				'bnbqr_reference'=> $this->request->getPost('reference'),
				'bnbqr_expiration'=> $expiration,
				'bnbqr_singleuse'=> $singleuse,
				'bnbqr_date'=> $this->request->getPost('date'),
				'bnbqr_image'=> $qrimage[0]
			]
			);
	}

	public function generateqr()
	{

		$coin = $this->request->getPost('coin');
		$amount = $this->request->getPost('amount');
		$reference = $this->request->getPost('reference');

		$validity = $this->request->getPost('validity');
		$expiration = date("Y-m-d");
		$singleuse = "";

		if(isset($validity))
		{
			switch($validity)
			{
			// Opción único uso
			case ($validity == "SINGLE"):
			$singleuse = true;
			break;

			// Opción una semana
			case ($validity == "WEEK"):
			$expiration = "2020-11-27";
			$singleuse = false;
			break;

			// Opción un mes
			case ($validity == "MONTH"):
			$expiration = "2020-12-27";
			$singleuse = false;
			break;

			// Opción un año
			case ($validity == "YEAR"):
			$expiration = "2021-11-20";
			$singleuse = false;
			break;
			}
		}

		if ( isset($_POST['amount']) )
		{
			$method="POST";
			$api="http://test.bnb.com.bo/ClientAuthentication.API/api/v1/auth/token";
			$data=["accountId" => "FNqw178nJ64+nTBRWAB8Yg==", "authorizationId" => "CaritasBolivia/1958"]; 
			$headers=["Content-type: application/json"];

			$result = $this->CallAPI($method, $api, $data, $headers);
			//var_dump ($result);

			if(isset($result))
			{
				$object = json_decode(json_encode($result), true);
				//echo $object["message"];
				//$success = $array->{'success'};
				//$message = $array->{'message'};

			$api2="http://test.bnb.com.bo/QRSimple.API/api/v1/main/getQRWithImageAsync";
			$data2=["currency" => $coin, "gloss" => $reference, "amount" => $amount, "singleUse" => $singleuse, "expirationDate" => $expiration];
			$headers2=array("Content-type: application/json", "Authorization: Bearer ".$object["message"]);

			$result2 = $this->CallAPI($method, $api2, $data2, $headers2);
			//var_dump ($result2);

			$object2 = json_decode(json_encode($result2), true);
			//echo $object2["qr"];
			$this->template('/bnbqr/generateqr', $object2);
			//echo '<img src="data:image/png;base64,'.$object2["qr"].'"/>';
			}
		}
	}


	function CallAPI($method, $api, $data, $headers) {
		$url = $api;
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
 
		switch ($method) {
			case "GET":
				curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
				break;
			case "POST":
				curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
				break;
			case "PUT":
				curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
				break;
			case "DELETE":
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE"); 
				curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
				break;
		}
		$response = curl_exec($curl);
		$data = json_decode($response);
 
		/* Check for 404 (file not found). */
		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		// Check the HTTP Status code
		switch ($httpCode) {
			case 200:
				$error_status = "200: Success";
				return ($data);
				break;
			case 404:
				$error_status = "404: API Not found";
				break;
			case 500:
				$error_status = "500: servers replied with an error.";
				break;
			case 502:
				$error_status = "502: servers may be down or being upgraded. Hopefully they'll be OK soon!";
				break;
			case 503:
				$error_status = "503: service unavailable. Hopefully they'll be OK soon!";
				break;
			default:
				$error_status = "Undocumented error: " . $httpCode . " : " . curl_error($curl);
				break;
		}
		curl_close($curl);
		echo $error_status;
		die;
 	}

//--------------------------------------------------------------------

}