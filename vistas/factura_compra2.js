function mostrarListarFacturaCompra() {
    let contenido = dameContenido("paginas/movimientos/compra/factura_compra/listar.php");
    $("#contenido-principal").html(contenido);
    //cargarTablaFacturaCompra();
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function mostrarAgregarFacturaCompra() {
    let contenido = dameContenido("paginas/movimientos/compra/factura_compra/agregar.php");
    $("#contenido-principal").html(contenido);
    cargarListasSucursal("#sucursal_lst");
    cargarListasMaterial("#material_lst");
    cargarListasUsuario("#usuario_lst");
    dameFechaActual("fecha");
    cargarListaOrdenPendientes("#orden_compra_lst");
    cargarListasDeposito2("#deposito_lst")
    cargarListaProveedoresActivos("#proveedor_compra_lst");
    $("#sucursal_lst").val("1");
    //obtener ultimo id
    let ultimo = ejecutarAjax("controladores/factura_compra.php", "ultimo_registro=1");
    if (ultimo === "0") {
        $("#cod").val("1");
    } else {
        let json_ultimo = JSON.parse(ultimo);
        $("#cod").val(quitarDecimalesConvertir(json_ultimo['cod_compra']) + 1);
    }

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function cancelarFacturaCompra() {
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
            mostrarListarFacturaCompra();
        }
    });

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function agregarTablaFacturaCompra() {
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

    $("#factura_compra_compra tr").each(function () {


        if ($(this).find("td:eq(0)").text() === $("#material_lst").val()) {
            mensaje_dialogo_info_ERROR("El material ya ha sido agregado anteriormente", "ATENCION");
            materialRepetido = true; // Marca como repetido
            return false; // Rompe el ciclo
        }
    });

// Si no se encontró material repetido, agrega una nueva fila
    if (!materialRepetido) {
        $("#factura_compra").append(`
        <tr>
            <td>${$("#material_lst").val()}</td>
            <td>${$("#material_lst option:selected").html().split(" | ")[0]}</td>
            <td>${$("#material_lst option:selected").html().split(" | ")[1].replace("Tipo: ", "")}</td>
            <td><input class="form-control costo-presu" value="${formatearNumero($("#costo_txt").val())}"></td>
            <td>${$("#cantidad_txt").val()}</td>
            <td>${formatearNumero(cantidad * costo)}</td>
            <td>
                <button class="btn btn-danger remover-item-factura_compra">Remover</button>
            </td>
        </tr>
    `);
        calcularTotalFacturaCompra();
    }
}
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
function calcularTotalFacturaCompra() {
    let total = 0;
    $("#factura_compra_compra tr").each(function (evt) {
        total += quitarDecimalesConvertir($(this).find("td:eq(5)").text());
    });

    $("#total").text(formatearNumero(total));
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".remover-item-factura_compra", function (evt) {
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
            calcularTotalFacturaCompra();
        }
    });
});

//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
function guardarFacturaCompra() {
    if ($("#sucursal_lst").val() === "0") {
        mensaje_dialogo_info_ERROR("Debes seleccionar una sucursal", "ATENCION");
        return;
    }

    if ($("#fecha").val() < dameFechaActualSQL()) {
        mensaje_dialogo_info_ERROR("La fecha no puede ser menor a la fecha actual", "ATENCION");
        return;
    }

  

    let cabecera = {
        'cod_compra': $("#cod").val(),
        'fecha_compra': $("#fecha").val(),
        'condicion': $("#condicion_lst").val(),
        'timbrado': $("#timbrado").val(),
        'intervalo': $("#sucursal_lst").val(),
        'fecha_venc_timbrado': $("#fecha_vencimiento_tim").val(),
        'nro_factura': $("#nro_factura").val(),
        'cod_proveedor': $("#proveedor_compra_lst").val(),
        'cod_orden_compra': $("#orden_compra_lst").val(),
        'cod_deposito': $("#deposito_lst").val(),
        'id_sucursal': $("#sucursal_lst").val(),
        'cod_usuario': $("#usuario_lst").val()
    };
    console.log(cabecera);

    let response = ejecutarAjax("controladores/factura_compra.php", "guardar=" + JSON.stringify(cabecera));

    console.log("CABECERA -> " + response);

    //detalle
    $("#factura_compra tr").each(function (evt) {
        let detalle = {
            'cod_factura_compra': $("#cod").val(),
            'cod_material': $(this).find("td:eq(0)").text(),
            'costo': quitarDecimalesConvertir($(this).find("input").val()),
            'cantidad': $(this).find("td:eq(4)").text()
        };
        response = ejecutarAjax("controladores/factura_compra_detalle.php", "guardar=" + JSON.stringify(detalle));

        console.log("DETALLE -> " + response);
    });
    mensaje_confirmacion("Se ha guardado correctamente, GUARDADO")

    mostrarListarFacturaCompra();
}

//------------------------------------------------------------------------------
function cargarTablaFacturaCompra() {
    let data = ejecutarAjax("controladores/factura_compra.php", "leer=1");

    let fila = "";
    if (data === "0") {
        fila = "NO HAY REGISTROS";
    } else {
        let json_data = JSON.parse(data);
        json_data.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.cod_factura_compra}</td>`;
            fila += `<td>${item.fecha_orden}</td>`;
            fila += `<td>${item.nom_ape_prov}</td>`;
            fila += `<td>${item.suc_descripcion}</td>`;
            fila += `<td>${formatearNumero(item.total)}</td>`;
            fila += `<td><span class="badge badge-${(item.estado === "PENDIENTE") ? 'info' : (item.estado === "ANULADO") ? 'danger' : 'success'}">${item.estado}</span></td>`;
            fila += `<td>
                        <button ${(item.estado === "CONFIRMADO" || item.estado === "ANULADO") ? "disabled" : ""} class='btn btn-success btn-sm aprobar-factura_compra'><i class='fa fa-check'></i></button>
                        <button onclick="imprimirFacturaCompra(${item.cod_factura_compra}); return false;" class='btn btn-warning btn-sm imprimir-factura_compra'><i class='fa fa-print'></i></button>
                        <button ${(item.estado === "CONFIRMADO" || item.estado === "ANULADO") ? "disabled" : ""} class='btn btn-danger btn-sm anular-factura_compra'><i class='fa fa-ban'></i></button>
                    </td>`;
            fila += `</tr>`;
        });
    }

    $("#factura_compra").html(fila);
}
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
function imprimirFacturaCompra(id) {
    window.open("paginas/movimientos/compra/factura_compra/print.php?id=" + id);
}
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("change", "#presupuesto_compra_lst", function (evt) {
    if ($("#presupuesto_compra_lst").val() === "0") {
            $("#factura_compra_compra").html("");
            $("#proveedor_compra_lst").val("0");

    } else {
        let cabecera = ejecutarAjax("controladores/presupuesto.php", "id=" + $("#presupuesto_compra_lst").val());
        console.log(cabecera);
        
        let json_cabecera =  JSON.parse(cabecera);
        $("#proveedor_compra_lst").val(json_cabecera['cod_proveedor']);
        
        let data = ejecutarAjax("controladores/presupuesto_detalle.php", "id=" + $("#presupuesto_compra_lst").val());
        console.log(data);
        let fila = "";
        if (data === "0") {
            $("#factura_compra_compra").html("");
        } else {
            let json_data = JSON.parse(data);

            $("#factura_compra_compra").html("");
            json_data.map(function (item) {
                $("#factura_compra_compra").append(`
                    <tr>
                        <td>${item.cod_material}</td>
                        <td>${item.nombre_material}</td>
                        <td>${item.tipo_material}</td>
                        <td><input class="form-control costo-presu" value="${formatearNumero(item.costo)}"></td>
                        <td>${item.cantidad}</td>
                        <td>${formatearNumero(item.total)}</td>
                        <td>
                            <button class="btn btn-danger remover-item-factura_compra">Remover</button>
                        </td>
                    </tr>
                `);
            });
        }
    }
    calcularTotalFacturaCompra();
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".anular-factura_compra", function (evt) {
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
            let response = ejecutarAjax("controladores/factura_compra.php",
                    "anular=" + id);


            console.log(response);
            mensaje_confirmacion("Anulado Correctamente", "Eliminado");
            mostrarListarFacturaCompra();
        }
    });
});
