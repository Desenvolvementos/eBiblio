<?php
    //+eBiblio
	//=========

	//The Class InterventionServiceImpl. 
	//Copyright (C) 2019 Noemí Pérez Rodríguez - Universidad Internacional de la Rioja

	//This program is free software: you can redistribute it and/or modify it under
	//the terms of the GNU Affero General Public License as published by the Free
	//Software Foundation, either version 3 of the License, or (at your option) any
	//later version.
	//This program is distributed in the hope that it will be useful, but WITHOUT
	//ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
	//FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
	//details.

	//You should have received a copy of the GNU Affero General Public License
	//along with this program. If not, see <https://www.gnu.org/licenses/>
    //
require_once('include/DB.php');

// Recuperamos la información de la sesión
session_start();

// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['usuario'])) 
    die("Error - debe <a href='login.php'>identificarse</a>.<br />");

// Se accede a la BD para cargar el fondo indicado
if (!isset($_POST['cod'])) 
	die("Acceso incorrecto - debe <a href='login.php'>identificarse</a>.<br />");
else 
	$pc = DB::obtieneProducto($_POST['cod']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tarea 5 Parte 1 -->
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Detalles de</title>
  <link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="barra_navegacion">
<form action='productos.php' method='post'>
    <input class='boton' type='submit' name='volver' value='Volver'/>
</form>        
</div>
<div id="contenedor">
  <div id="encabezado">
    <h1>Item código '<?php echo $pc->getcodigo(); ?>'</h1>
  </div>
  <div>
  <span class="fila"><span class="nombre">Título:</span><span><?php echo $pc->getnombre(); ?></span></span>
  <span class="fila"><span class="nombre">Descripción corta:</span><span><?php echo $pc->getnombrecorto(); ?></span></span>
  <span class="fila"><span class="nombre">Unidades:</span><span class="precio"> 1 </span></span>
  <span class="fila"><span class="nombre">Autor:</span><span><?php echo $pc->getprocesador(); ?></span></span>
  <span class="fila"><span class="nombre">Año publicación:</span><span><?php echo $pc->getRAM(); ?></span></span>
  <span class="fila"><span class="nombre">Editorial:</span><span><?php echo $pc->getdisco(); ?></span></span>
  <span class="fila"><span class="nombre">Edición:</span><span><?php echo $pc->getgrafica(); ?></span></span>
  <span class="fila"><span class="nombre">ISBN:</span><span><?php echo $pc->getSO(); ?></span></span>  
  <span class="fila"><span class="nombre">Tipo material:</span><span><?php echo $pc->getunidadoptica(); ?></span></span>
  <span class="fila"><span class="nombre">Otros:</span><span><?php echo $pc->getotros(); ?></span></span>
  </div>
</div>
</body>