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

      Administrar productos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar productos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarProducto">

          Agregar producto

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Imagen</th>
           <th>Codigo</th>
           <th>Descripcion</th>
           <th>Categoria</th>
           <th>Stock</th>
           <th>Precio de venta</th>
           <th>Acciones</th>

         </tr>

        </thead>

    <tbody>

        <?php

        $item = null;
        $valor = null;
        $orden ="id";
        $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

        foreach ($productos as $key => $value){
            echo ' <tr>
            <td>'.($key+1).'</td>
             <td>';
             if($value["imagen"] == ""){
               echo'<img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px">';
             }else{
                  echo'<img src="'.$value["imagen"].'" class="img-thumbnail" width="40px">';
             }
             echo'</td>
            <td>'.$value["codigo"].'</td>
            <td>'.$value["descripcion"].'</td>';
            $item = "id";
            $valor = $value["id_categoria"];
            $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);
            echo'<td>'.$categoria["categoria"].'</td>
            <td>'.$value["stock"].'</td>
            <td>'.number_format($value["precio_venta"]).'</td>
            <td>

              <div class="btn-group">
                <button class="btn btn-warning btnEditarProducto" data-toggle="modal" data-target="#modalEditarProducto" idProducto='.$value["id"].'><i class="fa fa-pencil"></i></button>
                <button class="btn btn-danger btnEliminarProducto" idProducto='.$value["id"].' codigo='.$value["codigo"].' imagen='.$value["imagen"].'><i class="fa fa-times"></i></button>
              </div>

            </td>

          </tr>';
        }

        ?>
        </tbody>

       </table>
          <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">
      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#28A745; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <!-- ENTRADA PARA SELECCIONAR SU CATEGORIA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>


                  <option value="">Selecionar categoria</option>

                  <?php

       $item = null;
       $valor = null;
       $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
       foreach ($categorias as $key => $value){

           echo'<option value="'.$value["id"].'">'.$value["categoria"].'</option>';

       }

                  ?>
                </select>

              </div>

            </div>


            <!-- ENTRADA PARA EL CODIGO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="nuevoCodigo"  name="nuevoCodigo" placeholder="Ingresar codigo" readonly required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCION -->

             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripcion" required>

              </div>

            </div>

            <!--ENTRADA PARA STOCK -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>

              </div>

            </div>

            <!--ENTRADA PARA PRECIO COMPRA -->

            <div class="form-group row">
                <!--<div class="col-xs-12 col-sm-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" placeholder="Precio de compra" required>

              </div>
            </div>-->

            <!--ENTRADA PARA PRECIO DE VENTA -->

              <div class="col-xs-12 col-sm-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" placeholder="Precio venta" required>

              </div>
              <br>

              <!--CHECKBOX PARA PORCENTAJE-->

              <!-- <div class="col-xs-6">
             <div class="form-group">
                 <label>
                     <input type="checkbox" class="minimal porcentaje" checked>
                     Utilizar porcentaje
                 </label>

             </div>

           </div> -->

              <!--ENTRADA PARA PORCENTAJE-->

            <!--<div class="col-xs-6" style="padding: 0">

             <div class="input-group">
                 <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                 <span class="input-group-addon"><i class="fa fa-percent"></i></span>
             </div>

           </div>-->

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">

              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Guardar producto</button>

        </div>

      </form>

        <?php

        $crearProducto = new ControladorProductos();
        $crearProducto -> ctrCrearProducto();

        ?>

    </div>

  </div>

</div>





<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#28A745; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <!-- ENTRADA PARA SELECCIONAR SU CATEGORIA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg"  name="editarCategoria" required>

                  <?
                     foreach ($categorias as $key => $value){
                         echo'<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                     }
                  ?>


                </select>

              </div>

            </div>


            <!-- ENTRADA PARA EL CODIGO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="editarCodigo"  name="editarCodigo"  readonly required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCION -->

             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg"  id="editarDescripcion" name="editarDescripcion"  required>

              </div>

            </div>



            <!--ENTRADA PARA STOCK -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0"  required>

              </div>

            </div>

            <!--ENTRADA PARA PRECIO COMPRA -->

            <div class="form-group row">

            <!--ENTRADA PARA PRECIO DE VENTA -->

              <div class="col-xs-12 col-sm-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" required>

              </div>
              <br>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">

              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="editarImagen">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="imagenActual" id="imagenActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Guardar cambios</button>

        </div>

      </form>

      <?php

      $editarProducto = new ControladorProductos();
      $editarProducto -> ctrEditarProducto();

      ?>

    </div>

  </div>

</div>


<?php

$eliminarProducto = new ControladorProductos();
$eliminarProducto ->ctrEliminarProducto();

?>
