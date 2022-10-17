@extends('layouts.dashboard')
@section('title', 'Produtos - MEGA MOTOS')
    
@section('dashboard')
<div class="products m-3">
  <div class="w-100 text-end">
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Cadastrar Produto</button> 
  </div>
  <div class="title mt-3">
    <h3 class="text-center">Lista de produtos</h3> 
  </div>
  <table class="table">
      <thead>
        <tr>
          <th scope="col">Cod.</th>
          <th scope="col">Nome do Produto</th>
          <th scope="col">Descrição</th>
          <th scope="col">Fornecedor</th>
          <th scope="col">Marca</th>
          <th scope="col">Categoria</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{$product->id}}</th>
            <td>{{$product->name}}</th>
            <td>{{$product->description}}</th>
            <td>{{$product->provider}}</th>
            <td>{{$product->brand}}</th>            
            <td>{{$product->category->category}}</th>            
        </tr>  
        @endforeach      
      </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Produto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('store_products')}}" method="POST">
            @csrf
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="name" name="name" placeholder="name@example.com">
              <label for="name">Nome do Produto</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="description" name="description" placeholder="name@example.com">
              <label for="description">Descrição</label>
            </div>
            <div class="row">
              <div class="col-6 form-floating mb-3">
                <input type="text" class="form-control" id="provider" name="provider" placeholder="name@example.com">
                <label for="provider" class="ps-4">Fornecedor</label>
              </div>
              <div class="col-6 form-floating mb-3">
                <input type="text" class="form-control" id="brand" name="brand" placeholder="name@example.com">
                <label for="brand" class="ps-4">Marca</label>
              </div>
            </div>
                        
            <div class="mb-3">
              <select class="form-select" name="category_id">
                <option selected>Selecione a categoria</option>
                @foreach ($category as $item)
                  <option value="{{$item->id}}">{{$item->category}}</option>
                @endforeach
              </select>         
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>        
      </div>
    </div>
  </div>
</div>         
{{-- <script src="/js/load.js"></script> --}}
@endsection
