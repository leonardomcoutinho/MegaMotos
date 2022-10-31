@extends('layouts.dashboard')
@section('title', 'Estoque - MEGA MOTOS')
    
@section('dashboard')
    <div class="m-3">
        <div class="add-estoque w-100 text-end">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Lançar Item</button>
        </div>
        <h3 class="text-center">Produtos em Estoque</h3>
          @foreach ($inventory as $item)
          <div class="card card-invent card-cat my-3" style="
          @if($item->qtd > 0)
            background-color: rgb(206, 255, 204, 0.2);
          @endif
          @if($item->qtd < 0)
            background-color: rgb(255, 204, 204, 0.2);
          @endif
          @if($item->qtd == 0)
            background-color: rgb(255, 239, 204, 0.2);
          @endif
          ">
            <div class="card-section d-flex align-items-center ">
              <div class="cod px-2 text-center">{{$item->id}}</div>
              <div class="prod-and-desc px-2">
                <h6 class="prod">{{$item->product->name}}</h6>
                <div class="desc">{{$item->product->description}}</div>
              </div>
              <div class="unit-med">{{$item->unit}}</div>
              <div class="qtd-prod text-center mx-2 px-2">
                <div><strong>Qtd</strong></div>
                <div>{{$item->qtd}}</div>
              </div>
              <div class="price-med text-center px-2">
                <div class="td-prices"><strong>M. Preço Compra</strong></div>
                <div class="td-prices">R$: {{$item->price_buy}}</div>
              </div>
            </div>
          </div>
          @endforeach
          
    </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Estoque</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('store_inventory')}}" method="POST">
                @csrf                
                          
                <div class="mb-3">                  
                    <select class="form-select" name="product_id" id="product_id">
                        <option selected>Selecione o Produto</option>                    
                        @foreach ($products as $item)
                        <option value="{{$item->id}}">{{$item->name}} - {{$item->description}}</option>
                        @endforeach
                    </select>         
                </div>
                <div class="row">
                    <div class="col-4 mb-3">
                        <label for="unit" class=" form-labelps-3">Unidade Medida</label>
                      <input type="text" class="form-control" id="unit" name="unit" placeholder="Ex: LT, PCT">
                    </div>
                    <div class="col-4 mb-3">
                        <label for="qtd" class=" form-labelps-3">Quantidade</label>
                      <input type="text" class="form-control" id="qtd" name="qtd">
                    </div>
                    <div class="col-4 mb-3">
                        <label for="price_buy" class=" form-labelps-3">Preço und.</label>
                        <input type="text" class="form-control" id="price_buy" name="price_buy">
                      </div>
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

@endsection
