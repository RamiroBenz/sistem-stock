<?php

	
	
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
	include("../funciones.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_producto=intval($_GET['id']);
		if ($delete1=mysqli_query($con,"DELETE FROM Clientes WHERE id='".$id."'")){
		?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		 
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $id =intval($_REQUEST['id']);
		 $aColumns = array('Cliente', 'Direccion');//Columnas de busqueda
		 $sTable = "Clientes";
		 $sWhere = "";
		
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		
		if ($id>0){
			$sWhere .=" and id='$id'";
		}
		$sWhere.=" order by id desc";

		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 18; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './clientes.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			  
				<?php
				$nums=1;
				while ($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						$cliente=$row['Cliente'];
						$dir=$row['Direccion'];
						$loc=$row['Localidad'];
					?>
					
					<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 thumb text-center ng-scope" ng-repeat="item in records">
						  <a class="thumbnail" href="clientes.php?id=<?php echo $id;?>">
							  <!-- <span title="Current quantity" class="badge badge-default stock-counter ng-binding"><?php echo number_format($loc,2); ?></span> -->
							  <!-- <span title="Low Cliente" class="low-stock-alert ng-hide" ng-show="item.current_quantity <= item.low_stock_threshold"><i class="fa fa-exclamation-triangle"></i></span> -->
							  <img class="img-responsive" src="img/Clientes.jpg" alt="<?php echo $Cliente;?>">
						  </a>
						  <span class="thumb-name"><strong><?php echo $cliente;?></strong></span>
						  <span class="thumb-code ng-binding"><?php echo $id;?></span>
					</div>
					<?php
					if ($nums%6==0){
						echo "<div class='clearfix'></div>";
					}
					$nums++;
				}
				?>
				<div class="clearfix"></div>
				<div class='row text-center'>
					<div ><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></div>
				</div>
			
			<?php
		}
	}
?>
