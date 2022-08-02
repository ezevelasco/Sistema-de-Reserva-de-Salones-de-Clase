<?php include '../conexion.php';

$query_traerProfesores= "SELECT * FROM profesores ORDER BY profesor_dni ASC";

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
                    <h2>Profesores - Vista Completa</h2>
                    <div>
                        <button type="button" onclick="location.href='agregarProfesor.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Profesor</button>
                        <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
                        <button type="button" id="diferente" onclick="location.href='listadoProfesores.php'" class="btn btn-secondary mb-3 mt-5 ">Lista Vigentes</button>
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
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Fecha de Nacimiento</th>
            <th>Correo</th>
            <th>Vigente</th>
            <th><img src="../engranaje.png"alt=""></th>
        </tr>
        <tr>
        <?php while($filas = mysqli_fetch_assoc($traerProfesores)){?>
            
            <?php echo "<td>".$filas['profesor_dni']."</td>"?>
            <?php echo "<td>".$filas['profesor_legajo']."</td>"?>
            <?php echo "<td>".$filas['profesor_nombre']."</td>"?>
            <?php echo "<td>".$filas['profesor_apellido']."</td>"?>
            <?php echo "<td>".$filas['profesor_telefono']."</td>"?>
            <?php echo "<td>".$filas['profesor_fechaNacimiento']."</td>"?>
            <?php echo "<td>".$filas['profesor_correo']."</td>"?>
            <?php if($filas['profesor_vigente'] == 1){
                echo "<td><input class='form-check-input pl-3' type='checkbox' value='' checked disabled></td>";
            }else{
                echo "<td><input class='form-check-input pl-3' type='checkbox' value='' unchecked disabled></td>";
            }?>
            <?php echo "<td><a href='eliminarProfesor.php?dni=".$filas["profesor_dni"]."'><img style='padding-right:25px;padding-left:10px;' src='../trash-bin.png'></a>";?>
            <?php echo "<a href='habilitarProfesor.php?dni=".$filas["profesor_dni"]."'><img style='padding-right:25px;' src='../cheque.png'></a>";?>
            <?php echo "<a href='modificarProfesor.php?dni=".$filas["profesor_dni"]."'><img src='../lapiz.png'></a></td>";?>
            
        </tr>
        <?php } ?>
    </table>
<div class="col-1"></div>
</div>
</div>

</body>
</html>