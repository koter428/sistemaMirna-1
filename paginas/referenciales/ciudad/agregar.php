<div class="row" style="background: #fff; padding: 30px;">
    <input type="text" id="id_ciduad" value="0" hidden> 
    <input type="text" id="nombre_anterior" value="0" hidden> 
  <div class="col-md-10">
        <h2>Agregar Ciudad</h2>
    
    </div>
     <div class="col-md-12">
        <hr>
    </div>
    
    <div class="col-md-6">
        <label>Descripcion</label>
        <input type="text" id="descripcion" class="form-control">
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
        <button class="form-control btn btn-success"  onclick="guardarCiudad();">Guardar</button>
    </div>
    <div class="col-md-6">
        <button class="form-control btn btn-danger" onclick="mostrarListarCiudad();">Cancelar</button>
    </div>

</div>
