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
$conn=connect();

#sanitize form data
function sanitize($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

//add an image in folder
function addImage($fileName)
{
    $targetDir = "C:/xampp/htdocs/images/";
    $ext ='jpg';
    $tempName = $_FILES['fileToUpload']['tmp_name'];
    $pathFilenameExt = $targetDir . $fileName . "." . $ext;
    move_uploaded_file($tempName, $pathFilenameExt);
}

//delete an image from images file
function deleteImage($fileName)
{
    $targetDir = "C:/xampp/htdocs/images/";
    $ext = 'jpg';
    $pathFilenameExt = $targetDir . $fileName . "." . $ext;
    if (file_exists($pathFilenameExt)){
        unlink($pathFilenameExt);
    }
}

function translate($data, $lang)
{
    GLOBAL $LANG;
    return $LANG[$lang][$data];
}
