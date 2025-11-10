function mostrarListarProveedor() {
    let contenido = dameContenido("paginas/referenciales/proveedor/listar.php");
    $("#contenido-principal").html(contenido);
    cargarTablaProveedors();
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarProveedores() {
    let contenido = dameContenido("paginas/referenciales/proveedor/agregar.php");
    $("#contenido-principal").html(contenido);
    cargarListaCiudad("#ciudad_lst");
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function guardarProveedor() {
    if ($("#nombre").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar un nombre", "ATENCION");
        return;
    }
    if ($("#razon_social").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar una razon social", "ATENCION");
        return;
    }
    if ($("#ruc").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar una RUC", "ATENCION");
        return;
    }
    if ($("#telefono").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar un numero de telefono", "ATENCION");
        return;
    }
    
    if ($("#ciudad_lst").val() === "0") {
        mensaje_dialogo_info_ERROR("Debes seleccionar una ciudad", "ATENCION");
        return;
    }
    
    if ($("#direccion").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar una direccion", "ATENCION");
        return;
    }
    
    
    

    let data = {
        'nombre_apellido_prov': $("#nombre").val(),
        'razon_social': $("#razon_social").val(),
        'ruc_prov': ($("#ruc").val()),
        'telefono_prov': ($("#telefono").val()),
        'direccion_prov': $("#direccion").val(),
        'cod_ciudad': $("#ciudad_lst").val(),
        'estado': 'ACTIVO'
    };

    if ($("#id_proveedor").val() === "0") {
        let response = ejecutarAjax("controladores/proveedores.php",
                "guardar=" + JSON.stringify(data));
        console.log(response);
        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");
    } else {
        data = {...data, 'cod_proveedor': $("#id_proveedor").val()};
        let response = ejecutarAjax("controladores/proveedores.php",
                "actualizar=" + JSON.stringify(data));
        console.log(response);
        mensaje_dialogo_info("Actualizado Correctamente", "EXITOSO");

    }
    mostrarListarProveedor();
}
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
function cargarTablaProveedors(componente) {
    let data = ejecutarAjax("controladores/proveedores.php",
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
                item.cod_proveedor,
                item.nombre_apellido_prov,
                item.razon_social,
                item.ruc_prov,
                item.telefono_prov,
                item.ciudad,
                item.direccion_prov,
                item.estado,
                `<button class="btn btn-warning editar-proveedor">
                        Editar
                    </button>
                <button class="btn btn-danger desactivar-proveedor">
                        Desactivar/Eliminar
                    </button>`
            ]);
        });

        cargarDataTable("#proveedor_tb", filas);
    }

}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
$(document).on("click", ".editar-proveedor", function (evt) {
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
            let registro = ejecutarAjax("controladores/proveedores.php", "registroPorId=" + id);
            //console.log(registro);
            if (registro === "0") {

            } else {
                let json_registro = JSON.parse(registro);
                let contenido = dameContenido("paginas/referenciales/proveedor/agregar.php");
                $("#contenido-principal").html(contenido);

                cargarListaCiudad("#ciudad_lst");
                $("#id_proveedor").val(json_registro['cod_proveedor']);
                $("#nombre_anterior").val(json_registro['nombre_apellido_prov']);
                $("#nombre").val(json_registro['nombre_apellido_prov']);
                $("#razon_social").val(json_registro['razon_social']);
                $("#ruc").val((json_registro['ruc_prov']));
                $("#telefono").val((json_registro['telefono_prov']));
                $("#ciudad_lst").val(json_registro['cod_ciudad']);
                $("#direccion").val(json_registro['direccion_prov']);
                $("#estado_lst").val(json_registro['estado']);
            }
        }
    });
});
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
$(document).on("click", ".desactivar-proveedor", function (evt) {
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
            let registro = ejecutarAjax("controladores/proveedores.php", "eliminar=" + id);
            console.log(registro);
            if (registro.includes("Cannot delete or update a parent row")) {
                registro = ejecutarAjax("controladores/proveedores.php", "desactivar=" + id);
                console.log(registro);
            }

            mensaje_dialogo_info("Operacion realizada correctamente", "ATENCION");
            mostrarListarProveedor();

        }
    });
});