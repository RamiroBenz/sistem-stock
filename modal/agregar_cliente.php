<?php 

    /* Connect To Database*/
  include "../cn.php";//Contiene las variables de configuracion para conectar a la base de datos
  
  $active_clientes="active";
  $title="Clientes | Simple Clientes";

  $vista="SELECT * FROM Clientes";

  $sql=$conexion->query($vista);

 /* $id = mysqli_real_escape_string($con, $_POST["id"]);*/

  $cliente = $_POST["cliente"];
  $dir = $_POST["direccion"];
  $local = $_POST["localidad"];
  $tel = $_POST["telefono"];
  $cuit = $_POST["cuit"];
  $mail = $_POST["mail"];

  $sql="INSERT INTO Cliente (Cliente, Direccion, Localidad, Telefono, cuit, mail) VALUES ('$cliente','$dir','$local', '$tel','$cuit', $mail)";

    //Ejecutar la consulta
  $resultado = mysqli_query($conexion, $sql);

  if (!$resultado) {
    echo 'Error al registrar el Cliente';
  }else{

    echo "Registro guardado Exitosamente..";
  }

  //cerrar conecxion
  mysqli_close($conexion);



 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Clientes</title>
  <?php include '../head.php'; ?>
</head>
<body>


  <?php include '../navbar.php'; ?>
  <br>
  <div class="panel-body">
<form class="form-horizontal"  method="post" name="add_stock" action="">
<!-- Modal -->
<div id="add-stock" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Agregar Cliente</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="quantity" class="col-sm-2 control-label">Cliente</label>
            <div class="col-sm-6">
              <input type="text" min="1" name="Cliente" class="form-control" id="quantity" value="" placeholder="Cliente" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="reference" class="col-sm-2 control-label">Direccion</label>
            <div class="col-sm-6">
              <input type="text" name="Direccion" class="form-control" id="reference" value="" placeholder="Direccion">
            </div>
          </div>
          <div class="form-group">
            <label for="quantity" class="col-sm-2 control-label">Localidad</label>
            <div class="col-sm-6">
              <input type="number" min="1" name="Localidad" class="form-control" id="quantity" value="" placeholder="Localidad" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="reference" class="col-sm-2 control-label">Telefono</label>
            <div class="col-sm-6">
              <input type="text" name="Telefono" class="form-control" id="reference" value="" placeholder="Telefono">
            </div>
          </div>

          <div class="form-group">
            <label for="quantity" class="col-sm-2 control-label">C.U.I.T.</label>
            <div class="col-sm-6">
              <input type="number" min="1" name="cuit" class="form-control" id="quantity" value="" placeholder="C.U.I.T." required="">
            </div>
          </div>
          <div class="form-group">
            <label for="reference" class="col-sm-2 control-label">E-Mail</label>
            <div class="col-sm-6">
              <input type="text" name="email" class="form-control" id="reference" value="" placeholder="E-Mail">
            </div>
          </div>
          
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		<button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>

  </div>
</div> 
 </form>
 <hr>
  <?php
  include("../footer.php");
  ?>
  </body>
  </html>