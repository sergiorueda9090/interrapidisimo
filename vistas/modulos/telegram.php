


<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Telegram 
  
    </h1>

    <h3>
      <?php /*
        require "botinfo.php";
  #7022150351:AAGhcgNl6YY2CAupmhyXUw4cGcnUSPJk0Vg
      #repidisimo_bot
        */
      ?>
    </h3>
    

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th>chat_id</th>
           <th>first_name</th>
           <th>last_name</th>
           <th>fecha</th>
           <th>Acciones</th>

         </tr>

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $telegram = ctrTelegram::ctrListTelegram();

       foreach ($telegram as $key => $value){

          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["chat_id"].'</td>
                  <td>'.$value["first_name"].'</td>
                  <td>'.$value["last_name"].'</td>
                  <td>'.$value["fecha"].'</td>';


          echo '<td>

                    <div class="btn-group">

                      <button class="btn btn-warning btnEditarTelegram" idTelegram="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarTelegram"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarTelegram" idTelegram="'.$value["id"].'"><i class="fa fa-times"></i></button>

                    </div>

                  </td>

                </tr>';
        }


        ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!-- Modal -->
<div class="modal fade" id="modalEditarTelegram" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
        <div class="form-group">
          <label for="exampleFormControlInput1">Chat ID: 11111111</label>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Nombre: Sergio rueda</label>
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Seleccionar Mensajero</label>
          <select class="form-control selectMensajero" id="selectMensajero">
            <option value="">Seleccionar Mensajero</option>
            <?php
              $domiciliarys = DeliveryCTR::crtListDomiciliary(); 
              foreach($domiciliarys as $key => $values){
                echo '<option  value="'.$values['id'].'">'.$values['nombre'].' '.$values['telefono'].'</option>';
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <input class="idTelegramUpdate" id="idTelegramUpdate"/>
        </div>
      </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btnSelectMensajero">Editar</button>
      </div>
    </div>
  </div>
</div>

<?php
  $borrarTelegram = new ctrTelegram();
  $borrarTelegram -> ctrBorrarTelegram();
?>

<script src="vistas/js/telegram.js"></script>