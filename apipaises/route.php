<?php
/*
http://localhost/educacion/unlpam/pow/2023/apipaises/route.php?option=list_paises&limit=10&order=nombre&order_dir=desc
http://localhost/educacion/unlpam/pow/2023/apipaises/route.php?option=list_provincias&idPais=1&limit=10&order=nombre&order_dir=desc
http://localhost/educacion/unlpam/pow/2023/apipaises/route.php?option=list_localidades&idProvincia=1&limit=10&order=nombre&order_dir=desc
*/
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json;charset=utf-8'); 
include('api.php');

$api = new Api();

$option = $_GET['option'];

if($option=='list_paises')
{
    $data = $api->list_paises($_GET['limit'],$_GET['order'],$_GET['order_dir']);
}

if($option=='list_provincias')
{
    $data = $api->list_provincias($_GET['limit'],$_GET['order'],$_GET['order_dir'],$_GET['idPais']);
}

if($option=='list_localidades')
{
    $data = $api->list_localidades($_GET['limit'],$_GET['order'],$_GET['order_dir'],$_GET['idProvincia']);
}

//echo 'hola soy la api de tortas'; 
echo json_encode($data);
?>