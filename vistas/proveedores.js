//function mostrarListarProveedores() {
//    let contenido = dameContenido("modelo/referenciales/proveedores/listar.php");
//    $(".contenido-principal").html(contenido);
//    cargarTablaProveedores("#proveedores_tb");
//    console.log(contenido);
//}
////----------------------------------------------------------------------------
////----------------------------------------------------------------------------
////----------------------------------------------------------------------------
//function mostrarAgregarProveedores() {
//    let contenido = dameContenido("modelo/referenciales/proveedores/agregar.php");
//    $(".contenido-principal").html(contenido);
//    cargarListaCiudad("#ciudad_lst");
//}
////---------------------------------------------------------------------------
////---------------------------------------------------------------------------
////---------------------------------------------------------------------------
//function cancelarProveedores() {
//    Swal.fire({
//        title: "Atencion",
//        text: "Desea cancelar la operacion?",
//        icon: "question",
//        showCancelButton: true,
//        confirmButtonColor: "#3085d6",
//        cancelButtonColor: "#d33",
//        cancelButtonText: "No",
//        confirmButtonText: "Si"
//    }).then((result) => {
//        if (result.isConfirmed) {
//            let contenido = dameContenido("modelo/referenciales/proveedores/listar.php");
//            $(".contenido-principal").html(contenido);
//            cargarTablaProveedores();
//        }
//    });
//
//}
//
//
////-----------------------------------------------------------------------------
////-----------------------------------------------------------------------------
////-----------------------------------------------------------------------------
//function guardarProveedores2() {
//
//   
//        // Validar 'Nombre y Apellido del Proveedor'
//        if ($("#nom_ape_prov").val().trim().length === 0) {
//            mensaje_dialogo_info_ERROR("Atención", "Debes ingresar el Nombre del Proveedor");
//            return false;
//        }
//    
//        // Validar 'Razón Social'
//        if ($("#razon_social_prov").val().trim().length === 0) {
//            mensaje_dialogo_info_ERROR("Atención", "Debes ingresar la Razón Social del Proveedor");
//            return false;
//        }
//    
//        // Validar 'Teléfono'
//        if ($("#telefono_prov").val().trim().length === 0) {
//            mensaje_dialogo_info_ERROR("Atención", "Debes ingresar el Teléfono del Proveedor");
//            return false;
//        }
//    
//        // Validar que el teléfono sea numérico
//        if (isNaN($("#telefono_prov").val().trim())) {
//            mensaje_dialogo_info_ERROR("Atención", "El Teléfono debe ser un valor numérico");
//            return false;
//        }
//    
//        // Validar 'RUC'
//        if ($("#ruc_prov").val().trim().length === 0) {
//            mensaje_dialogo_info_ERROR("Atención", "Debes ingresar el RUC del Proveedor");
//            return false;
//        }
//    
//        // Validar 'Dirección'
//        if ($("#direccion_prov").val().trim().length === 0) {
//            mensaje_dialogo_info_ERROR("Atención", "Debes ingresar la Dirección del Proveedor");
//            return false;
//        }
//    
//        // Validar 'Email'
//        if ($("#email_prov").val().trim().length === 0) {
//            mensaje_dialogo_info_ERROR("Atención", "Debes ingresar el Email del Proveedor");
//            return false;
//        }
//    
//        // Validar que el email tenga un formato válido
//        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//        if (!emailPattern.test($("#email_prov").val().trim())) {
//            mensaje_dialogo_info_ERROR("Atención", "El Email ingresado no es válido");
//            return false;
//        }
//    
//        // Validar 'Ciudad'
//        if ($("#ciudad_lst").val() === "" || $("#ciudad_lst").val() === "0") {
//            mensaje_dialogo_info_ERROR("Atención", "Debes seleccionar una Ciudad");
//            return false;
//        }
//    
//     
//    
//    
//    
//
//   
//    
//
//    let data = {
//        'nom_ape_prov': $("#nom_ape_prov").val(),
//        'razon_social_prov': $("#razon_social_prov").val(),
//        'telefono_prov': $("#telefono_prov").val(),
//        'ruc_prov': $("#ruc_prov").val(),
//        'direccion_prov': $("#direccion_prov").val(),
//        'email_prov': $("#email_prov").val(),
//        'cod_ciudad': $("#ciudad_lst").val(),
//        'estado': $("#estado").val()
//        
//    };
//    console.log(data);
//
//
//    
//    if($("#id_proveedor").val() === "0"){
//        
//        let response = ejecutarAjax("controladores/proveedores.php", "guardar=" + JSON.stringify(data));
//       console.log(response);
//         mensaje_confirmacion("Guardado correctamente", "Guardado");
//        mostrarListarProveedores();
//    }else{
//        data = {...data , 'cod_proveedor' : $("#id_proveedor").val()};
//        console.log(data);
//         let response = ejecutarAjax("controladores/proveedores.php",
//         "actualizar=" + JSON.stringify(data));
//        console.log(response);
//        mensaje_confirmacion("Actualizado Correctamente","Actualizado");
//        mostrarListarProveedores();
//    }
//       
//       
//
//
//}
////------------------------------------------------------------------------------
////------------------------------------------------------------------------------
////------------------------------------------------------------------------------
//function cargarTablaProveedores() {
//    let data = ejecutarAjax("controladores/proveedores.php", "leer=1");
//
//
//    let fila = "";
//    if (data === "0") {
//        fila = "NO HAY REGISTROS";
//    } else {
//        let json_data = JSON.parse(data);
//        json_data.map(function (item) {
//            fila += `<tr>`;
//            fila += `<td>${item.cod_proveedor}</td>`;
//            fila += `<td>${item.nom_ape_prov}</td>`;
//            fila += `<td>${item.razon_social_prov}</td>`;
//            fila += `<td>${item.telefono_prov}</td>`;
//            fila += `<td>${item.ruc_prov}</td>`;
//            fila += `<td>${item.direccion_prov}</td>`;
//            fila += `<td>${item.email_prov}</td>`;
//            fila += `<td>${item.estado}</td>`;
//            fila += `<td>${item.descripcion_ciud}</td>`;
//            fila += `<td>
//                        <button class='btn btn-warning editar-proveedores'><i class='fa fa-edit'></i></button>
//                        <button class='btn btn-danger eliminar-proveedores'><i class='fa fa-trash'></i></button>
//                    </td>`;
//            fila += `</tr>`;
//        });
//    }
//
//    $("#proveedores_tb").html(fila);
//}
//
////------------------------------------------------------------------------------
////------------------------------------------------------------------------------
////------------------------------------------------------------------------------
//$(document).on("click", ".editar-proveedores", function (evt) {
//    let id = $(this).closest("tr").find("td:eq(0)").text();
//    Swal.fire({
//        title: "Atencion",
//        text: "Desea editar el registro?",
//        icon: "question",
//        showCancelButton: true,
//        confirmButtonColor: "#3085d6",
//        cancelButtonColor: "#d33",
//        cancelButtonText: "No",
//        confirmButtonText: "Si"
//    }).then((result) => {
//        if (result.isConfirmed) {
//            let response = ejecutarAjax("controladores/proveedores.php", "id=" + id);
//            console.log(response);
//            if (response === "0") {
//
//            } else {
//                let json_data = JSON.parse(response);
//                //abrir ventana
//                let contenido = dameContenido("modelo/referenciales/proveedores/agregar.php");
//                $(".contenido-principal").html(contenido);
//                
//
//    
//                //cargar los datos
//                let json_registro = JSON.parse(response);
//                $("#id_proveedor").val(id);
//                $("#nom_ape_prov").val(json_registro['nom_ape_prov']);
//                $("#razon_social_prov").val(json_registro['razon_social_prov']);
//                $("#telefono_prov").val(json_registro['telefono_prov']);
//                $("#ruc_prov").val(json_registro['ruc_prov']);
//                $("#direccion_prov").val(json_registro['direccion_prov']);
//                $("#email_prov").val(json_registro['email_prov']);
//                $("#estado").val(json_registro['estado']);
//                cargarListaCiudad("#ciudad_lst");
//                $("#ciudad_lst").val(json_registro['cod_ciudad']);
//            }
//        }
//    });
//});
////------------------------------------------------------------------------------
////------------------------------------------------------------------------------
////------------------------------------------------------------------------------
//$(document).on("click", ".eliminar-proveedores", function (evt) {
//    let id = $(this).closest("tr").find("td:eq(0)").text();
//    Swal.fire({
//        title: "Atencion",
//        text: "Desea eliminar el registro?",
//        icon: "question",
//        showCancelButton: true,
//        confirmButtonColor: "#3085d6",
//        cancelButtonColor: "#d33",
//        cancelButtonText: "No",
//        confirmButtonText: "Si"
//    }).then((result) => {
//        if (result.isConfirmed) {
//            let response = ejecutarAjax("controladores/proveedores.php",
//            "eliminar=" + id);
//            
//            if(registro.includes("Cannot delete or update a parent row")){
//                registro = ejecutarAjax("controladores/ciudad.php", "desactivar=" + id);
//                console.log(registro);
//            }
//
//            console.log(response);
//            mensaje_confirmacion("Eliminado Correctamente", "Eliminado");
//            mostrarListarProveedores();
//        }
//    });
//});
////------------------------------------------------------------------------------
////------------------------------------------------------------------------------
////------------------------------------------------------------------------------
//$(document).on("keyup", "#b_proveedores", function (evt) {
//    let data = ejecutarAjax("controladores/proveedores.php", "leer_descripcion_proveedores="+$("#b_proveedores").val());
//
//
//    let fila = "";
//    if (data === "0") {
//        fila = "NO HAY REGISTROS";
//    } else {
//        let json_data = JSON.parse(data);
//        json_data.map(function (item) {
//            fila += `<tr>`;
//            fila += `<td>${item.cod_proveedor}</td>`;
//            fila += `<td>${item.nom_ape_prov}</td>`;
//            fila += `<td>${item.razon_social_prov}</td>`;
//            fila += `<td>${item.telefono_prov}</td>`;
//            fila += `<td>${item.ruc_prov}</td>`;
//            fila += `<td>${item.direccion_prov}</td>`;
//            fila += `<td>${item.email_prov}</td>`;
//            fila += `<td>${item.estado}</td>`;
//            fila += `<td>${item.cod_ciudad}</td>`;
//            fila += `<td>
//                        <button class='btn btn-warning editar-proveedores'><i class='fa fa-edit'></i> Editar</button>
//                        <button class='btn btn-danger eliminar-proveedores'><i class='fa fa-trash'></i> Eliminar</button>
//                    </td>`;
//            fila += `</tr>`;
//        });
//    }
//
//    $("#proveedores_tb").html(fila);
//});
////-------------------------------------------------------------------------------
////-------------------------------------------------------------------------------
////-------------------------------------------------------------------------------
//function imprimirProveedor(){
//    window.open("modelo/referenciales/proveedores/print.php");
//}
//
//
//function cargarListaServicioConPrecio(componente) {
//    let datos = ejecutarAjax("controladores/proveedores.php", "leer_proveedores_activos=1");
//    console.log(datos);
//    let option = "";
//    if (datos === "0") {
//        option = "<option value='0'>Selecciona un Proveedor</option>";
//    } else {
//        option = "<option value='0'>Selecciona un Proveedor</option>";
//        let json_datos = JSON.parse(datos);
//        json_datos.map(function (item) {
//            option += `<option value='${item.id_servicio}-${item.costo}'>${item.descripcion}</option>`;
//
//
//        });
//    }
//    $(componente).html(option);
//}

function cargarListaProveedoresActivos(componente) {
    let datos = ejecutarAjax("controladores/proveedores.php", "leer_activo=1");
    console.log(datos);
    let option = "";
    if (datos === "0") {
        option = "<option value='0'>Selecciona un Proveedor</option>";
    } else {
        option = "<option value='0'>Selecciona un Proveedor</option>";
        let json_datos = JSON.parse(datos);
        json_datos.map(function (item) {
            option += `<option value='${item.cod_proveedor}'>${item.razon_social} | RUC: ${item.ruc_prov}</option>`;


        });
    }
    $(componente).html(option);
}

