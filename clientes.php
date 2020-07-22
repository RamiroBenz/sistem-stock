<?php
	session_start();
	/* Connect To Database*/
	require_once ("cn.php");//Contiene las variables de configuracion para conectar a la base de datos
	
	$active_cliente="active";
	$title="Clientes | Simple Clientes";

	$vista="SELECT * FROM Clientes";

	$resultado=$conexion->query($vista);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Clientes</title>
	<?php include 'head.php'; ?>
</head>
<body>

	<?php include 'navbar.php'; ?>
	<br>
	<div align="center">
	<br><br>
	<?php include 'reloj.php'; ?>
	<br><br>
	</div>
	<div class="container">
	<form action="modal/agregar_cliente.php" method="POST">
		<div class="panel panel-success">
			<div class="panel-heading">
			    <div class="btn-group pull-right">
			    	<button type="submit" type='button' class="btn btn-success" data-toggle="modal" data-target="#nuevoCliente"><span class="glyphicon glyphicon-plus" ></span> Agregar</button>
			    </div>	
				<h4><i class='glyphicon glyphicon-search'></i> Consultar Clientes</h4>
			</div>
		<div class="panel-body">
		
	</form>		
			
			<?php
			include("modal/registro_clientes.php");
			include("modal/editar_cliente.php");
			?>
			<form class="form-horizontal" role="form" id="datos">
				
						
				<div class="row">
					<div class='col-md-4'>
						<label>Filtrar por código o nombre</label>
						<input type="text" class="form-control" id="q" placeholder="Código o nombre del Cliente" onkeyup='load(1);'>
					</div>
					
					
					<div class='col-md-12 text-center'>
						<span id="loader"></span>
					</div>
				</div>
				<br><br>
				<hr>
				<div class='row-fluid'>
					<div id="resultados">
						<table id="lookup" class="table table-bordered table-hover" width="85%" border='1' cellpadding='10'>
							<thead>
								<tr class="centro">
									
									<td><b>id</b></td>
									<td><b>Cliente</b></td>
									<td><b>Direccion</b></td>
									<td><b>Localidad</b></td>
									<td><b>Telefono</b></td>
									<td><b>C.U.I.T.</b></td>
									<td><b>E-Mail</b></td>
								</tr>
								<tbody>
									<?php while($row=$resultado->fetch_assoc()){ ?>
									<tr>
										<td><?php echo $row['id']?></td>
										<td><?php echo $row['Cliente']?></td>
										<td><?php echo $row['Direccion']?></td>
										<td><?php echo $row['Localidad']?></td>
										<td><?php echo $row['Telefono']?></td>
										<td><?php echo $row['cuit']?></td>
										<td><?php echo $row['mail']?></td>
									</tr>
									<?php } ?>
								</tbody>
							</thead>
						</table>
					</div>
					<!-- Carga los datos ajax -->
				</div>	
				<br>
				<br>
				<br>
				<!-- <div class='row'>
					<div class='outer_div'></div>
					Carga los datos ajax
				</div> -->
				<br>
				<br>
				<br>
			</form>
				
			
		
	
			
			
			
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/productos.js"></script>
  
<script>
function eliminar (id){
		var q= $("#q").val();
		var id_categoria= $("#id_categoria").val();
		$.ajax({
			type: "GET",
			url: "./ajax/buscar_productos.php",
			data: "id="+id,"q":q+"id_categoria="+id_categoria,
			 beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados").html(datos);
			load(1);
			}
		});
	}
		
	$(document).ready(function(){
			
		<?php 
			if (isset($_GET['delete'])){
		?>
			eliminar(<?php echo intval($_GET['delete'])?>);	
		<?php
			}
		
		?>	
	});
		
$( "#guardar_cliente" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_cliente.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax_productos").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax_cliente").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

</script>
	
</body>
</html>