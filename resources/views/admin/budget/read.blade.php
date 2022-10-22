@extends('layouts.dashboard')
@section('title', 'Orçamento - MEGA MOTOS')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
@endsection

@section('dashboard')
    <div class="orcamentos">
        <h3 class="text-center my-3">Orçamentos</h3>
        <div class="text-end mx-3">
            <a href="{{route('budget')}}" class="btn btn-danger ">Criar Orçamento</a>
        </div>
        <div class="table-budget">            
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
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($budget as $item)
                        <tr>
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
                            <th scope="row" class="td-prices">R$ {{$item->total}}</th>
                            <td style='@if($item->status == "Pendente") color: orange; @elseif($item->status == "Aprovado") color: green; @else color: red;  @endif '>{{$item->status}}</td>
                            <td><a href="{{route('pdf_budget', $item->id)}}" target="_blank"><i class="bi bi-printer btn btn-primary btn-sm"></i></a></td>
                            <td>
                                @if ($item->status == "Pendente")
                                <a href="{{route('edit_budget', $item->id)}}" class="btn btn-success btn-sm"><i class="bi bi-check-lg"></i></a>
                                 @elseif($item->status == "Aprovado")   
                                 <a href="{{route('revert_budget', $item->id)}}" class="btn btn-warning btn-sm"><i class="bi bi-arrow-counterclockwise"></i></i></a>
                                @endif
                            </td>
                            <td>
                                <form action="{{route('cancel_budget', $item->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" ><i class="bi bi-x-lg"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table> 
                  <div class="py-4">
                    {{$budget->links()}}
                </div> 
        </div>
    </div>
 
@endsection  
