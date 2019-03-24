<?php
error_reporting( E_ALL );
session_start();  
require_once './vendor/autoload.php';  
 

 use Twilio\Rest\Client;  
 $sid = 'AC0f11d528b4df88565f0d2744466d9857';  
 $token = '70f10add8298a3598ff2c2a06f68e12c';  
 $from = '+918860315256';  
 $countryCode = $_POST['country_code'];  
 $phoneNumber = $_POST['phone_number'];

 processOTP( $phoneNumber, $countryCode );

 function processOTP( $phone_number, $country_code){
 	//echo $country_code;
 	try{
 		include_once 'config.php';
 		$sql = $conn->prepare( 'SELECT * FROM  user_verify WHERE phone_number = :phone_number' );
 		$sql->bindParam(':phone_number', $phone_number);
 		$sql->execute();
 		$result = $sql->fetchAll();
   
 	if( count( $result ) > 0 ){
 		if( $result[0]['verified'] == 1 ){
 			$_SESSION['msg']  = 'Phone Number already Verified';
 			header('Location:index.php');
 			exit;
 		}else {
 				sendOpt( $phone_number, $country_code );
 				header( 'Location: verified_otp.php' );
 		}
	}else{

 			$sql = $conn->prepare( 'INSERT INTO user_verify( `country_code`, `phone_number` ) VALUES( :country_code, :phone_number )' );
 			$sql->bindParam( ':phone_number', $phone_number );
 			$sql->bindParam( ':country_code', $country_code );
 			$sql->execute();
 			sendOpt( $phone_number, $country_code );
 			header( 'Location: verified_otp.php' );
 		}

 	}catch(Exception $e){
 		echo $e->getMessage();
 	}

 }

function sendOpt( $phone_number, $country_code){
	
 	try{   
 		     include 'config.php';	    
		     global $sid;  
         global $token;  
         global $from;
         $client = new Client($sid , $token);  
         $otp = generateOTP();  

		 		 $message = $client->messages->create("+918860315256", // to  
                 array("from" => "+12015296015", "body" => "Your One Time Password is " . $otp)  
          );         		  //12015296015

          $sql = $conn->prepare( "UPDATE `user_verify` SET opt = :opt WHERE phone_number = :phone_number" );
           $sql->bindParam(':opt', $otp);
          $sql->bindParam( ':phone_number', $phone_number);
          $sql->execute();
          $_SESSION['phone'] = $phone_number;


 	}catch(Exception $e){
 		echo $e->getMessage();
 	}
 }


function generateOTP(){
 	return rand( 1000, 9999 );
 }
?>