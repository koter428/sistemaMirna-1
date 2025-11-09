<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Nueva Recepción de Equipo</h3>
                </div>
                <div class="card-body">
                    <form id="form_recepcion" class="form">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Código:</label>
                                    <input type="text" class="form-control" id="cod_recepcion" readonly>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fecha:</label>
                                    <input type="date" class="form-control" id="fecha_recepcion" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Sucursal:</label>
                                    <select class="form-control" id="sucursal" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>N° Serie:</label>
                                    <input type="text" class="form-control" id="nro_serie" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cliente:</label>
                                    <select class="form-control" id="cliente" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Técnico:</label>
                                    <select class="form-control" id="tecnico" required>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Estado del Equipo:</label>
                                    <select class="form-control" id="estado" required>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4>Detalles del Equipo</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Equipo:</label>
                                    <select class="form-control" id="equipo">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Observación:</label>
                                    <input type="text" class="form-control" id="observacion">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-success btn-block" onclick="agregarDetalle()">
                                        Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table id="tabla_detalles" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Equipo</th>
                                            <th>Observación</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" onclick="guardarRecepcion()">Guardar</button>
                                <button type="button" class="btn btn-danger" onclick="cancelarRecepcion()">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>