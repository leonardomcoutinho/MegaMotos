@extends('layouts.dashboard')
@section('title', 'Tarifas - MEGA MOTOS')
    
@section('dashboard')
    <h3 class="text-center my-3">Percentual Tarifas da Maquina de Cartão</h3>

    <div class="mx-3"> 
            <div class="tariff-tt">
                @foreach ($tariff as $t)
                    <div class="card-tariff rounded input-group input-group-sm mb-3">
                        <span class="input-group-text" id="basic-addon3">{{$t->name}}</span>
                        <input type="text" class="form-control" id="basic-url" name="percentual" value="{{$t->percentual}}">
                        <a href="{{route('edit_tariff', $t->id)}}" class="btn btn-danger"><i class="bi bi-pencil"></i></a>
                    </div>
                @endforeach
            </div>      
            
    </div>

@endsection
