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
    //print_r($user_id);

    $sql = "UPDATE user_registration SET user_status ='inactive' WHERE user_id=$user_id"; 

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