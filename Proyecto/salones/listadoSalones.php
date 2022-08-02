<?php include '../conexion.php';

$query_traerSalones= "SELECT * FROM salones";
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
    <title>Listado de Salones</title>
   
</head>
<body>
<div id="menutitulo">
    <h2>Salones</h2>
    <div>
    <button type="button" onclick="location.href='agregarSalon.php'" class="btn btn-primary mb-3 mt-5 ">Agregar Salón</button>
    <button type="button" onclick="location.href='../home.php'" class="btn btn-primary mb-3 mt-5 ">Inicio</button>
    </div>    
</div> 
<div class="row">
<div class="col-1"></div>
<div class="col-10">
   
    <table class="table table-striped table-bordered mt-3">
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Capacidad</th>
            <th>Habilitado</th>
            <th><img src="../engranaje.png"alt=""></th>
        </tr>
        <tr>
        <?php while($filas = mysqli_fetch_assoc($traerSalones)){

?>
            <?php echo "<td>".$filas['salon_codigo']."</td>"?>
            <?php echo "<td>".$filas['salon_nombre']."</td>"?>
            <?php echo "<td>".$filas['salon_capacidad']."</td>"?>
            <?php if($filas['salon_habilitado'] == 1){
                echo "<td><input class='form-check-input pl-3' type='checkbox' value='' checked disabled></td>";
            }else{
                echo "<td><input class='form-check-input pl-3' type='checkbox' value='' unchecked disabled></td>";
            }
            ?>
            <?php echo "<td><a href='eliminarSalon.php?cod=".$filas["salon_codigo"]."'><img style='padding-right:25px;padding-left:10px;' src='../trash-bin.png'></a>";
                echo "<a href='habilitarSalon.php?cod=".$filas["salon_codigo"]."'><img style='padding-right:25px;' src='../cheque.png'></a>";
                echo "<a href='modificarSalon.php?cod=".$filas["salon_codigo"]."'><img src='../lapiz.png'></a></td>";?>
        </tr>
        <?php } ?>
    </table>
<div class="col-1"></div>
</div>
</div>

</body>
</html>