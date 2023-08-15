<?php
include("admin/conexion/bd.php");

include("plantillas/header.php");

?>

<?php

echo "<br>";
//consulta para llamar los productos
$sentenciaSQL = $conexion->prepare("SELECT * FROM productos");
$sentenciaSQL->execute();
$listaPro = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

if (!$_GET) {
  header('Location: tienda.php?pagina=1');
}

$producto_x_pagina = 24;
//contar articulos productos
$total_productos_db = $sentenciaSQL->rowCount();
//echo $totalProductosBD;
$productos = $total_productos_db / $producto_x_pagina;
// el ceil me sirve para redondear una cantidad
$productos = ceil($productos);
//echo $productos;
?>

<br>
<div class="container p-1">
  <h1>EQUIPO PARA JUEGOS AVANZADO</h1>
  <p>Da el máximo en tus juegos favoritos con el mejor equipo para juegos de Logitech G, Corsair y Astro Gaming.</p>
  
  <?php if($mensaje!=""){?>
<div class="alert alert-success">
  <?php echo $mensaje; ?>
  <a href="mostrarCarrito.php" class="badge bg-success">Ver carrito </a>
</div>
<?php }?>

</div>
<?php

$iniciar = ($_GET['pagina'] - 1) * $producto_x_pagina;
//echo $iniciar;

$sql_productos = 'SELECT * FROM productos LIMIT :iniciar, :nproductos';
$sentencia_productos = $conexion->prepare($sql_productos);
$sentencia_productos->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
$sentencia_productos->bindParam(':nproductos', $producto_x_pagina, PDO::PARAM_INT);
$sentencia_productos->execute();

$resultado_productos = $sentencia_productos->fetchAll();

?>

<div class="container p-1">
  <div class="row row-cols-2 row-cols-md-4 g-4">
    <!--este foreach va leer todos los registro que estan en la lista de productos-->
    <?php foreach ($resultado_productos as $P) {  ?>
      <div class="col">
        <div class="card border-light">
          <img src="img/<?php echo $P['imagenP']; ?>" class="card-img-top" data-bs-toggle="popover" data-bs-trigger="hover" title="<?php echo $P['nombreP']; ?>" data-bs-content="<?php echo $P['descripcionP1']; ?>">
          <div class="card-body">
            <h5 class="card-title" id="card-title-tienda"><?php echo $P['nombreP']; ?></h5>
            <p class="card-text" id="card-text-tienda"><?php echo $P['descripcionP']; ?></p>

            <form action="" method="post">
              <input type="hidden" name="id" id="id" value="<?php echo $P['id']; ?>">
              <input type="hidden" name="nombre" id="nombre" value="<?php echo $P['nombreP']; ?>">
              <input type="hidden" name="precio" id="precio" value="<?php echo $P['precioP']; ?>">
              <input type="hidden" name="cantidad" id="cantidad" value="<?php echo 1; ?>">
              <button class="btn btn-outline-info bi bi-cart-plus" name="btnAccion" value="Agregar" type="submit"> Agregar al carrito</button>
            </form><br>

            <div class="dropdown">
              <button class="btn btn-dark dropdown-toggle bi bi-info-circle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Ver info
              </button>
              <ul class="dropdown-menu dropdown-menu-dark border-light" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#" id="card-comprar-tienda">Disponibles: <?php echo $P['existenciaP']; ?></a></li>
                <li><a class="dropdown-item" href="#" id="card-comprar-tienda">Precio: <?php echo $P['precioP']; ?></a></li>
              </ul>
            </div>

          </div>
        </div>
        <br>
      </div>
    <?php } ?>
  </div>
</div>

<!--NAVIGATION-->
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end">
    <li class="page-item
    <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>
    ">

      <a class="page-link" href="tienda.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">
        Anterior
      </a>
    </li>

    <?php for ($i = 0; $i < $productos; $i++) { ?>
      <li class="page-item 
      <?php
      try {
        echo $_GET['pagina'] == $i + 1 ? 'active' : '';
      } catch (Exception $ex) {
        echo $ex->getMessage();
      }
      ?>
      ">
        <a class="page-link" href="tienda.php?pagina=<?php echo $i + 1 ?>
        ">
          <?php echo $i + 1 ?>
        </a>
      </li>
    <?php } ?>


    <li class="page-item
    <?php echo $_GET['pagina'] >= $productos ? 'disabled' : '' ?>">
      <a class="page-link" href="tienda.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">
        Siguiente
      </a>
    </li>
  </ul>
</nav>



<?php include("plantillas/footer.php"); ?>