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
require_once('DB.php');

class CarritoReserva {
    protected $productos = array();
    
    // Introduce un nuevo item en el carrito de la reserva
    public function nuevo_articulo($codigo) {
        $producto = DB::obtieneProducto($codigo);
        $this->productos[] = $producto;
    }
    
    // Obtiene los artículos en el carrito
    public function get_productos() { return $this->productos; }
    
    // Obtiene el coste total de los artículos en la cesta
    public function get_coste() {
        $coste = 0;
        foreach($this->productos as $p) $coste += $p->getPVP();
        return $coste;
    }
    
    // Devuelve true si el carrito está vacío
    public function vacia() {
        if(count($this->productos) == 0) return true;
        return false;
    }
    
    // Guarda el carrito de la reserva en la sesión del usuario
    public function guarda_cesta() { $_SESSION['cesta'] = $this; }
    
    // Recupera el carrito de la reserva almacenada en la sesión del usuario
    public static function carga_cesta() {
        if (!isset($_SESSION['cesta'])) return new CarritoReserva();
        else return ($_SESSION['cesta']);
    }
    
    // Muestra el HTML de la cesta de la compra, con todos los productos
    public function muestra() {
       // Si la cesta está vacía, mostramos un mensaje
       if (count($this->productos)==0)  print "<p>Carrito vacío</p>";
       //  y si no está vacío, mostramos su contenido
       else foreach ($this->productos as $producto) $producto->muestra();
    }
}

?>
