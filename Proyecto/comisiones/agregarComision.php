<?php include '../conexion.php';
$query_traerProfesores = "SELECT * FROM profesores";
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
   
    <title>Agregar Comision</title>
</head>
<body>
    <div class="row">
    <div id="menutitulo">
            <h2>Comisiones > Agregar Comisión</h2>
            <div>
            <button type="button" onclick="location.href='listadoComisiones.php'" class="btn btn-primary mb-3 mt-5 ">Listado Comisiones</button>
            <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
            </div>
        </div>        
        <div class="col-1">

        </div>
        <div class="col-4">
            <form class ="p-3"action= "agregarComision.php" method="GET">
                
                <label class="form-label">Código de Comisión*</label>
                <input type="number" 
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                class="form-control" name="codigo" min ="1" maxLength="5">
                <br>

                <label class="form-label">Nombre*</label>
                <input type="text" class="form-control" name="nombre" maxlength="25">
                <br>

                <label class="form-label">Año*</label>
                <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="anio" maxLength="4">
                <br>

                <label class="form-label">¿Está Vigente?*</label>
                <input class="form-check-input pl-3" type="checkbox" value="1" name="vigente" id="flexCheckChecked" checked>
                <br>
                <br>

                <label class="form-label">¿A que Profesor pertenece?*</label>
                <select class="form-select" name="profesor">
                    <option selected>--Seleccionar--</option>

                    <?php while($filas = mysqli_fetch_assoc($traerProfesores)){?>

                    <option value="<?php echo $filas['profesor_dni']?>"><?php echo $filas['profesor_nombre']," ",$filas['profesor_apellido'];?>
                    </option>

                <?php }?>
                </select>
                <br>

                <button type="submit" class="btn btn-success">Enviar</button>

            </form>
        </div>
        <div class="col-7">
        </div>
    </div>
    <?php

        $cod = $_GET['codigo'];
        $nombre = $_GET['nombre'];
        $anio = $_GET['anio'];
        $profesor = $_GET['profesor'];
        $vigente = $_GET['vigente'];

        //Query para buscar el DNI del profesor, porque si utilizo el del form me tira error ya que trae un String y no un Number
        $traerProfesorSeleccionado = "SELECT profesor_dni FROM profesores WHERE profesor_dni='".$profesor."'";
        $profesorDNI = mysqli_query($conn, $traerProfesorSeleccionado);

        if ($cod!=null && $nombre!=null && $anio!=null && $profesor!=null){

            //Busco a ver si existe una comisión con ese código y de paso manejo el error q me puede tirar
            $checkExistingComision = mysqli_query($conn, "SELECT comision_codigo FROM comisiones WHERE comision_codigo='".$cod."'");

            if(empty($checkExistingComision)){
                echo "<br><div class='alert alert-danger' role='alert'>ERROR: El código ingresado".$cod." ya existe, intente nuevamente!</div>";
            }else{
                if($vigente == null){
                    $vigente = 0;
                } else{
                    $vigente = 1;
                }

                //Traigo el DNI del profesor y lo guardo en $p1
                $p1=0;
                while($profeTemporal = mysqli_fetch_assoc($profesorDNI)){
                    $p1 = $profeTemporal['profesor_dni'];
                }

                $query_guardarComision = "INSERT INTO comisiones (comision_codigo, comision_nombre, comision_anio, comision_vigente, profesor_dni)  VALUE ('$cod', '$nombre', '$anio', '$vigente', $p1)";
                mysqli_query($conn, $query_guardarComision);
                header('location:listadoComisiones.php');
            }
        }
?>

</body>
</html>

