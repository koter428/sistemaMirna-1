<div class="row" style="background: #fff; padding: 30px;">
    <input type="text" id="id_producto" value="0" hidden> 
    <input type="text" id="nombre_anterior" value="0" hidden> 
  <div class="col-md-10">
        <h2>Agregar Producto</h2>
    
    </div>
     <div class="col-md-12">
        <hr>
    </div>
    
    <div class="col-md-4">
        <label>Nombre</label>
        <input type="text" id="nombre" class="form-control">
    </div>
    <div class="col-md-4">
        <label>Descripcion</label>
        <input type="text" id="descripcion" class="form-control">
    </div>
    <div class="col-md-4">
        <label>Precio</label>
        <input type="text" id="precio" class="form-control fnum" value="0">
    </div>
    <div class="col-md-4">
        <label>Costo</label>
        <input type="text" id="costo" class="form-control fnum" value="0">
    </div>
    <div class="col-md-4">
        <label>Categoria</label>
        <select  id="categoria" class="form-control"></select>
    </div>
    <div class="col-md-4">
        <label>Tipo</label>
        <select  id="tipo" class="form-control"></select>
    </div>
    <div class="col-md-4">
        <label>Marca</label>
        <select  id="marca" class="form-control"></select>
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
        <button class="form-control btn btn-success"  onclick="guardarProducto();">Guardar</button>
    </div>
    <div class="col-md-6">
        <button class="form-control btn btn-danger" onclick="mostrarListarProducto();">Cancelar</button>
    </div>

</div>
