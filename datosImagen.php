<?php

//Recibimos los datos de la imagen: nombre, tipo, tamaño

$nombre_imagen=$_FILES['imagen'] ['name'];

$tipo_imagen=$_FILES['imagen'] ['type'];

$tamagno_imagen=$_FILES['imagen'] ['size'];

echo $tipo_imagen;

if($tamagno_imagen<=1000000) { //1millon de bytes

    if($tipo_imagen=="image/jpeg" || $tipo_imagen=="image/jpg" || $tipo_imagen=="image/png" || $tipo_imagen=="image/gif"){

    

//ruta de la carpeta destino en servidor
$carpeta_destino=$_SERVER['DOCUMENT_ROOT'] . '/intranet/uploads/';


//Mueve la imagen de carpeta temporal al carpeta permanente
move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$nombre_imagen);
    
    } else {

        echo "Solo se admiten imagenes de formato /jpg/jpeg/png/gif";
    }

} else {
    echo "El tamaño del archivo es demasiado pesado";
}


require("datosConexion.php");

$conexion=new mysqli($db_host, $db_usuario, $db_contra, $db_nombre, $db_port);

//en caso de que falle la conexion con la base de datos

if (mysqli_connect_errno()){
    echo "Fallo en la conexion";
    exit();

}

mysqli_select_db($conexion, $db_nombre) or die ("No se encuentr la BBDD");

mysqli_set_charset($conexion, "utf8"); //para admitir caracteres latinos

$sql="UPDATE PRODUCTOS SET FOTO= '$nombre_imagen' WHERE CÓDIGOARTÍCULO='AR01'"; //ENTRE COMILLAS LA RUTA A LA IMAGEN

$resultados=mysqli_query($conexion, $sql);


?>