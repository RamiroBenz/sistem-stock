<?php
/*include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado*/
		
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['id'])) {
           $errors[] = "No hay Id";
        } else if (empty($_POST['Cliente'])){
			$errors[] = "No existe el Cliente ";
		} else if ($_POST['Localidad']==""){
			$errors[] = "No hay Localidad..";
		
		} else if (
			!empty($_POST['id']) &&
			!empty($_POST['Cliente']) &&
			
			!empty($_POST['Localidad'])
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		include("../funciones.php");
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id=mysqli_real_escape_string($con,(strip_tags($_POST["id"],ENT_QUOTES)));
		$cliente=mysqli_real_escape_string($con,(strip_tags($_POST["cliente"],ENT_QUOTES)));
		$direccion=intval($_POST['Direccion']);
		$localidad=intval($_POST['Localidad']);
		$telefono=intval($_POST['Telefono']);
		$cuit=intval($_POST['cuit']);
		$mail=intval($_POST['mail']);
		
		


		$sql="INSERT INTO Cliente (id, Cliente, Direccion, Localidad, Telefono, cuit, mail) VALUES ('$id','$cliente','$direccion','$localidad', '$telefono','$cuit', $mail)";

		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "El Cliente se ha cargado correctamente..";
				/*$id_producto=get_row('Clientes','id', 'Cliente', $codigo);*/
				
				/*$nota="$firstname agregó $stock producto(s) al inventario";
				echo guardar_historial($id_producto,$user_id,$date_added,$nota,$codigo,$stock);*/
				
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>