<?php
session_start();
require_once  './facebook-php-sdk/autoload.php'; 

$fb = new Facebook\Facebook([
	'app_id' => '469268581120254',
	'app_secret' => '650e33acdbf383f9af48fd69de5ad175',
 	'default_graph_version' => 'v3.2',
  ]);

  

$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
  
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}
try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get('/me?fields=id,name,email', $accessToken);
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  
  $user = $response->getGraphUser();
 // var_dump($user);
  //echo 'Id: ' . $user['id'];				// <- datos
  //echo 'Name: ' . $user['name'];
  //echo 'Email: ' . $user['email'];
	include './conexion.php';
   		$respuesta = $conexion->query("select * from usuarios where correo='".$user['email']."'")or die($conexion->error);
	 	if(mysqli_num_rows($respuesta) == 0){
		$pass= $_POST['password'];
		$conexion->query("insert into usuarios (nombre,correo,contraseña,nivel, metodo)
		values(
		'".$user['name']."',
		'".$user['email']."',
		'".$accessToken."',
		'cliente',
		'Facebook'
		)
		")or die($conexion->error);
    $datos_usuario = mysqli_fetch_row($respuesta);
    $nombre = $user['name'];
    $id_usuario = $datos_usuario[0];
    $email = $user['email'];
    $nivel = 'cliente';
    $metodo = 'Facebook';
    $_SESSION['datos_login']= array(
    'nombre'=>$nombre,
    'id'=>$id_usuario,
    'correo'=>$email,
    'nivel'=>$nivel,
    'metodo'=>$metodo
    );
			header('Location: ../dashboard/');		
		}else{
      $datos_usuario = mysqli_fetch_row($respuesta);
      $nombre = $datos_usuario[1];
      $id_usuario = $datos_usuario[0];
      $email = $datos_usuario[2];
      $nivel = $datos_usuario[4];
      $metodo = $datos_usuario[5];
      $_SESSION['datos_login']= array(
      'nombre'=>$nombre,
      'id'=>$id_usuario,
      'correo'=>$email,
      'nivel'=>$nivel,
      'metodo'=>$metodo
      );
        header('Location: ../dashboard/');
		}
// Logged in
//echo '<h3>Access Token</h3>';
// $accessToken; //                               <- token de acceso

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
//$tokenMetadata = $oAuth2Client->debugToken($accessToken);
//echo '<h3>Metadata</h3>';
//var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
//$tokenMetadata->validateAppId('{app-id}'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
//$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
?>