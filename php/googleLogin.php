<?php
require_once './google-api/vendor/autoload.php';

// init configuration
$clientID = '1007307748626-8d67t19k3aqkoeunfq2qsfec8i7gk4gi.apps.googleusercontent.com';
$clientSecret = 'pMigrUlWudd8PqkkAM2BfphW';
$redirectUri = 'https://equipamostuoficina.com/php/googleLogin.php';
 
// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
 
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;

  // now you can use this profile info to create account in your website and make user logged in.
	include './conexion.php';
   		$respuesta = $conexion->query("select * from usuarios where 	correo='".$email."'")or die($conexion->error);
	 	if(mysqli_num_rows($respuesta) == 0){
		$pass= $_POST['password'];
		$conexion->query("insert into usuarios (nombre,correo,contraseña,nivel, metodo)
		values(
		'".$name."',
		'".$email."',
		'".$_GET['code']."',
		'cliente',
		'Gmail'
		)
		")or die($conexion->error);
			header('Location: ../dashboard/');		
		}else{
			header('Location: ../dashboard/');
		}
}

?>