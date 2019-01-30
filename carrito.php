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
require_once('include/CarritoReserva.php');

// Se recupera la información de la sesión
session_start();

// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['usuario'])) 
    die("Error - debe <a href='login.php'>identificarse</a>.<br />");

// Se recupera el carrito de la reserva
$cesta = CarritoReserva::carga_cesta();

function listaProductos($productos)
{
    $coste = 0;
    foreach ($productos as $p) {
        echo "<span class='fila'><span class='codigo'>" . $p->getcodigo() . "</span>";
        echo "<span class='nombre'>" . $p->getnombrecorto() . "</span>";
        echo "<span class='precio'>" . $p->getPVP() . "</span></span>";
        $coste += $p->getPVP();
    }        
    echo "<hr class='divisor' />";
    echo "<span class='fila'><span class='precio'>Número de reservas: " . $coste . " </span></span>";
    echo "<form action='reserva.php' method='post'>";
    echo "<p><span class='pagar'>";
    echo "<input class='boton' type='submit' name='pagar' value='Reservar'/>";
    echo "</span></p></form>";                 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title> Carrito de reservas</title>
  <link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="barra_navegacion">
  <form action='productos.php' method='post'>
      <input class='boton' type='submit' name='volver' value='Volver'/>
  </form> 
  <form action='logoff.php' method='post'>
      <input class='boton' type='submit' name='desconectar' value='Salir de eBiblio <?php echo $_SESSION['usuario']; ?>'/>
  </form>        
</div>
<div id="contenedor">
  <div id="encabezado">
    <h1>Carrito de reservas</h1>
  </div>
  <div id="productos">
<?php listaProductos($cesta->get_productos()); ?>
  </div>
</div>
</body>
</html>
