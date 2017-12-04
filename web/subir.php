<?php

    
session_start();

require_once 'vendor/autoload.php';
use Kunnu\Dropbox\DropboxFile;
use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;

$clienteId='n0st0nqytn97mx4';
$clienteSecret='333pltqbwu7gfiz';
$token='6i1WBS8gA2AAAAAAAAAALEFcvGGZeG6B50ViB8kCOFNLilXsMagE74j9KJ7s0y7b';


$app = new DropboxApp($clienteId, $clienteSecret, $token);
$exp=$_POST['expediente'];

$aux=0;

$dropbox = new Dropbox($app);

$folder = $dropbox->createFolder("/".$exp);


$total=$_POST['total'];
for ($i = 1; $i <= $total; $i++){
	
$archivo=$_FILES['archivo'.$i];
if($archivo!==""){
	$cargados=true;
	$aux=$aux+1;
	move_uploaded_file($archivo['tmp_name'],$archivo['name']);
	$fileStream = fopen($archivo['name'], DropboxFile::MODE_READ);
	$dropboxFile = DropboxFile::createByStream($archivo['name'], $fileStream);
	$file = $dropbox->upload($dropboxFile, "/".$exp."/".$archivo['name'], ['autorename' => true]);
	
}
}
if($cargados){
	$_SESSION["mensaje"]=$aux." Archivos Cargados";
}else{
	$_SESSION["mensaje"]="Error al subir los archivos";

}


header ("Location: index.php");

	
?>
