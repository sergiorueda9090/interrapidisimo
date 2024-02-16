<?php

class Conexion{

	static public function conectar(){

		/*$link = new PDO("mysql:host=localhost;dbname=sernetel_restaurante",
			            "sernetel",
			            "1917alejandraMauricio1290***maria");*/

		$link = new PDO("mysql:host=localhost;dbname=example_database","example_user","password");
		
		$link->exec("set names utf8");

		return $link;

	}

}
