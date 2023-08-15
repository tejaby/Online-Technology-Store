<?php include("plantillas/header.php") ?>

<?php
$UID = (isset($_POST['UID'])) ? $_POST['UID'] : "";
$Ucorreo = (isset($_POST['Ucorreo'])) ? $_POST['Ucorreo'] : "";
$Ucontra = (isset($_POST['Ucontra'])) ? $_POST['Ucontra'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("conexion/bd.php");

switch ($accion) {
    case 'agregar':
        $sentenciaSQL = $conexion->prepare("INSERT INTO usuarios (email, password) VALUES (:email, :password);");
        $sentenciaSQL->bindParam(':email', $Ucorreo);

        $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $sentenciaSQL->bindParam(':password', $pass);

        $sentenciaSQL->execute();

        header("Location:usuarios.php");
        break;


    case 'modificar':
        $sentenciaSQL = $conexion->prepare("UPDATE usuarios SET email=:email WHERE id=:id");
        $sentenciaSQL->bindParam(':email', $Ucorreo);
        $sentenciaSQL->bindParam(':id', $UID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE usuarios SET password=:password WHERE id=:id");
        $sentenciaSQL->bindParam(':password', $Ucontra);
        $sentenciaSQL->bindParam(':id', $UID);
        $sentenciaSQL->execute();

        header("Location:usuarios.php");
        break;


    case 'cancelar':
        header("Location:usuarios.php");
        break;


    case 'seleccionar':
        $sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $UID);
        $sentenciaSQL->execute();
        $U = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $Ucorreo = $U['email'];
        $Ucontra = $U['password'];
        break;



    case 'borrar':

        $sentenciaSQL = $conexion->prepare("DELETE FROM usuarios WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $UID);
        $sentenciaSQL->execute();

        header("Location:usuarios.php");
        break;


    default:
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios");
$sentenciaSQL->execute();
$listaU = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid bg-dark border border-light" id="container-login">
    <form method="POST" enctype="multipart/form-data">
        <p class="text-right" id="letraT">Administrar Usuarios :</p>
        <div class="mb-1">
            <p class="text-right" id="letraP">ID</p>
            <input type="text" required readonly name="id" value="<?php echo $UID; ?>" class="form-control">
        </div>

        <div class="mb-1">
            <p class="text-right" id="letraP">Correo Electronico</p>
            <input type="text" required name="correo" value="<?php echo $Ucorreo; ?>" class="form-control">
        </div>

        <div class="mb-2">
            <p class="text-right" id="letraP">Contraseña</p>
            <input type="password" required name="pass" value="<?php echo $Ucontra; ?>" class="form-control">
        </div>



        <div class="d-group" role="form-group">
            <button type="submit" name="accion" value="agregar" class="btn btn-outline-success">Agregar</button>
            <button type="submit" name="accion" value="modificar" class="btn btn-outline-primary">Modificar</button>
            <button type="submit" name="accion" value="cancelar" class="btn btn-outline-warning">Cancelar</button>
        </div>
    </form>
</div>

<br>


<div class="table-responsive bg-light">
    <table class="table table-sm align-middle table-dark table-hover table-bordered border-light" id="container-tabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Contraseña</th>
                <th>Opciones</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaU  as $usuarios) { ?>
                <tr>
                    <td><?php echo $usuarios['id']; ?></td>
                    <td><?php echo $usuarios['email']; ?></td>
                    <td><?php echo $usuarios['password']; ?></td>


                    <td>
                        <form method="POST">
                            <input type="hidden" name="UID" id="UID" value="<?php echo $usuarios['id']; ?>">
                            <input type="submit" name="accion" class="btn btn-outline-info" value="seleccionar">
                            <input type="submit" name="accion" class="btn btn-outline-danger" value="borrar">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php include("plantillas/footer.php") ?>