<div class="row" style="background: #fff; padding: 30px;">
    <input type="text" id="id_proveedor" value="0" hidden> 
    <input type="text" id="nombre_anterior" value="0" hidden> 
  <div class="col-md-10">
        <h2>Agregar Proveedor</h2>
    
    </div>
     <div class="col-md-12">
        <hr>
    </div>
    
    <div class="col-md-6">
        <label>Nombre</label>
        <input type="text" id="nombre" class="form-control">
    </div>
    <div class="col-md-6">
        <label>Razon Social</label>
        <input type="text" id="razon_social" class="form-control">
    </div>
    <div class="col-md-6">
        <label>R.U.C.</label>
        <input type="text" id="ruc" class="form-control">
    </div>
    <div class="col-md-6">
        <label>Telefono</label>
        <input type="text" id="telefono" class="form-control">
    </div>
    <div class="col-md-6">
        <label>Ciudad</label>
        <select id="ciudad_lst" class="form-control"></select>
    </div>
    <div class="col-md-6">
        <label>Direccion</label>
        <input type="text" id="direccion" class="form-control">
    </div>
    <div class="col-md-6">
        <label>Estado</label>
        <select  id="estado_lst" class="form-control">
            <option value="ACTIVO">ACTIVO</option>
            <option value="INACTIVO">INACTIVO</option>
        </select>
    </div>
  
    



    <div class="col-md-12">
        <hr>
    </div>
    
    <div class="col-md-6">
        <button class="form-control btn btn-success"  onclick="guardarProveedor();">Guardar</button>
    </div>
    <div class="col-md-6">
        <button class="form-control btn btn-danger" onclick="mostrarAgregarCiudades();">Cancelar</button>
    </div>

</div>
