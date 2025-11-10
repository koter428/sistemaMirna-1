function mostrarListarCiudad() {
    let contenido = dameContenido("paginas/referenciales/ciudad/listar.php");
    $("#contenido-principal").html(contenido);
    cargarTablaCiudades();
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarCiudades() {
    let contenido = dameContenido("paginas/referenciales/ciudad/agregar.php");
    $("#contenido-principal").html(contenido);
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function guardarCiudad() {
    if ($("#descripcion").val().trim().length === 0) {
        mensaje_dialogo_info_ERROR("Debes ingresar una descripcion", "ATENCION");
        return;
    }

    let data = {
        'descripcion': $("#descripcion").val(),
        'estado': 'ACTIVO'
    };

    if ($("#id_ciduad").val() === "0") {
        let response = ejecutarAjax("controladores/ciudad.php",
                "guardar=" + JSON.stringify(data));
        console.log(response);
        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");
    } else {
        data = {...data, 'cod_ciudad': $("#id_ciduad").val()};
        let response = ejecutarAjax("controladores/ciudad.php",
                "actualizar=" + JSON.stringify(data));
        console.log(response);
        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");

    }
    mostrarListarCiudad();
}
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
function cargarTablaCiudades(componente) {
    let data = ejecutarAjax("controladores/ciudad.php",
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
                item.cod_ciudad,
                item.descripcion,
                item.estado,
                `<button class="btn btn-warning editar-ciudad">
                        Editar
                    </button>
                <button class="btn btn-danger desactivar-ciudad">
                        Desactivar
                    </button>`
            ]);
        });

        cargarDataTable("#ciudad_tb", filas);
    }

}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
$(document).on("click", ".editar-ciudad", function (evt) {
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
            let registro = ejecutarAjax("controladores/ciudad.php", "registroPorId=" + id);
            if (registro === "0") {

            } else {
                let json_registro = JSON.parse(registro);
                let contenido = dameContenido("paginas/referenciales/ciudad/agregar.php");
                $("#contenido-principal").html(contenido);


                $("#id_ciduad").val(json_registro['cod_ciudad']);
                $("#nombre_anterior").val(json_registro['descripcion']);
                $("#descripcion").val(json_registro['descripcion']);
                $("#estado_lst").val(json_registro['estado']);
            }
        }
    });
});
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
$(document).on("click", ".desactivar-ciudad", function (evt) {
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
            //eliminar
            let registro = ejecutarAjax("controladores/ciudad.php", "eliminar=" + id);
            console.log(registro);
            //en caso que no pueda eliminar
            if(registro.includes("Cannot delete or update a parent row")){
                registro = ejecutarAjax("controladores/ciudad.php", "desactivar=" + id);
                console.log(registro);
            }
            
            mensaje_dialogo_info("Operacion realizada correctamente", "ATENCION");
            mostrarListarCiudad();
            
        }
    });
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function cargarListaCiudad(componente){
    let data = ejecutarAjax("controladores/ciudad.php",
            "dame_activos=1");
    console.log(data);
    let option = "";
    option = "<option value='0'>Selecciona una ciudad</option>";
    if (data === "0") {
    } else {
        let json_data = JSON.parse(data);
        json_data.map(function (item) {
            option += `<option value='${item.cod_ciudad}'>${item.descripcion}</option>`;
        });
    }
    
    $(componente).html(option);
}