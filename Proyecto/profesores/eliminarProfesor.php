<?php
include '../conexion.php';
$dni = $_GET['dni'];
$eliminarProfesor_query = "UPDATE profesores SET profesor_vigente='0' WHERE profesor_dni='".$dni."'";
mysqli_query($conn, $eliminarProfesor_query);
header('location:listadoProfesoresCompleto.php');
