<?php include '../conexion.php';
ob_start();
session_start();

$cod = $_GET['cod'];
$traerReservas_query= "SELECT *, reservas.comision_codigo AS rcc FROM reservas LEFT JOIN comisiones ON reservas.comision_codigo=comisiones.comision_codigo WHERE reservas.reserva_codigo='".$cod."'";

$buscarReserva = mysqli_query($conn, $traerReservas_query);

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
    <title>Modificar Reserva</title>
</head>
<body>
<div id="menutitulo">
            <h2>Reservas > Modificar Reserva</h2>
            <div>
            <button type="button" onclick="location.href='listadoReservas.php'" class="btn btn-primary mb-3 mt-5 ">Listado Reservas</button>
            <button type="button" onclick="location.href='agregarReserva.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Reserva</button>
            <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
            </div>
        </div>        
<div class="row">
        <div class="col-1">

        </div>
        <div class="col-5">
       
            <form class ="p-3"action= "modificarReserva.php" method="GET">

            <?php
                while($filas = mysqli_fetch_assoc($buscarReserva)){
            ?>
                <div class="row">
                    <div class="col-12">
                        <?php $errora = $_GET['hayerror'];
                        if($errora ==1){
                            echo '<div class="alert alert-danger" role="alert">
                            Fecha/Hora existente para el salón seleccionado! Intente nuevamente.
                            </div>';
                        }
                        
                        ?>
                    <label class="form-label">Código de Reserva*</label>
                        <input type="number" class="form-control" name="dni1" min ="1" maxLength="8" value="<?php echo $filas['reserva_codigo'];?>" readonly="readonly">
                        <br>

                        <?php  
                            $a = substr($filas['reserva_fechaInicio'],0,11);
                            $aa =substr($filas['reserva_fechaInicio'],0,11);
                            $b = substr($filas['reserva_fechaInicio'],11,-3);
                        ?>
                        <label class="form-label">Fecha de la Reserva*</label><br>
                        <?php date_default_timezone_set('America/Argentina/Mendoza');
                        $date = date('Y-m-d');
                        $n = date('Y-m-d', strtotime( $aa . " +1 days"));
                        ?>
                        
                        <input type="date"  value ="<?php echo $n?>" name ="fechaInicio" data-role="calendarpicker" data-dialog-mode="true" data-min-date="<?php echo $date?>"  data-exclude="">
                        
                    
                        <br>
                        <label class="form-label">Hora de la Reserva*</label>
                        <select class="form-select" name="horaInicio">
                        <?php
                            $TraerHoraPrevia =mysqli_query($conn, "SELECT * FROM horas WHERE hora_texto='".$b."'");
                            while($filaPrevia = mysqli_fetch_assoc($TraerHoraPrevia)){?>
                                <option value ="<?php echo $filaPrevia['hora_valor']?>" selected><?php echo "🕑 ".$filaPrevia['hora_texto']?></option>
                            <?php } ?>
                            <?php
                            $TraerHoras = mysqli_query($conn, "SELECT * FROM horas WHERE hora_Texto!='".$b."'");
                            while($pilas = mysqli_fetch_assoc($TraerHoras)){?>
                                <option value="<?php echo $pilas['hora_valor']?>"><?php echo "🕑 ".$pilas['hora_texto']?></option>
                            <?php } ?>
                        </select>
                        <br>
                        <label class="form-label">¿A qué Comisión Pertenece?*</label>
                        <select class="form-select" name="comision">
                            <?php if($filas['rcc'] != null){
                                echo '<option value="'.$filas['rcc'].'" selected>'.$filas['rcc'].'</option>';
                                $TraerComisiones_query= "SELECT * FROM comisiones WHERE comision_vigente='1' AND comision_codigo!='".$filas['rcc']."'";
                            } else {
                                echo '<option value="" selected>--Seleccionar--</option>';
                                $TraerComisiones_query= "SELECT * FROM comisiones WHERE comision_vigente='1'";}
                             
                            echo $TraerComisiones_query;
                            $TraerComisiones = mysqli_query($conn, $TraerComisiones_query);

                            while($ffilas = mysqli_fetch_assoc($TraerComisiones)){?>
                            <option value="<?php echo $ffilas['comision_codigo']?>"><?php echo $ffilas['comision_codigo']," ",$ffilas['comision_nombre'];?>
                            </option>
                            <?php } ?>
                        </select>
                        <br>

                        <label class="form-label">¿A qué Salón Pertenece?*</label>
                        <select class="form-select" name="salon">
                            <?php 
                                if($filas['salon_codigo'] != null){
                                    
                                    echo '<option value="'.$filas['salon_codigo'].'" selected>'.$filas['salon_codigo'].'</option>';
                                    $TraerSalones_query= "SELECT * FROM salones WHERE salon_habilitado='1' AND salon_codigo!='".$filas['salon_codigo']."'";
                                }else{
                                    echo '<option value="" selected>--Seleccionar--</option>';
                                    $TraerSalones_query= "SELECT * FROM salones WHERE salon_habilitado='1'";
                                }
                             
                            $TraerSalones = mysqli_query($conn, $TraerSalones_query);
                            while($ffilas = mysqli_fetch_assoc($TraerSalones)){?>
                            <option value="<?php echo $ffilas['salon_codigo']?>"><?php echo $ffilas['salon_nombre']." - 🧍".$ffilas['salon_capacidad'];?>
                            </option>
                            <?php } ?>
                        </select>
                        <br>
                        <label class="form-label">¿Está Vigente?*</label>
                        <?php if($filas['reserva_vigente'] == 1){
                            echo "<td><input class='form-check-input pl-3' type='checkbox' name='vigente1' value='1' id='flexCheckChecked' checked></td>";
                        }else{
                            echo "<td><input class='form-check-input pl-3' type='checkbox' name='vigente1' value='0' id='flexCheckChecked' unchecked></td>";
                        }; ?>
                        <br>
                        
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
    
            
                        <br>
                    </div>
                </div>
                <?php } ?>
            </form>
        </div>
        <div class="col-4">
        </div>
    </div>
    <script src="https://cdn.metroui.org.ua/v4.3.2/js/metro.min.js"></script>
</body>
</html>
<?php 

$cod = $_GET['dni1'];
$fechaInicio = $_GET['fechaInicio'];
$horaInicio = $_GET['horaInicio'];
$comision = $_GET['comision'];
$salon = $_GET['salon'];
$vigente = $_GET['vigente1'];

if ($cod!=null  && $horaInicio!=null && $comision!=null && $salon!=null && $fechaInicio !=null){
    
    if($vigente == null){
        $vigente = 0;
    } else{
        $vigente = 1;
    }
    
    $tempDate = "$fechaInicio $horaInicio";
    $verificarFecha = mysqli_query($conn, 'SELECT * FROM reservas');
    $tempVerificar = false;
    while($filas = mysqli_fetch_assoc($verificarFecha)){
    if($tempDate==$filas['reserva_fechaInicio'] && $salon == $filas['salon_codigo'] && $filas['reserva_vigente']==1){
        $tempVerificar = true;
        break;
        }
    }
    
    
    if($tempVerificar == false){
        
        $query_guardarReserva = "UPDATE  reservas SET reserva_fechaInicio='".$tempDate."', comision_codigo='".$comision."', salon_codigo='".$salon."', reserva_vigente='".$vigente."' WHERE  reserva_codigo = '".$cod."'";
        //echo $query_guardarReserva;
        mysqli_query($conn, $query_guardarReserva);
        header('location:listadoReservasCompleto.php');
    }else{
        
        header("location:modificarReserva.php?hayerror=1&cod=".$cod);
        

    }
}


session_destroy()

?>