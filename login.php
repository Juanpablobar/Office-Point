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
	<title>Office Point | Iniciar Sesión</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/login.css?11.0"> 
	
</head>
<body>

<?php include ('./layouts/reload.php'); ?>

<div class="login">
	<div class="login-second">
	</div>
	<div class="login-first">
	<div class="login-cont">
		<a href="./"><img src="img/logo.png" title="Office Point Logo"></a>
		<h1>Iniciar Sesión</h1>
		<form action="./php/login.php" method="post">
				<div class="login-input-item">
				<?php
					if(isset($_GET['error'])){
						echo '<h3 class="login-error" style="color:#ff6363;font-eweight:900;font-size: 16px;">Correo electrónico o contraseña incorrectos</h3>';
					}
					if(isset($_GET['invalid'])){
						echo '<h3 class="login-error" style="color:#ff6363;font-eweight:900;font-size: 16px;text-align:center">No existe una cuenta con este correo electrónico</h3>';
					}
					if(isset($_GET['new_user'])){
						echo '<h3 class="login-error" style="color:#24cc63;font-eweight:900;font-size: 16px;text-align:center">Tu usuario ha sido creado con éxito. Ahora inicia sesión.</h3>';
					}
					if(isset($_GET['new_password'])){
						echo '<h3 class="login-error" style="color:#24cc63;font-eweight:900;font-size: 16px;text-align:center">Tu contraseña ha sido reestablecida. Pruebe iniciando sesión de nuevo.</h3>';
					}
					?>
					<h2>Correo electrónico</h2>
					<input type="text" name="email" placeholder="nombre@ejemplo.com" required>
				</div>
				<div class="login-input-item">
					<div class="login-input-second">
					<h2>Contraseña</h2>
					<a href="#">¿Olvidaste tu contraseña?</a>
					</div>
					<input type="password" name="password" placeholder="Introduce 8 caracteres o más" required>
				</div>
				<button type="submit" name="send">INICIAR SESIÓN</button>
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
		<h4>¿Aún no estás registrado? <a href="register">Regístrate</a></h4>
	</div>
	</div>
</div>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/reload.js"></script>
</body>
</html>
