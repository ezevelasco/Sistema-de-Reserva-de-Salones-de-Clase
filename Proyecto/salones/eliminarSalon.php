<?php
include '../conexion.php';
$cod = $_GET['cod'];
$eliminarSalon_query = "UPDATE salones SET salon_habilitado='0' WHERE salon_codigo ='".$cod."'";
mysqli_query($conn, $eliminarSalon_query);
header('location:listadoSalones.php');

