<?php
include("conexion/bd.php");

$mensaje = '';

//si estos campos no estan vacios se pueden agregar datos
if (!empty($_POST['usuarioA']) && !empty($_POST['passwordA'])) {
  $sql = "INSERT INTO admin (usuario, password) VALUES (:usuario, :password)";
  //ejecutar conexion
  $stmt = $conexion->prepare($sql);
  //vincular 
  $stmt->bindParam(':usuario', $_POST['usuarioA']);
  //cifrar la contraseña
  $password = password_hash($_POST['passwordA'], PASSWORD_BCRYPT);
  $stmt->bindParam(':password', $password);

  if ($stmt->execute()) {
    $mensaje = 'Su cuenta ha sido creada con exito';
  } else {
    $mensaje = 'Algo salio mal, intente de nuevo';
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>SignUp Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

  <div class="container w-50 mt-5  mt-5 rounded shadow">
    <div class="row align-items">
      <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">

      </div>
      <div class="col bg-light p-4 rounded">
        <div class="text-end">
          <a href="../index.php">
            <img src="img/logo.png" width="48" alt="">
          </a>
        </div>
        <h2 class="fw-boldf text-center py-4">Registrarte</h2>

        <form action="signupA.php" method="POST">

          <div class="mb-4">
            <label class="form-label">Usuario</label>
            <input type="text" class="form-control" name="usuarioA">
          </div>

          <div class="mb-4">
            <label class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="passwordA">
          </div>

          <div class="d-grid">
            <button type="submit" value="Submit" class="btn btn-outline-primary">Registrarse</button>
          </div><br>
          <?php if (!empty($mensaje)) : ?>
            <div class="alert alert-success" role="alert"><?= $mensaje ?>
              <br>
              <div class="d-grid">
                <button type="submit" value="Submit" class="btn btn-outline-success"><a href="loginA.php" style="text-decoration: none; color:#FFFFFF">iniciar sesion</a></button>
              </div>
            </div>
          <?php endif; ?>

        </form>
      </div>
    </div>
  </div>

  <style>
    .bg {
      background-image: url(img/login.gif);
      background-size: 100%;
      background-position: center;
      background-repeat: no-repeat;
    }
  </style>

</body>
</html>