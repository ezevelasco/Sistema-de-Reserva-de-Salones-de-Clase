<?php
include '../conexion.php';
$dni = $_GET['dni'];
$eliminarAlumno_query = "UPDATE alumnos SET alumno_vigente='1' WHERE alumno_dni='".$dni."'";
mysqli_query($conn, $eliminarAlumno_query);
header('location:listadoAlumnosCompleto.php');
