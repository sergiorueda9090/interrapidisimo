<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar domicilio

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar domicilio</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarDomicilio">

          AGREGAR DOMICILIO

        </button>

      </div>



      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablaDomici" width="100%">
         <?php

         $respuestaDatos = DomicilioCtr::ctrMostrarDomicilios();

           ?>

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Teléfono</th>
           <th>Dirección</th>
           <th>Usuario</th>
           <th>Estado</th>
           <th>Total</th>
           <th>Fecha</th>
           <th>Acciones</th>

         </tr>

        </thead>

        <tbody>

          <?php
          foreach ($respuestaDatos as $key => $value) {

            echo'<tr>

                    <th scope="row">'.($key+1).'</th>
                    <td>'.$value["nombre"].'</td>
                    <td>'.$value["telefono"].'</td>
                    <td>'.$value["direccion"].'</td>';
                    $nombreUsuario = DomicilioCtr::ctrMostrarNombre($value["idUsuario"]);
                    echo'<td>'.$nombreUsuario["nombre"].'</td>';
                    if($value["estado"] == 1){
                      echo'<td><button class="btn btn-xs btnEnvio btn-warning estadoDomicilio" idDomicilio="'.$value["id"].'">
                                   Enviando el producto
                          </button></td>';
                    }else{
                      echo'<td>
                             <button class="btn btn-success btn-xs btnActivar">
                                producto entregado
                             </button>
                          </td>';
                    }

                    echo'<td>'.number_format($value["total"]).'</td>
                    <td>'.$value["fecha"].'</td>
                    <td>
                      <div class="btn-group">
                           <button class="btn btn-info btnImprimirFactura" IdImprimirDomicilio="'.$value["id"].'">
                             <i class="fa fa-print"></i>
                           </button>
                           <button class="btn btn-warning btnEditarDomicilio" idEditarDomicilio="'.$value["id"].'" data-toggle="modal" data-target="#modalAgregarDomicilio">
                             <i class="fa fa-pencil"></i>
                           </button>
                           <button class="btn btn-danger btnEliminarDomicilio" IdEliminarDomicilio="'.$value["id"].'">
                             <i class="fa fa-trash-o" aria-hidden="true"></i>
                           </button>
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
MODAL AGREGAR PRODUCTO
======================================-->
<?php
  $item = null;
  $valor = null;
  $respuestaCategoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);
  $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
?>

<div id="modalAgregarDomicilio" data-backdrop="static" data-keyboard="false" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#28A745; color:white">

          <button type="button" class="close cerrarModalDomicilioX" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Domicilio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">

          <div class="box-body">


          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="inputEmail4">Teléfono Cliente</label>
              <input type="number" class="form-control telefonoCliente" id="telefonoCliente">
              <input type="hidden" class="form-control idPedido" id="idPedido">
            </div>

            <div class="form-group col-md-6">
              <label for="inputPassword4">Nombre Cliente</label>
              <input type="text" class="form-control nombreCliente" id="nombreCliente" required>
            </div>

            <div class="form-group col-md-6">
              <label for="inputPassword4">Dirección Cliente</label>
              <input type="text" class="form-control direccionCliente" id="direccionCliente">
            </div>


              <?php
                echo'<div class="form-group col-md-6">
                       <label for="inputState">Usuario</label>
                       <select class="form-control usuarioCliente" id="usuarioCliente" required>
                         <option value="0">Seleccionar...</option>';
                         foreach ($usuarios as $key => $value) {
                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                       }
                       echo'</select>

                     </div>';

              ?>

            <?php

            foreach ($respuestaCategoria as $key => $value) {

              $respuestaProducto = AsignarMesa::ctrMostrarProductosCategorias($value["id"]);

           echo'<div class="form-group col-md-4">
                  <label for="inputState">'.$value["categoria"].'</label>
                  <select class="form-control seleccionarPedidoDomi seleccionarPedidoDomi'.($key+1).'" seleccionarPedidoDomi="'.($key+1).'">
                    <option value="0">Seleccionar...</option>';
                    foreach ($respuestaProducto as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                     }
                  echo'</select>

                </div>';
          }


            ?>

            <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">PEDIDO</th>
      <th scope="col">IMG</th>
      <th scope="col">PRECIO</th>
      <th scope="col">CANTIDAD</th>
      <th scope="col">ACCIONES</th>
    </tr>
  </thead>
  <tbody id="tablaDomicilios">
  </tbody>
</table>
<div class="pull-right" style="padding:10px;">
        <span style="font-size:20px;"><strong>TOTAL</strong></span>
        <span style="font-size:20px;" id="totalDomicilio"></span>
    </div>

          </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left cerrarModalDomicilio" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success guardarDomicilio">Guardar domicilio</button>
          <button type="button" style="display:none;" class="btn btn-success editarDomicilio">Editar domicilio</button>

        </div>

      </form>

    </div>

  </div>

</div>



<!--=====================================
MODAL EDITAR DIMICILIO
======================================-->
<div id="modalEditarDomicilio" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#28A745; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Domicilio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">

          <div class="box-body">


          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="inputEmail4">Teléfono Cliente</label>
              <input type="number" class="form-control telefonoClienteEditar" id="telefonoClienteEditar">
            </div>

            <div class="form-group col-md-6">
              <label for="inputPassword4">Nombre Cliente</label>
              <input type="text" class="form-control nombreClienteEditar" id="nombreClienteEditar">
            </div>

            <div class="form-group col-md-6">
              <label for="inputPassword4">Dirección Cliente</label>
              <input type="text" class="form-control direccionClienteEditar" id="direccionClienteEditar">
            </div>


              <?php
                echo'<div class="form-group col-md-6">
                       <label for="inputState">Usuario</label>
                       <select class="form-control usuarioClienteEditar" id="usuarioClienteEditar">
                         <option value="0">Seleccionar...</option>';
                         foreach ($usuarios as $key => $value) {
                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                       }
                       echo'</select>

                     </div>';

              ?>

            <?php

            foreach ($respuestaCategoria as $key => $value) {

              $respuestaProducto = AsignarMesa::ctrMostrarProductosCategorias($value["id"]);

           echo'<div class="form-group col-md-4">
                  <label for="inputState">'.$value["categoria"].'</label>
                  <select class="form-control seleccionarPedidoDomiEditar seleccionarPedidoDomiEditar'.($key+1).'" seleccionarPedidoDomiEditar="'.($key+1).'">
                    <option value="0">Seleccionar...</option>';
                    foreach ($respuestaProducto as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                     }
                  echo'</select>

                </div>';
          }


            ?>

            <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">PEDIDO</th>
      <th scope="col">IMG</th>
      <th scope="col">PRECIO</th>
      <th scope="col">CANTIDAD</th>
      <th scope="col">ACCIONES</th>
    </tr>
  </thead>
  <tbody id="tablaDomiciliosEditar">

  </tbody>
</table>
<div class="pull-right" style="padding:10px;">
        <span style="font-size:20px;"><strong>TOTAL</strong></span>
        <span style="font-size:20px;" id="totalDomicilioEditar"></span>
    </div>

          </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success editarDomicilio">Editar domicilio</button>

        </div>

      </form>

    </div>

  </div>

</div>

<?php
$eliminar = new DomicilioCtr();
$eliminar -> ctrEliminarDomicilio();
?>
