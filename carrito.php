<?php
session_start();

$mensaje = "";

if (isset($_POST['btnAccion'])) {
    switch ($_POST['btnAccion']) {
        case 'Agregar':
            if (is_numeric($_POST['id'])) {
                $ID = ($_POST['id']);
                $mensaje .= "Ok id correcto " . $ID . "<br>";
            } else {
                $mensaje .= "F id incorrecto " . "<br>";
            }

            if (is_string($_POST['nombre'])) {
                $NOMBRE = ($_POST['nombre']);
                $mensaje .= "Ok nombre correcto " . $NOMBRE . "<br>";
            } else {
                $mensaje .= "F nombre incorrecto " . "<br>";
                break;
            }
            if (is_numeric($_POST['cantidad'])) {
                $CANTIDAD = ($_POST['cantidad']);
                $mensaje .= "Ok cantidad correcto " . $CANTIDAD . "<br>";
            } else {
                $mensaje .= "F cantidd incorrecto " . "<br>";
                break;
            }
            if (is_numeric($_POST['precio'])) {
                $PRECIO = ($_POST['precio']);
                $mensaje .= "Ok precio correcto " . $PRECIO . "<br>";
            } else {
                $mensaje .= "F precio incorrecto " . "<br>";
                break;
            }

            if (!isset($_SESSION['CARRITO'])) {

                $productos = array(
                    'ID' => $ID,
                    'NOMBRE' => $NOMBRE,
                    'CANTIDAD' => $CANTIDAD,
                    'PRECIO' => $PRECIO
                );
                $_SESSION['CARRITO'][0] = $productos;
                $mensaje = "Producto agregado al carrito";
            } else {

                $idProductos = array_column($_SESSION['CARRITO'],"ID");

                if (in_array($ID, $idProductos)) {
                    echo "<script>alert('Este produto ya ha sido agregado')</script>";
                    $mensaje = "";
                } else {

                    $numeroProd = count($_SESSION['CARRITO']);
                    $productos = array(
                        'ID' => $ID,
                        'NOMBRE' => $NOMBRE,
                        'CANTIDAD' => $CANTIDAD,
                        'PRECIO' => $PRECIO
                    );
                    $_SESSION['CARRITO'][$numeroProd] = $productos;
                    $mensaje = "Producto agregado al carrito";
                    
                }
            }
            //$mensaje = print_r($_SESSION, true);

            break;

        case 'Eliminar':
            if (is_numeric($_POST['id'])) {
                $ID = ($_POST['id']);

                foreach ($_SESSION['CARRITO'] as $indice => $productos) {
                    if ($productos['ID'] == $ID) {
                        unset($_SESSION['CARRITO'][$indice]);
                        echo "<script>alert('producto eliminado');</script>";
                    }
                }
            } else {
                $mensaje .= "F id incorrecto " . "<br>";
            }
            break;
    }
}
