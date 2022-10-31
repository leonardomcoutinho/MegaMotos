@extends('layouts.dashboard')
@section('title', 'Orçamento - MEGA MOTOS')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
@endsection

@section('dashboard')
    <div class="mx-3">
        <h3 class="text-center text-warning my-3">Reagendar Venda Nº {{$sell->id}}</h3>
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
                    <td>{{$sell->id}}</td>
                    <td>{{$sell->created_at}}</td>
                    <td>{{$sell->client}}</td>
                    <td>{{$sell->contact}}</td>
                    <td>{{$sell->description_service}}</td>
                    <td>
                        @foreach ($inventory as $i)
                            @if ($sell->product_1_id == $i->product_id || $sell->product_2_id == $i->product_id || $sell->product_3_id == $i->product_id || $sell->product_4_id == $i->product_id || $sell->product_5_id == $i->product_id || $sell->product_6_id == $i->product_id || $sell->product_7_id == $i->product_id || $sell->product_8_id == $i->product_id || $sell->product_9_id == $i->product_id)
                            {{$i->product->name}}<br>
                        @endif                              
                        @endforeach
                    </td>                    
                    <td>
                        @if (!empty($sell->product_1_qtd))
                            {{$sell->product_1_qtd}}<br>                       
                        @endif
                        @if (!empty($sell->product_2_qtd))
                            {{$sell->product_2_qtd}}<br>
                        @endif
                        @if (!empty($sell->product_3_qtd))
                            {{$sell->product_3_qtd}}<br>
                        @endif
                        @if (!empty($sell->product_4_qtd))
                            {{$sell->product_4_qtd}}<br>
                        @endif
                        @if (!empty($sell->product_5_qtd))
                            {{$sell->product_5_qtd}}<br>
                        @endif
                        @if (!empty($sell->product_6_qtd))
                            {{$sell->product_6_qtd}}<br>
                        @endif
                        @if (!empty($sell->product_7_qtd))
                            {{$sell->product_7_qtd}}<br>
                        @endif
                        @if (!empty($sell->product_8_qtd))
                            {{$sell->product_8_qtd}}<br>
                        @endif
                        @if (!empty($sell->product_9_qtd))
                            {{$sell->product_9_qtd}}<br>
                        @endif                        
                    </td>
                    
                    <td class="td-prices">R$ {{$sell->price}}</td>
                    <td class="td-prices">
                        @if ($sell->labor == 0)
                        -
                        @else
                        R$ {{$sell->labor}}
                        @endif                        
                    </td>
                    <td class="td-prices">
                        @if ($sell->discount == 0)
                        -
                        @else
                        R$ {{$sell->discount}}
                        @endif                        
                    </td>                            
                    <th scope="row" class="td-prices">R$ {{$sell->total}}</th>
                </tr>
            </tbody>
          </table> 

          <form action="{{route('updatereag_sell', $sell->id)}}" method="POST">
            @csrf
            <div class="recebimento mb-3">
                <div class="date-pay">
                    <label for="date_pay" class="form-label">Data prevista para pagamento</label>
                    <input type="date" name="date_pay" id="date_pay" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-warning"><i class="bi bi-calendar"></i> Reagendar Recebimento</button>
          </form>
    </div>    
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
 // Ocultando e exibindo de acordo com o valor do select
  $(document).ready(function() {
        $('.parcel').hide();
        $('.document').hide();        
            $("#fpay_id").change(function(){
                $('.parcel').hide();        
                $('.document').hide();        
                var option = $(this).val();
                if(option == 1){
                    $('.parcel').show();
                    $('.document').show();
                }  
                if(option == 3){                    
                    $('.document').show();
                }              
        });
    });
</script>
@endsection  
