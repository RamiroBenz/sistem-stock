<?php
session_start();

//En un principio la variable $tabla que muestra el nuevo registro debe declararse y estar en blanco.
$tabla = "";
//En un principio la variable $error que muestra el posible error al filtrar los datos debe declararse y estar en blanco.
$error = "";

/* Si el formulario es enviado */
if (isset($_POST["insertar"]))
{
//Almacenar los campos en variables
$cliente = $_POST['Cliente'];
$dir = $_POST['Direccion'];
$local = $_POST['Localidad'];
$tel = $_POST['Telefono'];
$cuit = $_POST['cuit'];
$mail = $_POST['mail'];

//Filtrar los datos por motivos de seguridad
//Este proceso siempre hay que llevarlo a cabo al hacer consultas a la base de datos
//Para cada campo aplicaré un filtro de no pasarlo no se realizará la inserción del nuevo registro.

if (!preg_match("/^[a-zA-ZñÑáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/", $cliente)) //letras latinas + espacios
{
$error = "Ha ocurrido un error, datos no permitidos.";
}
else if(!preg_match("/^[a-zA-ZñÑáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/", $dir)) //letras latinas + espacios
{
$error = "Ha ocurrido un error, datos no permitidos.";
}
else if(!preg_match("/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s\_\-\/\º\ª\.\,\:\;]+$/", $local)) //letras latinas + números + espacios + algunos caracteres más
{
$error = "Ha ocurrido un error, datos no permitidos.";
}
else if(!preg_match("/^[0-9]+$/", $tel)) //Sólo números
{
$error = "Ha ocurrido un error, datos no permitidos.";
}
else if(!preg_match("/^[0-9]+$/", $cuit)) //Sólo números
{
$error = "Ha ocurrido un error, datos no permitidos.";
}
else if(!preg_match("/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s\_\-\/\º\ª\.\,\:\;]+$/", $mail)) //letras latinas + números + espacios + algunos caracteres más
{
$error = "Ha ocurrido un error, datos no permitidos.";

{
/* Connect To Database*/
	require_once ("cn.php");//Contiene las variables de configuracion para conectar a la base de datos
	

//Preparar la consulta para insertar los datos
$consulta = "INSERT INTO Clientes (Cliente, Direccion, Localidad, Telefono, cuit, mail)";
$consulta .= " VALUES ('$cliente', '$dire', '$local', '$tel', '$cuit', '$mail')";

//Ejecutar la consulta para guardar el registro
$resultado = mysqli_query($consulta, $conexion) 
	or die(mysqli_error());

//Mostrar el registro nuevo en una tabla
$tabla = "<table border='1' cellpadding='10'>\n";
$tabla .= "<tr><th>Cliente</th><th>Direccion</th><th>Localidad</th><th>Telefono</th><th>cuit</th><th>mail</th></tr>\n";
$tabla .= "<tr>
          <td>$cliente</td>
          <td>$dire</td>
          <td>$local</td>
		  <td>$tel</td>
		  <td>$cuit</td>
		  <td>$mail</td>
		  </tr>\n";
$tabla .= "</tabla>\n";

//Cerrar la conexión
mysqli_close($con);
	}
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Agregar Clientes..</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<?php include 'head.php'; ?>


</head>
<body>
<br>
<?php include 'navbar.php'; ?>
  <br>
  <br>
<div align="center">
	<H3>INSERTAR CLIENTE</H3>
</div>
<?php
	include("modal/registro_clientes.php");
	include("modal/editar_cliente.php");
?>

	<form action="" method="post" class="form-horizontal" role="form" id="datos">
	<br>
	<br>
	<div class="modal-body">
	    <div class="form-group">
	        <label for="quantity" class="col-sm-2 control-label">Cliente</label>
		    <div class="col-sm-6">
		    	<input type="text" name="nombre"  min="1" name="Cliente" class="form-control" id="quantity" value="" placeholder="Cliente" required=""></td>
			</div>
	<br>
	    </div>
	          <div class="form-group">
	            <label for="reference" class="col-sm-2 control-label">Direccion</label>
	            <div class="col-sm-6">
	              <input type="text" name="Direccion" class="form-control" id="reference" value="" placeholder="Direccion">
	            </div>
	          </div>
	          <br>

	          <div class="form-group">
	            <label for="quantity" class="col-sm-2 control-label">Localidad</label>
	            <div class="col-sm-6">
	              <input type="text" min="1" name="Localidad" class="form-control" id="quantity" value="" placeholder="Localidad" required="">
	            </div>
	          </div><br>

	          <div class="form-group">
	            <br><label for="reference" class="col-sm-2 control-label">Telefono</label>
	            <div class="col-sm-6">
	              <input type="text" name="reference" class="form-control" id="Telefono" value="" placeholder="Telefono">
	            </div>
	          </div>
				<br>
	          <div class="form-group">
	            <label for="quantity" class="col-sm-2 control-label">C.U.I.T.</label>
	            <div class="col-sm-6">
	              <input type="number" min="1" name="quantity" class="form-control" id="cuit" value="" placeholder="C.U.I.T." required="">
	            </div>
	          </div>
	          <br>
	          <div class="form-group">
	            <label for="reference" class="col-sm-2 control-label">E-Mail</label>
	            <div class="col-sm-6">
	              <input type="text" name="mail" class="form-control" id="reference" value="" placeholder="E-Mail">
	            </div>
	          </div>
	          
	       
	      </div>
	      <br><br>
	      		<div class="modal-footer">
	      			<!-- BOTON GUARDAR -->
					<button type="submit" class="btn btn-primary">Guardar</button>

	      			<!-- BOTON CERRAR... -->
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					
	      		</div>
	    	</div>
		</div>
	</form>

</div> 

		<!-- Para mostrar el nuevo registro -->
		<p style="color: blue;"><?php echo $tabla; ?></p>
</body>
</html>