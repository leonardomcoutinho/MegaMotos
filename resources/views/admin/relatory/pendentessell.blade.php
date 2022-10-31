@extends('layouts.dashboard')
@section('title', 'Venda/Serviço - MEGA MOTOS')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
@endsection

@section('dashboard')
    <div class="">
        <h3 class="text-center my-3">Vendas Pendentes</h3>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Nº</th>                
                <th scope="col">Ultima att.</th>                
                <th scope="col">Cliente</th>                
                <th scope="col">Contato</th>                
                <th scope="col">Material</th>
                <th scope="col">Qtd</th>
                <th scope="col">F. Pag</th>
                <th scope="col">M. Pag</th>
                <th scope="col">Doc</th>
                <th scope="col">Valor Prod</th>
                <th scope="col">M. Obra</th>
                <th scope="col">Desc</th>
                <th scope="col">Data Pag.</th>
                <th scope="col">Total</th>
                <th scope="col">Recebido</th>
                <th scope="col">A receber</th>
              </tr>
            </thead>
            <tbody>
                
                @foreach ($sell as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{date('d/m/Y H:m', strtotime($item->updated_at))}}</td>
                    <td>{{$item->client}}</td>
                    <td>{{$item->contact}}</td>
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
                    <td>
                        @if (empty($item->fpay->fpay))
                            A prazo
                        @else
                        {{$item->fpay->fpay}}
                        @endif
                    </td>
                    <td>                        
                        @if (!empty($item->fpay->fpay) && $item->fpay->fpay == 'Cartão')
                            @foreach ($tariff as $t)
                                @if ($item->tariff == $t->percentual)
                                    {{$t->name}}
                                @endif
                            @endforeach
                        @endif
                        
                    </td>
                    <td>{{$item->document}}</td>
                    <td class="td-prices">R$ {{$item->price}}</td>
                    <td class="td-prices">
                        @if ($item->labor == 0)
                        -
                        @else
                        R$ {{$item->labor}}
                        @endif                        
                    </td>
                    <td class="td-prices">
                        @if ($item->discount == 0)
                        -
                        @else
                        R$ {{$item->discount}}
                        @endif                        
                    </td>
                    <td class="td-prices">{{date('d/m/Y', strtotime($item->date_pay))}}</td>
                    <td scope="row" class="td-prices">R$ {{$item->total}}</td>
                    <td scope="row" class="td-prices text-success">R$ {{$item->recebido}}</td>
                    <td scope="row" class="td-prices text-danger">R$ {{$item->areceber}}</td>
                </tr> 
                @endforeach
            </tbody>
            
          </table>  

    </div>
    
@endsection  
