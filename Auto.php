<?php

class Auto
{
	private $Id;
	private $Marca;
	private $Modelo;
	private $Consumo;
	private $Emisiones;
	
	
	function setId($I)
	{
		$this->Id = $I;
	}
	
	function getId()
	{
		return $this->Id;
	}
	
	function setMarca($Ma)
	{
		$this->Marca = $Ma;
	}
	
	function getMarca()
	{
		return $this->Marca;
	}
	
	function setModelo($Mo)
	{
		$this->Modelo = $Mo;
	}
	
	function getModelo()
	{
		return $this->Modelo;
	}
	
	function setConsumo($C)
	{
		$this->Consumo = $C;
	} 
	
	function getConsumo()
	{
		return $this->Consumo;
	}
	
	function setEmisiones($E)
	{
		$this->Emisiones = $E;
	}
	
	function getEmisiones()
	{
		return $this->Emisiones;
	}
	
}

?>