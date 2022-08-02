<?php include '../conexion.php';

$query_traerProfesores= "SELECT * FROM profesores WHERE profesor_vigente='1'ORDER BY profesor_dni ASC";
$traerProfesores = mysqli_query($conn, $query_traerProfesores);
?>



<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesores</title>
   
</head>
<body>
<div id="menutitulo">
        <h2>Profesores</h2>
        <div>
        <button type="button" onclick="location.href='agregarProfesor.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Profesor</button>
            <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
            <button  id="diferente" type="button" onclick="location.href='listadoProfesoresCompleto.php'" class="btn btn-secondary mb-3 mt-5 ">Lista Completa</button>
        </div>    
    </div> 
<div class="row">
<div class="col-1"></div>
<div class="col-10">
    <table class="table table-striped table-bordered mt-3">
        <tr>
            <th>DNI</th>
            <th>Legajo</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Fecha de Nacimiento</th>
            <th>Correo</th>
            
        </tr>
        <tr>
        <?php while($filas = mysqli_fetch_assoc($traerProfesores)){

?>
            <?php echo "<td>".$filas['profesor_dni']."</td>"?>
            <?php echo "<td>".$filas['profesor_legajo']."</td>"?>
            <?php echo "<td>".$filas['profesor_nombre']."</td>"?>
            <?php echo "<td>".$filas['profesor_apellido']."</td>"?>
            <?php echo "<td>".$filas['profesor_telefono']."</td>"?>
            <?php echo "<td>".$filas['profesor_fechaNacimiento']."</td>"?>
            <?php echo "<td>".$filas['profesor_correo']."</td>"?>
            
        </tr>
        <?php } ?>
    </table>
<div class="col-1"></div>
</div>
</div>

</body>
</html>