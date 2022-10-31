<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{public_path().'\css\style.css'}}">
    <title>Resumo de vendas</title>
</head>
<body>
    <div class="area-empresa">
        <div class="logo-empresa">
            <img src="{{public_path().'\img\logo.png'}}" alt="" width="300px">
        </div>
        <div class="dados-empresa">
            <h4>Mega Motos Ltda</h4>
            <div>CPNJ: xxxxxxxxxxxxx</div>
            <div>Rua xx Qdxx Ltxx Bairro xxx - Caldas Novas-GO</div>
            <div>Contato: (xx)xxxxxxx</div>
            <div>Email: xxxxxxxxx@gmail.com</div>
        </div>
    </div>
    <table border="1" class="table-pdf table-striped">
        <thead class="thead-pdf">
          <tr>
            <th scope="col">Nº</th>                
            <th scope="col">Data da Venda</th>                
            <th scope="col">Cliente</th>                
            <th scope="col">Contato</th>                
            <th scope="col">Descrição </th>
            <th scope="col">Material</th>
            <th scope="col">Qtd</th>
            <th scope="col">F. Pag</th>
            <th scope="col">M. Pag</th>
            <th scope="col">Doc</th>
            <th scope="col">Valor Prod</th>
            <th scope="col">M. Obra</th>
            <th scope="col">Desc</th>
            <th scope="col">Tax.</th>
            <th scope="col">Status</th>
            <th scope="col">Total</th>
            <th scope="col">Recebido</th>
            <th scope="col">A receber</th>
          </tr>
        </thead>
        <tbody >
            @php
                $total = 0;
                $totalrecebido = 0;
                $totalareceber = 0;
            @endphp
            @foreach ($sell as $item)
            <tr >
                <td>{{$item->id}}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->client}}</td>
                <td>{{$item->contact}}</td>
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
                <td>@if (empty($item->fpay->fpay))
                    A prazo
                @else
                {{$item->fpay->fpay}}
                @endif</td>
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
                <td class="td-prices">
                    @if ($item->tariff == null)
                    -
                    @else
                    {{$item->tariff}}%
                    @endif
                    
                </td>
                <th scope="row" class="td-prices">{{$item->status}}</th>
                <th scope="row" class="td-prices">R$ {{$item->total}}</th>
                <th scope="row" class="td-prices">R$ {{$item->recebido}}</th>
                <th scope="row" class="td-prices">R$ {{$item->areceber}}</th>
            </tr>
            @php
                $total += $item->total;
                $totalrecebido += $item->recebido;
                $totalareceber += $item->areceber;
            @endphp
            @endforeach
                
          
        </tbody>
        <tfoot>
            <tr>
                <th colspan="15" class="text-end">Total</th>
                <th  class="td-prices">R$: {{$total}}</th>
                <th  class="td-prices">R$: {{$totalrecebido}}</th>
                <th  class="td-prices">R$: {{$totalareceber}}</th>
            </tr>
        </tfoot>
      </table> 
</body>
</html>