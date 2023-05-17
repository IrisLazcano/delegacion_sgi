<?php

include "./bd/conexion.php";

//$user_id=null;
//$sql1= "select * from person";
if (isset( $_GET['folio'])) 
	{
		//echo "Variable definida!!!";
		$folio =$_GET['folio'];
		trim($folio);
	}


	$query = "SELECT DISTINCT (idconcepto), idfolio, id_area from tbl_asignados, tbl_resolucion
             where  idfolio=$folio and idfolio=docref";
            $resultado = $dbh->query($query);
            $numfilas = $resultado->rowCount();
            if ($numfilas == 0) {

                $sql1 = "UPDATE tbl_docs SET asignar=0 where Idfolio=$folio";
                $res = $dbh->query($sql1);

            } else {

			   $sql = "SELECT DISTINCT(a.idconcepto), a.idreg as id, a.idfolio as folio,
               ar.area as area, u.cvesp as cve, u.nombre as sp, c.tarea as concep
    from tbl_asignados a
    inner join cat_conceptos c on a.idconcepto = c.Id
			inner join cat_areas ar on a.id_area = ar.Id
				inner join tbl_usuarios u on a.cvesp = u.cvesp
	where a.idfolio=$folio";
    $query = $dbh->query($sql);

    $query1="SELECT DISTINCT (r.Idr)
    from tbl_resolucion r
    where r.docref=$folio";
    $query2 = $dbh->query($query1);

					$numfila = $query->rowCount();
?>

<?php if($numfila >0){?>
<table class="table table-bordered table-hover">
<thead>
	<th>Área</th>
	<th>Servidor Público</th>
	<th>Concepto</th>
	<!--<th>Direccion</th>
	<th>Telefono</th> -->
	<th></th>
</thead>
<?php while ($r=$query->fetch(PDO::FETCH_ASSOC)):?>
<tr>
	<?php $id = trim($r["id"]); 
		
		$folio = trim($r["folio"]);
        $cve =trim($r["cve"]);
        
        $c=$query2->fetch(PDO::FETCH_ASSOC);
		$idr=trim($c["Idr"]);
		
	?>

	<td><?php echo $r["area"]; ?></td>
	<td><?php echo $r["sp"]; ?></td>
	<td><?php echo $r["concep"]; ?></td>
	<!--<td><?php //echo $r["address"]; ?></td>
	<td><?php //echo $r["phone"]; ?></td>-->
	<td style="width:150px;">
	<!--	<a data-id="<?php //echo $cvesp;?>" class="btn btn-edit btn-sm btn-warning">Editar</a> -->
		<a href="#" id="del-<?php echo $id;?>" class="btn btn-sm btn-danger">Eliminar</a>
		<script>
		var cvesp = "<?php echo $cve; ?>";
		$("#del-"+<?php echo $id;?>).click(function(e){
			e.preventDefault();
			p = confirm("Estas seguro?");
			if(p){
				$.get("eliminar.php","id="+<?php echo $id;?>+"&sp="+<?php echo $cve;?>+"&folio="+<?php echo $folio;?>+"&idr="+<?php echo $idr;?>,function(data){
					loadTabla();
				});
			}

		});
		</script>
	</td>
</tr>
<?php endwhile;?>
</table>
<?php }else{
	
	?>
	<p class="alert alert-warning">No hay resultados</p>


<?php //endif;
}

						}
?>
  <!-- Modal -->
  <script>
  	$(".btn-edit").click(function(){
			var folio = "<?php echo $idfolio; ?>";
  		cvesp = $(this).data("cvesp");
  		$.get("./php/formulario.php","cvesp="+cvesp+"folio="+folio,function(data){
  			$("#form-edit").html(data);
  		});
  		$('#editModal').modal('show');
  	});
  </script>
<?php ?>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Actualizar</h4>
        </div>
        <div class="modal-body">
        <div id="form-edit"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->