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
            @if($cuenta->valor<1)  
            <div class="alert alert-success">
                <strong><i class="far fa-grin-wink"></i> <i class="fas fa-thumbs-up"></i> ¡¡ No Registra Deuda !!</strong>
            </div>  
            @endif   
        <!-- TABLE -->
        <div class="row my-5">
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card shadow mb-4">
                  <div class="card-header py-3">
                      <h6 class="h5 mb-0 font-weight-bold text-success">
                        <i class="fas fa-dollar-sign"></i> Pagos Realizados
                      </h6>
                  </div>
                  <div class="card-body">
                      @if(count($cuenta->pagos)>0)
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
                              @foreach($cuenta->pagos as $pago)
                                <tr>
                                  <td>{{$pago->created_at->format('d/m/Y')}}</td>
                                  <td>{{$pago->valor}}</td>
                                  <td>
                                    <a href="{{route('pdf.pago', [$pago->id])}}" target="_black" class="btn btn-primary btn-circle btn-sm mx-1" title="DESCARGAR"><i class="fas fa-download fa-sm text-white-50"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#myModal" onclick="editPago('{{$pago->id}}', '{{$pago->valor}}')" class="btn btn-success btn-circle btn-sm mx-1" title="EDITAR PAGO">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#confimarModal" onclick="deletePago('{{$pago->id}}')" class="btn btn-danger btn-circle btn-sm mx-1" title="ELIMINAR PAGO">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                      </div>
                      @else
                          <strong class="text-danger">No Realizo nungun Pago...</strong>
                      @endif
                  </div>
              </div>
          </div>

            <div class="col-xl-6 col-md-6 mb-4">  
                <div class="col-xl-12 col-md-12 mb-3">
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
                              $ <span class="h1 font-weight-bold text-gray-700">{{$cuenta->valor}}</span>
                          </div>
                      </div>
                  </div>
              </div>         
                <div class="card shadow mb-4 border-bottom-success">
                    <div class="card-header">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 mb-0 font-weight-bold text-success"><i class="fas fa-money-check-alt"></i> Boleta de Pago</div>
                            </div>
                        </div>
                    </div>    
                    <div class="card-body">
                        <form class="user" method="POST" action="{{route('pago.register')}}">
                          @csrf
                          <input type="hidden" name="cuenta_id" id="cuenta_id" value="{{$cuenta->id}}">
                          <div class="form-group">
                            <input type="number" class="form-control form-control-user" name="monto" required placeholder="$ Monto" >
                          </div>                          
                          <hr>
                          <button type="submit" class="btn btn-success btn-user btn-block" @if($cuenta->valor<1)disabled @endif>
                            <span class="h5 mb-0 font-weight-bold">Registrar Pago</span>
                          </button>
                          <hr>                    
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">
                  <div class="h5 mb-0 font-weight-bold text-info">
                    <i class="fas fa-money-check-alt"></i> Editar Pago
                  </div>
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                  <form class="user" action="{{route('compra.editPago')}}" method="POST">
                      @csrf
                          <input type="hidden" name="pago_id" id="pago" value="">
                          <div class="form-group">
                            <input type="number" class="form-control form-control-user" name="monto" id="monto" required placeholder="$ Monto" >
                          </div>                          
                          <hr>
                          <button type="submit" class="btn btn-info btn-user btn-block">
                            <span class="h5 mb-0 font-weight-bold">Actualizar Pago</span>
                          </button>                  
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

         <div class="modal fade" id="confimarModal">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">
                  <div class="h5 mb-0 font-weight-bold text-danger">
                    <i class="fas fa-skull-crossbones"></i> Eliminar Pago
                  </div>
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                  <form class="user" action="{{route('pago.delete')}}" method="POST">
                    @csrf
                    <strong>¿Realmente desea Eliminar el Pago?</strong>
                    <input type="hidden" name="pago_id" value="" id="e-pago">
                    <br clear="my-3">
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-danger" >Eliminar</button>
                    </div>      
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

        
    @endsection

