<?php
include("admin/conexion/bd.php");
include("carrito.php");
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>SpacePC</title>
  <!--BOOTSTRAP-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!--ICONOS BOOTSTRAP-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <!--lINKS DE LETRAS-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Otomanopee+One&display=swap" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300&display=swap" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
  <!--DATA TABLE-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  <!--css-->
  <link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>

  <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
    <!--estilo de la barra de navegacion-->
    <div class="container-fluid">
      <!--alineacion del contenedor-->
      <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <!--el navbar-toggler sirve para complementar collpase-->
        <span class="navbar-toggler-icon"></span>
        <!--efecto responsive-->
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <!--collapse navbar-collapse es para agrupar y ocultar el contendio-->
        <a class="navbar-brand" href="index.php">
          <img src="img/recursos/logo.png" alt="logo" style="width:40px;">SpacePc</a>


        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" href="tienda.php">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reciente.php">Recien Ingreso</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="nosotros.php">Nosotros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link bi bi-cart" href="mostrarCarrito.php"> Carrito(<?php echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']); ?>)</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Usuario
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li>
                <a class="dropdown-item" href="admin/login.php"><span class="bi bi-person"> Iniciar Sesión</span></a>
              </li>
              <li>
                <a class="dropdown-item" href="admin/signup.php"><span class="bi bi-person-plus-fill"> Registrarme</span></a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item" href="admin/loginA.php">Ingresar Como Admin</a>
              </li>
            </ul>
          </li>
        </ul>

        <form class="d-flex" action="tienda.php">
          <input class="form-control me-2" type="search" placeholder="Buscar Producto" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">Buscar</button>
        </form>

      </div>
    </div>
  </nav>


  <br>
  <br>