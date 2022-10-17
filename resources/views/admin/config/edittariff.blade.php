@extends('layouts.dashboard')
@section('title', 'Tarifas - MEGA MOTOS')
    
@section('dashboard')
    <h3 class="text-center my-3">Tarifas da Maquina de Cartão</h3>

    <div class="mx-3">
        <div class="tariff-tt">
        <form action="{{route('update_tariff', $tariff->id)}}" method="POST">
            @csrf
            @method('PUT')                       
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="basic-addon3">{{$tariff->name}}</span>
                    <input type="text" class="form-control" id="basic-url" name="percentual" value="{{$tariff->percentual}}">                    
                </div> 
            <a href="{{route('tariff')}}" class="btn btn-warning"><i class="bi bi-arrow-return-left me-2"></i>Voltar</a>           
            <button type="submit" class="btn btn-danger text-end">Salvar Alterações</button>
            
        </form>
        </div>
    </div>
@endsection
