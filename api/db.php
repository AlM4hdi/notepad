<?php 

 $conn = new mysqli("hostname", "username", "database password", "database name");
if(!$conn){
    echo "Failed to connect to the database";
};
?>

