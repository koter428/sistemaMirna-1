function mostrarListarProducto() {
    let contenido = dameContenido("modelo/referenciales/producto/listar.php");
    $("#contenido-principal").html(contenido);
    cargarTablaProductoes();
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarProductoes() {
    let contenido = dameContenido("modelo/referenciales/producto/agregar.php");
    $("#contenido-principal").html(contenido);
    cargarListaCategorias("#categoria_lst");
    cargarListaTipoProducto("#tipo_lst");
    cargarListaMarca("#marca_lst");
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function guardarProducto() {
    if ($("#nombre").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar un nombre", "ATENCION");
        return;
    }
    if ($("#descripcion").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar una descripcion", "ATENCION");
        return;
    }
    if ($("#precio").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar un precio", "ATENCION");
        return;
    }
    if ($("#costo").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar un costo", "ATENCION");
        return;
    }
    if ($("#categoria_lst").val() === "0") {
        mensaje_dialogo_info_ERROR("Debes seleccionar una categoria", "ATENCION");
        return;
    }
    if ($("#tipo_lst").val() === "0") {
        mensaje_dialogo_info_ERROR("Debes seleccion un tipo", "ATENCION");
        return;
    }
    if ($("#marca_lst").val() === "0") {
        mensaje_dialogo_info_ERROR("Debes seleccion una marca", "ATENCION");
        return;
    }
    let costo = quitarDecimalesConvertir($("#costo").val());
    let precio = quitarDecimalesConvertir($("#precio").val());
    if (costo <= 0) {
        mensaje_dialogo_info_ERROR("El costo no puede ser menor o igual a cero", "ATENCION");
        return;
    }
    if (precio <= 0) {
        mensaje_dialogo_info_ERROR("El precio no puede ser menor o igual a cero", "ATENCION");
        return;
    }
    if (costo > precio) {
        mensaje_dialogo_info_ERROR("El costo no puede ser mayor al precio de venta", "ATENCION");
        return;
    }

    let data = {
        'descripcion_prod': $("#descripcion").val(),
        'nombre_prod': $("#nombre").val(),
        'precio_prod': quitarDecimalesConvertir($("#precio").val()),
        'costo_prod': quitarDecimalesConvertir($("#costo").val()),
        'cod_categoria': $("#categoria_lst").val(),
        'cod_tipo_prod': $("#tipo_lst").val(),
        'cod_marca': $("#marca_lst").val(),
        'estado': 'ACTIVO'
    };

    if ($("#id_producto").val() === "0") {
        let response = ejecutarAjax("controladores/producto.php",
                "guardar=" + JSON.stringify(data));
        console.log(response);
        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");
    } else {
        data = {...data, 'cod_producto': $("#id_producto").val()};
        let response = ejecutarAjax("controladores/producto.php",
                "actualizar=" + JSON.stringify(data));
        console.log(response);
        mensaje_dialogo_info("Actualizado Correctamente", "EXITOSO");

    }
    mostrarListarProducto();
}
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
function cargarTablaProductoes(componente) {
    let data = ejecutarAjax("controladores/producto.php",
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
                item.cod_producto,
                item.nombre_prod,
                formatearNumero(item.precio_prod),
                formatearNumero(item.costo_prod),
                item.nombre_cat,
                item.tipo_producto,
                item.descripcion_marc,
                item.estado,
                `<button class="btn btn-warning editar-producto">
                        Editar
                    </button>
                <button class="btn btn-danger desactivar-producto">
                        Desactivar/Eliminar
                    </button>`
            ]);
        });

        cargarDataTable("#producto_tb", filas);
    }

}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
$(document).on("click", ".editar-producto", function (evt) {
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
            let registro = ejecutarAjax("controladores/producto.php", "registroPorId=" + id);
            if (registro === "0") {

            } else {
                let json_registro = JSON.parse(registro);
                let contenido = dameContenido("modelo/referenciales/producto/agregar.php");
                $("#contenido-principal").html(contenido);

                cargarListaCategorias("#categoria_lst");
                cargarListaTipoProducto("#tipo_lst");
                cargarListaMarca("#marca_lst");
                $("#id_producto").val(json_registro['cod_producto']);
                $("#nombre_anterior").val(json_registro['nombre_prod']);
                $("#nombre").val(json_registro['nombre_prod']);
                $("#descripcion").val(json_registro['descripcion_prod']);
                $("#precio").val(formatearNumero(json_registro['precio_prod']));
                $("#costo").val(formatearNumero(json_registro['costo_prod']));
                $("#categoria_lst").val(json_registro['cod_categoria']);
                $("#tipo_lst").val(json_registro['cod_tipo_prod']);
                $("#marca_lst").val(json_registro['cod_marca']);
                $("#estado_lst").val(json_registro['estado']);
            }
        }
    });
});
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
$(document).on("click", ".desactivar-producto", function (evt) {
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
            let registro = ejecutarAjax("controladores/producto.php", "eliminar=" + id);
            console.log(registro);
            if (registro.includes("Cannot delete or update a parent row")) {
                registro = ejecutarAjax("controladores/producto.php", "desactivar=" + id);
                console.log(registro);
            }

            mensaje_dialogo_info("Operacion realizada correctamente", "ATENCION");
            mostrarListarProducto();

        }
    });
});

function cargarListasProducto(componente) {
    let datos = ejecutarAjax("controladores/producto.php", "leer_producto_activos=1");
    console.log(datos);
    let option = "<option value='0'>Selecciona un producto</option>";
    if (datos !== "0") {
        let json_datos = JSON.parse(datos);
        json_datos.map(function (item) {
            option += `<option value='${item.cod_producto}'>${item.nombre_prod} | Tipo: ${item.descripcion_prod}</option>`;
        });
    }
    $(componente).html(option);
}