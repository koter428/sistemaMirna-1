function mostrarListarRecepcionEquipo() {
    let contenido = dameContenido("paginas/movimientos/servicio/recepcion_equipo/listar.php");
    $("#contenido-principal").html(contenido);
    cargarTablaRecepcionEquipo();
}

function mostrarAgregarRecepcionEquipo() {
    let contenido = dameContenido("paginas/movimientos/servicio/recepcion_equipo/agregar.php");
    $("#contenido-principal").html(contenido);
    
    // Cargar listas necesarias
    cargarListaSucursal("#sucursal_lst");
    cargarListaClientesActivos("#cliente_lst");
    cargarListaEstadosEquipo("#estado_lst");
    cargarListaEquiposActivos("#equipo_lst");
    cargarListaUsuariosActivos("#tecnico_lst");
    
    // Establecer fecha actual
    dameFechaActual("fecha_recepcion");
    
    // Obtener último ID
    let ultimo = ejecutarAjax("controladores/recepcion_equipo.php", "ultimo_registro=1");
    if (ultimo === "0") {
        $("#cod_recepcion").val("1");
    } else {
        let json_ultimo = JSON.parse(ultimo);
        $("#cod_recepcion").val(parseInt(json_ultimo['ultimo']) + 1);
    }
}

function cargarTablaRecepcionEquipo() {
    let datos = ejecutarAjax("controladores/recepcion_equipo.php", "leer_activo=1");
    let json_datos = JSON.parse(datos);
    
    $("#tabla_recepciones").DataTable({
        data: json_datos,
        columns: [
            { data: "cod_recepcion" },
            { data: "fecha_recepcion" },
            { data: "nombre_cliente" },
            { data: "apellido_cliente" },
            { data: "nro_serie" },
            { data: "estado_equipo" },
            { data: "sucursal" },
            { data: "usuario" },
            {
                data: "estado",
                render: function(data, type, row) {
                    if (data === 'ACTIVO') {
                        return '<button class="btn btn-warning btn-sm" onclick="anularRecepcion(' + row.cod_recepcion + ')">Anular</button>' +
                               '<button class="btn btn-info btn-sm ml-1" onclick="imprimirRecepcion(' + row.cod_recepcion + ')">Imprimir</button>';
                    }
                    return 'ANULADO';
                }
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }
    });
}

 

// Función para cargar lista de estados de equipo
 /* function cargarListaEstadosEquipo(elemento) {
    let datos = ejecutarAjax("controladores/recepcion_equipo.php", "listar_estados=1");
    console.log("Respuesta de estados:", datos); // Log para depuración
    let json_datos = JSON.parse(datos);
    $(elemento).empty();
    $(elemento).append('<option value="">--Seleccione--</option>');
    for (let i = 0; i < json_datos.length; i++) {
        $(elemento).append('<option value="' + json_datos[i].cod_estado + '">' + 
            json_datos[i].descripcion + '</option>');
    }
} */

// Función para cargar lista de equipos activos
function cargarListaEquiposActivos(elemento) {
    let datos = ejecutarAjax("controladores/recepcion_equipo.php", "listar_equipos=1");
    let json_datos = JSON.parse(datos);
    $(elemento).empty();
    $(elemento).append('<option value="">--Seleccione--</option>');
    for (let i = 0; i < json_datos.length; i++) {
        $(elemento).append('<option value="' + json_datos[i].cod_equipo + '">' + 
            json_datos[i].descripcion + '</option>');
    }
}

// Función para cargar lista de usuarios (técnicos) activos
function cargarListaUsuariosActivos(elemento) {
    let datos = ejecutarAjax("controladores/usuario.php", "tecnicos=1");
    console.log("Respuesta de técnicos:", datos); // Log para depuración
    let json_datos = JSON.parse(datos);
    $(elemento).empty();
    $(elemento).append('<option value="">--Seleccione--</option>');
    for (let i = 0; i < json_datos.length; i++) {
        $(elemento).append('<option value="' + json_datos[i].cod_usuario + '">' + 
            json_datos[i].nom_apellido + '</option>');
    }
}

function guardarRecepcion() {
    // Validaciones básicas
    if ($("#cliente").val() === "") {
        mensajeError("Debe seleccionar un cliente");
        return;
    }
    if ($("#tecnico").val() === "") {
        mensajeError("Debe seleccionar un técnico");
        return;
    }
    if ($("#nro_serie").val() === "") {
        mensajeError("Debe ingresar el número de serie");
        return;
    }
    
    // Preparar datos
    let datos = {
        cod_cliente: $("#cliente").val(),
        cod_tecnico: $("#tecnico").val(),
        nro_serie: $("#nro_serie").val(),
        fecha_recepcion: $("#fecha_recepcion").val(),
        cod_estado: $("#estado").val(),
        cod_sucursal: $("#sucursal").val(),
        detalles: obtenerDetallesRecepcion()
    };
    
    // Guardar
    ejecutarAjax("controladores/recepcion_equipo.php", "guardar=" + JSON.stringify(datos));
    mensajeOk("Recepción guardada correctamente");
    mostrarListarRecepcionEquipo();
}

function obtenerDetallesRecepcion() {
    let detalles = [];
    $("#tabla_detalles tbody tr").each(function() {
        detalles.push({
            cod_equipo: $(this).find("td:eq(0)").text(),
            observacion: $(this).find("td:eq(2)").text()
        });
    });
    return detalles;
}

function agregarDetalle() {
    if ($("#equipo_lst").val() === "") {
        mensajeError("Debe seleccionar un equipo");
        return;
    }
    
    let cod_equipo = $("#equipo_lst").val();
    let descripcion_equipo = $("#equipo_lst option:selected").text();
    let observacion = $("#observacion").val();
    
    let fila = '<tr>' +
               '<td>' + cod_equipo + '</td>' +
               '<td>' + descripcion_equipo + '</td>' +
               '<td>' + observacion + '</td>' +
               '<td><button class="btn btn-danger btn-sm" onclick="$(this).closest(\'tr\').remove()">Eliminar</button></td>' +
               '</tr>';
               
    $("#tabla_detalles tbody").append(fila);
    $("#observacion").val("");
}

function anularRecepcion(cod_recepcion) {
    Swal.fire({
        title: "¿Está seguro?",
        text: "Va a anular la recepción " + cod_recepcion,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, anular",
        cancelButtonText: "No, cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            ejecutarAjax("controladores/recepcion_equipo.php", "anular=" + cod_recepcion);
            mensajeOk("Recepción anulada correctamente");
            mostrarListarRecepcionEquipo();
        }
    });
}

function imprimirRecepcion(cod_recepcion) {
    window.open("reportes/recepcion_equipo_print.php?cod_recepcion=" + cod_recepcion, "_blank");
}

function cancelarRecepcion() {
    Swal.fire({
        title: "ATENCIÓN",
        text: "¿Desea cancelar la operación?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Sí",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            mostrarListarRecepcionEquipo();
        }
    });
}