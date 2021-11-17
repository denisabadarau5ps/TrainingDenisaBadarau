<?php

include 'config.php';

#connect to database
function connect()
{
    $conn=new mysqli('localhost','root','','productsdb');
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

#validate form data
function testInput($input){
    $input=trim($input);
    $input=stripslashes($input);
    $input=htmlspecialchars($input);
    return $input;
}

?>
