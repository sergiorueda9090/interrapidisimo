<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Zona

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Zona</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarMesa">

          Agregar Zona

        </button>

      </div>

      <?php
          $item = null;
          $valor = null;
          $respuesta = ControladorMesa::ctrMostrarMesas($item,$valor);

       ?>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas">
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Zona</th>
           <th>Acciones</th>
         </tr>
        </thead>

        <tbody>

          <?php

          foreach ($respuesta as $key => $value) {
              echo '<tr>
                      <td>'.($key+1).'</td>
                      <td>'.$value["nombre"].'</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning btnEditarMesa" data-toggle="modal" data-target="#modalEditarMesa" idMesa='.$value["id"].'><i class="fa fa-pencil"></i></button>
                          <button class="btn btn-danger btnEliminarMesa" idMesa='.$value["id"].'><i class="fa fa-times"></i></button>
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

<!--=====================================
MODAL AGREGAR Mesa
======================================-->

<div id="modalAgregarMesa" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#008D4C; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Zona</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaMesa" placeholder="Ingresar Zona" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Guardar Zona</button>

        </div>

      </form>

      <?php

      $guardar = new ControladorMesa();
      $guardar -> ctrCrearMesa();

      ?>

    </div>

  </div>

</div>



<!--=====================================
MODAL EDITAR MESA
======================================-->

<div id="modalEditarMesa" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#008D4C; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Mesa</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg editarMesa" name="editarMesa"  required>
                <input type="text" name="idMesa" class="idMesa">
              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Editar Mesa</button>

        </div>

      </form>

      <?php

      $editar = new ControladorMesa();
      $editar -> ctrEditarMesa();


      ?>

    </div>

  </div>

</div>


<?php
  $borrar = new ControladorMesa();
  $borrar -> ctrBorrarMesa();
?>
