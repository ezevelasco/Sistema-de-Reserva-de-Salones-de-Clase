<?php include '../conexion.php';
ob_start();
session_start();

$cod = $_GET['cod'];
$buscarComision_query = "SELECT * FROM comisiones WHERE comision_codigo='".$cod."'"; 
$buscarComision = mysqli_query($conn, $buscarComision_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Comisión</title>
</head>
<body>
<div id="menutitulo">
            <h2>Comisiones > Modificar Comisión</h2>
            <div>
            <button type="button" onclick="location.href='listadoComisiones.php'" class="btn btn-primary mb-3 mt-5 ">Listado Comisiones</button>
            <button type="button" onclick="location.href='agregarComision.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Comisión</button>
            <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
            </div>
        </div>        
<div class="row">
        <div class="col-1">

        </div>
        <div class="col-4">
       
            <form class ="p-3"action= "modificarComision.php" method="GET">

            <?php
                while($filas = mysqli_fetch_assoc($buscarComision)){
            ?>
                <div class="row p-3">
                    
                    <label class="form-label">Código*</label>
                        <input type="number" class="form-control" name="cod1" min ="1" maxLength="8" value="<?php echo $filas['comision_codigo'];?>" readonly="readonly">
                        <br>

                        <label class="form-label">Nombre*</label>
                        <input type="text" class="form-control" name="nombre" maxlength="25" value="<?php echo $filas['comision_nombre'];?>">
                        <br>

                        <label class="form-label">Año*</label>
                        <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="anio" maxLength="4" value="<?php echo $filas['comision_anio'];?>"> 
                        <br>
                        
                        <p></p>
                        <label class="form-label">¿Está Vigente?*</label>
                        <?php if($filas['comision_vigente'] == 1){
                            echo "<td><input class='form-check-input pl-1' type='checkbox' name='vigente1' value='1' id='flexCheckChecked' checked></td>";
                        }else{
                            echo "<td><input class='form-check-input' type='checkbox' name='vigente1' value='0' id='flexCheckChecked' unchecked></td>";
                        }; ?>
                        <br>
                        
                        <label class="form-label">¿A que Profesor pertenece?*</label>
                        <select class="form-select" name="profesor">
                            <?php if($filas['profesor_dni'] != null){
                                echo '<option value="'.$filas['profesor_dni'].'" selected>'.$filas['profesor_dni'].'</option>';
                                $TraerProfesores_query= "SELECT * FROM profesores WHERE profesor_vigente='1' AND profesor_dni!='".$filas['profesor_dni']."'";
                            } else {
                                echo '<option value="" selected>--Seleccionar--</option>';
                                $TraerProfesores_query= "SELECT * FROM profesores WHERE profesor_vigente='1'";}
                             
                            echo $TraerProfesores_query;
                            $TraerProfesores = mysqli_query($conn, $TraerProfesores_query);

                            while($ffilas = mysqli_fetch_assoc($TraerProfesores)){?>
                            <option value="<?php echo $ffilas['profesor_dni']?>"><?php echo $ffilas['profesor_dni']," - ",$ffilas['profesor_nombre'];?>
                            </option>
                            <?php } ?>
                        </select>
                        <br>                        
                        <?php }?>
                        <div class="d-grid gap-2">
                            <br>
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
$anio = $_GET['anio'];
$vigente = $_GET['vigente1'];
$profesor = $_GET['profesor'];


if ($cod!=null && $nombre!=null && $anio!=null && $profesor){
    
    if($vigente == null){
        $vigente = 0;
    } else{
        $vigente = 1;
    }
    $query_guardarComision = "UPDATE comisiones SET comision_nombre='".$nombre."', comision_anio='".$anio."', profesor_dni='".$profesor."', comision_vigente='".$vigente."'  WHERE comision_codigo='".$cod."'";
    
    //echo $query_guardarComision;
    mysqli_query($conn, $query_guardarComision);
    header('location:listadoComisiones.php');
}


session_destroy()

?>