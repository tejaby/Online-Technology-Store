<?php include("plantillas/header.php"); ?>
<?php
include("admin/conexion/bd.php");
?>
<?php
$sentenciaSQL = $conexion->prepare("SELECT * FROM productos ORDER BY id DESC limit 12");
$sentenciaSQL->execute();
//el Fetch_assoc Recupera una fila de resultados como un array asociativo
$productosR = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<br><br>
<div class="container">
  <h1>RECIÉN INGRESADOS</h1>
  <p>Productos recien ingresados a la pagina.</p>
</div>

<div class="container p-1">
  <div class="row row-cols-2 row-cols-md-4 g-4">
    <!--este foreach va leer todos los registro que estan en la lista de productos-->
    <?php foreach ($productosR as $P) {  ?>
      <div class="col">
        <div class="card border-light">
          <img src="img/<?php echo $P['imagenP']; ?>" class="card-img-top" data-bs-toggle="popover" data-bs-trigger="hover" title="<?php echo $P['nombreP'];?>" data-bs-content="<?php echo $P['descripcionP1']; ?>"> 
          <div class="card-body">
            <h5 class="card-title" id="card-title-tienda"><?php echo $P['nombreP']; ?></h5>
            <p class="card-text" id="card-text-tienda"><?php echo $P['descripcionP']; ?></p>

            <div class="dropdown">
              <button class="btn btn-info btn-dark dropdown-toggle bi bi-info-circle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Ver existencias
              </button>
              <ul class="dropdown-menu dropdown-menu-dark border-light" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#" id="card-comprar-tienda">Disponibles: <?php echo $P['existenciaP']; ?></a></li>
                <li><a class="dropdown-item" href="#" id="card-comprar-tienda">Disponibles: <?php echo $P['precioP']; ?></a></li>
              </ul>
            </div>
          </div>
        </div>
        <br>
      </div>
    <?php } ?>
  </div>
</div>


<?php include("plantillas/footer.php"); ?>