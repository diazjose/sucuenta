    @extends('layouts.app')

    @section('content')
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    <strong>CLIENTE N° #{{$cuenta->cliente->dni}} - ({{$cuenta->cliente->nombre}} {{$cuenta->cliente->apellido}})</strong>
                    <input type="hidden" value="{{$cuenta->id}}" id="cuenta">
                </h1>
                <a href="{{route('client.view', [$cuenta->cliente->id])}}" class="text-success"><img src="{{asset('img/volver.jpeg')}}" width="40"> Volver</a>
            </div>
             <hr> 
            @if(session('message'))
                <div class="alert alert-{{ session('status') }}">
                    <strong>{{ session('message') }}</strong>
                </div>  
            @endif     
        <!-- TABLE -->
        <div class="row my-5">
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card shadow mb-4">
                  <div class="card-header py-3">
                      <h6 class="h5 mb-0 font-weight-bold text-primary">
                        <i class="fas fa-shopping-bag"></i> Compras Realizadas
                      </h6>
                  </div>
                  <div class="card-body">
                      @if(count($cuenta->facturas)>0)
                      <div class="table-responsive">
                          <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead> 
                              <tr>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Accion</th>
                              </tr>
                            </thead>
                            <tbody class="text-center" id="tbody-factura">
                              @foreach($cuenta->facturas as $factura)
                                <tr>
                                  <td>{{$factura->created_at->format('d/m/Y')}}</td>
                                  <td>{{$factura->valor}}</td>
                                  <td>
                                    <a href="{{route('compra.boleta', [$factura->id])}}" class="btn btn-info btn-circle btn-sm mx-1">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                      </div>
                      @else
                          <strong class="text-danger">No Realizo nunguna Compra...</strong>
                      @endif
                  </div>
              </div>
          </div>

            <div class="col-xl-8 col-md-6 mb-4">           
                <div class="card shadow mb-4 border-bottom-primary">
                    <div class="card-header">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 mb-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"></i> Boleta de compra</div>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="text-primary" title="AGREGAR PRENDA" data-toggle="modal" data-target="#myModal">
                                  <i class="fas fa-cart-plus fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>    
                    <div class="card-body">
                        <div class="table-responsive" id="table-boleta">
                          <table class="table text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead> 
                              <tr>
                                <th>Prenda</th>
                                <th>Cant.</th>
                                <th>Precio Uni.</th>
                                <th>Importe</th>
                              </tr>
                            </thead>
                            <tbody id="tbody">                                
                                                  
                            </tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <th>Total: </th>
                                <th id="total"></th>
                            </tr> 
                          </table>
                          <div class="col-md-6">
                            <div class="btn btn-primary btn-user btn-block" id="registerVenta">
                                <strong class="h5 mb-0 font-weight-bold">Registrar Compra</strong>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <!--FORM -->
        <form method="POST" id="form-factura">
            @csrf
            <input type="hidden" name="cuenta_id" id="cuenta_id" value="{{$cuenta->id}}">
            <input type="hidden" name="total" id="total-factura" value="">
        </form>

        <form method="POST" id="form-producto">
            @csrf
            <input type="hidden" name="factura_id" id="factura_id" value="">
            <input type="hidden" name="prenda" id="prenda-producto" value="">
            <input type="hidden" name="precio" id="precio-producto" value="">
            <input type="hidden" name="cantidad" id="cantidad-producto" value="">
        </form>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">
                  <div class="h5 mb-0 font-weight-bold text-primary">
                    <i class="fas fa-cart-plus"></i> Agragar Prenda
                  </div>
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                  <form class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="prenda" required placeholder="prenda" style="text-transform:uppercase;">
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="number" class="form-control form-control-user" value="1" required id="cantidad" placeholder="cantidad" style="text-transform:uppercase;">
                        </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="precio" placeholder="precio" style="text-transform:uppercase;" required>
                      </div>
                    </div>
                    <hr>
                    <div class="btn btn-primary btn-user btn-block" id="add-prenda" data-dismiss="modal">
                        <strong class="h5 mb-0 font-weight-bold">Agregar a la Boleta</strong>
                    </div>                    
                    <hr>                    
                  </form>
              </div>
              
              <!-- Modal footer
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
               -->
            </div>
          </div>
        </div>

        <div class="modal fade" id="boletaModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">
                  <div class="h5 mb-0 font-weight-bold text-primary">
                    <i class="fas fa-clipboard-list"></i> Boleta de Compra
                  </div>
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                  <div class="table-responsive" id="table-boleta">
                      <table class="table text-center" id="dataTable" width="100%" cellspacing="0">
                          <thead> 
                              <tr>
                                <th>Prenda</th>
                                <th>Cant.</th>
                                <th>Precio Uni.</th>
                                <th>Importe</th>
                              </tr>
                          </thead>
                          <tbody id="tbody-boleta">                                
                                                  
                          </tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <th>Total: </th>
                                <th id="total-edit"></th>
                            </tr> 
                      </table>
                      <div class="col-md-6">
                          <div class="btn btn-success btn-user btn-block" id="registerVenta">
                              <strong class="h5 mb-0 font-weight-bold">Editar Compra</strong>
                          </div>
                      </div>
                  </div>

              </div>
            </div>
          </div>
        </div>
    @endsection

