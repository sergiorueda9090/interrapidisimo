<?php

require_once "conexion.php";

class mdlTelegram{

    static public function mdlListTelegram($table, $id){
        
        if($id != null){
    
                $stmt = Conexion::conectar()->prepare("SELECT $table.*, clientes.nombre, clientes.telefono1, clientes.telefono2, clientes.direccion, 
                                                usuarios.nombre as nombreDomiciliario FROM $table 
                                                INNER JOIN clientes ON $table.idCustomer = clientes.id
                                                INNER JOIN usuarios ON $table.idDomiciliary = usuarios.id WHERE $table.id = :id");
    
                $stmt -> bindParam(":id", $id, PDO::PARAM_STR);
    
                $stmt -> execute();
    
                return $stmt -> fetch();
    
            }else{
    
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $table");
    
                $stmt -> execute();
    
                return $stmt -> fetchAll();
    
            }
    
    
            $stmt -> close();
    
            $stmt = null;
    }

    static public function mdlUpdateTelegram($table, $username, $idTelegram){
		
        $stmt = Conexion::conectar()->prepare("UPDATE $table SET username = :username WHERE id = :id");

		$stmt -> bindParam(":username", $username,   PDO::PARAM_STR);
		$stmt -> bindParam(":id",       $idTelegram, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;
    
    }

    static public function mdlBorrarTelegram($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;


	}

}