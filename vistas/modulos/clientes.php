<style>
  .userContainer{
    display:none;
  }

  .userContainerEditar{
    display:none;
  }

  .btnAddUserClienteEditar{
    display:none;
  }

  .btnAddUserEditar{
    display:none;
  }
</style>
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

        <button class="btn btn-new-primary" data-toggle="modal" data-target="#modalAgregarUsuario">

          Agregar clientes

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

<!--=====================================
MODAL AGREGAR CLIENTE
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

            <div class="row">

              <!-- ENTRADA PARA EL CLIENTE -->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control input-lg" name="cliente" placeholder="Cliente" required>
                  </div>
                </div>
              </div>

               <!-- ENTRADA PARA EL NOMBRE -->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control input-lg" name="nombreCliente" placeholder="Ingresar nombre" required>
                  </div>
                </div>
              </div>

              <!-- ENTRADA PARA EL TELEFONO 1-->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                    <input type="text" class="form-control input-lg" name="telefonoCliente1" placeholder="Ingresar Telefono 1" required>
                  </div>
                </div>
              </div>

              <!-- ENTRADA PARA EL TELEFONO 2-->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                    <input type="text" class="form-control input-lg" name="telefonoCliente2" placeholder="Ingresar Telefono 2" >
                  </div>
                </div>
              </div>

              <!-- ENTRADA CREDITO O CONTADO-->
              <div class="col-lg-12">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control input-lg" name="tipo">
                      <option value="">TIPO</option>
                      <option value="CREDITO">CREDITO</option>
                      <option value="CONTADO">CONTADO</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- ENTRADA PARA LA DIREECION-->
              <div class="col-lg-12">            
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <textarea  type="text" rows="4" class="form-control" name="direccionCliente" placeholder="Ingresar Direccion" required></textarea>
                  </div>
                </div>
              </div>

            </div>
            <!--=====================================
              START USERS
            ======================================-->
            <div class="row mb-3">
                <div class="col-lg-12">
                  <button type="button" class="btn btn-new-primary btnShowUser">Agregar Usuario</button> 
                </div>
            </div>
            <div class="userContainer">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" class="form-control nombreUsuarioCliente" name="nombreUsuarioCliente" id="nombreUsuarioCliente" require>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Telefono 1</label>
                      <input type="text" class="form-control telefono1UsuarioCliente" name="telefono1UsuarioCliente" id="telefono1UsuarioCliente" require>
                    </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Telefono 2</label>
                        <input type="text" class="form-control telefono2UsuarioCliente" name="telefono2UsuarioCliente" id="telefono2UsuarioCliente" require>
                      </div>
                  </div>

                  <div class="col-lg-6">
                      <div class="form-group">
                          <label for="exampleFormControlTextarea1">Direccion</label>
                          <textarea class="form-control direccionUsuarioCliente" name="direccionUsuarioCliente" id="direccionUsuarioCliente" rows="3"></textarea>
                      </div>
                  </div>

  
                    <input type="hidden" class="form-control infoUsuarioCliente" name="infoUsuarioCliente" id="infoUsuarioCliente" require>
     

                  <div class="col-lg-12">
                    <button type="button" class="btn btn-new-primary btn-block btnAddUser">Agregar</button>
                    <button type="button" class="btn btn-block btn-warning btnAddUserEditar">Editar</button>
                  </div>
                  
                  </div>

                  <div class="row mt-3">
                  <div class="col-lg-12 mt-3">
                    <table class="table table-striped mt-3 tableCustomerUsers">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Telefono 1</th>
                          <th scope="col">Telefono 2</th>
                          <th scope="col">Direccion</th>
                          <th scope="col">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                    
                      </tbody>
                    </table>
                  </div>
                  </div>
            </div>
            <!--=====================================
              END USERS
            ======================================-->

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-new-primary">Guardar clientes</button>

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
END MODAL AGREGAR CLIENTE
======================================-->

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->
<div id="modalEditarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#4c6ef8; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar clientes</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <!-- ENTRADA PARA EL CLIENTE -->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control input-lg clienteEditar" name="clienteEditar" placeholder="Cliente" required>
                    <input type="hidden" class="form-control input-lg idEditar"      name="id" placeholder="Cliente">
                  </div>
                </div>
              </div>

               <!-- ENTRADA PARA EL NOMBRE -->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control input-lg nombreEditar" name="nombreCliente" placeholder="Ingresar nombre" required>
                  </div>
                </div>
              </div>

              <!-- ENTRADA PARA EL TELEFONO 1-->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                    <input type="text" class="form-control input-lg telefonoEditar1" name="telefonoCliente1" placeholder="Ingresar Telefono 1" required>
                  </div>
                </div>
              </div>

              <!-- ENTRADA PARA EL TELEFONO 2-->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                    <input type="text" class="form-control input-lg telefonoEditar2" name="telefonoCliente2" placeholder="Ingresar Telefono 2" >
                  </div>
                </div>
              </div>

              <!-- ENTRADA CREDITO O CONTADO-->
              <div class="col-lg-12">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control input-lg tipoEditar" name="tipo">
                      <option value="">TIPO</option>
                      <option value="CREDITO">CREDITO</option>
                      <option value="CONTADO">CONTADO</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- ENTRADA PARA LA DIREECION-->
              <div class="col-lg-12">            
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <textarea  type="text" rows="4" class="form-control direccionEditar" name="direccionCliente" placeholder="Ingresar Direccion" required></textarea>
                  </div>
                </div>
              </div>

            </div>

            <!--=====================================
              START USERS
            ======================================-->
            <div class="row mb-3">
                <div class="col-lg-12">
                  <button type="button" class="btn btn-new-primary btnShowUserEditar">Editar Usuario</button> 
                </div>
            </div>
            <div class="userContainerEditar">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" class="form-control nombreUsuarioClienteEditar" name="nombreUsuarioClienteEditar" id="nombreUsuarioClienteEditar" require>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Telefono 1</label>
                      <input type="text" class="form-control telefono1UsuarioClienteEditar" name="telefono1UsuarioClienteEditar" id="telefono1UsuarioClienteEditar" require>
                    </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Telefono 2</label>
                        <input type="text" class="form-control telefono2UsuarioClienteEditar" name="telefono2UsuarioClienteEditar" id="telefono2UsuarioClienteEditar" require>
                      </div>
                  </div>

                  <div class="col-lg-6">
                      <div class="form-group">
                          <label for="exampleFormControlTextarea1">Direccion</label>
                          <textarea class="form-control direccionUsuarioClienteEditar" name="direccionUsuarioClienteEditar" id="direccionUsuarioClienteEditar" rows="3"></textarea>
                      </div>
                  </div>


                  <input type="hidden" class="form-control infoUsuarioClienteEditar" name="infoUsuarioClienteEditar" id="infoUsuarioClienteEditar" require>


                  <div class="col-lg-12">
                    <button type="button" class="btn btn-new-primary btn-block btnAddUserClienteAgregar">Agregar</button>
                    <button type="button" class="btn btn-danger btn-block btnAddUserClienteEditar">Editar</button>
                  </div>
                  
                  </div>

                  <div class="row mt-3">
                  <div class="col-lg-12 mt-3">
                    <table class="table table-striped mt-3 tableCustomerUsersEditar">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Telefono 1</th>
                          <th scope="col">Telefono 2</th>
                          <th scope="col">Direccion</th>
                          <th scope="col">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                    
                      </tbody>
                    </table>
                  </div>
                  </div>
            </div>
            <!--=====================================
              END USERS
            ======================================-->

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-new-primary">Editar cliente</button>

        </div>

        <?php
          $editarCliente = new ClienteCtr();
          $editarCliente->ctrEditarCliente();
        ?>

      </form>

    </div>

  </div>

</div>
<!--=====================================
END MODAL EDITAR CLIENTE
======================================-->

<?php

  $borrarCliente = new ClienteCtr();
  $borrarCliente -> ctrBorrarCliente();

?>
<script src="vistas/js/clientes.js"></script>