<!DOCTYPE html>
<?php

session_start();
if (@!$_SESSION['cvesp']) {
    header("Location:index.php");
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/titulo.css"/>
    <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
  <title>CONTROL DE DOCUMENTOS</title>
  </head>

<body>
<div class="container">
        <header class="row">
            <div class="center"  id="titulo">   
               <!-- <H1>HEADER</H1> -->
            </div>
		</header>
        <p>
 			<section class="contenedor-main row">
              <div class="col-sm-2"> <!-- Inicio Menú -->
              <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menú </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                         <a class="dropdown-item" href="./tabla_super.php">PÁGINA PRINCIPAL</a>
                         <a class="dropdown-item" href="./tabla_excel_super.php">BUSCAR Y EXPORTAR A:</a>

             </div>
             </div>           
         
            </div> <!-- FIN Menú-->
            
			 
            <main class="col-md-8">
            <table class="table table-striped" id="cabecera">
					<td><a><strong><?php echo $_SESSION['nombre']; ?></strong></a> </td>
	  		</table>
              </main>
                 

            <div class="col-sm-2">
			 <table class="table">
					<td width="350" align="right"><a href="desconectar.php" class="btn btn-info"> Cerrar Sesion </a></td>
   			 </table>	
            <!-- Lado derecho -->
             </div>  
             </section> 
             <td width="350" align="right"><a href="tabla_super.php" class="btn btn-info"> Regresar </a></td>

            <div class="row">
            <div class="col-lg-12">   

            <div class="center" style="text-align: center;"> 
                     <h2>
                          
                             CONTROL DE DOCUMENTOS 
                        
                    </h2>
            </div>
           <?php 
            $idfolio =$_POST['idfolio'] ;
             ?>	  
			 <?php 
			$i = 1;
            require("./bd/conndb1.php");
            $conexion = getConn();
            $usu = $_SESSION['cvesp'];
            $idarea=$_SESSION['idarea'];

            $sql = "SELECT * FROM tbl_docs WHERE tbl_docs.folio=$idfolio ";
            $result = $conexion->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);

            ?>
			<form  class="form-control" enctype="multipart/form-data">
                <input  type="hidden"  name="idfolio"  value="<?php echo $idfolio; ?>" >
                <input type="hidden" id="area" value=<?php  echo $idarea; ?> name="area">


	        <fieldset class="fieldset1">
            <legend class="legend1 estilo4">
            <p>Asunto / Documento </p> </legend>
    		   <div class="row">
				<div class="col-sm-4">
			   Fecha
 				
            <input name="fechaact"  disabled="disabled" type="text"  value="<?php echo $fecha=$row['fechaact']; ?>"  class="form-control"/>
   			</div> 
			<div class="col-sm-8">
 			 Remitente
 			 <input name="remitente" disabled="disabled" class="form-control" type="text" value="<?php echo $row['remitente']; ?>" tabindex="1"/>
    </div> 
	</div> 
    
            <fieldset class="fieldset1">
            <legend class="legend1 estilo4">
            <p>Detalle del Documento</p> </legend>
			<div class="row">
				<div class="col-sm-4">
  			Fecha de emisión del documento
  			<input  name="fechadoc"  disabled="disabled" type="text"  value="<?php  echo $fecha = $row['fecha_doc']; ?>"  class="form-control"/>
 			</div> 
			<div class="col-sm-4">
			Referencia
			<input name="referencia" disabled="disabled" class="form-control" type="text"  value="<?php echo $row['docreferencia']; ?>"  tabindex="4"/> 
			</div> 

            <div class="col-sm-4">
			Folio
			<input name="folio" disabled="disabled" class="form-control" type="text"  value="<?php echo $row['folio']; ?>"  tabindex="5"/> 
			</div> 



			
			</div> 	
			<p>Descripción</p>
			<p><textarea name="asunto"  class="form-control" disabled="disabled" value="" > <?php echo $row['descripcion']; ?></textarea>
				
			<p>Observaciones</p>
			<p><input name="observacion" disabled="disabled" class="form-control" type="text"value="<?php echo $row['observacion']; ?>" tabindex="4">

        </fieldset>
	
        <?php include ("tabla_res_super.php"); ?>

 		
         <div class="col-sm-10">
				<!--	<input type="file" class="form-control" id="archivo" name="archivo">-->
						
						<?php 
							$path = "files/".$idfolio;
							if(file_exists($path)){
								$directorio = opendir($path);
								while ($archivo = readdir($directorio))
								{
									if (!is_dir($archivo)){
                                        
                                        echo "$archivo";
										echo "<div class='center'><iframe  src='files/$idfolio/$archivo' width='120%' frameborder='0' height='550'></iframe></div>";
									}
								}
							}
							
						?>
						
					</div>

                    <input name="usu" type="hidden" value="<?php echo $_SESSION['cvesp'];?>" />
	         	</form>
               	<div class="row">
					
					
                     <div class="col-sm-4">
					 <form id="ver" action="tabla_super.php" method="post">
						<input type="submit" class="tbl" title="Ver Tabla" id="opcion" value=" "/> 
					</form>
					</div> 
   				</div> 
       
            
                   </div>
             </div>    
        
      
   	 </div>
</body>
</html>