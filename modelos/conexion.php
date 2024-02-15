<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=sernetel_restaurante",
			            "sernetel",
			            "1917alejandraMauricio1290***maria");

		$link->exec("set names utf8");

		return $link;

	}

}
