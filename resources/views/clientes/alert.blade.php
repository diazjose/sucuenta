    @extends('layouts.app')

    @section('content')
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    BUSCAR CLIENTES
                </h1>
                <a href="{{route('client.list')}}" class="btn btn-primary"><strong><i class="fas fa-users"></i> Listar Todos</strong></a>
            </div>
             <hr> 
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="h5 mb-0 font-weight-bold text-danger">
                          <i class="fas fa-search"></i> Clientes en Alerta de Pago {{$fecha}}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                              <thead> 
                                <tr>
                                  <th>#</th>
                                  <th>Apellido</th>
                                  <th>Nombre</th>
                                  <th>DNI</th>
                                  <th>Correo Electrico</th>
                                  <th>Telefono</th>
                                  <th>VER</th>
                                </tr>
                              </thead>
                              <tbody>
                                  @php($i=1)
                                  @foreach($clientes as $cliente)
                                    @php($comp = strtotime($fecha))
                                    @php($date = 0)
                                    @if(count($cliente->pagos)>0)
                                      @foreach($cliente->pagos as $pago)
                                          @php($date = strtotime($pago->created_at->format('d-m-Y')))
                                          @break
                                      @endforeach
                                      @if($date <= $comp)
                                      <tr>
                                        <td>{{$i}}</td>
                                        <td>{{ $cliente->cliente->apellido }}</td>
                                        <td>{{ $cliente->cliente->nombre }}</td>
                                        <td>{{ $cliente->cliente->dni }}</td>
                                        <td>{{ $cliente->cliente->email }}</td>
                                        <td>{{ $cliente->cliente->telefono }}</td>
                                        <td>
                                          <a href="{{route('client.view',[$cliente->cliente->id])}}" class="btn btn-info btn-circle btn-sm mx-1">
                                              <i class="fas fa-info-circle"></i>
                                          </a>
                                        </td>
                                      </tr>
                                      @php($i++)
                                      @endif
                                    @else
                                      @foreach($cliente->facturas as $factura)
                                          @php($date = strtotime($factura->created_at->format('d-m-Y')))
                                          @break
                                      @endforeach
                                      @if($date <= $comp)
                                      <tr>
                                        <td>{{$i}}</td>
                                        <td>{{ $cliente->cliente->apellido }}</td>
                                        <td>{{ $cliente->cliente->nombre }}</td>
                                        <td>{{ $cliente->cliente->dni }}</td>
                                        <td>{{ $cliente->cliente->email }}</td>
                                        <td>{{ $cliente->cliente->telefono }}</td>
                                        <td>
                                          <a href="{{route('client.view',[$cliente->cliente->id])}}" class="btn btn-info btn-circle btn-sm mx-1">
                                              <i class="fas fa-info-circle"></i>
                                          </a>
                                        </td>
                                      </tr>
                                      @php($i++)
                                      @endif
                                    @endif
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
          </div>
     
        </div>
    @endsection

    @section('script')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection