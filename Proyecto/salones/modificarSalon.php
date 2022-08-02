<?php include '../conexion.php';
ob_start();
session_start();

$cod = $_GET['cod'];
$buscarSalon_query = "SELECT * FROM salones WHERE salon_codigo='".$cod."'"; 
$buscarSalon = mysqli_query($conn, $buscarSalon_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Salón</title>
</head>
<body>
<div id="menutitulo">
            <h2>Salones > Modificar Salón</h2>
            <div>
            <button type="button" onclick="location.href='listadoSalones.php'" class="btn btn-primary mb-3 mt-5 ">Listado Salones</button>
            <button type="button" onclick="location.href='agregarSalon.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Salón</button>
            <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
            </div>
        </div>        
<div class="row">
        <div class="col-1">

        </div>
        <div class="col-4">
       
            <form class ="p-3"action= "modificarSalon.php" method="GET">

            <?php
                while($filas = mysqli_fetch_assoc($buscarSalon)){
            ?>
                <div class="row p-3">
                    
                    <label class="form-label">Código*</label>
                        <input type="number" class="form-control" name="cod1" min ="1" maxLength="8" value="<?php echo $filas['salon_codigo'];?>" readonly="readonly">
                        <br>

                        <label class="form-label">Nombre*</label>
                        <input type="text" class="form-control" name="nombre" maxlength="25" value="<?php echo $filas['salon_nombre'];?>">
                        <br>

                        <label class="form-label">Capacidad*</label>
                        <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="capacidad" maxLength="3" value="<?php echo $filas['salon_capacidad'];?>"> 
                        <br>
                        
                        <p></p>
                        <label class="form-label">¿Está Habilitado?*</label>
                        <?php if($filas['salon_habilitado'] == 1){
                            echo "<td><input class='form-check-input pl-1' type='checkbox' name='vigente1' value='1' id='flexCheckChecked' checked></td>";
                        }else{
                            echo "<td><input class='form-check-input' type='checkbox' name='vigente1' value='0' id='flexCheckChecked' unchecked></td>";
                        }; ?>
                        <br><br>
                        
                        
                        <?php }?>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Enviar</button>
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

$cod = $_GET['cod1'];
$nombre = $_GET['nombre'];
$capacidad = $_GET['capacidad'];
$vigente = $_GET['vigente1'];


if ($cod!=null && $nombre!=null && $capacidad!=null){
    
    if($vigente == null){
        $vigente = 0;
    } else{
        $vigente = 1;
    }
    $query_guardarSalon = "UPDATE salones SET salon_nombre='".$nombre."', salon_capacidad='".$capacidad."', salon_habilitado='".$vigente."'  WHERE salon_codigo='".$cod."'";
    
    //echo $query_guardarSalon;
    mysqli_query($conn, $query_guardarSalon);
    header('location:listadoSalones.php');
}


session_destroy()

?>