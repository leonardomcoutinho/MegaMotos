@extends('layouts.dashboard')
@section('title', 'Venda/Serviço - MEGA MOTOS')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
@endsection

@section('dashboard')
    <div class="mx-3">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Data da Venda</th>                
                <th scope="col">Descrição </th>
                <th scope="col">Material</th>
                <th scope="col">Qtd</th>
                <th scope="col">F. Pag</th>
                <th scope="col">M. Pag</th>
                <th scope="col">Valor do Serviço</th>
                <th scope="col">Desconto</th>
                <th scope="col">Tarifa</th>
                <th scope="col">Valor Recebido</th>
              </tr>
            </thead>
            <tbody>
                
                @foreach ($sell as $item)
                <tr>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->description_service}}</td>
                    <td>
                        @foreach ($inventory as $i)
                            @if ($item->product_1_id == $i->product_id || $item->product_2_id == $i->product_id || $item->product_3_id == $i->product_id || $item->product_4_id == $i->product_id || $item->product_5_id == $i->product_id || $item->product_6_id == $i->product_id || $item->product_7_id == $i->product_id || $item->product_8_id == $i->product_id || $item->product_9_id == $i->product_id)
                                {{$i->product->name}}<br>
                            @endif                             
                        @endforeach
                    </td>                    
                    <td>
                        @if (!empty($item->product_1_qtd))
                            {{$item->product_1_qtd}}<br>                       
                        @endif
                        @if (!empty($item->product_2_qtd))
                            {{$item->product_2_qtd}}<br>
                        @endif
                        @if (!empty($item->product_3_qtd))
                            {{$item->product_3_qtd}}<br>
                        @endif
                        @if (!empty($item->product_4_qtd))
                            {{$item->product_4_qtd}}<br>
                        @endif
                        @if (!empty($item->product_5_qtd))
                            {{$item->product_5_qtd}}<br>
                        @endif
                        @if (!empty($item->product_6_qtd))
                            {{$item->product_6_qtd}}<br>
                        @endif
                        @if (!empty($item->product_7_qtd))
                            {{$item->product_7_qtd}}<br>
                        @endif
                        @if (!empty($item->product_8_qtd))
                            {{$item->product_8_qtd}}<br>
                        @endif
                        @if (!empty($item->product_9_qtd))
                            {{$item->product_9_qtd}}<br>
                        @endif                        
                    </td>
                    <td>{{$item->fpay->fpay}}</td>
                    <td>
                        @if ($item->fpay->fpay == 'Cartão')
                            @foreach ($tariff as $t)
                                @if ($item->tariff == $t->percentual)
                                    {{$t->name}}
                                @endif
                            @endforeach
                        @endif
                        
                    </td>
                    <td>R$ {{$item->price}}</td>
                    <td>
                        @if ($item->discount == 0)
                        -
                        @else
                        R$ {{$item->discount}}
                        @endif                        
                    </td>
                    <td>
                        @if ($item->tariff == null)
                        -
                        @else
                        {{$item->tariff}}%
                        @endif
                        
                    </td>
                    <th scope="row">R$ {{$item->total}}</th>
                </tr>
                @endforeach
                    
              
            </tbody>
          </table>  
            <div class="py-4">
                {{$sell->links()}}
            </div>      
    </div>
@endsection  
