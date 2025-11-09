function mostrarListarCliente() {
    let contenido = dameContenido("modelo/referenciales/cliente/listar.php");
    $("#contenido-principal").html(contenido);
    cargarTablaClientes();
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarClientees() {
    let contenido = dameContenido("modelo/referenciales/cliente/agregar.php");
    $("#contenido-principal").html(contenido);
    cargarListaCiudad("#ciudad_lst");
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function guardarCliente() {
    if ($("#nombre").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar un nombre", "ATENCION");
        return;
    }
    if ($("#apellido").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar un apellido", "ATENCION");
        return;
    }
    if ($("#cedula").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar una cedula", "ATENCION");
        return;
    }
    if ($("#telefono").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar un numero de telefono", "ATENCION");
        return;
    }
    
    
    

    let data = {
        'nombre_cliente': $("#nombre").val(),
        'apellido_cliente': $("#apellido").val(),
        'cedula_cliente': quitarDecimalesConvertir($("#cedula").val()),
        'telefono_cliente': ($("#telefono").val()),
        'cod_ciudad': $("#ciudad_lst").val(),
        'direccion_cliente': $("#direccion").val(),
        'estado': 'ACTIVO'
    };

    if ($("#id_cliente").val() === "0") {
        let response = ejecutarAjax("controladores/cliente.php",
                "guardar=" + JSON.stringify(data));
        console.log(response);
        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");
    } else {
        data = {...data, 'cod_cliente': $("#id_cliente").val()};
        let response = ejecutarAjax("controladores/cliente.php",
                "actualizar=" + JSON.stringify(data));
        console.log(response);
        mensaje_dialogo_info("Actualizado Correctamente", "EXITOSO");

    }
    mostrarListarCliente();
}
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
function cargarTablaClientes(componente) {
    let data = ejecutarAjax("controladores/cliente.php",
            "dame_todo=1");
    console.log(data);
    let fila = "";
    if (data === "0") {
        fila = "No hay registros";
    } else {
        let json_data = JSON.parse(data);
        let filas = [];
        json_data.map(function (item) {
            filas.push([
                item.cod_cliente,
                item.nombre_cliente,
                item.apellido_cliente,
                item.cedula_cliente,
                item.telefono_cliente,
                item.ciudad,
                item.direccion_cliente,
                item.estado,
                `<button class="btn btn-warning editar-cliente">
                        Editar
                    </button>
                <button class="btn btn-danger desactivar-cliente">
                        Desactivar/Eliminar
                    </button>`
            ]);
        });

        cargarDataTable("#cliente_tb", filas);
    }

}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
$(document).on("click", ".editar-cliente", function (evt) {
    let id = $(this).closest("tr").find("td:eq(0)").text();
    console.log(id);

    Swal.fire({
        title: 'Edición',
        text: "Deseas editar el registro ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'No',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.isConfirmed) {
            let registro = ejecutarAjax("controladores/cliente.php", "registroPorId=" + id);
            //console.log(registro);
            if (registro === "0") {

            } else {
                let json_registro = JSON.parse(registro);
                let contenido = dameContenido("modelo/referenciales/cliente/agregar.php");
                $("#contenido-principal").html(contenido);

                cargarListaCiudad("#ciudad_lst");
                $("#id_cliente").val(json_registro['cod_cliente']);
                $("#nombre_anterior").val(json_registro['nombre_cliente']);
                $("#nombre").val(json_registro['nombre_cliente']);
                $("#apellido").val(json_registro['apellido_cliente']);
                $("#cedula").val(formatearNumero(json_registro['cedula_cliente']));
                $("#telefono").val((json_registro['telefono_cliente']));
                $("#ciudad_lst").val(json_registro['cod_ciudad']);
                $("#direccion").val(json_registro['direccion_cliente']);
                $("#estado_lst").val(json_registro['estado']);
            }
        }
    });
});
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
$(document).on("click", ".desactivar-cliente", function (evt) {
    let id = $(this).closest("tr").find("td:eq(0)").text();
    console.log(id);

    Swal.fire({
        title: 'Eliminación',
        text: "Deseas eliminar el registro ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'No',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.isConfirmed) {
            let registro = ejecutarAjax("controladores/cliente.php", "eliminar=" + id);
            console.log(registro);
            if (registro.includes("Cannot delete or update a parent row")) {
                registro = ejecutarAjax("controladores/cliente.php", "desactivar=" + id);
                console.log(registro);
            }

            mensaje_dialogo_info("Operacion realizada correctamente", "ATENCION");
            mostrarListarCliente();

        }
    });
});