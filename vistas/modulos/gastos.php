<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Gastos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Gastos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarGasto">

          Agregar Gasto

        </button>

      </div>

      <div class="box-body">

        <?php
        $item = null;
        $valor = null;
        $respuesta = ControladorGasto::ctrMostrarGasto($item,$valor);

        ?>

       <table class="table table-bordered table-striped dt-responsive tablas">

        <thead>

         <tr>
           <th style="width:10px">#</th>
           <th>Nombre Gasto</th>
           <th>Total</th>
           <th>Fecha</th>
           <th>Acciones</th>
         </tr>

        </thead>

        <tbody>

          <?php
          foreach ($respuesta as $key => $value) {
              echo '<tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["nombreGasto"].'</td>
                  <td>'.number_format($value["valorGasto"]).'</td>
                  <td>'.$value["fechaGasto"].'</td>
                  <td>
                    <div class="btn-group">
                        <button class="btn btn-warning btnEditarGasto" data-toggle="modal" data-target="#modalEditarGasto" idGasto="'.$value["idGastos"].'"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btnEliminarGasto" idGasto="'.$value["idGastos"].'"><i class="fa fa-times"></i></button>
                    </div>
                  </td>
                </tr>';
          };
          ?>
        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR GASTO
======================================-->

<div id="modalAgregarGasto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h5 class="modal-title" id="exampleModalLabel" style="font-size:30px;font-family:'Open Sans';text-align:center;">AGREGAR GASTO</h5>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
              <label for="exampleFormControlTextarea1" style="font-size:20px;font-family:'Open Sans';">Descripcion del gasto</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-shopping-basket"></i></span>
                <textarea class="form-control nombreGasto" name="nombreGasto" id="exampleFormControlTextarea1" rows="3" style="font-size:18px;font-family:'Open Sans';"></textarea>
              </div>

            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1" style="font-size:20px;font-family:'Open Sans';">Valor del gasto</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                <input type="text" class="form-control input-lg valorGasto" name="valorGasto" placeholder="Ingresar valor" style="font-size:18px;font-family:'Open Sans';">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1" style="font-size:20px;font-family:'Open Sans';">Fecha del gasto</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
                <input type="date" class="form-control input-lg fechaGasto" name="fechaGasto" style="font-size:18px;font-family:'Open Sans';">
              </div>
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="font-size:20px;font-family:'Open Sans';">Salir</button>

          <button type="submit" class="btn btn-success" style="font-size:20px;font-family:'Open Sans';">Guardar gasto</button>

        </div>

      </form>

      <?php

        $agregarGasto = new ControladorGasto();
        $agregarGasto -> ctrCrearGasto();

      ?>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR GASTO
======================================-->

<div id="modalEditarGasto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h5 class="modal-title" id="exampleModalLabel" style="font-size:30px;font-family:'Open Sans';text-align:center;">EDITAR GASTO</h5>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
              <label for="exampleFormControlTextarea1" style="font-size:20px;font-family:'Open Sans';" >Descripcion del gasto</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-shopping-basket"></i></span>
                <textarea class="form-control nombreEditarGasto" name="nombreEditarGasto" rows="3" style="font-size:18px;font-family:'Open Sans';"></textarea>
              </div>

            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1" style="font-size:20px;font-family:'Open Sans';" >Valor del gasto</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                <input type="text" class="form-control input-lg valorEditarGasto" name="valorEditarGasto" placeholder="Ingresar valor" style="font-size:18px;font-family:'Open Sans';">
                <input type="hidden" class="form-control input-lg idEditarGasto" name="idEditarGasto" placeholder="Ingresar valor">
              </div>

            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1" style="font-size:20px;font-family:'Open Sans';" >Fecha del gasto</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-check-o "></i></span>
                <input type="date" class="form-control input-lg fechaEditarGasto" name="fechaEditarGasto" style="font-size:18px;font-family:'Open Sans';">
              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="font-size:20px;font-family:'Open Sans';">Salir</button>

          <button type="submit" class="btn btn-success" style="font-size:20px;font-family:'Open Sans';">Editar gasto</button>

        </div>

      </form>

      <?php

      $editarGasto = new ControladorGasto();
      $editarGasto -> ctrEditarGasto();

      ?>


    </div>

  </div>

</div>

<?php

  $eliminarGasto = new ControladorGasto();
  $eliminarGasto -> ctrEliminarGasto();

?>
