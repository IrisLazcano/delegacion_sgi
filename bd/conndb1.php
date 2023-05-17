<?php

function getConn(){
//$dsn = 'mysql:host=localhost;dbname=sgi';
$nombre_usuario = 'root';
$contraseña = '';

//$opciones = array(   PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',); 
$conexion = new PDO("mysql:host=localhost;dbname=bd_dgi", $nombre_usuario, $contraseña);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $conexion->exec("set names utf8");
    return $conexion;

}
?>
