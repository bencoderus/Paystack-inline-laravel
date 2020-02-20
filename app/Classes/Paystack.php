<?php

namespace App\Classes;

class Paystack{

public function verify($ref){
$header =   "authorization: Bearer " .env("PAYSTACK_SECRET_KEY");
$curl = curl_init();
if(isset($ref)){
$reference = $ref;
}
else{
   abort('404');
}

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "accept: application/json", $header,
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
// there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}
$tranx = json_decode($response);
return $tranx;
}

}
