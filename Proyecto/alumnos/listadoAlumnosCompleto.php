<?php include '../conexion.php';

//$query_traerAlumnos= "SELECT *,alumnos.alumno_dni as dni1 FROM alumnos LEFT JOIN comisionesalumnos ON alumnos.alumno_dni= comisionesalumnos.alumno_dni ORDER BY alumnos.alumno_dni ASC";
$query_traerAlumnos1= "SELECT *,alumnos.alumno_dni as dni1 FROM alumnos ORDER BY alumnos.alumno_dni ASC";

$traerAlumnos = mysqli_query($conn, $query_traerAlumnos1);
?>



<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
   
</head>
<body>
                <div id="menutitulo">
                    <h2>Alumnos - Vista Completa</h2>
                    <div>
                        <button type="button" onclick="location.href='agregarAlumno.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Alumno</button>
                        <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
                        <button type="button" id="diferente" onclick="location.href='listadoAlumnos.php'" class="btn btn-secondary mb-3 mt-5 ">Lista Vigentes</button>
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
            <th>DNI</th>
            <th>Legajo</th>
            <th style="width: 10%">Nombre</th>
            <th style="width: 10%">Apellido</th>
            <th style="width: 8%">Teléfono</th>
            <th style="width: 8%">Fecha Nac.</th>
            <th>Correo</th>
            <th style="width: 15%">Comisiones</th>
            <th style="width: 1%">Vigente</th>
            <th style="width: 12%"><img src="../engranaje.png"alt=""></th>
        </tr>
        <tr>
        <?php while($filas = mysqli_fetch_assoc($traerAlumnos)){?>
            
            <?php echo "<td>".$filas['dni1']."</td>"?>
            <?php echo "<td>".$filas['alumno_legajo']."</td>"?>
            <?php echo "<td>".$filas['alumno_nombre']."</td>"?>
            <?php echo "<td>".$filas['alumno_apellido']."</td>"?>
            <?php echo "<td>".$filas['alumno_telefono']."</td>"?>
            <?php echo "<td>".$filas['alumno_fechaNacimiento']."</td>"?>
            <?php echo "<td>".$filas['alumno_correo']."</td>"?>
            <?php

            $query_traerComisiones= "SELECT * FROM comisionesalumnos WHERE alumno_dni='".$filas['dni1']."'";
            $traerComisiones = mysqli_query($conn, $query_traerComisiones);
            echo "<td>";
            while($ffilas = mysqli_fetch_assoc($traerComisiones)){
                echo "<span class='badge bg-primary'>".$ffilas['comision_codigo']."</span> ";
            }
            echo "</td>";
            
            ?>
            <?php if($filas['alumno_vigente'] == 1){
                echo "<td><input class='form-check-input pl-3' type='checkbox' value='' checked disabled></td>";
            }else{
                echo "<td><input class='form-check-input pl-3' type='checkbox' value='' unchecked disabled></td>";
            }?>
            <?php echo "<td><a href='eliminarAlumno.php?dni=".$filas["dni1"]."'><img style='padding-right:25px;padding-left:10px;' src='../trash-bin.png'></a>";
                  echo "<a href='habilitarAlumno.php?dni=".$filas["dni1"]."'><img style='padding-right:25px;' src='../cheque.png'></a>";
                  echo "<a href='modificarAlumno.php?dni=".$filas["dni1"]."'><img src='../lapiz.png'></a></td>";?>
        </tr>
        <?php } ?>
    </table>
<div class="col-1"></div>
</div>
</div>

</body>
</html>