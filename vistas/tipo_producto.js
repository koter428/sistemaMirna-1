function cargarListaTipoProducto(componente){
    let data = ejecutarAjax("controladores/tipo_producto.php",
            "dame_activos=1");
    //console.log(data);
    let option = "";
    option = "<option value='0'>Selecciona un tipo de producto</option>";
    if (data === "0") {
    } else {
        let json_data = JSON.parse(data);
        json_data.map(function (item) {
            option += `<option value='${item.cod_tipo_prod}'>${item.descripcion}</option>`;
        });
    }
    
    $(componente).html(option);
}
