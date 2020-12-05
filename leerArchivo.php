<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

$id="";

$contenido="";

$tipo="";

require("datosConexion.php");

$conexion=new mysqli($db_host, $db_usuario, $db_contra, $db_nombre, $db_port);

//en caso de que falle la conexion con la base de datos

if (mysqli_connect_errno()){
    echo "Fallo en la conexion";
    exit();

}

mysqli_select_db($conexion, $db_nombre) or die ("No se encuentr la BBDD");

//mysqli_set_charset($conexion, "utf8"); //para admitir caracteres latinos

$consulta="SELECT * FROM ARCHIVOS WHERE ID=2 "; 

$resultados=mysqli_query($conexion, $consulta);

while ($fila=mysqli_fetch_array($resultados)) {

    $id=$fila["ID"];

    $contenido=$fila["CONTENIDO"];

    $tipo=$fila["TIPO"];
}

echo "Id: " . $id . "<br>";

echo "Tipo: " . $tipo . "<br>";

//necesitamos un contenendor que almacene el archivo y un sistema de codificacion
echo "<img src='data:image/png; base64," .  base64_encode($contenido) . "'>";


?>

</body>
</html>


