<?php include '../conexion.php';

$cod = $_GET['cod'];
$query_traerCA="SELECT * FROM comisionesalumnos WHERE comision_codigo='".$cod."' AND comisionesalumnos_vigente='1'";
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
    <title>Alumnos x Comision</title>
    
   
</head>
<body>
    <div id="menutitulo">
        <?php echo"<h2>Alumnos de la Comisión: <span style='margin-left:100px,margin-top:30px' class='badge bg-danger'>".$cod."</span></h2>"?>
        <div>
            <button type="button" onclick="location.href='../alumnos/agregarAlumno.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Alumno</button>
            <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
            <button  id="diferente" type="button" onclick="location.href='listadoComisiones.php'" class="btn btn-secondary mb-3 mt-5 ">Listado Comisiones</button>
            <button  id="diferente" type="button" onclick="location.href='../alumnos/listadoAlumnosCompleto.php'" class="btn btn-secondary mb-3 mt-5 ">Listado Alumnos</button>
        </div>    
    </div> 
    <?php echo"<div></div>";?>
<div class="row">
    
    <div class="col-1"></div>
    
        <div class="col-10"> 
             <table class="table table-striped table-bordered mt-3">
        <tr>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Fecha Nac.</th>
            <th>Correo</th>
            <th>Comisiones</th>
        </tr>
        <tr>
        <?php 

            $cantAlumnos=0;
            while($filas = mysqli_fetch_assoc($traerCA)){

            $cantAlumnos = $cantAlumnos +1;
            echo "<td>".$filas['alumno_dni']."</td>";
            
            $query_traerAlumno= "SELECT * FROM alumnos WHERE alumno_dni='".$filas['alumno_dni']."'";
            $traerAlumno= mysqli_query($conn, $query_traerAlumno);
            while($ffilas=mysqli_fetch_assoc($traerAlumno)){
            
             echo "<td>".$ffilas['alumno_nombre']."</td>";
             echo "<td>".$ffilas['alumno_apellido']."</td>";
             echo "<td>".$ffilas['alumno_telefono']."</td>";
             echo "<td>".$ffilas['alumno_fechaNacimiento']."</td>";
             echo "<td>".$ffilas['alumno_correo']."</td>";
            }
            ?>
            
            <?php 
                $query_traerComisiones= "SELECT * FROM comisionesalumnos WHERE alumno_dni='".$filas['alumno_dni']."'";
                $traerComisiones = mysqli_query($conn, $query_traerComisiones);
                echo "<td>";
                while($ffilas = mysqli_fetch_assoc($traerComisiones)){
                    echo "<span class='badge bg-secondary'>".$ffilas['comision_codigo']."</span> ";
                }
                echo "</td>";
            ?>
        </tr>
        <?php } 
        echo "<br><h4>Cantidad de Alumnos: <span class='badge bg-primary'>".$cantAlumnos."</span></h4>"; ?>
    </table>
<div class="col-1"></div>
</div>
</div>
</body>
</html>