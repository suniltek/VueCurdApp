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
    $user_id = ($data->userid);
    $user_full_name = ($data->name);
    $user_email = ($data->email);
    $user_phone = ($data->phone);
    $user_city = ($data->city);
    $user_locality = ($data->locality);
    $user_address = ($data->address);
    $user_pincode = ($data->pincode);
    $user_setupboxno = ($data->setupbox_no);
    $user_statusCode = ($data->status);

    
    $sql = "UPDATE user_registration SET user_full_name ='$user_full_name', user_email='$user_email', 
    user_phone='$user_phone', user_city='$user_city', user_locality='$user_locality', user_address='$user_address', 
    user_pincode='$user_pincode', setupbox_no='$user_setupboxno', status_code='$user_statusCode' WHERE
    user_id=$user_id"; 

    // echo $sql;
    $result = $conn->query($sql);

    if($result)
    {
        $response = array('response'=> 'success');

        // $get["message"] = "User Updated successfully";
        // $get["status"] = "success";
        echo json_encode($response);
    }
    else
    {
        // $get["message"] = "User not Updated successfully";
        // $get["status"] = "error";
        $response = array('response'=> 'failed');
        echo json_encode($response);
    }
}
  
?>