<?php namespace App\Controllers;

    class BCPServices extends BaseController
    {
        var $certificatePEM = __DIR__."/Certificado_Sandbox.pem"; //Direccion de una ruta con permiso de escritura y lectura para el certificado este certificado, tampoco tiene que ser publico
        var $certificatePFX = __DIR__."/Certificado_Sandbox.pfx"; //Se recomienda que no este en un link compartido al publico
        var $passwordPFX = 'Pa$$Bcp2020';
        var $appUserId = "CARITASUser14102020";
        var $businessCode = "0101";
        var $publicToken = "05E935AE-4BCD-4203-B858-9AC60BB3E521";
        var $usuario = "CARITAS_USER";
        var $passwordUsuario = "37aa20a2e4214f8b9c311143d8c60437";
        var $qrV2 = 'https://www99.bancred.com.bo/sandbox/api/v2/Qr';
        var $buttonPay = 'https://www99.bancred.com.bo/sandbox/api/v1/Payments';
        
        public function ConsultQr(int $id, string $correlationId) {
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
        public function GeneratedQr(float $amount, string $currency, string $gloss, $collectors, string $expiration = "1/00:00", string $correlationId) {
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
    }
?>