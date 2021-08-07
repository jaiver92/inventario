<?php

include_once('clsCatalogos.php');

if(count($_POST) > 0 && isset($_POST["accion"]))
{
    $request = (object)$_POST;
    $request->parametros = (object)$request->parametros;
}
else 
{
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
}

$result = array();
$result["data"] = array();
$result["error"] = "";
$operationResult = "";

switch($request->modelo)
{
    case "catalogos":
        $operationResult = clsCatalogos::EjecutarOperacion($request->operacion, $request->parametros); break;
}

if(is_array($operationResult))
{
    $result["data"] = $operationResult;
}
else
{
    $result["error"] = $operationResult;
}

echo json_encode($result, JSON_NUMERIC_CHECK);

?>