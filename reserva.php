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
    // Recuperamos la información de la sesión
    session_start();

    if (!isset($_SESSION['usuario'])) 
    	die("Error - debe <a href='login.php'>identificarse</a>.<br />");
    else
    	unset($_SESSION['cesta']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title> Confirmar reservas</title>
  <link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="barra_navegacion">
  <form action='productos.php' method='post'>
      <input class='boton' type='submit' name='volver' value='Volver'/>
  </form> 
  <form action='logoff.php' method='post'>
      <input class='boton' type='submit' name='desconectar' value='Desconectar usuario <?php echo $_SESSION['usuario']; ?>'/>
  </form>        
</div>
<div id="contenedor">
<p>Gracias por su reserva.</p>
</div>
</div>
</body>
</html>