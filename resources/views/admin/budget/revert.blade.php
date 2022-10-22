@extends('layouts.dashboard')
@section('title', 'Orçamento - MEGA MOTOS')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
@endsection

@section('dashboard')
    <div class="mx-3">
        <h3 class="text-center my-3 text-warning">Reverter Orçamento Nº {{$budget->id}}</h3>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Nº</th>                
                <th scope="col">Data</th>                
                <th scope="col">Cliente</th>                
                <th scope="col">Contato</th>                
                <th scope="col">Descrição </th>
                <th scope="col">Material</th>
                <th scope="col">Qtd</th>                        
                <th scope="col">Valor Prod</th>
                <th scope="col">M. Obra</th>
                <th scope="col">Desc</th>                        
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$budget->id}}</td>
                    <td>{{$budget->created_at}}</td>
                    <td>{{$budget->client}}</td>
                    <td>{{$budget->contact}}</td>
                    <td>{{$budget->description_service}}</td>
                    <td>
                        @foreach ($inventory as $i)
                            @if ($budget->product_1_id == $i->product_id || $budget->product_2_id == $i->product_id || $budget->product_3_id == $i->product_id || $budget->product_4_id == $i->product_id || $budget->product_5_id == $i->product_id || $budget->product_6_id == $i->product_id || $budget->product_7_id == $i->product_id || $budget->product_8_id == $i->product_id || $budget->product_9_id == $i->product_id)
                                {{$i->product->name}}<br>
                            @endif                             
                        @endforeach
                    </td>                    
                    <td>
                        @if (!empty($budget->product_1_qtd))
                            {{$budget->product_1_qtd}}<br>                       
                        @endif
                        @if (!empty($budget->product_2_qtd))
                            {{$budget->product_2_qtd}}<br>
                        @endif
                        @if (!empty($budgetbudget->product_3_qtd))
                            {{$budgetbudget->product_3_qtd}}<br>
                        @endif
                        @if (!empty($budgetbudget->product_4_qtd))
                            {{$budgetbudget->product_4_qtd}}<br>
                        @endif
                        @if (!empty($budgetbudget->product_5_qtd))
                            {{$budgetbudget->product_5_qtd}}<br>
                        @endif
                        @if (!empty($budget->product_6_qtd))
                            {{$budget->product_6_qtd}}<br>
                        @endif
                        @if (!empty($budget->product_7_qtd))
                            {{$budget->product_7_qtd}}<br>
                        @endif
                        @if (!empty($budget->product_8_qtd))
                            {{$budget->product_8_qtd}}<br>
                        @endif
                        @if (!empty($budget->product_9_qtd))
                            {{$budget->product_9_qtd}}<br>
                        @endif                        
                    </td>
                    
                    <td class="td-prices">R$ {{$budget->price}}</td>
                    <td class="td-prices">
                        @if ($budget->labor == 0)
                        -
                        @else
                        R$ {{$budget->labor}}
                        @endif                        
                    </td>
                    <td class="td-prices">
                        @if ($budget->discount == 0)
                        -
                        @else
                        R$ {{$budget->discount}}
                        @endif                        
                    </td>                            
                    <th scope="row" class="td-prices">R$ {{$budget->total}}</th>
                </tr>
            </tbody>
          </table> 
          <form action="{{route('revertbudget', $budget->id)}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning"><i class="bi bi-arrow-counterclockwise"></i> Reverter Orçamento</button>
          </form>

    </div>    
@endsection
@section('scripts')

@endsection  
