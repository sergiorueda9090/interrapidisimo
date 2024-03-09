let clienteUsuario = [];

$(document).on('click','.btnEditarClientes',function(){
  
  clienteUsuario = [];
  $(".tableCustomerUsersEditar tbody").empty();
  $(".infoUsuarioClienteEditar").val("");
  $(".tableCustomerUsers tbody").empty();

  var idCliente = $(this).attr('idCliente');
  console.log("idCliente ",idCliente);


  var datos = new FormData();
	datos.append("idCliente", idCliente);

	$.ajax({
		url:"ajax/clientes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
      $(".clienteEditar").val(respuesta["cliente"]);
      $(".nombreEditar").val(respuesta["nombre"]);
      $(".telefonoEditar1").val(respuesta["telefono1"]);
      $(".telefonoEditar2").val(respuesta["telefono2"]);
      $(".tipoEditar").val("CREDITO");
      $(".direccionEditar").val(respuesta["direccion"]);
      $(".idEditar").val(respuesta["id"]);
		}
	});

  showListClientesUser(idCliente);

})

function showListClientesUser(idCliente){

  let datos = new FormData();

	datos.append("idUsuario", idCliente);

	$.ajax({
		url:"ajax/clientes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
      respuesta.forEach(function(cliente, index) {
        callCustomerUsersEditar(cliente.nombre, cliente.telefono1, cliente.telefono2, cliente.direccion);
      });
		}
	});
}

function callCustomerUsersEditar(name=null, cellphone1=null, cellphone2=null, address=null){
  clienteUsuario.push({'nombre':name, 'telefono1':cellphone1, 'telefono2':cellphone2, 'direccion':address});
  showTableCustomerUsersEditar();
}

function showTableCustomerUsersEditar(){
  $(".tableCustomerUsersEditar tbody").empty();
    clienteUsuario.forEach(function(cliente, index) {
    let newRow = $("<tr>");
    $(".tableCustomerUsersEditar tbody").append(newRow);
    // Agregar las celdas a la fila
    newRow.append("<td>" + (index + 1) + "</td>");
    newRow.append("<td>" + cliente.nombre + "</td>");
    newRow.append("<td>" + cliente.telefono1 + "</td>");
    newRow.append("<td>" + cliente.telefono2 + "</td>");
    newRow.append("<td>" + cliente.direccion + "</td>");
    newRow.append(`<td><div class="btn-group">
                  <button type="button" class="btn btn-warning btnEditarClientesUsuariosEditar" idUsuariocliente="${(index)}"><i class="fa fa-pencil"></i></button>
                  <button type="button" class="btn btn-danger  btnEliminarClientesUsuariosEditar" idUsuariocliente ="${(index)}"><i class="fa fa-times"></i></button>
                </div>`);
  });

  if(clienteUsuario.length > 0){
    $(".infoUsuarioClienteEditar").val(JSON.stringify(clienteUsuario));
  }else{
    $(".infoUsuarioClienteEditar").val("");
  }
}

$(document).on('click','.btnAddUserClienteAgregar',function(){

  let nombreUsuarioCliente    = $(".nombreUsuarioClienteEditar").val();
  let telefono1UsuarioCliente = $(".telefono1UsuarioClienteEditar").val();
  let telefono2UsuarioCliente = $(".telefono2UsuarioClienteEditar").val();
  let direccionUsuarioCliente = $(".direccionUsuarioClienteEditar").val();

  if (nombreUsuarioCliente === "") {
    alert("El nombre del usuario es obligatorio.");
  } else if (telefono1UsuarioCliente === "") {
    alert("El teléfono 1 es obligatorio.");
  } else if (direccionUsuarioCliente === "") {
    alert("La dirección es obligatoria.");
  }else {
    callCustomerUsersEditar(nombreUsuarioCliente, telefono1UsuarioCliente, telefono2UsuarioCliente, direccionUsuarioCliente);
    $(".nombreUsuarioClienteEditar").val("");
    $(".telefono1UsuarioClienteEditar").val("");
    $(".telefono2UsuarioClienteEditar").val("");
    $(".direccionUsuarioClienteEditar").val("");
  }
});

$(document).on("click",".btnEditarClientesUsuariosEditar",function(){
  let idUsuarioCliente = $(this).attr('idUsuariocliente');
  $(".btnAddUserClienteEditar").attr("idUsuariocliente", idUsuarioCliente);
  $(".nombreUsuarioClienteEditar").val(clienteUsuario[idUsuarioCliente].nombre);
  $(".telefono1UsuarioClienteEditar").val(clienteUsuario[idUsuarioCliente].telefono1);
  $(".telefono2UsuarioClienteEditar").val(clienteUsuario[idUsuarioCliente].telefono2);
  $(".direccionUsuarioClienteEditar").val(clienteUsuario[idUsuarioCliente].direccion);
  $(".btnAddUserClienteAgregar").css({"display":"none"});
  $(".btnAddUserClienteEditar").css({"display":"block"});
});

$(document).on("click",".btnAddUserClienteEditar",function(){
  let idUsuarioCliente                        = $(this).attr('idUsuariocliente');
  clienteUsuario[idUsuarioCliente].nombre     = $(".nombreUsuarioClienteEditar").val();
  clienteUsuario[idUsuarioCliente].telefono1  = $(".telefono1UsuarioClienteEditar").val();
  clienteUsuario[idUsuarioCliente].telefono2  = $(".telefono2UsuarioClienteEditar").val();
  clienteUsuario[idUsuarioCliente].direccion  = $(".direccionUsuarioClienteEditar").val();
  showTableCustomerUsersEditar(); 
  $(".btnAddUserClienteAgregar").css({"display":"block"});
  $(".btnAddUserClienteEditar").css({"display":"none"});
  $(".nombreUsuarioClienteEditar").val("");
  $(".telefono1UsuarioClienteEditar").val("");
  $(".telefono2UsuarioClienteEditar").val("");
  $(".direccionUsuarioClienteEditar").val("");
});

$(document).on("click",".btnEliminarClientesUsuariosEditar",function(){
  let idUsuarioCliente = $(this).attr('idusuariocliente');
  clienteUsuario.splice(idUsuarioCliente, 1);
  showTableCustomerUsersEditar();
});

$(document).on('click','.salirEditarCliente',function(){
  $(".nombreClienteEditar").val("");
  $(".telefonoClienteEditar").val("");
  $(".direccionClienteEditar").val("");
})

$(document).on('click','.btnShowUser',function(){
  $(".userContainer").toggle();
});


$(document).on('click','.btnAddUser',function(){

  let nombreUsuarioCliente    = $(".nombreUsuarioCliente").val();
  let telefono1UsuarioCliente = $(".telefono1UsuarioCliente").val();
  let telefono2UsuarioCliente = $(".telefono2UsuarioCliente").val();
  let direccionUsuarioCliente = $(".direccionUsuarioCliente").val();

  if (nombreUsuarioCliente === "") {
    alert("El nombre del usuario es obligatorio.");
  } else if (telefono1UsuarioCliente === "") {
    alert("El teléfono 1 es obligatorio.");
  } else if (direccionUsuarioCliente === "") {
    alert("La dirección es obligatoria.");
  }else {
    callCustomerUsers(nombreUsuarioCliente, telefono1UsuarioCliente, telefono2UsuarioCliente, direccionUsuarioCliente);
    $(".nombreUsuarioCliente").val("");
    $(".telefono1UsuarioCliente").val("");
    $(".telefono2UsuarioCliente").val("");
    $(".direccionUsuarioCliente").val("");
  }
});


function callCustomerUsers(name=null, cellphone1=null, cellphone2=null, address=null){
  clienteUsuario.push({'nombre':name, 'telefono1':cellphone1, 'telefono2':cellphone2, 'direccion':address});
  showTableCustomerUsers();
}

function showTableCustomerUsers(){
  
  $(".tableCustomerUsers tbody").empty();

    // Iterar sobre el arreglo clienteUsuario y agregar cada objeto a la tabla
    clienteUsuario.forEach(function(cliente, index) {
    // Crear una nueva fila de tabla y agregarla al cuerpo de la tabla
    let newRow = $("<tr>");
    $(".tableCustomerUsers tbody").append(newRow);
    // Agregar las celdas a la fila
    newRow.append("<td>" + (index + 1) + "</td>");
    newRow.append("<td>" + cliente.nombre + "</td>");
    newRow.append("<td>" + cliente.telefono1 + "</td>");
    newRow.append("<td>" + cliente.telefono2 + "</td>");
    newRow.append("<td>" + cliente.direccion + "</td>");
    newRow.append(`<td><div class="btn-group">
                  <button type="button" class="btn btn-warning btnEditarClientesUsuarios" idUsuariocliente="${(index)}"><i class="fa fa-pencil"></i></button>
                  <button type="button" class="btn btn-danger btnEliminarClientesUsuarios" idUsuariocliente ="${(index)}"><i class="fa fa-times"></i></button>
                </div>`);
  });
  if(clienteUsuario.length > 0){
    $(".infoUsuarioCliente").val(JSON.stringify(clienteUsuario));
  }
 
}

$(document).on("click",".btnEliminarClientesUsuarios",function(){
  let idUsuarioCliente = $(this).attr('idUsuariocliente');
  clienteUsuario.splice(idUsuarioCliente, 1);
  showTableCustomerUsers();
});


$(document).on("click",".btnEditarClientesUsuarios",function(){
  let idUsuarioCliente = $(this).attr('idUsuariocliente');
  $(".btnAddUserEditar").attr("idUsuariocliente", idUsuarioCliente);
  $(".nombreUsuarioCliente").val(clienteUsuario[idUsuarioCliente].nombre);
  $(".telefono1UsuarioCliente").val(clienteUsuario[idUsuarioCliente].telefono1);
  $(".telefono2UsuarioCliente").val(clienteUsuario[idUsuarioCliente].telefono2);
  $(".direccionUsuarioCliente").val(clienteUsuario[idUsuarioCliente].direccion);
  $(".btnAddUser").css({"display":"none"});
  $(".btnAddUserEditar").css({"display":"block"});
});


$(document).on("click",".btnAddUserEditar",function(){
  let idUsuarioCliente                        = $(this).attr('idUsuariocliente');
  clienteUsuario[idUsuarioCliente].nombre     = $(".nombreUsuarioCliente").val();
  clienteUsuario[idUsuarioCliente].telefono1  = $(".telefono1UsuarioCliente").val();
  clienteUsuario[idUsuarioCliente].telefono2  = $(".telefono2UsuarioCliente").val();
  clienteUsuario[idUsuarioCliente].direccion  = $(".direccionUsuarioCliente").val();
  showTableCustomerUsers(); 
  $(".btnAddUser").css({"display":"block"});
  $(".btnAddUserEditar").css({"display":"none"});
  $(".nombreUsuarioCliente").val("");
  $(".telefono1UsuarioCliente").val("");
  $(".telefono2UsuarioCliente").val("");
  $(".direccionUsuarioCliente").val("");
});

/*=============================================
EDIT USER COSTUMER
=============================================*/
$(document).on("click",".btnShowUserEditar",function(){
    $(".userContainerEditar").toggle();
});

/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEliminarClientes", function(){

  var idCliente = $(this).attr("idCliente");


  swal({
    title: '¿Está seguro de borrar el usuario?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar usuario!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=clientes&idCliente="+idCliente;

    }

  })

})


