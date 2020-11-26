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

	public function qr()
	{

		$coin = $_POST['coin'];
		$amount = $_POST['amount'];

		if ( isset($_POST['amount']) )
		{
			$method="POST";
			$api="http://test.bnb.com.bo/ClientAuthentication.API/api/v1/auth/token";
			$data=["accountId" => "FNqw178nJ64+nTBRWAB8Yg==", "authorizationId" => "CaritasBolivia/1958"]; 
			$headers=["Content-type: application/json"];

			$result = $this->CallAPI($method, $api, $data, $headers);
			var_dump ($result);

			if(isset($result))
			{
				$object = json_decode(json_encode($result), true);
				echo $object["message"];
				//$success = $array->{'success'};
				//$message = $array->{'message'};

			$api2="http://test.bnb.com.bo/QRSimple.API/api/v1/main/getQRWithImageAsync";
			$data2=["currency" => $coin, "gloss" => "Donacion", "amount" => $amount, "singleUse" => true, "expirationDate" => "2020-12-31"];
			$headers2=array("Content-type: application/json", "Authorization: Bearer ".$object["message"]);

			$result2 = $this->CallAPI($method, $api2, $data2, $headers2);
			var_dump ($result2);

			$object2 = json_decode(json_encode($result2), true);
			echo $object2["qr"];

			echo '<img src="data:image/png;base64,'.$object2["qr"].'"/>';
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

public function generateqr()
{

// Manipulación de datos del formulario
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
$singleuse = "false";
break;

// Opción un mes
case ($validity == "MONTH"):
$expiration = "2020-12-27";
$singleuse = "false";
break;

// Opción un año
case ($validity == "YEAR"):
$expiration = "2021-11-20";
$singleuse = "false";
break;
}
}

// Obtener datos de autorización
$authorization = $this->generateToken();
echo "<br>AUTHORIZATION: ";
var_dump ($authorization);

// Validar datos de autorización
if(isset($authorization))
{
// Obtener datos de conexion
$conection = $this->conection($authorization);
echo "<br>CONECTION: ";
var_dump ($conection);

// Validar datos de conexion
if(isset($conection))
{

$permission = $this->permission($this->request->getPost('coin'), $this->request->getPost('amount'),
$this->request->getPost('reference'), $expiration, $singleuse);
echo "<br>PERMISSION: ";
var_dump ($permission);

if(isset($permission))
{
$qr = $this->conection2($permission, $conection);
echo "<br>QR: ";
var_dump ($qr);

$this->template('/bnbqr/generateqr', $qr);

if(isset($qr))
{
$qrimage = $this->qrsimple($qr, $this->request->getPost('date'));
echo "<br>QRIMAGE: ";
var_dump ($qrimage);
echo "<br>QR: ".($qrimage[0]);

if(isset($qrimage))
{
$this->create($expiration, $singleuse, $qrimage);
//$this->template('/bnbqr/generateqr', $qrimage);
$this->template('/bnbqr/generateqr', $qrimage);
}
}
}
}
}
else
{
echo "false";
}

//$this->template('/bnbqr/generateqr', array($qrimage));

}

private function generateToken()
{
// Realizando petición HTTP POST para obtener Token
$url1 = "http://test.bnb.com.bo/ClientAuthentication.API/api/v1/auth/token";

// Datos de acceso
$data1 = ["accountId" => "FNqw178nJ64+nTBRWAB8Yg==", "authorizationId" => "CaritasBolivia/1958"];

return array($url1, $data1);
}

private function conection($authorization)
{
// Crear opciones de la petición HTTP
$options1 = array(
"http" => array(
"header" => "Content-type: application/json",
"method" => "POST",
"content" => json_encode($authorization[1])
),
);

// Preparar petición
$context1 = stream_context_create($options1);

// Resultado de petición
$result1 = file_get_contents($authorization[0], false, $context1);
if ($result1 === false) {
echo "Error haciendo petición";
exit;
}

// Separando resultado en variables
$object1 = json_decode($result1);
$success = $object1->{'success'};
$message = $object1->{'message'};

return array($success, $message);
}

private function permission($coin, $amount, $reference, $expiration, $singleuse)
{
// Realizando petición HTTP POST para generar QR
$url2 = "http://test.bnb.com.bo/QRSimple.API/api/v1/main/getQRWithImageAsync";

// Array de datos del formulario
$data2 = ["currency" => $coin, "gloss" => $reference, "amount" => $amount, "singleUse" => $singleuse, "expirationDate"
=> $expiration];

return array($url2, $data2);
}

private function conection2($permission, $conection)
{
// Crear opciones de la petición HTTP
$options2 = array(
"http" => array(
"header" => array("Content-type: application/json", "Authorization: Bearer ".$conection[1]),
"method" => "POST",
"content" => json_encode($permission[1])
),
);

// Preparar petición
$context2 = stream_context_create($options2);

// Resultado de petición
$result2 = file_get_contents($permission[0], false, $context2);
if ($result2 === false) {
echo "Error haciendo petición";
exit;
}

// Separando respuesta en variables
$object2 = json_decode($result2);
$id = $object2->{'id'};
$qr = $object2->{'qr'};
$success = $object2->{'success'};

return array($id, $qr);
}

private function qrsimple($generate, $name)
{
// Obtain the original content (usually binary data)
$bin = base64_decode($generate[1]);

// Load GD resource from binary data
$im = imageCreateFromString($bin);

// Make sure that the GD library was able to load the image
// This is important, because you should not miss corrupted or unsupported images
if (!$im) {
die('Base64 value is not a valid image');
}

// Specify the location where you want to save the image
echo $name;
$name = str_replace('-','',$name);
$name = str_replace(' ','',$name);
$name = str_replace(':','',$name);
echo "trim()".$name;
$img_file = "qr/".$name.".png";

// Save the GD resource as PNG in the best possible quality (no compression)
// This will strip any metadata or invalid contents (including, the PHP backdoor)
// To block any possible exploits, consider increasing the compression level
imagepng($im, $img_file, 0);

return array($img_file);
}
//--------------------------------------------------------------------

}