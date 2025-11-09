<div class="row" style="background: #fff; padding: 30px;">
    <input type="text" id="id_cliente" value="0" hidden> 
    <input type="text" id="nombre_anterior" value="0" hidden> 
  <div class="col-md-10">
        <h2>Agregar Cliente</h2>
    
    </div>
     <div class="col-md-12">
        <hr>
    </div>
    
    <div class="col-md-6">
        <label>Nombre</label>
        <input type="text" id="nombre" class="form-control">
    </div>
    <div class="col-md-6">
        <label>Apellido</label>
        <input type="text" id="apellido" class="form-control">
    </div>
    <div class="col-md-6">
        <label>Cedula</label>
        <input type="text" id="cedula" class="form-control fnum">
    </div>
    <div class="col-md-6">
        <label>Telefono</label>
        <input type="text" id="telefono" class="form-control">
    </div>
    <div class="col-md-6">
        <label>Ciudad</label>
        <select  id="ciudad" class="form-control">
            
        </select>
    </div>
    <div class="col-md-6">
        <label>Direccion</label>
        <input type="text" id="direccion" class="form-control">
    </div>
    <div class="col-md-6">
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
        <button class="form-control btn btn-success"  onclick="guardarCliente();">Guardar</button>
    </div>
    <div class="col-md-6">
        <button class="form-control btn btn-danger" onclick="mostrarListarCliente();">Cancelar</button>
    </div>

</div>
