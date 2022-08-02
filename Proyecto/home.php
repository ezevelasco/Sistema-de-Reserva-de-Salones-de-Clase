<?php include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body id="boverride">
    <div id="cabecera">
        <h4>Sistema de Reserva de Salones de Clase</h4>
        <h1>Inicio</h1>
        
    </div>
    <div>
        <button type="button" onclick="location.href='/Proyecto/alumnos/listadoAlumnos.php'" class="btn btn-primary mb-3 mt-5 ">Alumnos</button>
        <button type="button" onclick="location.href='/Proyecto/profesores/listadoProfesores.php'" class="btn btn-primary mb-3 mt-5 ">Profesores</button>
        <button type="button" onclick="location.href='/Proyecto/comisiones/listadoComisiones.php'" class="btn btn-primary mb-3 mt-5 ">Comisiones</button>
        <button type="button" onclick="location.href='/Proyecto/salones/listadoSalones.php'" class="btn btn-primary mb-3 mt-5 ">Salones</button>
        <button type="button" id="reserva" onclick="location.href='/Proyecto/reservas/listadoReservas.php'" class="btn btn-primary mb-3 mt-5 ">Reservas</button>
        <button id="agregarreserva" type="button" onclick="location.href='/Proyecto/reservas/agregarReserva.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Reserva</button>
    </div>
    
</body>
</html>