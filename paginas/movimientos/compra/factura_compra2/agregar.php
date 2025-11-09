<div class="container-fluid card" style="padding: 30px;">
    <?php session_start();?>
<div class="row">
    <input type="text" id="id_cliente" hidden value="0">
    <div class="col-md-12">
        <h3>Agregar Factura de  Compra</h3>
    </div>
    <div class="col-md-12">
        <hr> 
    </div>
    <div class="col-md-1">
        <label for="">Codigo</label>
        <input type="text" id="cod" class="form-control" readonly>
    </div>
    <div class="col-md-4">
        <label for="">Sucursal</label>
        <select name="" id="sucursal" class="form-control"></select>
    </div>
    <div class="col-md-4">
        <label for="">Usuario</label>
        <input type="text" id="usuario" class="form-control" readonly value="<?= $_SESSION['nombre_user']?>">
          
    </div>
    <div class="col-md-3">
        <label for="">Fecha</label>
        <input type="date" name="" id="fecha" class="form-control"></input>
    </div>

    <div class="col-md-1">
        <label for="">Nro de Factura</label>
        <input type="text" name="" id="nro_factura" class="form-control"></input>
    </div>
    <div class="col-md-4">
        <label>Orden de Compra</label>
        <select name="" id="orden_compra" class="form-control"></select>
    </div>

    <div class="col-md-4">
        <label for="">Timbrado</label>
        <input type="text" name="" id="timbrado" class="form-control"></input>
    </div>
    <div class="col-md-3">
        <label for="">Fecha Vencimiento</label>
        <input type="date" name="" id="fecha_vencimiento_tim" class="form-control"></input>
    </div>
    <div class="col-md-4">
        <label>Proveedor</label>
        <select name="" id="proveedor_compra" class="form-control"></select>
    </div>
     <div class="col-md-4">
        <label>Deposito</label>
        <select name="" id="deposito" class="form-control"></select>
    </div>
    <div class="col-md-4">
    <label for="condicion">Condición</label>
    <select name="condicion" id="condicion" class="form-control">
        <option value="credito">Crédito</option>
        <option value="contado">Contado</option>
    </select>
</div>

    
       <div class="col-md-12">
        <hr> 
    </div>
    <div class="col-md-4">
        <label>Material</label>
        <select name="" id="material" class="form-control"></select>
    </div>
    <div class="col-md-3">
        <label>Cantidad</label>
        <input type="text" value="1" class="form-control formatear-numero" id="cantidad_txt">
    </div>
    <div class="col-md-3">
        <label>Costo</label>
        <input type="text" value="1" class="form-control formatear-numero" id="costo_txt">
    </div>
    <div class="col-md-2">
        <label>Operaciones</label>
        <button class="form-control btn btn-primary" onclick="agregarTablaOrdenCompra(); return false;">Agregar</button>
    </div>
       <div class="col-md-12">
        <hr> 
    </div>
    
 
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                     <th>#</th>
                     <th>Material</th>
                     <th>Tipo</th>
                     <th>Costo</th>
                     <th>Cantidad</th>
                     <th>Exento</th>
                     <th>I.V.A. 5%</th>
                     <th>I.V.A. 10%</th>
                    
                </tr>
            </thead>
            <tbody id="factura_compra"></tbody>
            <tfoot>
                <tr>
                    <th colspan="5">Sub Totales</th>
                    <th id="total_exenta">0</th>
                    <th id="total_iva5">0</th>
                    <th id="total_iva10">0</th>
                </tr>
                <tr>
                    <th colspan="7">Total General</th>
                    <th id="total">0</th>
                </tr>
            </tfoot>
        </table>
    </div>
    
   
   
    <div class="col-md-12">
        <hr> 
    </div>
    <div class="col-md-3">
        <button class="form-control btn btn-success" onclick="guardarFacturaCompra(); return false;"><i class="fa fa-save"></i> Guardar</button>
    </div>
    <div class="col-md-3">
        <button class="form-control btn btn-danger" onclick="cancelarFacturaCompra(); return false;"><i class="fa fa-ban"></i> Cancelar</button>
    </div>
</div>
</div>
