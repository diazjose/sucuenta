@extends('layouts.app')

@section('content')

    <div class="col-md-10 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-success">
                    <i class="fa fa-address-card"></i> Editar Cliente
                </h4>
            </div>
            <div class="card-body">
                <form class="user" method="POST" action="{{route('client.apdate')}}">
                    @csrf
                    <input type="hidden" name="cliente_id" value="{{$cliente->id}}">
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" name="nombre" class="form-control form-control-user @error('nombre') is-invalid @enderror"" value="{{ $cliente->nombre }}" id="nombre" placeholder="Nombre" style="text-transform:uppercase;">
                        @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      <div class="col-sm-6">
                        <input type="text" name="apellido" class="form-control form-control-user @error('apellido') is-invalid @enderror"" value="{{ $cliente->apellido }}" id="apellido" placeholder="Apellidos" style="text-transform:uppercase;">
                        @error('apellido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="text" name="dni" class="form-control form-control-user @error('dni') is-invalid @enderror"" value="{{ $cliente->dni }}" id="dni" placeholder="DNI">
                        @error('dni')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="text" name="telefono" class="form-control form-control-user @error('telefono') is-invalid @enderror"" value="{{ $cliente->telefono }}" id="telefono" placeholder="Telefono">
                        @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      <div class="col-sm-6">
                        <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror"" value="{{ $cliente->email }}" id="email" placeholder="Correo Electronico">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="text" name="direccion" class="form-control form-control-user" id="direccion" value="{{ $cliente->direccion }}" placeholder="Direccion" style="text-transform:uppercase;">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success btn-user btn-block">
                        <strong>REGISTRAR CLIENTE</strong>
                    </button>
                    
                    <hr>
                    
                  </form>
            </div>
        </div>
    </div>        
@endsection

