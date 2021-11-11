
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>LOGINOAUTHTEST</title>
</head>
<body>
    
    
<?php
$client_id = "wprQYMZBqqx-dgszFUfQG";
$authorizeURL = "https://id-sandbox.cashtoken.africa/oauth/authorize";

$tokenURL =
'https://id-sandbox.cashtoken.africa/oauth/token';

$APIurlBASE = "https://id-sandbox.cashtoken.africa";

$domaine = "/loginoauthtest";

$baseURL = 'http://localhost/loginoauthtest/index.php';
// echo $baseURL;


session_start();


if (isset($_GET['sign-out'])) {
  session_destroy();
}


////Make a request to endpoint server for Access Token Request
////Make a request to endpoint server for Access Token Request
////Make a request to endpoint server for Access Token Request
  if(isset($_GET['code'])) {
    // Verify the state matches our stored state
    if(!isset($_GET['state'])
      || $_SESSION['state'] != $_GET['state']) {
   
      header('Location: ' . $baseURL . '?error=invalid_state');
      die();
    }
  
    $authorization_code = $_GET['code'];
    $client_secret = $_GET['state'];
   // Exchange the auth code for an access token
    $fields = [
        'grant_type' => 'authorization_code',
        'client_id' => $client_id,
        'redirect_uri' => $baseURL,
        'state' => $client_secret,
        'code_verifier'=> $_SESSION['code_verifier'],
        'code' => $authorization_code
    ];
    $fileds_string = http_build_query($fields);

    $headers = array(
      "Content-Type: application/x-www-form-urlencoded"
   );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, $tokenURL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fileds_string);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $variable = substr($result, 17);
    $access_token = substr($variable, 0, strpos($variable, '"'));
    $_SESSION['access_token'] = $access_token;
    curl_close($ch);

    header('Location: userinfo.php');
 
    

   
    
    die();
  }



  






///Login&&Profile Page  Login&&Profile Page
///Login&&Profile Page  Login&&Profile Page
///Login&&Profile Page  Login&&Profile Page

if (!isset($_GET['action'])) {
    if(!empty($_SESSION['access_token'])) {
      echo '
          <div class="container-fluid">
          <div class="row">
              <div class="profile-header">
                  <div class="logo"></div>
                  <a href="signout.php" class="btn btn-primary">Sign Out</a>
                  
              </div>
          </div>
          <div class="row profile-row">
              <div class="col-md-4">
                  <div class="text-center">
                      <img src="https://via.placeholder.com/300x250" alt=""><br>
                      <div style="text-align: left;">
                          <h3>Name: <?php echo $_SESSION["first_name"]." ".$_SESSION["last_name"];?></h3>
                          <h4 >Gender: <?php echo $_SESSION["gender"];?></h4>
                          <h4 >Email: <?php echo $_SESSION["user_email"];?></h4>
                          <h4 >Username: <?php echo $_SESSION["user_name"];?></h4>
                      </div>
                      <br>

                      <a class="btn btn-primary btn-xs" href="#" role="button">Facebook</a>
                      <a class="btn btn-primary btn-xs" href="#" role="button">Twitter</a>
                      <a class="btn btn-primary btn-xs" href="#" role="button">Instagram</a>
                      <a class="btn btn-primary btn-xs" href="#" role="button">Website</a>
                  </div>
              </div>
              <div class="col-md-8">
                  <p class="lead profile-row">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed sunt quis maxime accusamus nesciunt, doloremque tempore debitis odio? Quidem ullam ipsa temporibus assumenda non inventore consequuntur vero velit, iure ipsam. </p> <hr>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea, incidunt?</p>
                  <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Blanditiis enim expedita eaque dolorem corrupti accusamus.</p>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem maxime deleniti velit accusamus modi excepturi ullam hic ex fuga odit repellendus, libero earum aliquid molestiae!</p>
                  <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt natus aliquid dignissimos obcaecati assumenda magnam amet eveniet voluptates corrupti inventore?</p>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, accusamus.</p>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt, possimus fuga incidunt vel reiciendis commodi sed dolorem alias officiis deleniti minus tenetur, enim, quisquam qui sequi. Sit, quas dolorem.</p>
              </div>
          </div>
      </div>
      ';
    }else {
      echo 
            '<div class="form-container">
                <div class="form-group login-wrapper" >
                    <h3 class="login_welcome">Welcome To Lotsconnect</h3>
                    <input placeholder="Email" type="email" name="email" class="form-control">
                    <input placeholder="Password" type="password" name="password" class="form-control">
                    <p><a class="btn btn-primary login-submit" href="#">Sign In</a></p>
                    <p class="divider"> or </p>
                    <a  class="cashtokenlink" href="?action=login"><img src="./images/cashtoken.jpg" alt=""> <p>Sign in with Cash Token</p></a>
                </div>
            </div>'
            ;
            die();
    }
   }
    










// Start the login process by sending the user
// to cashtoken's authorization page
// Start the login process by sending the user
// to cashtoken's authorization page
if(isset($_GET['action']) && $_GET['action'] == 'login') {
    unset($_SESSION['access_token']);
    unset($_SESSION['code_verifier']);
    unset($_SESSION['code_challenge']);
   
    $_SESSION['state'] = bin2hex(random_bytes(16));
    // // $verify_bytes = random_bytes(64);
    // $code_verifier = bin2hex(random_bytes(30)).'-_~.';
    // $_SESSION['code_verifier'] = $code_verifier;
    // $hash = hash('sha256', $code_verifier);
    // $code_challenge = rtrim(strtr(base64_encode($hash), '+/', '-_'), "=");
    // $_SESSION['code_challenge'] = $code_challenge;


    function base64url_encode($plainText)
    {
        $base64 = base64_encode($plainText);
        $base64 = trim($base64, "=");
        $base64url = strtr($base64, '+/', '-_');
        return ($base64url);
    }

    $random = bin2hex(openssl_random_pseudo_bytes(32));
    $verifier = base64url_encode(pack('H*', $random));
    $_SESSION['code_verifier'] = $verifier;
    $challenge = base64url_encode(pack('H*', hash('sha256', $verifier)));
    $_SESSION['code_challenge'] = $challenge;
  
    

    $params = array(
      'response_type' => 'code',
      'grant_type' => 'authorization_code',
      'client_id' => $client_id,
      'redirect_uri' => $baseURL,
      'scope' => 'openid email profile',
      'code_verifier'=> $_SESSION['code_verifier'],
      'code_challenge' => $_SESSION['code_challenge'],
      'code_challenge_method'=> 'S256',
      'state' => $_SESSION['state']
    );
   
    // // // Redirect the user to cashToken's authorization page
    header('Location: '.$authorizeURL.'?'.http_build_query($params));
    die();
  }


  




  ?>
</body>
</html>
