function mostrarListarDeposito() {
    let contenido = dameContenido("paginas/referenciales/deposito/listar.php");
    $("#contenido-principal").html(contenido);
    cargarTablaDepositos();
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarDeposito() {
    let contenido = dameContenido("paginas/referenciales/deposito/agregar.php");
    $("#contenido-principal").html(contenido);
    cargarListaSucursal("#sucursal_lst")
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function guardarDeposito() {

    if ($("#nombre").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar un nombre", "ATENCIÓN");
        return;
    }


    if ($("#sucursal_lst").val() === "0") {
        mensaje_dialogo_info_ERROR("Debes seleccionar una sucursal", "ATENCION");
        return;
    }
    
    

    let data = {
        'nombre_dep': $("#nombre").val(),
        'cod_sucursal': $("#sucursal_lst").val(),
        'estado': 'ACTIVO'
    };
console.log(data);
    if ($("#id_deposito").val() === "0") {
        let response = ejecutarAjax("controladores/deposito.php",
                "guardar=" + JSON.stringify(data));
        console.log(response);
        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");
    } else {
        data = {...data, 'cod_deposito': $("#id_deposito").val()};
        let response = ejecutarAjax("controladores/deposito.php",
                "actualizar=" + JSON.stringify(data));
        console.log(response);
        mensaje_dialogo_info("Actualizado Correctamente", "EXITOSO");

    }
    mostrarListarDeposito();
}
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
function cargarTablaDepositos(componente) {
    let data = ejecutarAjax("controladores/deposito.php",
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
                item.cod_deposito,
                item.nombre_dep,
                item.nombre_sucur,
                item.estado,
                `<button class="btn btn-warning editar-deposito">
                        Editar
                    </button>
                <button class="btn btn-danger desactivar-deposito">
                        Desactivar/Eliminar
                    </button>`
            ]);
        });

        cargarDataTable("#deposito_tb", filas);
    }

}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
$(document).on("click", ".editar-deposito", function (evt) {
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
            let registro = ejecutarAjax("controladores/deposito.php", "registroPorId=" + id);
            //console.log(registro);
            if (registro === "0") {

            } else {
                let json_registro = JSON.parse(registro);
                let contenido = dameContenido("paginas/referenciales/deposito/agregar.php");
                $("#contenido-principal").html(contenido);

                $("#id_deposito").val(json_registro['cod_deposito']);
                $("#nombre").val(json_registro['nombre_dep']);
                cargarListaSucursal("#sucursal_lst");
                $("#sucursal_lst").val(json_registro['cod_sucursal']);
            }
        }
    });
});
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
$(document).on("click", ".desactivar-deposito", function (evt) {
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
            let registro = ejecutarAjax("controladores/deposito.php", "eliminar=" + id);
            console.log(registro);
            if (registro.includes("Cannot delete or update a parent row")) {
                registro = ejecutarAjax("controladores/deposito.php", "desactivar=" + id);
                console.log(registro);
            }

            mensaje_dialogo_info("Operacion realizada correctamente", "ATENCION");
            mostrarListarDeposito();

        }
    });
});

function cargarListaDeposito(componente) {
    let datos = ejecutarAjax("controladores/deposito.php", "dame_activos=1");
    console.log(datos);
    let option = "<option value='0'>Selecciona una deposito</option>";
    if (datos !== "0") {
        let json_datos = JSON.parse(datos);
        json_datos.map(function (item) {
            option += `<option value='${item.cod_deposito}'>${item.nombre_dep}</option>`;
        });
    }
    $(componente).html(option);
}

