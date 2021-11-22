<?php
require_once 'config.php';
include 'translate.php';
session_start();

#connect to database
function connect()
{
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=UTF8";
    try {
        $conn = new PDO($dsn, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($conn) {
            return $conn;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

#validate form data
function sanitize($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

//add an image in forlder
function addImage($fileName)
{
    $targetDir = "C:/xampp/htdocs/images/";
    $file = $_FILES['fileToUpload']['name'];
    $path = pathinfo($file);
    $ext = $path['extension'];
    $temp_name = $_FILES['fileToUpload']['tmp_name'];
    $path_filename_ext = $targetDir . $fileName . "." . $ext;
    move_uploaded_file($temp_name, $path_filename_ext);
}

function translate($data)
{
    return $data;
}



