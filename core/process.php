<?php

$host_aceptado = array('localhost','127.0.0.1');
$metodo_aceptado = 'POST';
$usuario_correcto = 'Admin';
$password_correcto = 'Admin';
$txt_usuario = $_POST["txt_usuario"];
$txt_password = $_POST["txt_password"];
$token = "";

if (in_array($_SERVER["HTTP_HOST"],$host_aceptado) ){
//la direccion ip es aceptada
if ($_SERVER["REQUEST_METHOD"]== $metodo_aceptado) {
  //SE ACPETN EL METODO EL USUARIO
  if(isset($txt_password) && !empty($txt_password)) {
     if(isset($txt_password) && !empty($txt_password)) {

    if($txt_password==$usuario_correcto){
        //el valor ingrsd del cmpo usuario
        if($txt_password==$password_correcto){
            //pass correcto
            $ruta = "Welcome.php";
            $msg = "";
            $codigo_estado = 200;
            $texto_estado = "OK";
            list($usec,$sec) = explode('',microtime());
            $token = base64_encode(date("Y-m-d H:i:s",$sec).substr($usec,1));
        }else{
            $ruta = "Welcome.php";
            $msg = "pass equivocada ";
            $codigo_estado = 400;
            $texto_estado = "bad request";
            $token = "";
            //valor pass wrong
        }
    }else{
        $ruta = "";
            $msg = "usuario vacio ";
            $codigo_estado = 401;
            $texto_estado = "Unauthorized";
            $token = "";
        //valorusuario wrong
    }else{
        $ruta = "";
            $msg = "Contra vacia ";
            $codigo_estado = 405;
            $texto_estado = "method no allowed";
            $token = "";
        //pass vacio
    }
}else{
    //la dir IP no es aceptada
    $ruta = "Welcome.php";
            $msg = "su equipo no esta autorizado ";
            $codigo_estado = 403;
            $texto_estado = "Forbidden";
            $token = "";

}

$arreglo_respuesta = array(
    "status" =>( (intval($codigo_estado)== 200) ? "ok": "Error" ),
    "error" => ( (intval($codigo_estado)== 200) ? "": array("code"=>$codigo_estado, "message"=>$msg) ),
    "error" => array(
        "url"=>$ruta,
        "token"=>$token
    ),
    "count"=>1

);

header("HTTP/1.1 ".$codigo_estado." ".$texto_estado);
header("Content-type: Application/json");
echo($arreglo_respuesta);
