﻿<?php
session_start();
include("./bd/conexion2.php");
//guardardo de formulario 
 $idfolio = $_POST['idfolio'];
 $fechaact=$_POST['fechaact'];
 $remitente=$_POST['remitente'];
 $fechadoc=$_POST['fechadoc'];
 $descripcion=$_POST['asunto'];
 $referencia=$_POST['referencia'];
 $observacion=$_POST['observacion'];
 $usu=$_SESSION['cvesp'] ;
 

		$idfolio = $idfolio;
	
		$query=utf8_decode("INSERT INTO tbl_docs(folio,fechaact,remitente,fecha_doc,docreferencia,descripcion,emitido,observacion) 
		VALUES ($idfolio,'$fechaact','$remitente','$fechadoc','$referencia','$descripcion', '$usu','$observacion')");
		$result= $mysqli->query($query);

	if($_FILES["archivo"]["error"]>0){
		echo "Error al cargar archivo";	
		} else {
		
		$permitidos = array("application/pdf");
		$limite_kb = 1024;
		
		if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024)
		{
			
			$ruta = 'pdf/'.$idfolio.'/';
			$archivo = $ruta.$_FILES["archivo"]["name"];
			
			if(!file_exists($ruta)){
				mkdir($ruta);
			}
			
			if(!file_exists($archivo)){
				
				$resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
				
				if($resultado){
					//echo "Archivo Guardado";
					echo '<script>alert("Archivo Guardado")</script> ';
					
					
				
				} else {
					echo '<script>alert("Error al guardar archivo")</script> ';
					echo "<script>location.href='tabla_admon.php' </script>";
				}
				
				} else {
				echo '<script>alert("Archivo ya existe")</script> ';
				echo "<script>location.href='tabla_admon.php' </script>";
			}
			
			} else {
			echo '<script>alert("Archivo no permitido o excede el tamaño")</script> ';
			echo "<script>location.href='tabla_admon.php' </script>";
		}
		
	}
	
	if($result){
		echo '<script>alert("REGISTRO GUARDADO")</script> ';
		echo "<script>location.href='tabla_admon.php' </script>";

		  
		}
		 else{
		 echo "no exitosa";
	 }


?>  
	
	