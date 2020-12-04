<?php

//Recibimos los datos de la imagen: nombre, tipo, tamaño

$nombre_imagen=$_FILES['imagen'] ['name'];

$tipo_imagen=$_FILES['imagen'] ['type'];

$tamagno_imagen=$_FILES['imagen'] ['size'];


//ruta de la carpeta destino en servidor
$carpeta_destino=$_SERVER['DOCUMENT_ROOT'] . '/intranet/uploads/';


//Mueve la imagen de carpeta temporal al carpeta permanente
move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$nombre_imagen);




?>