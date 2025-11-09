function cargarListaTipoPago(componente){
    let data = ejecutarAjax("controladores/tipo_pago.php",
            "dame_activos=1");
    //console.log(data);
    let option = "";
    if (data === "0") {
    } else {
        let json_data = JSON.parse(data);
        json_data.map(function (item) {
            option += `<option value='${item.cod_tipo_pago}'>${item.descripcion}</option>`;
        });
    }
    
    $(componente).html(option);
}
