<?php

//inicializar
session_start();
if (isset($_SESSION['usuario_id'])) {
	header('Location: /spacepc');
}
include("conexion/bd.php");
//combrobar que no estan vacios
if (!empty($_POST['emailU']) && !empty($_POST['passwordU'])) {
	$records = $conexion->prepare('SELECT id, email, password FROM usuarios WHERE email = :email');
	//remplazar parametros
	$records->bindParam(':email', $_POST['emailU']);
	$records->execute();
	//obtener los datos del usuario
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$mensaje = '';

	//comparar contraseña de la base de datos con la que se esta ingresando
	if (is_countable($results) > 0 && password_verify($_POST['passwordU'], $results['password'])) {
		$_SESSION['usuario_id'] = $results['id'];
		header("Location: inicio.php");
	} else {
		$mensaje = 'El correo electronico o contraseña no son validos.';
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login Usuario</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style1.css">
</head>

<body>

	<div class="container w-50 mt-5 mt-4 rounded shadow">
		<div class="row align-items">
			<div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">

			</div>
			<div class="col bg-light p-4 rounded">
				<div class="text-end">
					<a href="../index.php">
						<img src="img/logo.png" width="48">
					</a>
				</div>
				<h2 class="fw-boldf text-center py-4">Iniciar sesión</h2>

				<!--LOGIN-->
				<form action="login.php" method="POST">

					<div class="mb-4">
						<label class="form-label">Correo electronico</label>
						<input type="text" class="form-control" name="emailU">
					</div>

					<div class="mb-4">
						<label class="form-label">Contraseña</label>
						<input type="password" class="form-control" name="passwordU">
					</div>

					<div class="d-grid">
						<button type="submit" class="btn btn-outline-primary">Iniciar Sesion</button>
					</div><br>

					<?php if (!empty($mensaje)) : ?>
						<div class="alert alert-danger" role="alert"><?= $mensaje ?>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>