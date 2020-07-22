<?php
session_start();

?>
 
<?php
 
$host_db = "localhost";
$user_db = "root";
$pass_db = "root";

$db_name = "simple_stock";

$tbl_name = "users";

 

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

 

if ($conexion->connect_error) {

 die("La conexion falló: " . $conexion->connect_error);

}

 

$usuario = $_POST['user_name'];

$pass = $_POST['user_password_hash'];

  

$sql = "SELECT * FROM $tbl_name WHERE user_name = '$usuario'";

 

$result = $conexion->query($sql);

 

 

if ($result->num_rows > 0) {     

 }

 $row = $result->fetch_array(MYSQLI_ASSOC);

 if (password_verify($pass, $row['user_password_hash'])) { 

  

    $_SESSION['loggedin'] = true;

    $_SESSION['user_name'] = $usuario;

    $_SESSION['start'] = time();

    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

 

    echo "Bienvenido! " . $_SESSION['user_name'];

    echo "<br><br><a href=panel-control.php>Panel de Control</a>"; 

 

 } else { 

   echo "Usuario o Password estan incorrectos.";

 

   echo "<br><a href='login.html'>Volver a Intentarlo</a>";

 }

 mysqli_close($conexion);

 ?>
