<?php
session_start();

include("conexion/bd.php");

if (isset($_SESSION['admin_id'])) {
    $records = $conexion->prepare('SELECT id, usuario, password FROM admin WHERE id = :id');
    $records->bindParam(':id', $_SESSION['admin_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $adm = null;

    if (count($results) > 0) {
        $adm = $results;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Inicio Admin</title>
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
    <!--css-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <?php $url = "http://" . $_SERVER['HTTP_HOST'] . "/spacepc" ?>

    <nav class="navbar navbar-expand-lg fixed-top " id="navbar">
        <div class="container-fluid">
            <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="index.php"><img src="img/recursos/logo.png" alt="logo" style="width:40px;"> SpacePc</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url; ?>/admin/usuarios.php">Administrar Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url; ?>/admin/productos.php">Administrar Productos</a>
                    </li>


                </ul>
                <?php if (!empty($adm)) { ?>

                    <form class="d-flex">
                        <a class="" href="index.php">
                            <button class="btn btn-outline-light justify-content-end" type="submit"><a class="navbar-brand bi bi-box-arrow-right" href="logoutA.php"> Cerrar Sesion</a></button></a>
                    </form>

                <?php } ?>


            </div>
        </div>
    </nav>
    <br><br><br>


    <div class="container">

        <?php if (!empty($adm)) : ?>



            <div class="card" style="width: 24rem;">
                <img src="img/admin.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">
                    <h1 id="ms">Bienvenido: <?= $adm['usuario']; ?></h1>
                    </p>
                    <p id="sm"> iniciado correctamente</p>
                </div>
            </div>

        <?php else : ?>
            <h1>Por favor ingresa o regístrate</h1>

            <button type="submit" class="btn btn-outline-light btn-lg"><a href="loginA.php" style="text-decoration: none;">
                    <p class="textL">Iniciar Sesion<p>
                </a></button>
            O
            <button type="submit" class="btn btn-outline-light btn-lg"><a href="signupA.php" style="text-decoration: none;">
                    <p class="textL">Registrarse<p>
                </a></button>



        <?php endif; ?>
    </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>