<?php include '../conexion.php';

$query_traerComisiones= "SELECT * FROM comisiones";
$traerComisiones = mysqli_query($conn, $query_traerComisiones);
?>



<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Comisiones</title>
   
</head>
<body>
<div id="menutitulo">
        <h2>Comisiones</h2>
        <div>
            <button type="button" onclick="location.href='agregarComision.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Comisión</button>
            <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
            
        </div>    
    </div> 
<div class="row">
<div class="col-2"></div>
<div class="col-7">
    <table class="table table-striped table-bordered mt-3">
        <tr>
            <th style="width: 5%">Código</th>
            <th style="width: 15%">Nombre</th>
            <th style="width: 5%">Año</th>
            <th style="width: 5%">Vigente</th>
            <th style="width: 9%">Profesor DNI</th>
            <th style="width: 9%">Ver Alumnos</th>
            <th style="width: 13%"><img src="../engranaje.png"alt=""></th>
        </tr>
        <tr>
        <?php while($filas = mysqli_fetch_assoc($traerComisiones)){

?>
            <?php echo "<td>".$filas['comision_codigo']."</td>"?>
            <?php echo "<td>".$filas['comision_nombre']."</td>"?>
            <?php echo "<td>".$filas['comision_anio']."</td>"?>
            <?php if($filas['comision_vigente'] == 1){
                echo "<td><input class='form-check-input pl-3' style='margin-left:32px;' type='checkbox' value='' checked disabled></td>";
            }else{
                echo "<td><input class='form-check-input pl-3' style='margin-left:32px;' type='checkbox' value='' unchecked disabled></td>";
            }
            ?>
            <?php echo "<td><a href='../profesores/listadoProfesores.php'>".$filas['profesor_dni']."</a></td>"?>
            <?php echo "<td><a href='listadoAlumnosPorComision.php?cod=".$filas['comision_codigo']."'><img style='padding-left:35px;' src='../student.png'></a></td>"; ?>
            <?php echo "<td><a href='eliminarComision.php?cod=".$filas["comision_codigo"]."'><img style='padding-right:25px;padding-left:10px;' src='../trash-bin.png'></a>";
                  echo "<a href='habilitarComision.php?cod=".$filas["comision_codigo"]."'><img style='padding-right:25px;' src='../cheque.png'></a>";
                  echo "<a href='modificarComision.php?cod=".$filas["comision_codigo"]."'><img src='../lapiz.png'></a></td>";?>
        </tr>
        <?php } ?>
    </table>
<div class="col-1"></div>
</div>
</div>

</body>
</html>