<?php
session_start();

include("conexion/bd.php");

if (isset($_SESSION['usuario_id'])) {
    $records = $conexion->prepare('SELECT id, email, password FROM usuarios WHERE id = :id');
    $records->bindParam(':id', $_SESSION['usuario_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $us = null;

    if (count($results) > 0) {
        $us = $results;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Inicio Usuarios</title>
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

    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container-fluid">

            <a class="navbar-brand" href="inicio.php"><img src="img/recursos/logo.png" alt="logo" style="width:40px;"> SpacePc</a>

            <?php if (!empty($us)) { ?>
                <form class="d-flex">
                    <a class="" href="inicio.php">
                        <button class="btn btn-outline-light justify-content-end" type="submit"><a class="navbar-brand bi bi-box-arrow-right" href="logout.php"> Cerrar Sesion</a>
                        </button>
                    </a>
                </form>
            <?php } ?>
        </div>
    </nav>

    <?php if (!empty($us)) : ?>
        <br><br><br>
        <div class="container">
            <div class="card-group">
                <div class="card" style="width: 24rem;">
                    <img src="img/user.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">
                        <h1 id="ms">Bienvenido: <?= $us['email']; ?></h1>
                        </p>
                        <p id="sm">Has iniciado correctamente</p>
                    </div>
                </div>


            <?php else : ?>
                <h1>Por favor ingresa o regístrate</h1>

                <button type="submit" class="btn btn-outline-light btn-lg"><a href="login.php" style="text-decoration: none;">
                        <p class="textL">Iniciar Sesion<p>
                    </a></button>
                O
                <button type="submit" class="btn btn-outline-light btn-lg"><a href="signup.php" style="text-decoration: none;">
                        <p class="textL">Registrarse<p>
                    </a></button>

            <?php endif; ?>


            <div class="card" style="width: 14rem;">
                <img src="img/pago.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <button type="button" class="btn btn-lg btn-info" data-bs-toggle="popover" title="Depósito Bancarios" data-bs-content="Contamos con depósito  bancario, el cual a la hora de hacer la orden en la página web usted puede elegir este método de pago. Si usted elige depósito bancario como su forma de pago deberá mandar la boleta de pago ya sea a nuestro correo electrónico o a nuestra página de Facebook, para que su orden sea enviada el mismo día y no sea cancelada.">Formas de pago</button>
                    <br><br>
                    <button type="button" class="btn btn-lg btn-info" data-bs-toggle="popover" title="PAYPAL" data-bs-content="Al pagar con PayPal en nuestro sitio web, la Protección al Comprador de PayPal le ofrece protección integral si su transacción que reúne los requisitos presenta un problema. Si un artículo no llega o si es significativamente distinto al descrito, le ayudaremos a obtener un rembolso completo.">Formas de pago</button>
                    <br><br>
                    <button type="button" class="btn btn-lg btn-info" data-bs-toggle="popover" title="Visa Cuotas" data-bs-content="VisaNet Guatemala se preocupa por que los comercios afiliados pueden brindar un servicio seguro en la industria. Para eliminar el fraude la capacitación es primordial. Para ello, ofrece cursos de capacitación a todo el personal que recibe tarjetas Visa como medio de pago.">Formas de pago</button>
                </div>
            </div>


            <div class="card" style="width: 14rem;">
                <img src="img/envio.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <br><br>
                    <button type="button" class="btn btn-lg btn-primary" data-bs-toggle="popover" title="Envios" data-bs-content="El costo del envío es Q25 ($3) a todo el país de Guatemala. Los envíos normalmente duran de 1-2 días hábiles dependiendo del departamento dónde resides y si es zonas rojas. Puede también pedir que se envíen sus productos a una tienda mas cercana de GUATEX o directamente a tu casa.">Formas de pago</button>
                </div>
            </div>
            </div>
        </div>
        </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
</script>

</html>