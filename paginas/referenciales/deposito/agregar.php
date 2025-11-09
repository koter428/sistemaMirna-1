<div class="row" style="background: #fff; padding: 30px;">
    <input type="text" id="id_deposito" value="0" hidden> 
    <input type="text" id="nombre_anterior" value="0" hidden> 
  <div class="col-md-10">
        <h2>Agregar Deposito</h2>
    
    </div>
     <div class="col-md-12">
        <hr>
    </div>
    
    <div class="col-md-4">
        <label>Nombre</label>
        <input type="text" id="nombre" class="form-control">
    </div>
    <div class="col-md-4">
        <label>Sucursal</label>
        <select type="text" id="sucursal" class="form-control"></select>
    </div>

    <div class="col-md-4">
        <label>Estado</label>
        <select  id="estado" class="form-control">
            <option value="ACTIVO">ACTIVO</option>
            <option value="INACTIVO">INACTIVO</option>
        </select>
    </div>
  
    



    <div class="col-md-12">
        <hr>
    </div>
    
    <div class="col-md-6">
        <button class="form-control btn btn-success"  onclick="guardarDeposito();">Guardar</button>
    </div>
    <div class="col-md-6">
        <button class="form-control btn btn-danger" onclick="mostrarListarDeposito();">Cancelar</button>
    </div>

</div>
