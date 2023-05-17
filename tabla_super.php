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
              <div class="col-sm-1"> <!-- Inicio Menú -->
              <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menú </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                         <a class="dropdown-item" href="./tabla_super.php">PÁGINA PRINCIPAL</a>
                         <a class="dropdown-item" href="./tabla_excel_super.php">BUSCAR Y EXPORTAR A:</a>

             </div>
             </div>           
         
            </div> <!-- FIN Menú-->
            <div style="margin-left: 10px;" class="col-sm-1.5"> <!-- Inicio Menú -->
              <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Historial </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                         
              
                         <a class="dropdown-item" href="./tabla_super4.php?year=2022"> 2022</a>
                         <a class="dropdown-item" href="./tabla_super3.php?year=2021"> 2021 </a>
                         <a class="dropdown-item" href="./tabla_super1.php?year=2020"> 2020 </a>
                         <a class="dropdown-item" href="./tabla_super2.php?year=2019"> 2019 </a>

                         
             </div>
             </div>           
         
            </div>
			 
            <main class="col-md-7">
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
                     <h2>
                          
                             CONTROL DE DOCUMENTOS 
                        
                    </h2>
            </div>

                                <table class="table table-striped">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th class="center"> No.</th>
                                            <th class="center"> Folio</th>
                                            <th class="center"> Fecha Actual</th>
                                            <th class="center"> Fecha del Documento</th>
                                            <th class="center"> Numero de Oficio </th>
                                            <th class="center"> Nombre del remitente</th>
                                            <th class="center"> Concepto</th>
                                            <th colspan="2" class="center">Estatus</th>
                                            <th colspan="3" class="center"> Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="center">


                                        <?php
                                       
                                        $i = 1;
                                        require('./bd/conndb1.php');
                                        $conexion = getConn();
                                        $usu = $_SESSION['cvesp'];
                                        $idarea=$_SESSION['idarea'];

                                        $_pagi_sql = "SELECT distinct(d.idfolio) idfolio,ROW_NUMBER() OVER(ORDER BY d.folio DESC) N,d.folio, d.fechaact,d.fecha_doc, d.docreferencia, d.remitente, d.descripcion
                                        FROM tbl_docs d, tbl_asignados a 
                                          /*where  id_area=$idarea*/ 
                                            where fechaact > '2023-01-01'
                                              and a.idfolio = d.folio            
                                                          GROUP BY d.folio order by d.folio DESC";

                                        //and fecha >='2019-01-01'
                                        $_pagi_result = $conexion->query($_pagi_sql);
                                        $numfilas = $_pagi_result->rowCount();
                                        if ($numfilas == 0) {
                                            echo '<script>alert(" NO CUENTA CON REGISTROS EN ESTA SECCION ")</script>';
                                        } else {
                                            
                                            $_pagi_nav_estilo = "cls_pagi"; 
                                            $enlacesdepaginacion = 11;

                                            include("paginator2.inc.php");

                                            while ($i <= 1) {
                                                $x = $_pagi_hasta;
                                                
                                                while ($row = $_pagi_result->fetch(PDO::FETCH_ASSOC)) {
                                                    $n = $row['N'];
                                                    $x=$i;
                                                    $contador=$i; 
                                                    $idfolio = $row['folio'];
                                                    $folio = $row['folio'];
                                                    $fechaact = $row['fechaact'];
                                                    $fecha_doc = $row['fecha_doc'];
                                                    $docreferencia = $row['docreferencia'];
                                                    $remitente = $row['remitente'];
                                                    $descripcion = $row['descripcion'];

                                                    include("./asignados_super.php");
                                                    
                                                   // }
                                                    ?>

                                        </tr>
                                        <?php
                                        $i++;
                                        $x--;
                                      
                                    }
                                    $sig = $_Num_regis_Consul + 1;
                                } 
                            }
                            ?>
                                    </tbody>
                                </table>
                              
                                <?php

                                $conexion = null;
                                if ($numfilas == 0) { } else {
                                    echo "<div id = \"cls_pagi\"><p align=\"center\">" . $_pagi_navegacion . "</p>";
                                }

                                ?>
                           
            
                           </div>
             </div>    
         
       
   
    <script type="text/javascript">
                    $(document).ready(function() {
                        $("form.external").on('click', function() {
                            url = $(this).attr("action");
                            window.open(url, '_blank');
                            return false;
                        });
                    });
                </script>
	 </div>
</body>
</html>