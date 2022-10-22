<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{public_path().'\css\style.css'}}">
    <title>{{$budget->client}}</title>
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
    <div class="area-info-orcamento">
        <div class="norcamento">
            <div class="numero">
                Orçamento Nº: <strong>{{$budget->id}}</strong>
            </div>
            <div class="data">
                Emitido em: <strong>{{$budget->created_at}}</strong>
            </div>
        </div>
    </div>
    <div class="cliente-bud">
        <div class="cli"> Cliente</div>
        <div class="nome-cliente">
            Nome: <strong>{{$budget->client}}</strong>
        </div>
        <div class="contato-cliente">
            Contato: <strong>{{$budget->contact}}</strong>
        </div>
    </div>
    <div class="table-prod">
        <table class="table">
            <thead>
              <tr>
                <th>Nº</th>
                <th>Material</th>
                <th>Qtd</th>
                <th>Handle</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td class="testttt">
                        @if (isset($budget->product_1_id) && !empty($budget->product_1_id))
                            @foreach ($product as $item)
                                @if ($item->id === $budget->product_1_id)
                                {{$item->name}}
                                @endif
                            @endforeach                        
                        @else
                            -
                        @endif
                    </td>
                    <td>{{$budget->product_1_qtd}}</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        @if (isset($budget->product_2_id) && !empty($budget->product_2_id))
                            @foreach ($product as $item)
                                @if ($item->id === $budget->product_2_id)
                                {{$item->name}}
                                @endif
                            @endforeach                        
                        @else
                            -
                        @endif
                    </td>
                    <td>{{$budget->product_2_qtd}}</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        @if (isset($budget->product_3_id) && !empty($budget->product_3_id))
                            @foreach ($product as $item)
                                @if ($item->id === $budget->product_3_id)
                                {{$item->name}}
                                @endif
                            @endforeach                        
                        @else
                            -
                        @endif
                    </td>
                    <td>{{$budget->product_3_qtd}}</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>
                        @if (isset($budget->product_4_id) && !empty($budget->product_4_id))
                            @foreach ($product as $item)
                                @if ($item->id === $budget->product_4_id)
                                {{$item->name}}
                                @endif
                            @endforeach                        
                        @else
                            -
                        @endif
                    </td>
                    <td>{{$budget->product_4_qtd}}</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>
                        @if (isset($budget->product_5_id) && !empty($budget->product_5_id))
                            @foreach ($product as $item)
                                @if ($item->id === $budget->product_5_id)
                                {{$item->name}}
                                @endif
                            @endforeach                        
                        @else
                            -
                        @endif
                    </td>
                    <td>{{$budget->product_5_qtd}}</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>
                        @if (isset($budget->product_6_id) && !empty($budget->product_6_id))
                            @foreach ($product as $item)
                                @if ($item->id === $budget->product_6_id)
                                {{$item->name}}
                                @endif
                            @endforeach                        
                        @else
                            -
                        @endif
                    </td>
                    <td>{{$budget->product_6_qtd}}</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>
                        @if (isset($budget->product_7_id) && !empty($budget->product_7_id))
                            @foreach ($product as $item)
                                @if ($item->id === $budget->product_7_id)
                                {{$item->name}}
                                @endif
                            @endforeach                        
                        @else
                            -
                        @endif
                    </td>
                    <td>{{$budget->product_7_qtd}}</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>
                        @if (isset($budget->product_8_id) && !empty($budget->product_8_id))
                            @foreach ($product as $item)
                                @if ($item->id === $budget->product_8_id)
                                {{$item->name}}
                                @endif
                            @endforeach                        
                        @else
                            -
                        @endif
                    </td>
                    <td>{{$budget->product_8_qtd}}</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>
                        @if (isset($budget->product_9_id) && !empty($budget->product_9_id))
                            @foreach ($product as $item)
                                @if ($item->id === $budget->product_9_id)
                                {{$item->name}}
                                @endif
                            @endforeach                        
                        @else
                            -
                        @endif
                    </td>
                    <td>{{$budget->product_9_qtd}}</td>
                    <td>@mdo</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="subtotaltd">Material </th>
                    <th colspan="2">R$: {{$budget->price}}</th>
                </tr>
                <tr>
                    <th colspan="2" class="subtotaltd">Mao de Obra </th>
                    <th colspan="2">R$: {{$budget->labor}}</th>
                </tr>
                <tr>
                    <th colspan="2" class="subtotaltd ">Desconto </td>
                    <th colspan="2" class="discount-bud">R$: ({{$budget->discount}})</th>
                </tr>
                <tr>
                    <th colspan="2" class="subtotaltd">Total </th>
                    <th colspan="2">R$: {{$budget->total}}</th>
                </tr>
            </tfoot>
          </table>
    </div>
    <div class="obs">
        <div class="obs-title">Descrição do Serviço</div>
        <div class="obs-service">
            {{$budget->description_service}}
        </div>
    </div>
    <div class="assinatura">
        <div class="ass-emp">
            <div></div>
            <div>Mega Motos</div>
        </div>
        <div class="ass-client">
            <div></div>
            <div>{{$budget->client}}</div>
        </div>
    </div>
</body>
</html>