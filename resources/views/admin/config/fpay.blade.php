@extends('layouts.dashboard')
@section('title', 'Venda/Serviço - MEGA MOTOS')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
@endsection

@section('dashboard')
    <div class="fpay">
        <h3 class="my-3 text-center">Formas de Recimento</h3>
        <div class="create-cat text-end me-5 d-flex justify-content-end align-items-center">
            <form action="{{route('store_fpay')}}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="fpay" placeholder="Nome da f. recebimento">
                    <button class="input-group-text btn btn-danger" type="submit" id="basic-addon2">Criar F. Recebimento</button>
                </div>
            </form>
        </div>
        <div class="list-cat mx-3">
            @foreach ($fpay as $f)
                <div class="card-cat mb-3 d-flex border rounded justify-content-between align-items-center">
                    <h6>{{$f->fpay}}</h6>
                    <div> 
                        <form action="{{route('destroy_fpay', $f->id)}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning">Excluir</button>
                        </form>                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection  
