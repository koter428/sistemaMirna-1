function cargarListaCategorias(componente){
    let data = ejecutarAjax("controladores/categoria.php",
            "dame_activos=1");
    //console.log(data);
    let option = "";
    option = "<option value='0'>Selecciona una categoria</option>";
    if (data === "0") {
    } else {
        let json_data = JSON.parse(data);
        json_data.map(function (item) {
            option += `<option value='${item.cod_categoria}'>${item.nombre_cat}</option>`;
        });
    }
    
    $(componente).html(option);
}
