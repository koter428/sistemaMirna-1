function mostrarListarPedidoCompra() {
    let contenido = dameContenido("modelo/movimientos/compra/pedido/listar.php");
    $("#contenido-principal").html(contenido);
    cargarTablaPedido(".pedido_compra");
    console.log(contenido);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function mostrarAgregarPedidoCompra() {
    let contenido = dameContenido("modelo/movimientos/compra/pedido/agregar.php");
    $("#contenido-principal").html(contenido);
    cargarListaSucursal("#sucursal_lst");
    cargarListasProducto("#material_lst");

    dameFechaActual("fecha_pedido");

    $("#sucursal_lst").val("1");
    //obtener ultimo id
    let ultimo = ejecutarAjax("controladores/pedido.php", "ultimo_registro=1");
    console.log(ultimo);
    if (ultimo === "0") {
        $("#cod").val("1");
    } else {
        let json_ultimo = JSON.parse(ultimo);
        $("#cod").val(quitarDecimalesConvertir(json_ultimo['cod_pedido_compra']) + 1);


    }

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function cancelarPedidoCompra() {
    Swal.fire({
        title: "ATENCION",
        text: "Desea cancelar la operacion?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "No",
        confirmButtonText: "Si"
    }).then((result) => {
        if (result.isConfirmed) {
            mostrarListarPedidoCompra();
        }
    });

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function agregarTablaPedidoCompra() {
    if ($("#material_lst").val() === "0") {
        mensaje_dialogo_info_ERROR("Debes seleccionar un material", "ATENCION");
        return;
    }

    if ($("#cantidad_txt").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar una cantidad", "ATENCION");
        return;
    }

    let cantidad = quitarDecimalesConvertir($("#cantidad_txt").val().trim());

    if (cantidad <= 0) {
        mensaje_dialogo_info_ERROR("La cantidad debe ser mayor a cero", "ATENCION");
        return;
    }

    let materialRepetido = false; // Variable para detectar si el material ya existe

    $("#pedido_compra tr").each(function () {


        if ($(this).find("td:eq(0)").text() === $("#material_lst").val()) {
            mensaje_dialogo_info_ERROR("El material ya ha sido agregado anteriormente", "ATENCION");
            materialRepetido = true; // Marca como repetido
            return false; // Rompe el ciclo
        }
    });

// Si no se encontró material repetido, agrega una nueva fila
    if (!materialRepetido) {
        $("#pedido_compra").append(`
        <tr>
            <td>${$("#material_lst").val()}</td>
            <td>${$("#material_lst option:selected").html().split(" | ")[0]}</td>
            <td>${$("#material_lst option:selected").html().split(" | ")[1].replace("Tipo: ", "")}</td>
            <td><input type="number" min="1" class='form-control' value="${$("#cantidad_txt").val()}"></td>

            <td>
                <button class="btn btn-danger remover-item-pedido">Remover</button>
            </td>
        </tr>
    `);
    }
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".remover-item-pedido", function (evt) {
    let tr = $(this).closest("tr");
    Swal.fire({
        title: "ATENCION",
        text: "Desea remover el registro?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "No",
        confirmButtonText: "Si"
    }).then((result) => {
        if (result.isConfirmed) {
            $(tr).remove();
        }
    });
});

//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
function guardarPedidoCompra() {
    if ($("#sucursal_lst").val() === "0") {
        mensaje_dialogo_info_ERROR("Debes seleccionar una sucursal", "ATENCION");
        return;
    }



    let cabecera = {
        'cod_pedido_compra': $("#cod").val(),
        'fecha_pedido': $("#fecha_pedido").val(),
        'cod_sucursal': $("#sucursal_lst").val(),
        'estado': 'PENDIENTE'
    };
    let response = "";
    if ($("#editar").val() === "NO") {
        if ($("#fecha_pedido").val() < dameFechaActualSQL()) {
            mensaje_dialogo_info_ERROR("La fecha no puede ser menor a la fecha actual", "ATENCION");
            return;
        }

        response = ejecutarAjax("controladores/pedido.php", "guardar=" + JSON.stringify(cabecera));

        console.log("CABECERA -> " + response);
          mensaje_confirmacion("Se ha guardado correctamente, GUARDADO")

    } else {

        response = ejecutarAjax("controladores/pedido.php", "actualizar=" + JSON.stringify(cabecera));

        console.log("CABECERA -> " + response);

        response = ejecutarAjax("controladores/pedido_detalle.php", "eliminar=" + $("#cod").val());
        console.log("ELIMINACION -> " + response);
        
          mensaje_confirmacion("Se ha guardado actualizado, Actualizado")
    }

    //detalle
    $("#pedido_compra tr").each(function (evt) {
        let detalle = {
            'cod_pedido_compra': $("#cod").val(),
            'cod_producto': $(this).find("td:eq(0)").text(),
            'cantidad': $(this).find("input").val()
        };
        response = ejecutarAjax("controladores/pedido_detalle.php", "guardar=" + JSON.stringify(detalle));

        console.log("DETALLE -> " + response);
    });
  
    imprimirPedido($("#cod").val());
    mostrarListarPedidoCompra();
}

//------------------------------------------------------------------------------
function cargarTablaPedido() {
    let data = ejecutarAjax("controladores/pedido.php", "leer=1");

    let fila = "";
    if (data === "0") {
        fila = "NO HAY REGISTROS";
    } else {
        let json_data = JSON.parse(data);
        json_data.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.cod_pedido_compra}</td>`;
            fila += `<td>${item.fecha_pedido}</td>`;
            fila += `<td>${item.suc_descripcion}</td>`;
            fila += `<td>${item.nombre_apellido}</td>`;
            fila += `<td><span class="alert alert-${(item.estado === "PENDIENTE") ? 'info' : (item.estado === "ANULADO") ? 'danger' : 'success'}">${item.estado}</span></td>`;
            fila += `<td>
                        <button onclick="imprimirPedido(${item.cod_pedido_compra}); return false;" class='btn btn-warning imprimir-pedido'><i class='ti ti-printer'></i></button>
                        <button ${(item.estado === "CONFIRMADO" || item.estado === "ANULADO") ? "disabled" : ""} class='btn btn-danger anular-pedido' ><i class='ti ti-ban'></i></button>
                        <button ${(item.estado === "CONFIRMADO" || item.estado === "ANULADO" || item.estado === "PRESUPUESTADO") ? "disabled" : ""} class='btn btn-info editar-pedido' ><i class='ti ti-pencil'></i></button>
                    </td>`;
            fila += `</tr>`;
        });
    }

    $("#pedido_compra").html(fila);
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".editar-pedido", function (evt) {
    let id = $(this).closest("tr").find("td:eq(0)").text();
    Swal.fire({
        title: "Atencion",
        text: "Desea editar el registro?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "No",
        confirmButtonText: "Si"
    }).then((result) => {
        if (result.isConfirmed) {
            let contenido = dameContenido("modelo/movimientos/compra/pedido/agregar.php");
            $("#contenido-principal").html(contenido);
            cargarListaSucursal("#sucursal_lst");
            cargarListasProducto("#material_lst");

            dameFechaActual("fecha_pedido");

            $("#sucursal_lst").val("1");
//            JQUERY
            $("#guardar_btn").text("Actualizar");
            //obtener ultimo id
            let cabecera = ejecutarAjax("controladores/pedido.php",
                    "id=" + id);
            console.log(cabecera);

            if (cabecera !== "0") {
                let json_cab = JSON.parse(cabecera);
                $("#fecha_pedido").val(json_cab['fecha_pedido']);
                $("#sucursal_lst").val(json_cab['cod_sucursal']);
                $("#editar").val("SI");
                $("#cod").val(id);

            }

            let detalle = ejecutarAjax("controladores/pedido_detalle.php",
                    "id_cabecera=" + id);
            console.log(detalle);

            if (detalle !== "0") {
                let json_det = JSON.parse(detalle);
                json_det.map(function (item) {
                    $("#pedido_compra").append(`
                        <tr>
                            <td>${item.cod_producto}</td>
                            <td>${item.nombre_prod}</td>
                            <td>${item.tipo}</td>
                            <td><input type="number" min="1" class='form-control' value="${item.cantidad}"></td>
                            <td>  <button class="btn btn-danger remover-item-pedido">Remover</button></td>
                        </tr>
                    `);
                });
            }


        }
    });
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".anular-pedido", function (evt) {
    let id = $(this).closest("tr").find("td:eq(0)").text();
    Swal.fire({
        title: "Atencion",
        text: "Desea anular el registro?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "No",
        confirmButtonText: "Si"
    }).then((result) => {
        if (result.isConfirmed) {
            let response = ejecutarAjax("controladores/pedido.php",
                    "anular=" + id);


            console.log(response);
            mensaje_confirmacion("Anulado Correctamente", "Eliminado");
            mostrarListarPedidoCompra();
        }
    });
});

//$("#material_lst").change(function () {
//    let codMaterial = $(this).val();
//    if (codMaterial) {
//        let data = ejecutarAjax("controladores/pedido.php", "cod_material=" + codMaterial);
//        let materialInfo = JSON.parse(data);
//        $("#tipo_material").val(materialInfo.tipo_material); // Cargar tipo de material
//    }
//});

function cargarListaPedidoPendientes(componente) {
    let datos = ejecutarAjax("controladores/pedido.php", "pedidos_pendientes=1");
    console.log(datos);
    let option = "<option value='0'>Selecciona un pedido</option>";
    if (datos !== "0") {
        let json_datos = JSON.parse(datos);
        json_datos.map(function (item) {
            option += `<option value='${item.cod_pedido_compra}'>Nro Pedido ${item.cod_pedido_compra} | ${item.nombre_apellido} | ${item.suc_descripcion} </option>`;
        });
    }
    $(componente).html(option);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function imprimirPedido(id) {
    window.open("modelo/movimientos/compra/pedido/print.php?id=" + id);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
