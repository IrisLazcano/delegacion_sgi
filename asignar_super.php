<?php 
  //include "php/navbar.php";
  include "bd/conexion.php";
  $idarea=$_SESSION['idarea'];
  $cvesp=$_SESSION['cvesp'];
  ?>

<h4>Servidores Públicos Asignados</h4>
<!-- Button trigger modal -->
<form class="form-inline" role="search" id="buscar">
      <div class="form-group">
        <!--<input type="text" name="s" class="form-control" placeholder="Buscar">-->
      </div>
      <!-- <button type="submit" class="btn btn-default">&nbsp;<i class="glyphicon glyphicon-search"></i>&nbsp;</button> -->
  <a data-toggle="modal" href="#newModal" class="btn btn-info">Agregar</a>
    </form> 

<br>
  <!-- Modal -- SUTITUIR POR COMBOS-->  
  <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Asignar Actividades</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
<form role="form" method="post" id="agregar" > <!-- action="leerdatos.php" -->
<input type="hidden" id="folio" value=<?php  echo $idfolio; ?> name="folio">
<input type="hidden" id="area" value=<?php  echo $idarea; ?> name="area">
  <div class="form-group">
  <?php if( $cvesp==997570520){  ?>
  <div class="form-group">
    <label for="lastname">RECURSOS HUMANOS</label>
  </div>  
  <?php } ?>  
  <?php if( $cvesp==997253757){  ?>
   
  <div class="form-group">
    <label for="lastname">RECURSOS MATERIALES</label>
  </div>  
  <?php } ?>
  <?php if( $cvesp==997034143) {  ?>
  <div class="form-group">
    <label for="lastname">RECURSOS FINANCIEROS</label>
  </div>  
  <?php } ?>

    <label for="lastname">Servidor Público</label>
    <?php 

     
    
     $sql1="SELECT * FROM tbl_usuarios, cat_areas where not tipo_usuario =2 and cat_areas.Id= $idarea and cat_areas.Id=tbl_usuarios.idarea  ";
        $resultado = $dbh->query($sql1); ?>
        <select name="usuario" id="usuarios" class="form-control" tabindex="9">
      <option value="0"> Elige una opción</option>
         <?php
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
        ?>
     <option value="<?php echo $row['cvesp']; ?>"><?php echo $row['nombre']; ?></option>
         <?php 
        } ?>
        </select>
    <!-- <input type="text" class="form-control" name="lastname" required> -->
  </div>
  <div class="form-group">
    <label for="address">Concepto</label>
    <?php
       $sql2= "SELECT * FROM cat_conceptos";
        $resultado2 = $dbh->query($sql2); ?>
        <select name="concepto" class="form-control" tabindex="10">
      <option  value="0"> Elige un Concepto</option>
         <?php
        while ($row2 = $resultado2->fetch(PDO::FETCH_ASSOC)) {
            ?>
     <option value="<?php echo $row2['Id']; ?>"><?php echo $row2['tarea']; ?></option>
<?php 
    } 
?>
        </select>
  </div>

  <button type="submit" class="btn btn-info">Agregar</button>
</form>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

<div id="tabla"></div>



<script>

function loadTabla(){
  var idfolio = "<?php echo $idfolio; ?>";
  var idarea= "<?php echo $idarea; ?>";
  //document.write("idfolio = " + idfolio);
  $('#editModal').modal('hide');
  $.get("./super_tabla.php",{folio:idfolio,idarea:idarea},function(data){
    $("#tabla").html(data);
  })
  //{folio :  idfolio} "&usuarios="+sp
}

$("#buscar").submit(function(e){
  e.preventDefault();
  $.get("busqueda.php",$("#buscar").serialize(),function(data){
    $("#tabla").html(data);
  $("#buscar")[0].reset();
  });
});

loadTabla();


  $("#agregar").submit(function(e){
    e.preventDefault();
    $.post("agregar.php",$("#agregar").serialize(),function(data){
    });
    //alert("Agregado exitosamente!");
    $("#agregar")[0].reset();
    $('#newModal').modal('hide');
    loadTabla();
  });
</script>
