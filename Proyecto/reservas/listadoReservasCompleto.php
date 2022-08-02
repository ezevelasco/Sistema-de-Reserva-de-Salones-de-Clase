<?php include '../conexion.php';

$query_traerReservas= "SELECT *, reservas.comision_codigo AS rcc FROM reservas INNER JOIN comisiones ON reservas.comision_codigo=comisiones.comision_codigo ORDER BY reserva_fechaInicio ASC";
$traerReservas = mysqli_query($conn, $query_traerReservas);
?>



<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Reservas</title>
   
</head>
<body>
                <div id="menutitulo">
                    <h2>Reservas - Vista Completa</h2>
                    <div>
                        <button type="button" onclick="location.href='agregarReserva.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Reserva</button>
                        <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
                        <button type="button" id="diferente" onclick="location.href='listadoReservas.php'" class="btn btn-secondary mb-3 mt-5 ">Lista Vigentes</button>
                    </div>
            
                </div>      
<div class="row">
    <div class="col-1">
        
    </div>
    <div class="col-10">
        <div class="row">
            <div class="col-3">
                 
            </div>
        <div class="col-9">
        </div>
    </div>
    <table class="table table-striped table-bordered mt-3">
        <tr>
            <th>Código de Reserva</th>
            <th>Fecha Inicio</th>
            <th>Código de Comisión</th>
            <th>Profesor</th>
            <th>Código de Salón</th>
            <th>Vigente</th>
            <th><img src="../engranaje.png"alt=""></th>
        </tr>
        <tr>
        <?php while($filas = mysqli_fetch_assoc($traerReservas)){?>
            
            <?php echo "<td>".$filas['reserva_codigo']."</td>"?>
            <?php echo "<td>".$filas['reserva_fechaInicio']."</td>"?>
            <?php echo "<td>".$filas['rcc']."</td>"?>
            <?php echo "<td>".$filas['profesor_dni']."</td>"?>
            <?php echo "<td>".$filas['salon_codigo']."</td>"?>

            <?php if($filas['reserva_vigente'] == 1){
                echo "<td><input class='form-check-input pl-3' type='checkbox' value='' checked disabled></td>";
            }else{
                echo "<td><input class='form-check-input pl-3' type='checkbox' value='' unchecked disabled></td>";
            }?>
            <?php echo "<td><a href='eliminarReserva.php?cod=".$filas["reserva_codigo"]."'><img style='padding-right:25px;padding-left:10px;' src='../trash-bin.png'></a>";
             echo "<a href='habilitarReserva.php?cod=".$filas["reserva_codigo"]."'><img style='padding-right:25px;' src='../cheque.png'></a>";
                  echo "<a href='modificarReserva.php?cod=".$filas["reserva_codigo"]."'><img src='../lapiz.png'></a></td>";?>
        </tr>
        <?php } ?>
    </table>
<div class="col-1"></div>
</div>
</div>

</body>
</html>