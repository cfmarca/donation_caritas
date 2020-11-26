<?php namespace App\Controllers;

class Bcpqr extends BaseController
{

	//include "BCPCore.php";
	var $certificatePEM = "Certificado_Sandbox.pem"; //Direccion de una ruta con permiso de escritura y lectura para el certificado este certificado, tampoco tiene que ser publico
	var $certificatePFX = "Certificado_Sandbox.pfx"; //Se recomienda que no este en un link compartido al publico
	var $passwordPFX = 'Pa$$Bcp2020';
	var $appUserId = "CARITASUser14102020";
	var $businessCode = "0101";
	var $publicToken = "05E935AE-4BCD-4203-B858-9AC60BB3E521";
	var $usuario = "CARITAS_USER";
	var $passwordUsuario = "37aa20a2e4214f8b9c311143d8c60437";
	var $qrV2 = 'https://www99.bancred.com.bo/sandbox/api/v2/Qr';
	var $buttonPay = 'https://www99.bancred.com.bo/sandbox/api/v1/Payments';

	public function index()
	{
		$this->template('bcpqr/create', array());
	}

	public function create($expiration, $qrimage)
	{
		$bcpqr = new BcpqrModel();

		$bcpqr->insert(
			[
				/* Insertando datos qrbnb */
				'bcpqr_coin'=> $this->request->getPost('coin'),
				'bcpqr_amount'=> $this->request->getPost('amount'),
				'bcpqr_reference'=> $this->request->getPost('reference'),
				'bcpqr_expiration'=> $expiration,
				'bcpqr_correlation'=> "123",
				'bcpqr_date'=> $this->request->getPost('date'),
				'bcpqr_image'=> $qrimage[0]
			]
			);
	}

/* 	public function store(){
		$request = service('request');
		$postData = $request->getPost();

		if(isset($postData['submit'])){

		## Validation
		$input = $this->validate([
			  'bcp_coin' => 'required|min_length[3]',
			  'qrbcp_amount' => 'required|min_length[1]',
			  'qrbcp_reference' => 'required|min_length[10]',
		   ]);
  
		   if (!$input) {
			  return redirect()->route('bcpqr/create')->withInput()->with('validation',$this->validator); 
		   } else {
  
			  $qrbcps = new QRBcpModel();
  
			  $data = [
				 'bcpqr_coin' => $postData['coin'],
				 'bcpqr_amount' => $postData['amount'],
				 'bcpqr_reference' => $postData['reference'],
				 'bcpqr_expiration' => $postData['expiration'],
				 'bcpqr_correlation' => $postData['123'],
				 'bcpqr_image' => $postData[''],
			  ];
  
			  ## Insert Record
			  if($qrbcps->insert($data)){
				 session()->setFlashdata('message', 'Added Successfully!');
				 session()->setFlashdata('alert-class', 'alert-success');
  
				 return redirect()->route('bcpqr/create'); 
			  }else{
				 session()->setFlashdata('message', 'Data not saved!');
				 session()->setFlashdata('alert-class', 'alert-danger');
  
				 return redirect()->route('bcpqr/create')->withInput(); 
			  }
  
		   }
		   $this->template('bcpqr/qr', array());
		}
  
	 } */

	public function qr()
	{
		// Manipulación de datos del formulario
		$collector = array( //En este campo se envia datos a guardar en un array
			array(
				"Name" => "Id",
				"Paremeter" =>  "int",
				"Value" => 123
			),
			array(
				"Name" => "Nombre",
				"Paremeter" =>  "string",
				"Value" => "Prueba"
			),
			array(
				"Name" => "Livees",
				"Paremeter" =>  "ClasePrueba",
				"Value" => array(
					"Key" => "Value"
				)
			)
		);
		//$bcp = new BCPServices();
		$qr = $this->GeneratedQr(10, "BOB", "GLOSA CARITAS", $collector, "00/00:10", "123");
		print_r($qr);
		var_dump($qr);
		echo '<br>';
		echo '<img src="data:image/png;base64,'.$qr->data->qrImage.'"/>';
		echo '<br>';
		$consult = $bcp->ConsultQr($qr->data->id, "123");
		print_r($consult);
		echo '<br>';
		echo '<img src="data:image/png;base64,'.$consult->data->qrImage.'"/>';
	}

	public function ConsultQr(int $id, string $correlationId)
	{
		verificate($this->certificatePEM, $this->certificatePFX, $this->passwordPFX);
		$body = array(
			"appUserId" => $this->appUserId,
			"id" => $id,
			"serviceCode" => "050",
			"businessCode" => $this->businessCode,
			"publicToken" => $this->publicToken,
		);
		return ConexionApiBCP($this->qrV2.'/Consult', 'POST', array(), $body, $correlationId, $this->usuario, $this->passwordUsuario, $this->certificatePEM);
	}
	
	public function GeneratedQr(float $amount, string $currency, string $gloss, $collectors, string $expiration = "1/00:00", string $correlationId)
	{
		verificate($this->certificatePEM, $this->certificatePFX, $this->passwordPFX);
		$body = array(
			"appUserId" => $this->appUserId,
			"currency" => $currency,
			"amount" => $amount,
			"gloss" => $gloss,
			"serviceCode" => "050",
			"businessCode" => $this->businessCode,
			"collectors" => $collectors,
			"expiration" => $expiration, // formato dia/Hora:minuto campo obligatorio
			"publicToken" => $this->publicToken,
		);
		return ConexionApiBCP($this->qrV2.'/Generated', 'POST', array(), $body, $correlationId, $this->usuario, $this->passwordUsuario, $this->certificatePEM);
	}

	public function ReportQrDetallado(string $begin, string $end, string $currency, string $correlationId) {
		verificate($this->certificatePEM, $this->certificatePFX, $this->passwordPFX);
		$body = array(
			"appUserId" => $this->appUserId,
			"currency" => $currency,
			"startDate" => $begin,
			"finDate" => $end,
			"serviceCode" => "050",
			"businessCode" => $this->businessCode,
			"publicToken" => $this->publicToken,
		);
		return ConexionApiBCP($this->qrV2.'/Report/Detail', 'POST', array(), $body, $correlationId, $this->usuario, $this->passwordUsuario, $this->certificatePEM);
	}
	function ReportQrGeneral(string $begin, string $end, string $currency, string $correlationId) {
		verificate($this->certificatePEM, $this->certificatePFX, $this->passwordPFX);
		$body = array(
			"appUserId" => $this->appUserId,
			"currency" => $currency,
			"startDate" => $begin,
			"finDate" => $end,
			"serviceCode" => "050",
			"businessCode" => $this->businessCode,
			"publicToken" => $this->publicToken,
		);
		return ConexionApiBCP($this->qrV2.'/Report/General', 'POST', array(), $body, $correlationId, $this->usuario, $this->passwordUsuario, $this->certificatePEM);
	}
	function EnlistPayment(string $idc, string $extension, float $amount, string $currency, string $gloss, string $serviceCode, string $correlationId, string $expirationDate = "", string $soliNumber = "", string $complement = "00") {
		verificate($this->certificatePEM, $this->certificatePFX, $this->passwordPFX);
		$body = array(
			"appUserId" => $this->appUserId,
			"currency" => $currency,
			"amount" => $amount,
			"gloss" => $gloss,
			"idc" => $idc,
			"complement" => $complement,
			"extension" => $extension,
			"serviceCode" => $serviceCode, // 001 Tarjeta de Debito, 002 Tarjeta de Credito y 003 Soli
			"date" => date("Ymd"),
			"hour" => date("his"),
			"businessCode" => $this->businessCode,
			"solinumber" => $soliNumber,
			"expirationDate" => $expirationDate, // Fecha de Expiracion de la tarjeta debito o credito
			"publicToken" => $this->publicToken
		);
		return ConexionApiBCP($this->buttonPay.'/Enlist', 'POST', array(), $body, $correlationId, $this->usuario, $this->passwordUsuario, $this->certificatePEM);
	}
	public function ConfirmPayment(string $authorizationNumber, string $opt, string $correlationIdEnlist, string $serviceCode, string $correlationId) {
		verificate($this->certificatePEM, $this->certificatePFX, $this->passwordPFX);
		$body = array(
			"appUserId" => $this->appUserId,
			"authorizationNumber" => $authorizationNumber,
			"otp" => $otp,
			"correlationId" => $correlationIdEnlist,
			"date" => date("Ymd"),
			"hour" => date("his"),
			"businessCode" => $this->businessCode,
			"publicToken" => $this->publicToken
		);
		return ConexionApiBCP($this->buttonPay.'/Confirm', 'POST', array(), $body, $correlationId, $this->usuario, $this->passwordUsuario, $this->certificatePEM);
	}
	public function ConsultPayment(string $authorizationNumber, string $opt, string $correlationIdEnlist, string $correlationId) {
		verificate($this->certificatePEM, $this->certificatePFX, $this->passwordPFX);
		$body = array(
			"appUserId" => $this->appUserId,
			"authorizationNumber" => $authorizationNumber,
			"correlationId" => $correlationIdEnlist,
			"serviceCode" => $serviceCode, // 001 Tarjeta de Debito, 002 Tarjeta de Credito y 003 Soli
			"businessCode" => $this->businessCode,
			"publicToken" => $this->publicToken
		);
		return ConexionApiBCP($this->buttonPay.'/Consult', 'POST', array(), $body, $correlationId, $this->usuario, $this->passwordUsuario, $this->certificatePEM);
	}

	//--------------------------------------------------------------------

}

?>