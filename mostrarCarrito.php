<?php
include("admin/conexion/bd.php");
include("carrito.php");
include("plantillas/header.php");
?>


<div class="container">
    <h1>LISTA DE CARRITO</h1>
    <p>Estos son los productos que has agregado al carrito.</p>
    <?php if (!empty($_SESSION['CARRITO'])) { ?>

        <table class="table table-dark table-hover">
            <tbody>
                <tr>
                    <th width="40%">Descripción</th>
                    <th width="15%" class="text-center">Cantidad</th>
                    <th width="20%" class="text-center">Precio</th>
                    <th width="20%" class="text-center">Total</th>
                    <th width="5%">Acción</th>
                </tr>
                <?php $total = 0; ?>
                <?php foreach ($_SESSION['CARRITO'] as $indice => $productos) { ?>
                    <tr>
                        <th width="40%"><?php echo $productos['NOMBRE']; ?></th>
                        <th width="15%" class="text-center"><?php echo $productos['CANTIDAD']; ?></th>
                        <th width="20%" class="text-center"><?php echo $productos['PRECIO']; ?></th>
                        <th width="20%" class="text-center"><?php echo number_format($productos['PRECIO'] * $productos['CANTIDAD'], 2); ?></th>
                        <th width="5%">
                            <form action="" method="post">
                                <input type="hidden" name="id" value=" <?php echo $productos['ID']; ?>">
                                <button type="submit" name="btnAccion" value="Eliminar" class="btn btn-danger">Eliminar</button>
                            </form>
                        </th>
                    </tr>
                    <?php $total = $total + ($productos['PRECIO'] * $productos['CANTIDAD']); ?>
                <?php } ?>
                <tr>
                    <td colspan="3" align="right">
                        <h3>Total</h3>
                    </td>
                    <td align="right">
                        <h3>Q<?php echo number_format($total, 2) ?></h3>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    <?php } else { ?>

        <div class="alert alert-success">
            No hay productos en el carrito
        </div>
    <?php } ?>
</div>
<?php include("plantillas/footer.php"); ?>