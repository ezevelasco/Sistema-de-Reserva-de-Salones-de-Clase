<?php include '../conexion.php';
$query_traerSalones = "SELECT * FROM salones";
$traerSalones = mysqli_query($conn, $query_traerSalones);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Agregar Salón</title>
</head>
<body>
<div id="menutitulo">
            <h2>Salones > Agregar Salón</h2>
            <div>
            <button type="button" onclick="location.href='listadoSalones.php'" class="btn btn-primary mb-3 mt-5 ">Listado Salones</button>
        <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
            </div>
        </div>   
    <div class="row">
        <div class="col-1">

        </div>
        <div class="col-4">
            <form class ="p-3"action= "agregarSalon.php" method="GET">
                
                <label class="form-label">Código de Salón*</label>
                <input type="number" 
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                class="form-control" name="codigo" min ="1" maxLength="5">
                <br>

                <label class="form-label">Nombre*</label>
                <input type="text" class="form-control" name="nombre" maxlength="25">
                <br>

                <label class="form-label">Capacidad*</label>
                <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="capacidad" maxLength="3">
                <br>

                <label class="form-label">¿Está Habilitado?*</label>
                <input class="form-check-input pl-3" type="checkbox" value="1" name="habilitado" id="flexCheckChecked" checked>
                <br>    
                <br>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>

            </form>
        </div>
        <div class="col-7">
        </div>
    </div>
    <?php

        $cod = $_GET['codigo'];
        $nombre = $_GET['nombre'];
        $capacidad = $_GET['capacidad'];
        $habilitado = $_GET['habilitado'];

        if ($cod!=null && $nombre!=null && $capacidad!=null){
           
            if($habilitado == null){
                $habilitado = 0;
            } else{
                $habilitado = 1;
            }
            $query_guardarSalon = "INSERT INTO salones(salon_codigo, salon_nombre, salon_capacidad,salon_habilitado)  VALUE ('$cod','$nombre', '$capacidad', '$habilitado')";
            mysqli_query($conn, $query_guardarSalon);
            header('location:listadoSalones.php');
            
        }
?>

</body>
</html>

