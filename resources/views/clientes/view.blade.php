    @extends('layouts.app')

    @section('content')
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    <strong>CLIENTE N° #{{$cliente->dni}} - ({{$cliente->nombre}} {{$cliente->apellido}})</strong>
                    <input type="hidden" id="cuenta" value="{{$cliente->cuenta->id}}">
                </h1>
            </div>
             <hr> 
             @if($cliente->cuenta->valor<1)  
            <div class="alert alert-success">
                <strong><i class="far fa-grin-wink"></i> <i class="fas fa-thumbs-up"></i> ¡¡ No Registra Deuda !!</strong>
            </div>  
            @else
            <div class="alert alert-danger">
                <strong><i class="far fa-frown"></i> <i class="fas fa-thumbs-down"></i> ¡¡ Registra Deuda !!</strong>
            </div>
            @endif   
              <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                
                <div class="col-xl-4 col-md-6 mb-4" id="compra">
                  <div class="card border-left-primary shadow h-100 py-2 caja">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="h5 mb-0 font-weight-bold text-primary">Realizar Compra</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4" id="pago">
                  <div class="card border-left-success shadow h-100 py-2 caja">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="h5 mb-0 font-weight-bold text-success">Realizar Pago</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4" id="editar">
                  <div class="card border-left-info shadow h-100 py-2 caja">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="h5 mb-0 font-weight-bold text-info">Editar Cuenta</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>        
        </div>
        <hr>
        <!-- TABLE -->
        <div class="row my-5">
            <div class="col-xl-8 col-md-6 mb-4">           
                <div class="card shadow mb-4 border-bottom-info">
                    <div class="card-header">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 mb-0 font-weight-bold text-info"><i class="fa fa-address-card"></i> Datos de Cliente</div>
                            </div>
                        </div>    
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <i class="fas fa-user"></i> <strong>Nombre</strong><br> 
                                 <span class="mx-3">{{$cliente->nombre}} {{$cliente->apellido}}</span>
                            </div>
                            <div class="form-group">
                                <i class="fas fa-mobile-alt"></i> <strong>Teléfono</strong><br>
                                <span class="mx-3">{{$cliente->telefono}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <i class="fas fa-envelope"></i> <strong>Correo Electrónico</strong><br>
                                 <span class="mx-3">{{$cliente->email}}</span>
                            </div>
                            <div class="form-group">
                                <i class="fas fa-map-marker-alt"></i> <strong>Dirección</strong><br>
                                <span class="mx-3">{{$cliente->direccion}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-bottom-danger shadow h-100 py-2">
                    <div class="card-header">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="h5 mb-0 font-weight-bold text-danger">Deuda</div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-comment-dollar fa-2x text-danger"></i>
                            </div>
                          </div>
                    </div>
                    <div class="card-body d-flex align-items-center">
                        <div class="h1 font-weight-bold text-gray-800 mx-auto"> 
                            $ <span class="h1 font-weight-bold text-gray-700">{{$cliente->cuenta->valor}}</span>
                        </div>
                    </div>
                </div>
            </div>              
        </div>
    @endsection

