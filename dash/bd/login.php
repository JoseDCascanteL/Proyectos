<?php
session_start();

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$contrasenia = (isset($_POST['contrasenia'])) ? $_POST['contrasenia'] : '';

$consulta = "SELECT * FROM usuario WHERE usuario='$usuario' AND contrasenia='$contrasenia' ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["s_usuario"] = $usuario;
}else{
    $_SESSION["s_usuario"] = null;
    $data=null;
}
echo ("putos");
print json_encode($data);
$conexion=null;


/*
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$raza = (isset($_POST['raza'])) ? $_POST['raza'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$codigo = (isset($_POST['codigo'])) ? $_POST['codigo'] : '';
$dueno_id = (isset($_POST['dueno_id'])) ? $_POST['dueno_id'] : '';

$consulta = "INSERT INTO animal (codigo, nombre, raza, tipo, dueno_id) VALUES('$codigo', '$nombre', '$raza', '$tipo', '$dueno_id') ";			
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 

$consulta = "SELECT codigo, nombre, raza, tipo FROM animal ORDER BY codigo DESC LIMIT 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
*/