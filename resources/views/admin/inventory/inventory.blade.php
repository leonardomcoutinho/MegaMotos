@extends('layouts.dashboard')
@section('title', 'Estoque - MEGA MOTOS')
    
@section('dashboard')
    <div class="m-3">
        <div class="add-estoque w-100 text-end">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Lançar Item</button>
        </div>
        <table class="table text-start table-striped">
            <thead>
              <tr>
                <th scope="col">Cod.</th>
                <th scope="col">Produto</th>
                <th scope="col">Und. Medida</th>
                <th scope="col">Qtd.</th>
                <th scope="col">Média Preço</th>                
              </tr>
            </thead>
            <tbody>             
              @foreach ($inventory as $item)
              <tr>                
                <td>{{$item->id}}</td>
                <td>{{$item->product->name}}</td>
                <td>{{$item->unit}}</td>
                <td>{{$item->qtd}}</td>
                <td>R$: {{$item->price_buy}}</td>                                
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
