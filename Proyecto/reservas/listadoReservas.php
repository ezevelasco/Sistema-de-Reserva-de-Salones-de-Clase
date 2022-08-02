<?php include '../conexion.php';
$query_traerReservas= "SELECT *, reservas.comision_codigo AS rcc FROM reservas INNER JOIN comisiones ON reservas.comision_codigo=comisiones.comision_codigo WHERE reserva_vigente='1'ORDER BY reserva_fechaInicio ASC";
$traerReservas = mysqli_query($conn, $query_traerReservas);

date_default_timezone_set('America/Argentina/Mendoza');
$date = date('Y-m-d');

$query_traerReservasHoy= "SELECT *, reservas.comision_codigo AS rcc FROM reservas INNER JOIN comisiones ON reservas.comision_codigo=comisiones.comision_codigo WHERE reserva_vigente='1'AND reserva_fechaInicio LIKE '".$date."%' ORDER BY reserva_fechaInicio ASC";

//echo $query_traerReservasHoy;
$traerReservasHoy = mysqli_query($conn, $query_traerReservasHoy);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
</head>
<body>
    <div id="menutitulo">
        <h2>Reservas</h2>
        <div>
            <button type="button" onclick="location.href='agregarReserva.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Reserva</button>
            <button type="button" onclick="location.href='filtrarReservas.php'" class="btn btn-primary mb-3 mt-5 ">Filtrar Reservas</button>
            <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
            <button  id="diferente" type="button" onclick="location.href='listadoReservasCompleto.php'" class="btn btn-secondary mb-3 mt-5 ">Lista Completa</button>
            <button  id="diferente2" type="button" onclick="location.href='../comisiones/listadoComisiones.php'" class="btn btn-secondary mb-3 mt-5 ">Comisiones</button>
            <button  id="diferente2" type="button" onclick="location.href='../profesores/listadoProfesores.php'" class="btn btn-secondary mb-3 mt-5 ">Profesores</button>
            <button  id="diferente2" type="button" onclick="location.href='../salones/listadoSalones.php'" class="btn btn-secondary mb-3 mt-5 ">Salones</button>
            
        </div>    
    </div> 
<div class="row">
    <div class="col-1">

    </div>
    <div class="col-10">
        <br><br>
    <h2><span class="badge bg-secondary">Hoy</span></h2>
        <table class="table table-striped table-bordered mt-3">
            <tr>
                <th>Código de Reserva</th>
                <th>Fecha Inicio</th>
                <th>Código de Comisión</th>
                <th>Profesor</th>
                <th>Código de Salón</th>
            </tr>
            <tr>
                <?php while($filas = mysqli_fetch_assoc($traerReservasHoy)){?>
                    <?php echo "<td>".$filas['reserva_codigo']."</td>"?>
                    <?php echo "<td>".$filas['reserva_fechaInicio']."</td>"?>
                    <?php echo "<td>".$filas['rcc']."</td>"?>
                    <?php echo "<td>".$filas['profesor_dni']."</td>"?>
                    <?php echo "<td>".$filas['salon_codigo']."</td>"?>
                </tr>
                <?php } ?>
        </table>
    </div>
    <div class="col-1">

    </div>

</div>

<div class="row">
    <div class="col-1">
    </div>
    <div class="col-10">
        <br><br> 
            <h2><span class="badge bg-secondary">Todas</span></h2>
            <table class="table table-striped table-bordered mt-3">
                <tr>
                    <th>Código de Reserva</th>
                    <th>Fecha Inicio</th>
                    <th>Código de Comisión</th>
                    <th>Profesor</th>
                    <th>Código de Salón</th>
                </tr>
                <tr>
                <?php while($filas = mysqli_fetch_assoc($traerReservas)){?>
                    <?php echo "<td>".$filas['reserva_codigo']."</td>"?>

                    <?php 
                    $a = substr($filas['reserva_fechaInicio'],0,11);
                    $b = substr($filas['reserva_fechaInicio'],11,-3);
                    
                    echo "<td><h5><span class='badge bg-primary'>".$a."</span>   <span class='badge bg-success'>".$b."</span><h5></td>"?>

                    <?php echo "<td>".$filas['rcc']."</td>"?>
                    <?php echo "<td>".$filas['profesor_dni']."</td>"?>
                    <?php echo "<td>".$filas['salon_codigo']."</td>"?>
                </tr>
                <?php } ?>
            </table>
    </div>    
    <div class="col-1">
    </div>
</div>





</body>
</html>