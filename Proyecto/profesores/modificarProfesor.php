<?php include '../conexion.php';
ob_start();
session_start();

$dni = $_GET['dni'];
$buscarProfesor_query = "SELECT * FROM profesores WHERE profesor_dni='".$dni."'"; 
$buscarProfesor = mysqli_query($conn, $buscarProfesor_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Profesor</title>
</head>
<body>
<div id="menutitulo">
            <h2>Profesores > Modificar Profesor</h2>
            <div>
            <button type="button" onclick="location.href='listadoProfesores.php'" class="btn btn-primary mb-3 mt-5 ">Listado Profesores</button>
            <button type="button" onclick="location.href='agregarProfesor.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Profesor</button>
            <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
            </div>
        </div>        
<div class="row">
        <div class="col-1">

        </div>
        <div class="col-7">
       
            <form class ="p-3"action= "modificarProfesor.php" method="GET">

            <?php
                while($filas = mysqli_fetch_assoc($buscarProfesor)){
            ?>
                <div class="row">
                    <div class="col-6">
                    <label class="form-label">Número de DNI*</label>
                        <input type="number" class="form-control" name="dni1" min ="1" maxLength="8" value="<?php echo $filas['profesor_dni'];?>" readonly="readonly">
                        <br>
                        
                        <label class="form-label">Número de Legajo*</label>
                        <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="legajo" maxLength="5" value="<?php echo $filas['profesor_legajo'];?>">
                        <br>

                        <label class="form-label">Nombre*</label>
                        <input type="text" class="form-control" name="nombre" maxlength="25" value="<?php echo $filas['profesor_nombre'];?>">
                        <br>

                        <label class="form-label">Apellido*</label>
                        <input type="text" class="form-control" name="apellido" maxlength="25" value="<?php echo $filas['profesor_apellido'];?>">
                        <br>

                        <label class="form-label">Teléfono Celular*</label>
                        <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="telefono" maxLength="13" value="<?php echo $filas['profesor_telefono'];?>"> 
                        <br>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Fecha de Nacimiento*</label>
                        <input type="date" class="form-control" name="fechaNacimiento" value="<?php echo $filas['profesor_fechaNacimiento'];?>">
                        <br>

                        <label class="form-label">Correo*</label>
                        <input type="text" class="form-control" name="correo" maxlength="25"value="<?php echo $filas['profesor_correo'];?>">
                        <br>

                        <label class="form-label">¿Está Vigente?*</label>
                        <?php if($filas['profesor_vigente'] == 1){
                            echo "<td><input class='form-check-input pl-3' type='checkbox' name='vigente1' value='1' id='flexCheckChecked' checked></td>";
                        }else{
                            echo "<td><input class='form-check-input pl-3' type='checkbox' name='vigente1' value='0' id='flexCheckChecked' unchecked></td>";
                        }; ?>
                        <br>
                        
                        <?php }?>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                        
                    </div>
                </div>
                

               

            </form>
        </div>
        <div class="col-4">
        </div>
    </div>
</body>
</html>
<?php 

$dni1 = $_GET['dni1'];
$legajo = $_GET['legajo'];
$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$telefono = $_GET['telefono'];
$fechaNacimiento = $_GET['fechaNacimiento'];
$correo = $_GET['correo'];
$vigente = $_GET['vigente1'];


if ($dni1!=null && $legajo!=null && $nombre!=null && $apellido!=null && $telefono!=null && $fechaNacimiento!=null && $correo!=null){
    
    if($vigente == null){
        $vigente = 0;
    } else{
        $vigente = 1;
    }
    $query_guardarProfesor = "UPDATE profesores SET profesor_dni='".$dni1."', profesor_legajo='".$legajo."', profesor_nombre='".$nombre."', profesor_apellido='".$apellido."', profesor_telefono='".$telefono."', profesor_fechaNacimiento='".$fechaNacimiento."', profesor_correo='".$correo."', profesor_vigente='".$vigente."'  WHERE profesor_dni='".$dni1."'";
    
   // echo $query_guardarComision;
    mysqli_query($conn, $query_guardarProfesor);
    header('location:listadoProfesoresCompleto.php');
}


session_destroy()

?>