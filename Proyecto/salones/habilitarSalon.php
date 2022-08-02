<?php
include '../conexion.php';
$cod = $_GET['cod'];
$habilitarSalon_query = "UPDATE salones SET salon_habilitado='1' WHERE salon_codigo ='".$cod."'";
mysqli_query($conn, $habilitarSalon_query);
header('location:listadoSalones.php');

