<?php

function OpenCon()
 {
 //Personalize com as opções de seu banco
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "BD_PEDIDOS";


 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>
