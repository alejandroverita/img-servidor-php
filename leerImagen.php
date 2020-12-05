<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

require("datosConexion.php");

$conexion=new mysqli($db_host, $db_usuario, $db_contra, $db_nombre, $db_port);

//en caso de que falle la conexion con la base de datos

if (mysqli_connect_errno()){
    echo "Fallo en la conexion";
    exit();

}

mysqli_select_db($conexion, $db_nombre) or die ("No se encuentr la BBDD");

mysqli_set_charset($conexion, "utf8"); //para admitir caracteres latinos

$consulta="SELECT FOTO FROM PRODUCTOS WHERE CÓDIGOARTÍCULO='AR01'"; 

$resultados=mysqli_query($conexion, $consulta);

while ($fila=mysqli_fetch_array($resultados)) {

    $ruta_img=$fila["FOTO"];
}


?>
<div>
    <img src="/intranet/uploads/<?php echo $ruta_img; ?>" width="25%"/>

</div>
</body>
</html>


