<?php include '../conexion.php';
ob_start();
session_start();

$dni = $_GET['dni'];

$buscarAlumno_query = "SELECT *,alumnos.alumno_dni as dni1 FROM alumnos WHERE alumnos.alumno_dni='".$dni."'"; 






$buscarAlumno = mysqli_query($conn, $buscarAlumno_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Alumno</title>
</head>
<body>
<div id="menutitulo">
            <h2>Alumnos > Modificar Alumno</h2>
            <div>
            <button type="button" onclick="location.href='listadoAlumnos.php'" class="btn btn-primary mb-3 mt-5 ">Listado Alumnos</button>
            <button type="button" onclick="location.href='listadoAlumnosCompleto.php'" class="btn btn-primary mb-3 mt-5 ">Listado Alumnos Completo</button>
            <button type="button" onclick="location.href='agregarAlumno.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Alumno</button>
            <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
            </div>
        </div>        
<div class="row">
        <div class="col-1">

        </div>
        <div class="col-7">
       
            <form class ="p-3"action= "modificarAlumno.php" method="GET">

            <?php
                while($filas = mysqli_fetch_assoc($buscarAlumno)){
            ?>
                <div class="row">
                    <div class="col-6">
                    <label class="form-label">Número de DNI*</label>
                        <input type="number" class="form-control" name="dni1" min ="1" maxLength="8" value="<?php echo $filas['dni1'];?>" readonly="readonly">
                        <br>
                        
                        <label class="form-label">Número de Legajo*</label>
                        <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="legajo" maxLength="5" value="<?php echo $filas['alumno_legajo'];?>">
                        <br>

                        <label class="form-label">Nombre*</label>
                        <input type="text" class="form-control" name="nombre" maxlength="25" value="<?php echo $filas['alumno_nombre'];?>">
                        <br>

                        <label class="form-label">Apellido*</label>
                        <input type="text" class="form-control" name="apellido" maxlength="25" value="<?php echo $filas['alumno_apellido'];?>">
                        <br>

                        <label class="form-label">Teléfono Celular*</label>
                        <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="telefono" maxLength="13" value="<?php echo $filas['alumno_telefono'];?>"> 
                        <br>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Fecha de Nacimiento*</label>
                        <input type="date" class="form-control" name="fechaNacimiento" value="<?php echo $filas['alumno_fechaNacimiento'];?>">
                        <br>

                        <label class="form-label">Correo*</label>
                        <input type="text" class="form-control" name="correo" maxlength="25"value="<?php echo $filas['alumno_correo'];?>">
                        <br>

                        <label class="form-label">¿Está Vigente?*</label>
                        <?php if($filas['alumno_vigente'] == 1){
                            echo "<td><input class='form-check-input pl-3' type='checkbox' name='vigente1' value='1' id='flexCheckChecked' checked></td>";
                        }else{
                            echo "<td><input class='form-check-input pl-3' type='checkbox' name='vigente1' value='0' id='flexCheckChecked' unchecked></td>";
                        }; ?>
                        <br>
                        <label class="form-label">Comisiones*</label>
                        <select class="form-select" name="comision[]" multiple>
                            <?php 
                                $query_traerComisionesAlumnos= "SELECT * FROM comisionesalumnos WHERE comisionesalumnos_vigente='1' AND alumno_dni='".$filas['dni1']."'";
                                $traerComisionesAlumnos = mysqli_query($conn, $query_traerComisionesAlumnos);
                                $ffilas = mysqli_fetch_assoc($traerComisionesAlumnos);
                                if($ffilas!= null){
                                    $TraerComisiones_query= "SELECT * FROM comisiones";
                                    $TraerComisiones = mysqli_query($conn, $TraerComisiones_query);
                                    while($pilas = mysqli_fetch_assoc($TraerComisiones)){
                                            $tempCoincide=false;
                                            $traerComisionesAlumnos1 = mysqli_query($conn, $query_traerComisionesAlumnos);
                                            while($filas1 = mysqli_fetch_assoc($traerComisionesAlumnos1)){
                                                if($filas1['comision_codigo'] == $pilas['comision_codigo']){
                                                    $tempCoincide=true;
                                                    break;
                                                }
                                            }
                                            if($tempCoincide ==true){
                                                echo '<option value="'.$pilas['comision_codigo'].'" selected>'.$pilas['comision_codigo'].'</option>';
                                            }else{
                                                if($pilas['comision_vigente'] == 1){
                                                    echo '<option value="'.$pilas['comision_codigo'].'">'.$pilas['comision_codigo'].'</option>';
                                                }
                                            }
                                    }
                                }else{
                                    $TraerComisiones_query= "SELECT * FROM comisiones WHERE comision_vigente='1'";
                                    $TraerComisiones = mysqli_query($conn, $TraerComisiones_query);
                                    while($ffilas = mysqli_fetch_assoc($TraerComisiones)){?>
                                        <option value="<?php echo $ffilas['comision_codigo']?>"><?php echo $ffilas['comision_codigo'];?>
                                        </option>
                                        
                                    <?php } 
                                } ?>
                        </select>
                        <?php }?>
                        <br>
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
$comision = $_GET['comision'];

if ($dni1!=null && $legajo!=null && $nombre!=null && $apellido!=null && $telefono!=null && $fechaNacimiento!=null && $correo!=null){
    
    if($vigente == null){
        $vigente = 0;
    } else{
        $vigente = 1;
    }

    $query_guardarAlumno = "UPDATE alumnos SET alumno_dni='".$dni1."', alumno_legajo='".$legajo."', alumno_nombre='".$nombre."', alumno_apellido='".$apellido."', alumno_telefono='".$telefono."', alumno_fechaNacimiento='".$fechaNacimiento."', alumno_correo='".$correo."', alumno_vigente='".$vigente."'  WHERE alumno_dni='".$dni1."'";
    

    $query_borrarComisiones = "DELETE FROM comisionesalumnos WHERE alumno_dni='".$dni1."'";
    mysqli_query($conn, $query_borrarComisiones);
    
    /*foreach ($_GET['comision'] as $selectedOption){
    echo $selectedOption."\n";
    }*/
    
    if($comision != null){
        $cant = sizeof($comision);
        echo $cant;
        if($cant>0){
            for($i=0;$i<$cant;$i++){
                $query_guardarCA = "INSERT INTO comisionesalumnos (comision_codigo, alumno_dni, comisionesalumnos_vigente) VALUE ('$comision[$i]','$dni1', '1')";
                //echo $query_guardarCA;
                mysqli_query($conn, $query_guardarCA);
            }
        }
    }
    

    mysqli_query($conn, $query_guardarAlumno);
    header('location:listadoAlumnosCompleto.php');
}


session_destroy()

?>