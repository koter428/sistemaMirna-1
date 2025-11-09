function cargarListaSucursal(componente){
    let data = ejecutarAjax("controladores/sucursal.php", "dame_activos=1");

    console.log(data);
    let option = "";
    if (data === "0") {
        option = "<option value='0'>Selecciona una sucursal</option>";
    } else {
        let json_data = JSON.parse(data);
        option = "<option value='0'>Selecciona una sucursal</option>";
        json_data.map(function (item) {
            option += `<option value="${item.cod_sucursal}">${item.nombre_sucur}  | ${item.direccion_sucur}  </option>`;
        });
    }
//    console.log(option);
    $(componente).html(option);
}