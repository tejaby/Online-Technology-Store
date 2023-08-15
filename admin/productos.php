<?php include("plantillas/header.php") ?>

<?php
//validacion si hay algo en el input entonces input va ser igual al valor que se envio
$PID = (isset($_POST['PID'])) ? $_POST['PID'] : "";
$Pmarca = (isset($_POST['Pmarca'])) ? $_POST['Pmarca'] : "";
$Pnombre = (isset($_POST['Pnombre'])) ? $_POST['Pnombre'] : "";
$Pdescripcion = (isset($_POST['Pdescripcion'])) ? $_POST['Pdescripcion'] : "";
$Pdescripcion1 = (isset($_POST['Pdescripcion1'])) ? $_POST['Pdescripcion1'] : "";
$Pdescripcion2 = (isset($_POST['Pdescripcion2'])) ? $_POST['Pdescripcion2'] : "";
$Pdescripcion3 = (isset($_POST['Pdescripcion3'])) ? $_POST['Pdescripcion3'] : "";
$Pprecio = (isset($_POST['Pprecio'])) ? $_POST['Pprecio'] : "";
$Pexistencia = (isset($_POST['Pexistencia'])) ? $_POST['Pexistencia'] : "";
$Pimagen = (isset($_FILES['Pimagen']['name'])) ? $_FILES['Pimagen']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

//incluir base de datos
include("conexion/bd.php");

switch ($accion) {


	case 'agregar':
		$sentenciaSQL = $conexion->prepare("INSERT INTO productos (marcaP, nombreP, descripcionP,  descripcionP1, descripcionP2, descripcionP3, precioP, existenciaP, imagenP) VALUES (:marcaP, :nombreP, :descripcionP, :descripcionP1, :descripcionP2, :descripcionP3, :precioP, existenciaP, :imagenP);");

		$sentenciaSQL->bindParam(':marcaP', $Pmarca);
		$sentenciaSQL->bindParam(':nombreP', $Pnombre);
		$sentenciaSQL->bindParam(':descripcionP', $Pdescripcion);
		$sentenciaSQL->bindParam(':descripcionP1', $Pdescripcion1);
		$sentenciaSQL->bindParam(':descripcionP2', $Pdescripcion2);
		$sentenciaSQL->bindParam(':descripcionP3', $Pdescripcion3);
		$sentenciaSQL->bindParam(':precioP', $Pprecio);
		$sentenciaSQL->bindParam(':existenciaP', $Pexistencia);

		//DateTime nos servira para obtener info
		$fecha = new DateTime();
		$nombreArchivo = ($Pimagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["Pimagen"]["name"] : "imagen.jpg";

		$tmpImagen = $_FILES["Pimagen"]["tmp_name"];

		if ($tmpImagen != "") {
			move_uploaded_file($tmpImagen, "../img/" . $nombreArchivo);
		}

		$sentenciaSQL->bindParam(':imagenP', $nombreArchivo);
		$sentenciaSQL->execute();

		header("Location:productos.php");
		break;


	case 'seleccionar':
		$sentenciaSQL = $conexion->prepare("SELECT * FROM productos WHERE id=:id");
		$sentenciaSQL->bindParam(':id', $PID);
		$sentenciaSQL->execute();
		$P = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

		$Pmarca = $P['marcaP'];
		$Pnombre = $P['nombreP'];
		$Pdescripcion = $P['descripcionP'];
		$Pdescripcion1 = $P['descripcionP1'];
		$Pdescripcion2 = $P['descripcionP2'];
		$Pdescripcion3 = $P['descripcionP3'];
		$Pprecio = $P['precioP'];
		$Pexistencia = $P['existenciaP'];
		$Pimagen = $P['imagenP'];
		break;


	case 'modificar':

		$sentenciaSQL = $conexion->prepare("UPDATE productos SET nombreP=:nombreP WHERE id=:id");
		$sentenciaSQL->bindParam(':nombreP', $Pnombre);
		$sentenciaSQL->bindParam(':id', $PID);
		$sentenciaSQL->execute();

		$sentenciaSQL = $conexion->prepare("UPDATE productos SET descripcionP=:descripcionP WHERE id=:id");
		$sentenciaSQL->bindParam(':descripcionP', $Pdescripcion);
		$sentenciaSQL->bindParam(':id', $PID);
		$sentenciaSQL->execute();

		$sentenciaSQL = $conexion->prepare("UPDATE productos SET descripcionP1=:descripcionP1 WHERE id=:id");
		$sentenciaSQL->bindParam(':descripcionP1', $Pdescripcion1);
		$sentenciaSQL->bindParam(':id', $PID);
		$sentenciaSQL->execute();

		$sentenciaSQL = $conexion->prepare("UPDATE productos SET descripcionP2=:descripcionP2 WHERE id=:id");
		$sentenciaSQL->bindParam(':descripcionP2', $Pdescripcion2);
		$sentenciaSQL->bindParam(':id', $PID);
		$sentenciaSQL->execute();

		$sentenciaSQL = $conexion->prepare("UPDATE productos SET descripcionP3=:descripcionP3 WHERE id=:id");
		$sentenciaSQL->bindParam(':descripcionP3', $Pdescripcion3);
		$sentenciaSQL->bindParam(':id', $PID);
		$sentenciaSQL->execute();

		$sentenciaSQL = $conexion->prepare("UPDATE productos SET marcaP=:marcaP WHERE id=:id");
		$sentenciaSQL->bindParam(':marcaP', $Pmarca);
		$sentenciaSQL->bindParam(':id', $PID);
		$sentenciaSQL->execute();

		$sentenciaSQL = $conexion->prepare("UPDATE productos SET precioP=:precioP WHERE id=:id");
		$sentenciaSQL->bindParam(':precioP', $Pprecio);
		$sentenciaSQL->bindParam(':id', $PID);
		$sentenciaSQL->execute();

		$sentenciaSQL = $conexion->prepare("UPDATE productos SET existenciaP=:existenciaP WHERE id=:id");
		$sentenciaSQL->bindParam(':existenciaP', $Pexistencia);
		$sentenciaSQL->bindParam(':id', $PID);
		$sentenciaSQL->execute();

		//validar si tiene algo
		if ($Pimagen != "") {
			$fecha = new DateTime();
			$nombreArchivo = ($Pimagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["Pimagen"]["name"] : "imagen.jpg";

			$tmpImagen = $_FILES["Pimagen"]["tmp_name"];

			//copiado de archivo a la carpeta img
			move_uploaded_file($tmpImagen, "../img/" . $nombreArchivo);


			//seleccionar img antigua y borrarla
			$sentenciaSQL = $conexion->prepare("SELECT imagenP FROM productos WHERE id=:id");
			$sentenciaSQL->bindParam(':id', $PID);
			$sentenciaSQL->execute();
			$P = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

			if (isset($P["imagenP"]) && ($P["imagenP"] != "imagen.jpg")) {

				if (file_exists("../img/" . $P["imagenP"])) {
					unlink("../img/" . $P["imagenP"]);
				}
			}

			//actulizar img new
			$sentenciaSQL = $conexion->prepare("UPDATE productos SET imagenP=:imagenP WHERE id=:id");
			$sentenciaSQL->bindParam(':imagenP', $nombreArchivo);
			$sentenciaSQL->bindParam(':id', $PID);
			$sentenciaSQL->execute();
		}

		header("Location:productos.php");
		break;


	case 'cancelar':
		header("Location:productos.php");
		break;


	case 'borrar':

		//buscar img
		$sentenciaSQL = $conexion->prepare("SELECT imagenP FROM productos WHERE id=:id");
		$sentenciaSQL->bindParam(':id', $PID);
		$sentenciaSQL->execute();
		$P = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
		//preguntar si existe esa img
		if (isset($P["imagenP"]) && ($P["imagenP"] != "imagen.jpg")) {
			//si existe la img
			if (file_exists("../img/" . $P["imagenP"])) {
				//borrar
				unlink("../img/" . $P["imagenP"]);
			}
		}

		$sentenciaSQL = $conexion->prepare("DELETE FROM productos WHERE id=:id");
		$sentenciaSQL->bindParam(':id', $PID);
		$sentenciaSQL->execute();

		//redireccion
		header("Location:productos.php");

		break;
	default:
		break;
}


$sentenciaSQL = $conexion->prepare("SELECT * FROM productos");
$sentenciaSQL->execute();
$listaPro = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid bg-dark border border-light" id="container-Admin">
	<form method="POST" enctype="multipart/form-data">
		<p class="text-right" id="letraT">Administrar Productos :</p>
		<div class="mb-1">
			<p class="text-right" id="letraP">ID</p>
			<input type="text" required readonly name="PID" value="<?php echo $PID; ?>" class="input-group input-group-sm">
		</div>

		<div class="mb-1">
			<p class="text-right" id="letraP">Nombre</p>
			<input type="text" required name="Pnombre" value="<?php echo $Pnombre; ?>" class="input-group input-group-sm">
		</div>

		<div class="mb-1">
			<p class="text-right" id="letraP">Descripción</p>
			<input type="text" required name="Pdescripcion" value="<?php echo $Pdescripcion; ?>" class="input-group input-group-sm">
		</div>

		<div class="mb-1">
			<p class="text-right" id="letraP">Marca</p>
			<input type="text" required name="Pmarca" value="<?php echo $Pmarca; ?>" class="input-group input-group-sm">
		</div>

		<div class="mb-1">
			<p class="text-right" id="letraP">Precio</p>
			<input type="text" required name="Pprecio" value="<?php echo $Pprecio; ?>" class="input-group input-group-sm">
		</div>

		<div class="mb-1">
			<p class="text-right" id="letraP">Existencia</p>
			<input type="text" required name="Pexistencia" value="<?php echo $Pexistencia; ?>" class="input-group input-group-sm">
		</div>

		<p class="text-right" id="letraT">Información detallada :</p>
		<div class="mb-1">
			<p class="text-right" id="letraP">Descripción 1</p>
			<input type="text" required name="Pdescripcion1" value="<?php echo $Pdescripcion1; ?>" class="input-group input-group-sm">
		</div>

		<div class="mb-1">
			<p class="text-right" id="letraP">Descripción 2</p>
			<input type="text" required name="Pdescripcion2" value="<?php echo $Pdescripcion2; ?>" class="input-group input-group-sm">
		</div>

		<div class="mb-1">
			<p class="text-right" id="letraP">Descripción 3</p>
			<input type="text" required name="Pdescripcion3" value="<?php echo $Pdescripcion3; ?>" class="input-group input-group-sm">
		</div>

		<div class="mb-1">
			<p class="text-right" id="letraP">Imagen</p>


			<?php
			if ($Pimagen != "") {	?>
				<img class="img-thumbnail rounded" src="../img/<?php echo $Pimagen; ?>" width="70px">

			<?php } ?>

			<input type="file" name="Pimagen" class="form-group" placeholder="id">
		</div>


		<div class="d-group" role="form-group">
			<button type="submit" name="accion" value="agregar" class="btn btn-outline-success">Agregar</button>
			<button type="submit" name="accion" value="modificar" class="btn btn-outline-primary">Modificar</button>
			<button type="submit" name="accion" value="cancelar" class="btn btn-outline-warning">Cancelar</button>
		</div>
	</form>
</div><br>

<div class="container-fluid bg-light">
	<div class="table-responsive">
		<table class="table table-sm align-middle table-dark table-hover table-bordered border-light" id="container-tabla">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Descripción 1</th>
					<th>Descripción 2</th>
					<th>Descripción 3</th>
					<th>Marca</th>
					<th>Precio</th>
					<th>Existencia</th>
					<th>Imagen</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				<!--foreach sirve para recorrer arrays y objetos xd-->
				<?php foreach ($listaPro  as $productos) { ?>
					<tr>
						<td><?php echo $productos['id']; ?></td>
						<td><?php echo $productos['nombreP']; ?></td>
						<td><?php echo $productos['descripcionP']; ?></td>
						<td><?php echo $productos['descripcionP1']; ?></td>
						<td><?php echo $productos['descripcionP2']; ?></td>
						<td><?php echo $productos['descripcionP3']; ?></td>
						<td><?php echo $productos['marcaP']; ?></td>
						<td><?php echo $productos['precioP']; ?></td>
						<td><?php echo $productos['existenciaP']; ?></td>

						<td>
							<img src="../img/<?php echo $productos['imagenP']; ?>" width="80px">
						</td>
						<td>
							<form method="POST">
								<input type="hidden" name="PID" id="PID" value="<?php echo $productos['id']; ?>">
								<input type="submit" name="accion" class="btn btn-outline-info" value="seleccionar">
								<input type="submit" name="accion" class="btn btn-outline-danger" value="borrar">
							</form>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<?php include("plantillas/footer.php") ?>