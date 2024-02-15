
      <?php

      if(isset($_GET["fechaInicial"])){

          $fechaInicial = $_GET["fechaInicial"];
          $fechaFinal = $_GET["fechaFinal"];

      }else{

          $fechaInicial = null;
          $fechaFinal = null;

      }
          $usuario = Tarjetas::ctrUsuario();
          //$tarjetas = Tarjetas::ctrTarjetas($fechaInicial,$fechaFinal);
          //var_dump($usuario);
          //$respuestaDatos = DomicilioCtr::ctrMostrarDomicilios();
          //var_dump($respuestaDatos);
       ?>

      <!--=====================================
      ÚLTIMOS USUARIOS
      ======================================-->
      <div class="container-fluid">

        <div class="row">

          <?php

          $contador = 0;

          foreach ($usuario as $key => $value) {

            echo '<div class="col-sm-6 col-12">


               <div class="box box-success" style="-webkit-box-shadow: 1px 2px 9px -2px rgba(0,0,0,0.75);
                                                   -moz-box-shadow: 1px 2px 9px -2px rgba(0,0,0,0.75);
                                                    box-shadow: 1px 2px 9px -2px rgba(0,0,0,0.75);">


                 	<div class="box-header with-border">

               	    <h3 class="box-title" style="margin-bottom: 5px; color:#235291;">'.strtoupper($value["nombre"]).'</h3>
                    <h4 class="box-title pull-right" style="color:#235291;">'.$value["placa"].'</h4>
               	    <br>
                    <span style="color:#235291;">Planca: '.$value["placa"].'</span>
                    <br>
                    <span style="color:#235291;">Telefono: '.$value["telefonoUsuario"].'</span>

                 	</div>

                 	<div class="box-body no-padding">
                     <div class="box-header with-border">
                       <div class="user-block">';

                       if($value["foto"] != ""){

                        echo'<img class="img-circle" src="'.$value["foto"].'" alt="User Image">';

                       }else{

                         echo '<img src="vistas/img/usuarios/default/anonymous.png" class="img-circle">';

                       }

                    echo'<span class="username"><a class="users-list-name" href="#">
                          Domiciliario</a></span>';
                  echo '<span class="description">'.$value["nombre"].'</span>';
                  echo'
                       </div>
                     </div>
                      <ul style="padding: 3px 10px 0px 10px;" class="nav nav-pills nav-stacked">
                          <li>';
                          echo'</li>
                        </ul>
                     <ul class="nav nav-pills nav-stacked">';

                     $tarjetas = Tarjetas::ctrTarjetas($fechaInicial,$fechaFinal,$value["id"]);

                     echo'<table class="table table-striped table-hover">
                           <thead>
                             <tr>
                               <th scope="col">Cant</th>
                               <th scope="col">Dirección</th>
                               <th scope="col">Precio</th>
                               <th scope="col">Fecha</th>
                             </tr>
                           </thead>
                           <tbody>';

                           $t = 0;
                           $st = 0;
                           foreach ($tarjetas as $key => $valueTabla) {
                             $t = $valueTabla["total"];
                             $st = $valueTabla["subTotal"];
                             echo'<tr>
                                    <th scope="row">'.($key+1).'</th>
                                    <td>'.$valueTabla["direccion"].'</td>
                                    <td>$ '.number_format($valueTabla["precioDomicilio"]).'</td>
                                    <td>'.$valueTabla["fecha"].'</td>
                                  </tr>';
                           }



                      echo'</tbody>
                            </table>
                               </ul>';


                      echo'<div class="pull-right" style="padding:10px;">
                              <span style="font-size:20px;"><strong>TOTAL</strong></span>
                                <span style="font-size:20px;">$'.number_format($t).'</span>
                          </div>';
                          echo'<div class="pull-right" style="padding:10px;">
                                  <span style="font-size:20px;"><strong>SUB-TOTAL</strong></span>
                                    <span style="font-size:20px;">$'.number_format($st).'</span>
                              </div>';


                 	echo'</div>';


               echo'</div>
             </div>';

             if($contador == 1){
                echo '<div class="clearfix "></div>';
                $contador = 0;
             }else{
               $contador++;
             }
          }

          ?>

     </div>
    </div>
      <!-- USERS LIST -->

  <?php
  $eliminarOrden = new AsignarMesa();
  $eliminarOrden -> ctrEliminarOrden();
  ?>
