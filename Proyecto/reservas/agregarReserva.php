<?php include '../conexion.php'; 
ob_start();
session_start();



$TraerComisiones_query= "SELECT * FROM comisiones WHERE comision_vigente='1'";
$TraerComisiones = mysqli_query($conn, $TraerComisiones_query);
$TraerHoras = mysqli_query($conn,"SELECT * FROM horas");
$TraerSalones = mysqli_query($conn,"SELECT * FROM salones WHERE salon_habilitado='1'");
?>
<!DOCTYPE html>
<html lang="en">
<head>  
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4.3.2/css/metro-all.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Reserva</title>
</head>
<body id="bodytable">
    <div class="row">
        <div id="menutitulo">
            <h2>Reservas > Agregar Reserva</h2>
            <div>
            <button type="button" onclick="location.href='listadoReservas.php'" class="btn btn-primary mb-3 mt-5 ">Listado Reservas</button>
            <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
            </div>
        </div>        
        <div class="col-1">
        </div>
        <div class="col-5">
            <form class ="p-3"action= "agregarReserva.php" method="GET">                   
                        <label class="form-label">Fecha de la Reserva*</label>
                        <?php date_default_timezone_set('America/Argentina/Mendoza');
                        $date = date('Y/m/d');?>
                        <input type="date" name ="fechaInicio" data-role="calendarpicker" data-dialog-mode="true" data-min-date="<?php echo $date?>"  data-exclude="7">
                        <br>
                        <label class="form-label">Hora de la Reserva*</label>
                        <select class="form-select" name="horaInicio">
                            <option selected>--Seleccionar--</option>
                            <?php while($filas = mysqli_fetch_assoc($TraerHoras)){?>
                                <option value="<?php echo $filas['hora_valor']?>"><?php echo "🕑 ".$filas['hora_texto']?></option>
                            <?php }?>
                        </select>
                        <br>
                        <label class="form-label">¿A que Comisión pertenece?*</label>
                        <select class="form-select" name="comision">
                            <option selected>--Seleccionar--</option>
                            <?php while($filas = mysqli_fetch_assoc($TraerComisiones)){?>
                            <option value="<?php echo $filas['comision_codigo']?>"><?php echo $filas['comision_codigo']," ",$filas['comision_nombre'];?>
                            </option>
                            <?php }?>
                        </select>
                        <br>
                        <label class="form-label">Salón*</label>
                        <select class="form-select" name="salon">
                            <option selected>--Seleccionar--</option>
                            <?php while($filas = mysqli_fetch_assoc($TraerSalones)){?>
                            <option value="<?php echo $filas['salon_codigo']?>"><?php echo $filas['salon_nombre']." - 🧍".$filas['salon_capacidad'];?></option>
                        <?php }?>
                        </select>                        
                        <br>                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                        <script src="https://cdn.metroui.org.ua/v4.3.2/js/metro.min.js"></script>
            </form>
        </div>
        <div class="col-6">
            <br>
        <?php require_once '../comisiones/listadoComisionesReducido.php'; ?>
        </div>
        
    </div>

<?php 
$fechaInicio = $_GET['fechaInicio'];
$horaInicio = $_GET['horaInicio'];
$comision = $_GET['comision'];
$salon = $_GET['salon'];


if ($fechaInicio!=null && $horaInicio!=null && $comision!=null && $salon!=null){
    $tempDate = "$fechaInicio $horaInicio";

    $verificarFecha = mysqli_query($conn, 'SELECT * FROM reservas');
    $tempVerificar = false;
    while($filas = mysqli_fetch_assoc($verificarFecha)){
        if($tempDate==$filas['reserva_fechaInicio']){
            if($salon == $filas['salon_codigo']){
                if($filas['reserva_vigente']==1){
                    $tempVerificar = true;
                    echo '<div class="alert alert-danger" role="alert">
                    Fecha/Hora existente para el salón seleccionado! Intente nuevamente.
                  </div>';
                    return;
                }
            }
           
        }
    }
    
    if($tempVerificar == false){
        $query_guardarReserva = "INSERT INTO reservas (reserva_fechaInicio, comision_codigo, salon_codigo, reserva_vigente) VALUE ('$tempDate', '$comision', '$salon', '1')";
        mysqli_query($conn, $query_guardarReserva);
        header('location:listadoReservas.php');
    }else{
        header('location:agregarReserva.php?hayerror=1');
    }
    session_destroy();
}

?> 

</body>
</html>

