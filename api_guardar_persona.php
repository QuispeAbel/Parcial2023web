<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
//header('Content-Type: application/json');
//esta api recibe datos por medio de GET o POST de manera plana (no json) y devuevle un html con la palabra guardo
extract($_REQUEST);
$apellido=mysqli_real_escape_string($conexion,$apellido);
$nombre=mysqli_real_escape_string($conexion,$nombre);
$celular=mysqli_real_escape_string($conexion,$celular);
$latitud=mysqli_real_escape_string($conexion,$latitud);
$longitud=mysqli_real_escape_string($conexion,$longitud);
$disponible=mysqli_real_escape_string($conexion,$disponible);
$longitud=mysqli_real_escape_string($conexion,$var_temp);
$var_temp =  mysqli_connect('localhost', 'root', 'adminadmin', 'cordenate');

{
	$instruccion="insert into personas (apellido,nombre,celular,latitud,longitud,disponible,var_temp)value('$apellido','$nombre','$celular','$latitud','$longitud','$disponible','')";
    $consulta=mysqli_query($conexion,$instruccion) or die ("no puede grabar, verifique envio de datos");
	printf("<p>Guardo</p>");
	mysqli_close($conexion);

}
?>