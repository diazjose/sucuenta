@extends('layouts.app')

@section('content')

    <div class="col-md-8 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">
                    Bienvenidos a <img src="{{ asset('img/sucuenta2.png') }}" width="30">
                    <span><strong class="text-primary">SuCuenta <sup>2</sup></strong></span>
                </h4>
            </div>
            <div class="card-body">
                <p>
                    <span><strong class="text-primary">SuCuenta <sup>2</sup></strong></span>: Es un sistema deseñado con la ultima tecnologia web. Con el podras llevar un control estricto de todas las cuentas corrientes de tu negocio sin perdida de tiempo ni de dinero.
                </p>
                <p>
                    Ademas tendras la posibilidad de tener tu cartera de clientes con un solo click, posibilitando un busqueda  precisa y rapida de lo que nesecites saber de los mismo.
                </p>
                <p class="mb-0">
                    No pierdas mas tiempo y comenza a usar <span><strong class="text-primary">SuCuenta <sup>2</sup></strong></span> ya.
                </p>
            </div>
        </div>
    </div>        
@endsection

