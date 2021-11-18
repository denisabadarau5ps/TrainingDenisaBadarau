<?php
    require 'config.php';
    #connect to database
    function connect()
    {
        $dsn= "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=UTF8";
       try{
           $conn=new PDO($dsn,DB_USER,DB_PASS);
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           if($conn){
               return $conn;
           }
       }catch(PDOException $e){
           echo $e->getMessage();
       }
    }

    #validate form data
    function testInput($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

