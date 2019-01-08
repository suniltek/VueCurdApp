<?php
  
$conn = new mysqli("localhost", "root", "", "vue_cable");
  
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

$data = json_decode(file_get_contents("php://input"));

$get = array('error' => false);

if ($_SERVER["REQUEST_METHOD"] === 'GET')
{ 
    $sql = "SELECT user_id, user_full_name, user_email, user_phone, user_city, user_locality, user_address, 
    user_pincode, setupbox_no, status_code from user_registration WHERE user_status = 'active' ";
    
    $result = $conn->query($sql);
    $user_list = array();

    while($row = $result->fetch_assoc()){

        $users = array(
            'userid' => $row['user_id'],
            'name' => $row['user_full_name'],
            'email' =>$row['user_email'],
            'phone' => $row['user_phone'],
            'city' => $row['user_city'],
            'locality' => $row['user_locality'],
            'address' => $row['user_address'],
            'pincode' => $row['user_pincode'],
            'setupbox_no' => $row['setupbox_no'],
            'status' => $row['status_code'],
          );
		array_push($user_list, $users);
	}
 
	$get['user_list'] = $user_list;

    if($result)
    {
        $get["message"] = "data retrived successfully";
        $get["status"] = "success";
        echo json_encode($user_list);
    }
    else
    {
        $get["message"] = "data not retrived successfully";
        $get["status"] = "error";
    }
}
else
{
    $get["message"] = "Format not supported";
    $get["status"] = "error";    
}
  
?>