<?php include '../conexion.php'; 
ob_start();
session_start();
$TraerComisiones_query= "SELECT * FROM comisiones WHERE comision_vigente='1'";
$TraerComisiones = mysqli_query($conn, $TraerComisiones_query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Profesor</title>
</head>
<body id="bodytable">
    <div class="row">
        <div id="menutitulo">
            <h2>Profesores > Agregar Profesor</h2>
            <div>
            <button type="button" onclick="location.href='listadoProfesores.php'" class="btn btn-primary mb-3 mt-5 ">Listado Profesores</button>
            <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
            </div>
        </div>        
        <div class="col-1">
        </div>
        <div class="col-8">
            <form class ="p-3"action= "agregarProfesor.php" method="GET">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">Número de DNI*</label>
                        <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="dni" maxLength="8" >
                        <br>                        
                        <label class="form-label">Número de Legajo*</label>
                        <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="legajo" maxLength="5">
                        <br>
                        <label class="form-label">Nombre*</label>
                        <input type="text" class="form-control" name="nombre" maxlength="25">
                        <br>
                        <label class="form-label">Apellido*</label>
                        <input type="text" class="form-control" name="apellido" maxlength="25">
                        <br>
                        <label class="form-label">Teléfono Celular*</label>
                        <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="telefono" maxLength="13">
                        <br>
                        
                    </div>
                    <div class="col-6">
                    <label class="form-label">Fecha de Nacimiento*</label>
                        <input type="date" class="form-control" name="fechaNacimiento">
                        <br>
                        <label class="form-label">Correo*</label>
                        <input type="text" class="form-control" name="correo" maxlength="25">
                        <br>                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-3">
        </div>
    </div>

    <?php 

$dni = $_GET['dni'];
$legajo = $_GET['legajo'];
$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$telefono = $_GET['telefono'];
$fechaNacimiento = $_GET['fechaNacimiento'];
$correo = $_GET['correo']; 

    
if ($dni!=null && $legajo!=null && $nombre!=null && $apellido!=null && $telefono!=null && $fechaNacimiento!=null && $correo!=null){
    $query_guardarProfesor = "INSERT INTO profesores (profesor_dni, profesor_legajo, profesor_nombre, profesor_apellido, profesor_telefono, profesor_fechaNacimiento, profesor_correo, profesor_vigente) VALUE ('$dni', '$legajo', '$nombre', '$apellido', '$telefono', '$fechaNacimiento', '$correo', '1')";
    
    

    try {
        mysqli_query($conn, $query_guardarProfesor);    
        header('location:listadoProfesores.php');

      }catch(Exception $e) {
        echo '<div class="alert alert-danger" role="alert">El DNI ingresado ya existe en el sistema. Intente nuevamente.</div>';
      }




















}
session_destroy();
?>

</body>
</html>

