<?php
  
$conn = new mysqli("localhost", "root", "", "vue_cable");
  
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

$data = json_decode(file_get_contents("php://input"));

if ($_SERVER["REQUEST_METHOD"] === 'POST')
{
    $uemail = ($data->email);
    $password = ($data->password);
    $api_token = ($data->api_token);

    $sql = "select u_email, password, api_token from admin_cred where u_email ='$uemail' and password = '$password' and api_token = '$api_token' ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0 ) {
        echo json_encode(
            array('authentication' => true, 'api_token'=>'abdc#0000')
        );
    } else {
      echo json_encode(
        array('authentication' => false, 'error-msg'=>'Invalid Credentials')
      );
    }
}
  
  
?>