<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Telegram

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Telegram</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-new-primary" data-toggle="modal" data-target="#modalAgregarUsuario">

          Agregar Telegram

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th>Cliente</th>
           <th>Nombre</th>
           <th>Telefono 1</th>
           <th>Telefono 2</th>
           <th>Direccion</th>
           <th>Acciones</th>

         </tr>

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $usuarios = ClienteCtr::ctrMostrarClientes($item, $valor);

       foreach ($usuarios as $key => $value){

          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["cliente"].'</td>
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["telefono1"].'</td>
                  <td>'.$value["telefono2"].'</td>
                  <td>'.$value["direccion"].'</td>';


          echo '<td>

                    <div class="btn-group">

                      <button class="btn btn-warning btnEditarClientes" idCliente="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCliente"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarClientes" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>

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




<?php

  $borrarCliente = new ClienteCtr();
  $borrarCliente -> ctrBorrarCliente();

?>
<script src="vistas/js/telegram.js"></script>