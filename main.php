
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="stylesheet" href="assets/libs/datatable/datatables.min.css" />
  <link rel="stylesheet" href="assets/libs/sweetalert2/sweetalert2.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="assets/images/logos/dark-logo.svg" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Inicio</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./index.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Escritorio</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Informes Referenciales</span>
            </li>
<!--            <li class="sidebar-item">
                <a class="sidebar-link" href="#" onclick="mostrarListarCiudad(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Ciudad</span>
              </a>
            </li>-->
            <li class="sidebar-item">
                <a class="sidebar-link" href="#" onclick="mostrarListarProducto(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Productos</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#" onclick="mostrarListarCliente(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Clientes</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#" onclick="mostrarListarDeposito(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Deposito</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#" onclick="mostrarListarProveedor(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Proveedor</span>
              </a>
            </li>
            
           
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">MODULO COMPRAS</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" onclick="mostrarListarPedidoCompra(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Pedido Compras</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" onclick="mostrarListarPresupuestoCompra(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Presupuesto Proveedor</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" onclick="mostrarListarOrdenCompra(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Orden de Compra</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#" aria-expanded="false" onclick="mostrarListarFacturaCompra(); return false;">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Factura</span>
              </a>
            </li>            
            <li class="sidebar-item">
                <a class="sidebar-link" onclick="mostrarListarNotaCreditoCompra(); return false;" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Nota de Credito/Debito</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" onclick="mostrarListarRemision(); return false;" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Nota de Remisión</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" onclick="mostrarListarAjusteStock(); return false;" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Ajuste de Stock</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" onclick="mostrarListarInforme(); return false;" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Informes de Movimientos</span>
              </a>
            </li>
                       <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">MODULO SERVICIOS</span>
          <li class="sidebar-item">
              
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" onclick="mostrarListarRecepcionEquipo(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">recepcion de equipo</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" onclick="mostrarListarOrdenCompra(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Diagnostico de los Equipos</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#" onclick="mostrarListarRecepcionEquipo(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Presupuesto</span>
              </a>
            </li>
           <li class="sidebar-item">
              <a class="sidebar-link" href="#" onclick="mostrarListarOrdenCompra(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Generar orden de servicios</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" onclick="mostrarListarNotaCreditoCompra(); return false;" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Registrar Insumos Utilizados</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" onclick="mostrarListarRemision(); return false;" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Finalizacion y Entrega del Equipo</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" onclick="mostrarListarAjusteStock(); return false;" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Registrar Reclamos</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" onclick="mostrarListarInforme(); return false;" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Informes de Movimientos</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">MODULO VENTAS</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" onclick="mostrarListarPedidoCompra(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">apertura y Generar cierre de caja</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" onclick="mostrarListarPresupuestoCompra(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Recaudaciones a Depositar</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" onclick="mostrarListarOrdenCompra(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Registrar pedidos de Cliente</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#" aria-expanded="false" onclick="mostrarListarFacturaCompra(); return false;">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Facturas y cuentas a cobrar</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" onclick="mostrarListarNotaCreditoCompra(); return false;" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Registrar cobros</span>
              </a>
            </li>
            
            <li class="sidebar-item">
                <a class="sidebar-link" onclick="mostrarListarNotaCreditoCompra(); return false;" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Nota de Credito/Debito</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" onclick="mostrarListarRemision(); return false;" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Generar arqueo</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" onclick="mostrarListarInforme(); return false;" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Informes de Movimientos</span>
              </a>
            </li>
            <ul>
           <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Administracion</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" onclick="mostrarListarPedidoCompra(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Gestion de Usuarios</span>
              </a>
            </li>
          </ul>
          <li class="sidebar-item">
              <a class="sidebar-link" href="#" onclick="mostrarListarPedidoCompra(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Manual de Usuarios</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" onclick="mostrarListarPedidoCompra(); return false;" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Manual de Seguridad</span>
              </a>
            </li>
          </ul>
          <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
            <div class="d-flex">
              <div class="unlimited-access-title me-3">
                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Upgrade to pro</h6>
                <a href="https://adminmart.com/product/modernize-bootstrap-5-admin-template/" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
              </div>
              <div class="unlimited-access-img">
                <img src="assets/images/backgrounds/rocket.png" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                      <a href="controladores/cerrarSesion.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Cerrar Sesion</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid" id="contenido-principal">
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Sales Overview</h5>
                  </div>
                  <div>
                    <select class="form-select">
                      <option value="1">March 2025</option>
                      <option value="2">April 2025</option>
                      <option value="3">May 2025</option>
                      <option value="4">June 2025</option>
                    </select>
                  </div>
                </div>
                <div id="chart"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-lg-12">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                  <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Yearly Breakup</h5>
                    <div class="row align-items-center">
                      <div class="col-8">
                        <h4 class="fw-semibold mb-3">₲36,358</h4>
                        <div class="d-flex align-items-center mb-3">
                          <span
                            class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                            <i class="ti ti-arrow-up-left text-success"></i>
                          </span>
                          <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                          <p class="fs-3 mb-0">last year</p>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="me-4">
                            <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                            <span class="fs-2">2023</span>
                          </div>
                          <div>
                            <span class="round-8 bg-light-primary rounded-circle me-2 d-inline-block"></span>
                            <span class="fs-2">2023</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-center">
                          <div id="breakup"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <!-- Monthly Earnings -->
                <div class="card">
                  <div class="card-body">
                    <div class="row alig n-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold"> Monthly Earnings </h5>
                        <h4 class="fw-semibold mb-3">₲6,820</h4>
                        <div class="d-flex align-items-center pb-1">
                          <span
                            class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                            <i class="ti ti-arrow-down-right text-danger"></i>
                          </span>
                          <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                          <p class="fs-3 mb-0">last year</p>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-end">
                          <div
                            class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-currency-dollar fs-6"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="earning"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      
     
        
      </div>
    </div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/js/dashboard.js"></script>
  <script src="assets/libs/datatable/datatables.min.js"></script>
  <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
  <style>
      .CodeMirror-code, .extras{
          display: none;
      }
  </style>
  
  <script src="vistas/util.js"></script>
  <script src="vistas/ciudad.js"></script>
  <script src="vistas/categoria.js"></script>
  <script src="vistas/tipo_producto.js"></script>
  <script src="vistas/marca.js"></script>
  <script src="vistas/producto.js"></script>
  <script src="vistas/cliente.js"></script>
  <script src="vistas/deposito.js"></script>
  <script src="vistas/sucursal.js"></script>
  <script src="vistas/tipo_pago.js"></script>
  <script src="vistas/vehiculo.js"></script>
  
  <script src="vistas/proveedores.js"></script>
  <script src="vistas/proveedor.js"></script>
  <script src="vistas/pedido.js"></script>
  <script src="vistas/presupuesto.js"></script>
  <script src="vistas/orden_compra.js"></script>
  <script src="vistas/factura_compra.js"></script>
  <script src="vistas/nota_credito_compra.js"></script>
  <script src="vistas/remision.js"></script>
  <script src="vistas/ajuste_stock.js"></script>
  <script src="vistas/informes.js"></script>
  <script src="vistas/recepcion_equipo.js"></script>
</body>

</html>