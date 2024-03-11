<?php

class ctrTelegram{

    static public function ctrListTelegram(){

        $respuesta = mdlTelegram::mdlListTelegram($table="telegram", $id=null);

        return $respuesta;

    }

    static public function ctrUpdateTelegram($username=null, $idTelegram=null){
        
        $respuesta = mdlTelegram::mdlUpdateTelegram($table="telegram", $username, $idTelegram);

        return $respuesta;

    }

    static public function ctrBorrarTelegram(){

		if(isset($_GET["idTelegram"])){

			$respuesta = mdlTelegram::mdlBorrarTelegram($table="telegram", $_GET["idTelegram"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Telegram ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "telegram";

								}
							})

				</script>';

			}

		}

	}

}