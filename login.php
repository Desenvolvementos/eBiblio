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

// Comprobamos si ya se ha enviado el formulario
if (isset($_POST['enviar'])) {

    if (empty($_POST['usuario']) || empty($_POST['password'])) 
        $error = "Debe introducir un nombre de usuario y una contraseña";
    else {
        try {

            // se comprueba si se ha marcado la casilla de alta
            if (isset($_POST['alta'])) {
                // Se da de alta el usuario en el sistema
                if (DB::altaCliente($_POST['usuario'], $_POST['password']))
                    $error = "Nuevo usuario creado correctamente";
                else $error = "No se ha podido realizar el alta";

            } else {
                // Ha habido un intento de login
                // comprobamos las credenciales con la base de datos
                if (DB::verificaCliente($_POST['usuario'], $_POST['password'])) {
                    session_start();
                    $_SESSION['usuario']=$_POST['usuario'];
					// Vuelve a la cabecera.
                    header("Location: productos.php");                    
                }
                else $error = "Error. Usuario o contraseña no válidos";
            } 

        } catch (Exception $e) {
            $error = "Error en el acceso a la base de datos";
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>::eBiblio::Autenticación</title>
  <link href="estilo.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id='login'>
    <form action='login.php' method='post'>
        <div class='campo'>
            <label for='usuario' >Nº de lector:</label>
            <input class='entrada' type='text' name='usuario' id='usuario' maxlength="50" />
        </div>
        <div class='campo'>
            <label for='password' >Contraseña:</label>
            <input class='entrada' type='password' name='password' id='password' maxlength="50" />
        </div>
        <div class='campo'>
            <center><input class='boton' type='submit' name='enviar' value='Enviar' /></center>
        </div>

        <div class='campo'>
            <input type='checkbox' name='alta' value='Alta' /><span class='nota'>Crear cuenta en eBiblio</span></input>
        </div>
        <div class='error'><?php if (isset($error)) echo $error; ?></div>
    </form>
    </div>
</body>
</html>
