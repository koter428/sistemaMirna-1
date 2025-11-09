function mostrarListarPresupuestoCompra() {
    let contenido = dameContenido("modelo/movimientos/compra/presupuesto/listar.php");
    $("#contenido-principal").html(contenido);
    cargarTablaPresupuesto();
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function mostrarAgregarPresupuestoCompra() {
    let contenido = dameContenido("modelo/movimientos/compra/presupuesto/agregar.php");
    $("#contenido-principal").html(contenido);
    cargarListaSucursal("#sucursal_lst");
    cargarListasProducto("#material_lst");
    dameFechaActual("fecha_presu");
    dameFechaActual("fecha_vencimiento");
    cargarListaPedidoPendientes("#pedido_compra_lst");
    cargarListaProveedoresActivos("#proveedor_compra_lst");
    $("#sucursal_lst").val("1");
    //obtener ultimo id
    let ultimo = ejecutarAjax("controladores/presupuesto.php", "ultimo_registro=1");
    if (ultimo === "0") {
        $("#cod").val("1");
    } else {
        let json_ultimo = JSON.parse(ultimo);
        $("#cod").val(quitarDecimalesConvertir(json_ultimo['cod_presupuesto_compra']) + 1);


    }

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function cancelarPresupuestoCompra() {
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
            mostrarListarPresupuestoCompra();
        }
    });

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function agregarTablaPresupuestoCompra() {
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
    if ($("#costo_txt").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar un costo", "ATENCION");
        return;
    }

    let costo = quitarDecimalesConvertir($("#costo_txt").val().trim());

    if (costo <= 0) {
        mensaje_dialogo_info_ERROR("El costo debe ser mayor a cero", "ATENCION");
        return;
    }

    let materialRepetido = false; // Variable para detectar si el material ya existe

    $("#presupuesto_compra tr").each(function () {


        if ($(this).find("td:eq(0)").text() === $("#material_lst").val()) {
            mensaje_dialogo_info_ERROR("El material ya ha sido agregado anteriormente", "ATENCION");
            materialRepetido = true; // Marca como repetido
            return false; // Rompe el ciclo
        }
    });

// Si no se encontró material repetido, agrega una nueva fila
    if (!materialRepetido) {
        $("#presupuesto_compra").append(`
        <tr>
            <td>${$("#material_lst").val()}</td>
            <td>${$("#material_lst option:selected").html().split(" | ")[0]}</td>
            <td>${$("#material_lst option:selected").html().split(" | ")[1].replace("Tipo: ", "")}</td>
            <td><input class="form-control costo-presu" value="${formatearNumero($("#costo_txt").val())}"></td>
            <td>${$("#cantidad_txt").val()}</td>
            <td>${formatearNumero(cantidad * costo)}</td>
            <td>
                <button class="btn btn-danger remover-item-presupuesto">Remover</button>
            </td>
        </tr>
    `);
        calcularTotalPresupuesto();
    }
}
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
function calcularTotalPresupuesto() {
    let total = 0;
    $("#presupuesto_compra tr").each(function (evt) {
        total += quitarDecimalesConvertir($(this).find("td:eq(5)").text());
    });

    $("#total").text(formatearNumero(total));
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".remover-item-presupuesto", function (evt) {
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
            calcularTotalPresupuesto();
        }
    });
});

//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
function guardarPresupuestoCompra() {
    if ($("#sucursal_lst").val() === "0") {
        mensaje_dialogo_info_ERROR("Debes seleccionar una sucursal", "ATENCION");
        return;
    }

    if ($("#fecha_presu").val() < dameFechaActualSQL()) {
        mensaje_dialogo_info_ERROR("La fecha no puede ser menor a la fecha actual", "ATENCION");
        return;
    }

    if ($("#fecha_vencimiento").val() < dameFechaActualSQL()) {
        mensaje_dialogo_info_ERROR("La fecha de vencimiento no puede ser menor a la fecha actual", "ATENCION");
        return;
    }

    if ($("#fecha_vencimiento").val() < $("#fecha_presu").val()) {
        mensaje_dialogo_info_ERROR("La fecha de emision no puede ser mayor a la fecha de vencimiento", "ATENCION");
        return;
    }
    
    if ($("#proveedor_compra_lst").val() === "0") {
        mensaje_dialogo_info_ERROR("Debes seleccionar un proveedor", "ATENCION");
        return;
    }

    let cabecera = {
        'cod_presupuesto_comp': $("#cod").val(),
        'fecha_presu': $("#fecha_presu").val(),
        'fecha_vencimiento': $("#fecha_vencimiento").val(),
        'cod_pedido_compra': $("#pedido_compra_lst").val(),
        'cod_proveedor': $("#proveedor_compra_lst").val(),
        'cod_sucursal': $("#sucursal_lst").val(),
        'estado': 'PENDIENTE'
    };

    let response = ejecutarAjax("controladores/presupuesto.php", "guardar=" + JSON.stringify(cabecera));

    console.log("CABECERA -> " + response);

    //detalle
    $("#presupuesto_compra tr").each(function (evt) {
        let detalle = {
            'cod_presupuesto_comp': $("#cod").val(),
            'cod_material': $(this).find("td:eq(0)").text(),
            'costo': quitarDecimalesConvertir($(this).find("input").val()),
            'cantidad': $(this).find("td:eq(4)").text()
        };
        response = ejecutarAjax("controladores/presupuesto_detalle.php", "guardar=" + JSON.stringify(detalle));

        console.log("DETALLE -> " + response);
    });
    mensaje_confirmacion("Se ha guardado correctamente, GUARDADO")

    mostrarListarPresupuestoCompra();
}

//------------------------------------------------------------------------------
function cargarTablaPresupuesto() {
    let data = ejecutarAjax("controladores/presupuesto.php", "leer=1");

    let fila = "";
    if (data === "0") {
        fila = "NO HAY REGISTROS";
    } else {
        let json_data = JSON.parse(data);
        json_data.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.cod_presupuesto_comp}</td>`;
            fila += `<td>${item.fecha_presu}</td>`;
            fila += `<td>${item.fecha_vencimiento}</td>`;
            fila += `<td>${item.nom_ape_prov}</td>`;
            fila += `<td>${item.suc_descripcion}</td>`;
            fila += `<td>${formatearNumero(item.total)}</td>`;
            fila += `<td><span class="alert alert-${(item.estado === "PENDIENTE") ? 'info' : (item.estado === "ANULADO") ? 'danger' : 'success'}">${item.estado}</span></td>`;
            fila += `<td>
                        <button ${(item.estado === "CONFIRMADO" || item.estado === "ANULADO") ? "disabled" : ""} class='btn btn-success  aprobar-presupuesto'><i class='ti ti-check'></i></button>
                        <button onclick="imprimirPresupuesto(${item.cod_presupuesto_comp}); return false;" class='btn btn-warning  imprimir-presupuesto'><i class='ti ti-printer'></i></button>
                        <button ${(item.estado === "CONFIRMADO" || item.estado === "ANULADO") ? "disabled" : ""} class='btn btn-danger  anular-presupuesto'><i class='ti ti-ban'></i></button>
                    </td>`;
            fila += `</tr>`;
        });
    }

    $("#presupuesto_compra").html(fila);
}
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
function imprimirPresupuesto(id) {
    window.open("modelo/movimientos/compra/presupuesto/print.php?id=" + id);
}
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("change", "#pedido_compra_lst", function (evt) {
    if ($("#pedido_compra_lst").val() === "0") {
            $("#presupuesto_compra").html("");

    } else {
        let data = ejecutarAjax("controladores/pedido_detalle.php", "id=" + $("#pedido_compra_lst").val());
        console.log(data);
        let fila = "";
        if (data === "0") {
            $("#presupuesto_compra").html("");
        } else {
            let json_data = JSON.parse(data);

            $("#presupuesto_compra").html("");
            json_data.map(function (item) {
                $("#presupuesto_compra").append(`
                    <tr>
                        <td>${item.cod_material}</td>
                        <td>${item.nombre_material}</td>
                        <td>${item.tipo_material}</td>
                        <td><input class="form-control costo-presu" value="${formatearNumero(item.costo_material)}"></td>
                        <td>${item.cantidad}</td>
                        <td>${formatearNumero(item.total)}</td>
                        <td>
                            <button class="btn btn-danger remover-item-presupuesto">Remover</button>
                        </td>
                    </tr>
                `);
            });
        }
    }
    calcularTotalPresupuesto();
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function cargarListaPresupuestoPendientes(componente) {
    let datos = ejecutarAjax("controladores/presupuesto.php", "presupuesto_pendientes=1");
    console.log(datos);
    let option = "<option value='0'>Selecciona un presupuesto</option>";
    if (datos !== "0") {
        let json_datos = JSON.parse(datos);
        json_datos.map(function (item) {
            option += `<option value='${item.cod_presupuesto_comp}'>Nro Presupuesto ${item.cod_presupuesto_comp} | ${item.nom_ape_prov}  | Total: ${formatearNumero(item.total)}</option>`;
        });
    }
    $(componente).html(option);
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("keyup", ".costo-presu", function (evt) {
    $(this).val(formatearNumero($(this).val()));
    
    let cantidad =  quitarDecimalesConvertir($(this).closest("tr").find("td:eq(4)").text());
    let costo =  quitarDecimalesConvertir($(this).val());
    
    $(this).closest("tr").find("td:eq(5)").text(formatearNumero(cantidad * costo));
    calcularTotalPresupuesto();
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".anular-presupuesto", function (evt) {
     let id = $(this).closest("tr").find("td:eq(0)").text();
     if($(this).closest("tr").find("td:eq(6)").text() === "ANULADO"){
         mensaje_dialogo_info_ERROR("El registro ya ha sido anulado anteriormete", "ATENCION");
         return;
     }
     
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
            let response = ejecutarAjax("controladores/presupuesto.php",
                    "anular=" + id);


            console.log(response);
            mensaje_confirmacion("Anulado Correctamente", "Eliminado");
            mostrarListarPresupuestoCompra();
        }
    });
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".aprobar-presupuesto", function (evt) {
     let id = $(this).closest("tr").find("td:eq(0)").text();
     if($(this).closest("tr").find("td:eq(6)").text() === "ANULADO"){
         mensaje_dialogo_info_ERROR("El registro ya ha sido anulado anteriormete", "ATENCION");
         return;
     }
     
    Swal.fire({
        title: "Atencion",
        text: "Desea aprobar el registro?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "No",
        confirmButtonText: "Si"
    }).then((result) => {
        if (result.isConfirmed) {
            let response = ejecutarAjax("controladores/presupuesto.php",
                    "aprobar=" + id);


            console.log(response);
            mensaje_confirmacion("Anulado Correctamente", "Eliminado");
            mostrarListarPresupuestoCompra();
        }
    });
});