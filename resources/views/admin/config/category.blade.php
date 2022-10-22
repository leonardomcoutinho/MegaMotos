@extends('layouts.dashboard')
@section('title', 'Categorias - MEGA MOTOS')
    
@section('dashboard')
    <div class="category">
        <h3 class="my-3 text-center">Categorias</h3>
        <div class="create-cat text-end me-5 d-flex justify-content-end align-items-center">
            <form action="{{route('store_category')}}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="category" placeholder="Nome da Categoria">
                    <button class="input-group-text btn btn-danger" type="submit" id="basic-addon2">Criar Categoria</button>
                </div>
            </form>
        </div>
        <div class="list-cat mx-3">
            @foreach ($categories as $cat)
                <div class="card-cat mb-3 d-flex border rounded justify-content-between align-items-center">
                    <h6>{{$cat->category}}</h6>
                    <form action="{{route('destroy_category', $cat->id)}}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-warning">Excluir</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

@endsection
