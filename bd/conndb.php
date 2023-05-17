<?php

/*** mysql hostname ***/
$hostname = "localhost";//servidor dgi
//$hostname = 'localhost'; //Locale
//echo $hostname;

/*** mysql username ***/
//$username = 'root'; //SEI
$username = "root";

/*** mysql password ***/
$password = "";//serverdgi
//$password = 'rootdgi2015';//serversei
//$password = 'Dgi$2017';


try {
  //$dbh = new PDO("mysql:host=$hostname;dbname=padronsgc", $username, $password);
  $conexion = new PDO(
    "mysql:host=$hostname;dbname=bd_dgi",
    $username,
    $password,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
  ); //dgi
  /*** echo a message saying we have connected ***/
  // echo 'Connected to database'.'<br />';
} catch (PDOException $e) {
  echo $e->getMessage();
}
?>
