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
require_once('include/CarritoReserva.php');


// Recuperamos la información de la sesión
session_start();

// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['usuario'])) 
    die("Error en el catálogo- debe <a href='login.php'>identificarse</a>.<br />");

// Recuperamos la cesta de la compra
$cesta = CarritoReserva::carga_cesta();

// Comprobamos si se ha enviado el formulario de vaciar la cesta
if (isset($_POST['vaciar'])) {
    unset($_SESSION['cesta']);
    $cesta = new CarritoReserva();
}

// Comprobamos si se quiere añadir un producto a la cesta
if (isset($_POST['enviar'])) {
    $cesta->nuevo_articulo($_POST['cod']);
    $cesta->guarda_cesta();
}

function creaFormularioProductos()
{
    try {
        $productos = DB::obtieneProductos();
        foreach ($productos as $p) {

            echo "<span class='fila'><form id='" . $p->getcodigo() . "' action='productos.php' method='post'>";
            // Metemos ocultos los datos de los productos
            echo "<input type='hidden' name='cod' value='" . $p->getcodigo() . "'/>";
            echo "<span><input type='submit' class='boton' name='enviar' value='Añadir'/></span>";
            echo "<span class='nombre'>". $p->getnombrecorto() . "</span>";
            // echo "<span class='precio'>". $p->getPVP() . " </span>";
			echo "<span class='precio'>".  " 1 </span>";
			
            echo "</form>";
            if ($p instanceof Ordenador) {
              echo "<form action='fichafondo.php' method='post'>";
            //  echo "<img class= 'imagenpc' src='pc.png' alt='pc'>";
              echo "<input type='hidden' name='cod' value='" . $p->getcodigo() . "'/>";
              echo "<span><input type='submit' class='boton' name='ficha' value='Ver ficha'/></span></form>";
            }
            echo "</span>";
        }
    } catch (Exception $e) {
        echo "<span class='error'>Error en catálogo al acceder a la base de datos</span>";
    }      
}

function muestraCestaCompra($cesta) {
    try {
        echo "<h3><img src='cesta.png' alt='Cesta' width='24' height='21'> Cesta</h3>";
        echo "<hr class='divisor' />";
        $cesta->muestra();
        echo "<form id='vaciar' action='productos.php' method='post'>";
        echo "<span><input type='submit' class='boton' name='vaciar' value='Vaciar Cesta' "; 
        if ($cesta->vacia()) echo "disabled='true'";
        echo "/></span></form>";
        echo "<span><form id='comprar' action='carrito.php' method='post'>";
        echo "<input type='submit' class='boton' name='comprar' value='Reservar' ";
        if ($cesta->vacia()) echo "disabled='true'";
        echo "/></span></form>";
    } catch (Exception $e) {
        echo "<span class='error'>Error al acceder a la base de datos</span>";
    } 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tarea 5 Parte 1 -->
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title> Listado de Productos</title>
  <link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
  <div id="barra_navegacion">
    <form action='logoff.php' method='post'>
        <input class='boton' type='submit' name='desconectar' value='Desconectar lector nº: <?php echo $_SESSION['usuario']; ?>'/>
    </form>        
  </div>
  <div id="contenedor">
      <div id="encabezado"><h1>Catálogo en línea</h1></div>
    <div id="cesta">
  <?php muestraCestaCompra($cesta); ?>
    </div>
    <div id="productos">
  <?php creaFormularioProductos(); ?>
    </div>
  </div>
</body>
</html>
