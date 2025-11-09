function cargarListaMarca(componente){
    let data = ejecutarAjax("controladores/marca.php",
            "dame_activos=1");
    //console.log(data);
    let option = "";
    option = "<option value='0'>Selecciona una marca</option>";
    if (data === "0") {
    } else {
        let json_data = JSON.parse(data);
        json_data.map(function (item) {
            option += `<option value='${item.cod_marca}'>${item.descripcion_marc}</option>`;
        });
    }
    
    $(componente).html(option);
}
