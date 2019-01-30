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
require_once('Fondo.php');

class DB { 

    // estos son los datos de la base de datos especificos
    private static $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    private static $dsn = "mysql:host=localhost;dbname=ebibliobd";
    private static $usuario = 'root';
    private static $contrasena = '';

    // metodo que devuelve el resultado de ejecutar una consulta (SELECT) sobre la base de datos
    protected static function ejecutaConsulta($sql) {
        
        $conexion = new PDO(self::$dsn, self::$usuario, self::$contrasena, self::$opc);
        $resultado = null;
        if (isset($conexion)) {
            $resultado = $conexion->query($sql);
            // cerramos conexion
            $conexion = null;
        }
        return $resultado;

    }

    // metodo que ejecuta una sentencia SQL y devuelve true si ha modificado la base de datos
    protected static function ejecutaSentencia($sql) {
        
        $filas_afectadas = 0;
        $conexion = new PDO(self::$dsn, self::$usuario, self::$contrasena, self::$opc);
        if (isset($conexion)) {
            $filas_afectadas = $conexion->exec($sql);
            // cerramos conexion
            $conexion = null;
        }
        return ($filas_afectadas > 0);

    }

    // funcion que devuelve un array con los datos especificos de un fondo, dado un
    // determinado código, si el mismo esta vacio no existe ningun fondo con ese codigo
    public static function obtieneOrdenador($cod) {

        $sql = "SELECT procesador, RAM, disco, grafica, unidadoptica, SO, otros from ORDENADOR";
        $sql .= " WHERE cod='" . $cod . "'";
        $resultado = self::ejecutaConsulta($sql);
        $row = $resultado->fetch();
        return $row;

    }

    // metodo que devuelve un array con todos los productos en la base de datos
    public static function obtieneProductos() {
        $sql = "SELECT cod, nombre_corto, nombre, PVP FROM producto;";
        $resultado = self::ejecutaConsulta($sql);
        $productos = array();

    	if($resultado) {
                // Añadimos un elemento por cada producto obtenido
                $row = $resultado->fetch();
                while ($row != null) {

                    //  consulta si existe un fondo en la tabla correspondiente
                    $row_ordenador = self::obtieneOrdenador($row['cod']);

                    // si no está en la tabla, se crea un producto básico
                    if (empty($row_ordenador)) 
                        $productos[] = new Producto($row);
                    else 
                        // si es un fondo, se almacena como tal ya que por el polimorfismo
                        // inherente a la herencia, un fondo ES un producto 
                        $productos[] = new Ordenador($row + $row_ordenador);
                    $row = $resultado->fetch();
                }
    	}
        return $productos;
    }

    // metodo que devuelve un determinado producto identificado con el código especificado almacenado
    // en la base de datos, o null si no existiese  
    public static function obtieneProducto($codigo) {
        $sql = "SELECT cod, nombre_corto, nombre, PVP FROM producto";
        $sql .= " WHERE cod='" . $codigo . "'";
        $resultado = self::ejecutaConsulta($sql);
        $producto = null;

    	if(isset($resultado)) {
            
            $row = $resultado->fetch();

            //  consulta si existe un fondo en la tabla correspondiente
            $row_ordenador = self::obtieneOrdenador($row['cod']);

            // si no está en la tabla, se crea un producto básico
            if (empty($row_ordenador)) 
                $producto = new Producto($row);
            else 
                // si es un fondo, se almacena como tal
                $producto = new Ordenador($row + $row_ordenador);            
    	}
        
        return $producto;    
    }
    
    // metodo que devuelve true si y solo si las credenciales existen en la tabla de usuarios 
    // de la base de datos
    public static function verificaCliente($nombre, $contrasena) {
        $sql = "SELECT usuario FROM usuarios ";
        $sql .= "WHERE usuario='$nombre' ";
        $sql .= "AND contrasena='" . md5($contrasena) . "';";
        $resultado = self::ejecutaConsulta($sql);
        $verificado = false;

        if(isset($resultado)) {
            $fila = $resultado->fetch();
            if($fila !== false) $verificado=true;
        }
        return $verificado;
    }

    // metodo para dar de alta un nuevo usuario y devuelve true si ésta se ha realizado con éxito
    public static function altaCliente($nombre, $contrasena) {

        $insercion = "INSERT INTO usuarios (usuario,contrasena) ";
        $insercion .= "VALUES ('" . $nombre . "', '" . md5($contrasena) . "');";

        return self::ejecutaSentencia($insercion);
    
    }  
    
}

?>
