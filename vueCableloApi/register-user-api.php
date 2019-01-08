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

$post = array();

if ($_SERVER["REQUEST_METHOD"] === 'POST')
{ 
    $user_full_name = ($data->userfullname);
    $user_email = ($data->uemail);
    $user_phone = ($data->uphone);
    $user_city = ($data->ucity);
    $user_locality = ($data->ulocality);
    $user_address = ($data->uaddress);
    $user_pincode = ($data->upincode);
    $user_setupboxno = ($data->usetupboxno);
    $user_statusCode = ($data->ustatusCode);

    $sql = "INSERT INTO user_registration (user_full_name, user_email, user_phone, user_city, user_locality, 
    user_address, user_pincode, setupbox_no, status_code) VALUES ('$user_full_name', '$user_email', '$user_phone', 
    '$user_city', '$user_locality', '$user_address', '$user_pincode', '$user_setupboxno', '$user_statusCode') ";
    
    $result = $conn->query($sql);

    if($result == 1)
    {
        $post["message"] = "data saved successfully";
        $post["status"] = "success";
    }
    else
    {
        $post["message"] = "data not saved successfully";
        $post["status"] = "error";
    }
}
else
{
    $post["message"] = "Format not supported";
    $post["status"] = "error";    
}

echo json_encode($post);
  
?>