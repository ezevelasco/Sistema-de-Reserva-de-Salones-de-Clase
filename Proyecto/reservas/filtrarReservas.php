<?php include '../conexion.php';
//$query_traerReservas= "SELECT *, reservas.comision_codigo AS rcc FROM reservas INNER JOIN comisiones ON reservas.comision_codigo=comisiones.comision_codigo WHERE reserva_vigente='1'ORDER BY reserva_fechaInicio ASC";
//$traerReservas = mysqli_query($conn, $query_traerReservas);
$TraerHoras = mysqli_query($conn,"SELECT * FROM horas");
$TraerHoras1 = mysqli_query($conn,"SELECT * FROM horas");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar Reservas</title>
</head>
<body>
    <div id="menutitulo">
        <h2>Filtrar Reservas</h2>
        <div>
            <button type="button" onclick="location.href='agregarReserva.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Reserva</button>
            <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
            <button  id="diferente" type="button" onclick="location.href='listadoReservasCompleto.php'" class="btn btn-secondary mb-3 mt-5 ">Lista Completa</button>
            
        </div>    
    </div> 
<div class="row">
    <div class="col-1"></div>
    <div class="col-8">
        <form class ="p-3"action= "filtrarReservas.php" method="GET">
        <div class="row">
            <div class="col-5">
                <h4><span class="badge bg-secondary">Desde:</span></h4> <input style="width:40%" type="date" name="fechaDesde">
                <select style="width:40%" class="form-select" name="horaDesde">
                    <option selected>--Seleccionar--</option>
                    <?php while($filas = mysqli_fetch_assoc($TraerHoras)){?>
                        <option value="<?php echo $filas['hora_valor']?>"><?php echo "🕑 ".$filas['hora_texto']?></option>
                    <?php }?>
                </select>
            </div>
            <div class="col-4">
                <h4><span class="badge bg-secondary">Hasta:</span></h4><input style="width:50%" type="date" name="fechaHasta">
                <select class="form-select" style="width:50%" name="horaHasta">
                    <option selected>--Seleccionar--</option>
                    <?php while($filas = mysqli_fetch_assoc($TraerHoras1)){?>
                        <option value="<?php echo $filas['hora_valor']?>"><?php echo "🕑 ".$filas['hora_texto']?></option>
                    <?php }?>
                </select>
            </div>
            <div class="col-3">
                <div class="d-grid gap-2" style="height:100%">
                    <input type="submit" class="btn btn-primary">
                </div>
            </div>
        </div>
        </form>
        
    
    </div>
    <div class="col-1"></div>

</div>
<?php 
$desde=$_GET['fechaDesde'];
$desdeHora=$_GET['horaDesde'];
$hasta=$_GET['fechaHasta'];
$hastaHora=$_GET['horaHasta'];

$tempDesde = "$desde $desdeHora";
$tempHasta = "$hasta $hastaHora";
if($desde !=null && $hasta !=null && $desdeHora !=null && $hastaHora !=null && ($tempDesde<=$tempHasta)){

    $query_traerReservasFiltradas= "SELECT * FROM reservas WHERE reserva_vigente='1'AND (reserva_fechaInicio >='".$tempDesde."' AND reserva_fechaInicio <='".$tempHasta."') ORDER BY reserva_fechaInicio ASC";
    //echo $query_traerReservasFiltradas;
    $traerReservasFiltradas = mysqli_query($conn, $query_traerReservasFiltradas);
?>

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
                <?php while($filas = mysqli_fetch_assoc($traerReservasFiltradas)){?>
                    <?php echo "<td>".$filas['reserva_codigo']."</td>"?>

                    <?php 
                    $a = substr($filas['reserva_fechaInicio'],0,11);
                    $b = substr($filas['reserva_fechaInicio'],11,-3);
                    
                    echo "<td><h5><span class='badge bg-primary'>".$a."</span>   <span class='badge bg-success'>".$b."</span><h5></td>"?>

                    <?php echo "<td>".$filas['comision_codigo']."</td>"?>

                    <?php
                    $traerProfesor = mysqli_query($conn,"SELECT profesor_dni FROM comisiones WHERE comision_codigo='".$filas['comision_codigo']."'");
                    while($ffilas=mysqli_fetch_assoc($traerProfesor)){
                        echo "<td>".$ffilas['profesor_dni']."</td>";
                    }
                    
                    ?>
                    <?php echo "<td>".$filas['salon_codigo']."</td>"?>
                </tr>
                <?php } ?>
            </table>
    </div>    
    <div class="col-1">
    </div>
</div>



<?php }else{
    echo '<div class="alert alert-danger" role="alert">Las fechas/horas no pueden estar vacías</div>';
}

?>









</body>
</html>