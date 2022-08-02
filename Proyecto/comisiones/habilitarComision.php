<?php
include '../conexion.php';
$cod = $_GET['cod'];
$eliminarComision_query = "UPDATE comisiones SET comision_vigente='1' WHERE comision_codigo ='".$cod."'";
mysqli_query($conn, $eliminarComision_query);
header('location:listadoComisiones.php');