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

            <div class="row">
            <div class="col-lg-12">   

            <div class="center" style="text-align: center;"> 
                     <h4>
                          
                             RESOLUCIÓN
                        
                    </h4>
            </div>

            <?php 
                                $idfolio = $_GET['idfolio'];
                                ?>
                                <form action="guardar_res_super.php" method="post" class="form-control" enctype="multipart/form-data">


                                <?php 
                    require("./bd/conndb1.php");
                    $conexion = getConn();
                    $usu = $_SESSION['cvesp'];

                    $sql = "SELECT * FROM tbl_docs, tbl_asignados, tbl_usuarios 
                            WHERE tbl_docs.Idfolio=$idfolio
                            and tbl_docs.Idfolio=tbl_asignados.idfolio
                            and tbl_asignados.cvesp=tbl_usuarios.cvesp
                            and tbl_asignados.cvesp=$usu ";
                    $result = $conexion->query($sql);
                    $row = $result->fetch(PDO::FETCH_ASSOC);

                    ?>
                    <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                    <input type="hidden" name="referencia" value="<?php echo $row['docreferencia']; ?>">

                    <fieldset class="fieldset1">
                        <legend class="legend1 estilo4">
                            Resolución </legend>
                        <div class="row">
                            <div class="col-sm-4">

                                <p> Tipo de Documento de la resolución </p>
                                <input name="tipo_doc" class="form-control" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="" required="required" onpaste="return false" tabindex="1">
                            </div>
                            <div class="col-sm-4">
                                <p>Número de Documento de la resolución </p>
                                <input name="num_doc" class="form-control" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="" required="required" onpaste="return false" tabindex="2">
                            </div>
                            <div class="col-sm-4">
                                <p>Fecha de la resolución</p>
                                <?php 
                                date_default_timezone_set('America/Mexico_City');
                                $fecha = date('y/m/d');
                                ?>
                                <input name="fechares" id="fechaid1" type="datetimepicker" disabled="disabled" value="20<?php echo $fecha ?>" required="required" class="form-control" tabindex="" />
                                <input name="fechares" type="hidden" value="20<?php echo $fecha; ?>" />
                            </div>
                        </div>
                        <div class="row ">
                        <div class="col-sm-8">
                                <p>Notas: </p>
                                <input name="nota" class="form-control" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="" required="required" onpaste="return false" tabindex="3">
                            </div>
                        </div>


                    </fieldset>

                                    <fieldset class="fieldset1">
                                        <legend class="legend1 estilo4">
                                            <p>Asunto / Documento </p>
                                        </legend>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p>Fecha</p>

                                                <?php 
                                                date_default_timezone_set('America/Mexico_City');
                                                $fecha = date('y/m/d');
                                                ?>
                                                <input name="fechaact" id="fechaid1" type="text" disabled="disabled" value="20<?php echo $fecha; ?>" required="required" class="form-control" tabindex="3" />
                                                <input name="fechares" type="hidden" value="20<?php echo $fecha; ?>" />
                                            </div>
                                            <div class="col-sm-8">
                                                <p>Remitente</p>
                                                <p><input name="remitente" disabled="disabled" class="form-control" type="text" value="<?php echo $row['remitente']; ?>">
                                            </div>
                                        </div>

                                        <fieldset class="fieldset1">
                                            <legend class="legend1 estilo4">
                                                <p>Detalle del Documento</p>
                                            </legend>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p>Fecha de emisión del documento</p>
                                                    <p> <input name="fechadoc" id="fechaid1" type="date" value="<?php echo $fecha = $row['fecha_doc']; ?>" required="required" class="form-control" disabled="disabled" tabindex="3" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <p>Referencia</p>
                                                    <p><input name="referencia" disabled="disabled" class="form-control" type="text" value="<?php echo $row['docreferencia']; ?>">
                                                </div>
                                            </div>
                                            <p>Descripción</p>
                                            <p><textarea name="asunto"  class="form-control" disabled="disabled" value="" > <?php echo $row['descripcion']; ?></textarea>

                                                <p>Observaciones</p>
                                                <p><input name="observacion" disabled="disabled" class="form-control" type="text" value="<?php echo $row['observacion']; ?>">

                                        </fieldset>
                                        <input name="usu" type="hidden" value="<?php echo $_SESSION['cvesp']; ?>" />
                                       
                                        <div class="col-sm-10">
					<input type="file" class="form-control" id="archivo" name="archivo">
						
						<?php 
							$path = "files/".$idfolio;
							if(file_exists($path)){
								$directorio = opendir($path);
								while ($archivo = readdir($directorio))
								{
									if (!is_dir($archivo)){
                                        echo "$archivo";
                                     //   echo "$archivo <a href='#' class='delete' title='Ver Archivo Adjunto' ><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>                                       </div>";
										echo "<div class='center'><iframe  src='files/$idfolio/$archivo' width='120%' frameborder='0' height='550'></iframe></div>";
									}
								}
							}
							
						?>
						
					</div>

                                       
                                        <div class="row">
                                        <div class="col-sm-6">
                                        <input type="submit" title="Guardar" value=" " class="aceptar" id="opcion" tabindex="4" />
                                    
                                        </div>
</form>                             
                                             <div class="col-sm-6">
                                    <form id="ver" action="tabla_super.php" method="post">
                                        <input type="submit" class="tbl" title="Ver Tabla" id="opcion" value=" " tabindex="5" />
                                    </form>
                                </div>
                            </div>

                            </div>
             </div>    
         
  
	 </div>
</body>
</html>