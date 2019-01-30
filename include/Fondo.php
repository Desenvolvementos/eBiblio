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

require_once('Producto.php');
/*
    La clase Fondo es un tipo de Catálogo, clase a la que
    extiende aÃ±adiendo una serie de atributos especificos y los
    correspondientes metodos de acceso a ellos
*/
class Ordenador extends Producto {
    
    protected $procesador;
    protected $RAM;
    protected $disco;
    protected $grafica;
    protected $unidadoptica;
    protected $SO;
    protected $otros;
    
    public function __construct($row) {

        parent::__construct($row);
        $this->procesador = $row['procesador'];
        $this->RAM = $row['RAM'];
        $this->disco = $row['disco'];
        $this->grafica = $row['grafica'];
        $this->SO = $row['SO'];
        $this->unidadoptica = $row['unidadoptica'];
        $this->otros = $row['otros'];

    }

    public function getprocesador() {return $this->procesador; }
    public function getRAM() {return $this->RAM; }
    public function getdisco() {return $this->disco; }
    public function getgrafica() {return $this->grafica; }
    public function getunidadoptica() {return $this->unidadoptica; }
    public function getSO() {return $this->SO; }
    public function getotros() {return $this->otros; }
}

?>