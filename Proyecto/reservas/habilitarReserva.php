<?php
include '../conexion.php';
$cod = $_GET['cod'];
$eliminarReserva_query = "UPDATE reservas SET reserva_vigente='1' WHERE reserva_codigo='".$cod."'";
mysqli_query($conn, $eliminarReserva_query);
header('location:listadoReservasCompleto.php');
