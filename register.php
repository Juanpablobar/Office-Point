<?php
session_start();
		require_once  'php/facebook-php-sdk/autoload.php'; 
		$fb = new Facebook\Facebook([
		  'app_id' => '469268581120254',
		  'app_secret' => '650e33acdbf383f9af48fd69de5ad175',
		  'default_graph_version' => 'v3.2',
		  ]);

		$helper = $fb->getRedirectLoginHelper();

		$permissions = ['email']; // Optional permissions
		$redirectURL = "https://".$_SERVER['SERVER_NAME']."/php/fbLogin.php";
		$loginUrl = $helper->getLoginUrl($redirectURL, $permissions);
 ?>
 <!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Regístrate</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/login.css?10.0"> 
	
</head>
<body>

<?php include ('./layouts/reload.php'); ?>

<div class="login">
	<div class="register-second">
	</div>
	<div class="login-first">
	<div class="login-cont">
		<a href="./"><img src="img/logo.png" title="Office Point Logo"></a>
		<h1>Regístrate</h1>
		<form action="./php/register.php" method="post">
				<div class="login-input-item">
					<h2>Tu Nombre</h2>
					<input type="text" name="name" placeholder="Nombre" required>
				</div>
				<div class="login-input-item">
						<h2>Correo electrónico</h2>
					<input type="text" name="email" placeholder="nombre@ejemplo.com" id="email" required>
						<?php
						if(isset($_GET['invalid_email'])){
							echo '<h3>Introduce una dirección de correo válida</h3>';
						}						if(isset($_GET['already_register'])){
							echo '<h3>Esta dirección de correo eléctrónico ya está siendo usada. Por favor, introdúce otra.</h3>';
						}
						?>
				</div>
				<div class="login-input-item">
					<h2>Contraseña</h2>
					<input type="password" name="password" placeholder="Introduce 8 caracteres o más" minlength="8" required>
				</div>
				<button type="submit" name="send">REGÍSTRATE</button>
		</form>
		<h3>o</h3>
		<?php
		echo '<a class="button-facebook" href="'.$loginUrl.'"><img src="img/facebook.svg"><h2>INICIAR SESIÓN CON FACEBOOK</h2></a>';
		?>
		<?php
require_once './php/google-api/vendor/autoload.php';

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
} else {
  echo '<a class="button-google" href="'.$client->createAuthUrl().'"><img src="img/google.svg"><h2>INICIAR SESIÓN CON GOOGLE</h2></a>';
}		?>
		<h4>¿Ya estás registrado? <a href="login">Inicia Sesión</a></h4>
	</div>
	</div>
</div>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/reload.js"></script>
</body>
</html>
