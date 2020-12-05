<?php

//Recibimos los datos de la imagen: nombre, tipo, tamaño, del index name=arvhico

$nombre_archivo=$_FILES['archivo'] ['name'];

$tipo_archivo=$_FILES['archivo'] ['type'];

$tamagno_archivo=$_FILES['archivo'] ['size'];

//echo $tipo_imagen;

if($tamagno_archivo<=1000000) { //1millon de bytes

//ruta de la carpeta destino en servidor
$carpeta_destino=$_SERVER['DOCUMENT_ROOT'] . '/intranet/uploads/';


//Mueve la imagen de carpeta temporal al carpeta permanente
move_uploaded_file($_FILES['archivo']['tmp_name'], $carpeta_destino.$nombre_archivo);

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

//fopen abre un grupo de datos para poder adjuntar un archivo y luego leerlo
$archivo_objetivo=fopen($carpeta_destino . $nombre_archivo, "r"); //convierte a bytes para su lectura

//sucesion de bytes que forman el archivo contenido en el index
$contenido=fread($archivo_objetivo, $tamagno_archivo);

//addslashes sirve para que php lea caracteres especiales y les pase literalmente como los /
$contenido=addslashes($contenido);

//hay que cerrar el grupo de datos con siguiente funcion:
fclose($archivo_objetivo);

$sql="INSERT INTO ARCHIVOS (ID, NOMBRE, TIPO, CONTENIDO) VALUES (0, '$nombre_archivo', '$tipo_archivo', '$contenido')"; //variable contenido esta dato tipo BLOB

$resultados=mysqli_query($conexion, $sql);


if (mysqli_affected_rows($conexion)>0) {
    echo "Se ha insertado el registro con exito";

    }
    else {
        echo "No se ha podido insertar el registro ";
    }




?>