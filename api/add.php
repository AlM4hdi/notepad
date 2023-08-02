<?php 

include "db.php";

if(isset($_SERVER['HTTP_ORIGIN'])){
    // header('Access-Control-Allow-Origin: http://pracaccounting.ezyro.com');
    
    header('Access-Control-Allow-Origin: *');

    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 1000');
}
if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
    if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])){
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    }
    if(isset($_SERVER['HTTP_ACCESS-CONTROL_REQUEST_HEADERS'])){
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
    }
    exit(0);
}
$response = array('error' => false);
$action = '';
if(isset($_GET['action'])){
    $action= $_GET['action'];
}

if($action== 'newsolved'){
    // $userid=$_POST['userid'];
    $title=$_POST['title'];
    
   $sql = "INSERT INTO `solved_problem`(`id`, `title`) VALUES (NULL, '$title')";
    $querySubmit=$conn->query($sql);
    if($querySubmit== true){
        $response['error']=false;
        $response['message']='New question added successfully';
    } else{
        $response['error']=true;
        $response['message']='Failed to add the question';
    }
}

mysqli_close($conn);
header("Content-type: application/json");
echo json_encode($response);
die();
?>
