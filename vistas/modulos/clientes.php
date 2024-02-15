<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar clientes

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar clientes</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarUsuario">

          Agregar clientes

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th>Cliente</th>
           <th>Telefono</th>
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
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["telefono"].'</td>
                  <td>'.$value["direccion"].'</td>';


          echo '<td>

                    <div class="btn-group">

                      <button class="btn btn-warning btnEditarClientes" idCliente="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarClientes" idCliente="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#4c6ef8; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar clientes</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nombreCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

            <div class="form-group">

             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-mobile"></i></span>

               <input type="text" class="form-control input-lg" name="telefonoCliente" placeholder="Ingresar Telefono" required>

             </div>

           </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

            <div class="form-group">

             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-home"></i></span>

               <textarea  type="text" rows="4" class="form-control" name="direccionCliente" placeholder="Ingresar Direccion" required></textarea>

             </div>

           </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Guardar clientes</button>

        </div>

        <?php

          $crearUsuario = new ClienteCtr();
          $crearUsuario -> ctrCrearCliente();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#4c6ef8; color:white">

          <button type="button" class="close salirEditarCliente" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg nombreClienteEditar" name="nombreClienteEditar" placeholder="Ingresar nombre" required>

              </div>

            </div>


            <!-- ENTRADA PARA EL USUARIO -->

            <div class="form-group">

             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-mobile"></i></span>

               <input type="text" class="form-control input-lg telefonoClienteEditar" name="telefonoClienteEditar" placeholder="Ingresar Telefono" required>
               <input type="hidden" class="form-control input-lg idClienteEditar" name="idClienteEditar">
             </div>

           </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

            <div class="form-group">

             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-home"></i></span>

               <textarea  type="text" rows="4" class="form-control direccionClienteEditar" name="direccionClienteEditar" placeholder="Ingresar Direccion" required></textarea>

             </div>

           </div>

          </div>
      </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left salirEditarCliente" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Modificar cliente</button>

        </div>

     <?php

          $editarCliente = new  ClienteCtr();
          $editarCliente -> ctrEditarCliente();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $borrarCliente = new ClienteCtr();
  $borrarCliente -> ctrBorrarCliente();

?>
