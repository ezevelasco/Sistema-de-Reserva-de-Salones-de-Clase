<?php include '../conexion.php';

$query_traerCA= "SELECT * FROM comisionesalumnos";
$traerCA = mysqli_query($conn, $query_traerCA);
?>



<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Alumno-Comision</title>
   
</head>
<body>

<div class="row">
<div class="col-1"></div>
<div class="col-10">
    <button type="button" onclick="location.href='../alumnos/agregarAlumno.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Alumno</button>
    <button type="button" onclick="location.href='../comisiones/agregarComision.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Comision</button>
    <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Volver al inicio</button>
    <table class="table table-striped table-bordered mt-3">
        <tr>
            <th>Código Comisión</th>
            <th>Nombre Comisión</th>
            <th>DNI Alumno</th>
            <th>Alumno</th>
            <th><img src="../engranaje.png"alt=""></th>
        </tr>
        <tr>
        <?php while($filas = mysqli_fetch_assoc($traerCA)){

?>
            <?php echo "<td>".$filas['comision_codigo']."</td>"?>
            <?php echo "<td>".$filas['comision_nombre']."</td>"?>
            <?php echo "<td>".$filas['comision_anio']."</td>"?>
            <?php if($filas['comision_vigente'] == 1){
                echo "<td><input class='form-check-input pl-3' type='checkbox' value='' checked disabled></td>";
            }else{
                echo "<td><input class='form-check-input pl-3' type='checkbox' value='' unchecked disabled></td>";
            }
            ?>
            <?php echo "<td><a href='../profesores/listadoProfesores.php'>".$filas['profesor_dni']."</a></td>"?>
            <?php echo "<td><a href='eliminarComision.php?cod=".$filas["comision_codigo"]."'><img style='padding-right:25px;padding-left:10px;' src='../trash-bin.png'></a>";
                  echo "<a href='modificarComision.php?cod=".$filas["comision_codigo"]."'><img src='../lapiz.png'></a></td>";?>
        </tr>
        <?php } ?>
    </table>
<div class="col-1"></div>
</div>
</div>

</body>
</html>