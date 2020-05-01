@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
            <strong>BOLETA DE COMPRA</strong>
            </h1>
            <a href="{{route('compra.index', [$factura->cuenta->id])}}" class="text-success"><img src="{{asset('img/volver.jpeg')}}" width="40"> Volver</a>
        </div>
        <hr> 
        @if(session('message'))
        <div class="alert alert-{{ session('status') }}">
            <strong>{{ session('message') }}</strong>
        </div>  
        @endif    
        <!-- TABLE -->
        <div class="row my-5">
            <div class="col-xl-12 col-md-12 mb-4">
              <div class="card shadow mb-4">
                  <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                      <h6 class="h5 mb-0 font-weight-bold text-primary">
                        <i class="fas fa-clipboard-list"></i> Compras Realizadas el {{$factura->created_at->format('m/d/Y')}}
                      </h6>
                      <a href="{{route('pdf.boleta', [$factura->id])}}" target="_black" class="btn btn-primary"><i class="fas fa-download fa-sm text-white-50"></i> <strong>Generar PDF</strong></a>
                  </div>
                  <div class="card-body">
                      @if(count($factura->productos)>0)
                      <div class="table-responsive">
                          <table class="table text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead> 
                              <tr>
                                <th>Prenda</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Importe</th>
                                <th>Accion</th>
                              </tr>
                            </thead>
                            <tbody class="text-center" id="tbody-factura">
                              @foreach($factura->productos as $producto)
                                <tr>
                                  <td>{{$producto->denominacion}}</td>
                                  <td>{{$producto->cantidad}}</td>
                                  <td>{{$producto->valor}}</td>
                                  @php($importe = $producto->valor*$producto->cantidad)
                                  <td>{{ $importe }}</td>
                                  <td>
                                    <a href="#" data-toggle="modal" data-target="#myModal" onclick="editPrenda('{{$producto->id}}', '{{$producto->denominacion}}', '{{$producto->cantidad}}', '{{$producto->valor}}')" class="btn btn-success btn-circle btn-sm mx-1" title="EDITAR PRENDA">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#confimarModal" onclick="deletePrenda('{{$producto->id}}')" class="btn btn-danger btn-circle btn-sm mx-1" title="ELIMINAR PRENDA">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <th>Total: </th>
                                <th>{{$factura->valor}}</th>
                                <td><a href="#"></a></td>
                            </tr> 
                          </table>                          
                      </div>
                      @else
                          <strong class="text-danger">La Boleta no tiene ninguna prenda cargada...</strong>
                      @endif
                  </div>
              </div>
          </div>
      </div>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">
                  <div class="h5 mb-0 font-weight-bold text-success">
                    <i class="fas fa-tshirt"></i> Editar Prenda
                  </div>
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                  <form class="user" action="{{route('compra.editPrenda')}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <input type="text" name="prenda" value="" class="form-control form-control-user" id="prenda" required placeholder="prenda" style="text-transform:uppercase;">
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0"> 
                        <input type="number" name="cantidad" value="" class="form-control form-control-user" required id="cantidad" placeholder="cantidad" style="text-transform:uppercase;">
                        </div>
                      <div class="col-sm-6">
                        <input type="text" name="precio" value="" class="form-control form-control-user" id="precio" placeholder="precio" style="text-transform:uppercase;" required>
                      </div>
                    </div>
                    <hr>
                    <input type="hidden" name="producto_id" value="" id="producto">
                    <input type="hidden" name="factura_id" value="{{$factura->id}}" id="factura">
                    
                    <button type="submit" class="btn btn-success btn-user btn-block">
                        <strong class="h5 mb-0 font-weight-bold"><i class="fas fa-pencil-alt"></i> Editar Prenda</strong>
                    </button><!--
                    <div class="btn btn-success btn-user btn-block" id="add-prenda" data-dismiss="modal">
                        <strong class="h5 mb-0 font-weight-bold">Editar Prenda</strong>
                    </div>       -->             
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
                    <i class="fas fa-skull-crossbones"></i> Editar Prenda
                  </div>
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                  <form class="user" action="{{route('compra.eliminarPrenda')}}" method="POST">
                    @csrf
                    <strong>¿Realmente desea Eliminar esta Prenda?</strong>
                    <input type="hidden" name="producto_id" value="" id="e-producto">
                    <input type="hidden" name="factura_id" value="{{$factura->id}}">
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

