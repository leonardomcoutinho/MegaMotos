@extends('layouts.dashboard')
@section('title', 'Orçamento - MEGA MOTOS')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
@endsection

@section('dashboard')
    <div class="mx-3">
        <h3 class="text-center my-3">Aprovar Orçamento Nº {{$budget->id}}</h3>
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
                        @if (!empty($budget->product_3_qtd))
                            {{$budget->product_3_qtd}}<br>
                        @endif
                        @if (!empty($budget->product_4_qtd))
                            {{$budget->product_4_qtd}}<br>
                        @endif
                        @if (!empty($budget->product_5_qtd))
                            {{$budget->product_5_qtd}}<br>
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

          <form action="{{route('aproved_budget', $budget->id)}}" method="POST">
            @csrf
            <div class="mb-3 d-flex w-100 gap-5 align-items-end recebimento">
                <div class="fpag">
                    <label for="fpay_id" class="form-label">Selecione a Forma do Recebimento</label>
                    <select class="form-select" name="fpay_id" id="fpay_id" aria-label="Default select example" required>
                        <option selected disabled>Forma de Recebimento</option>
                        @foreach ($fpay as $item)
                            <option value="{{$item->id}}">{{$item->fpay}}</option>
                        @endforeach
                    </select> 
                </div>
                <div class="form-check form-switch checkbox">
                    <input class="form-check-input" type="checkbox" role="switch" name="aprazo" id="aprazo" value="1" class="">
                    <label class="form-check-label" for="aprazo">Venda a prazo</label>
                </div>
                <div class="form-check form-switch checkbox2">
                    <input class="form-check-input" type="checkbox" role="switch" name="aprazo" id="pentrada" value="1" class="">
                    <label class="form-check-label" for="pentrada">Venda com entrada</label>
                </div>
                <div class="parcel ms-3">
                    <label for="cardTariff" class="form-label">Selecione o Método</label>
                    <select class="form-select" name="cardTariff" id="cardTariff" aria-label="Default select example">  
                            <option selected disabled> Selecione...</option>                  
                        @foreach ($cardTariff as $item)
                            <option value="{{$item->percentual}}">{{$item->name}}</option>
                        @endforeach
                    </select> 
                </div> 
                <div class="ms-3 document">
                    <label for="document" class="form-label">Nº do Documento</label>                 
                    <input type="text" class="form-control " name="document" id="document" placeholder="Nº Comprovante">                    
                </div> 
                <div class="entrada-pay p-0 m-0 ">
                    <label for="recebido" class="form-label p-0 m-0">Valor Entrada R$:
                    <input type="text" class="form-control" name="recebido" id="recebido" value="0"> 
                </label>
                </div>
                <div class="date-pay">
                    <label for="date_pay" class="form-label">Data prevista para pagamento</label>
                    <input type="date" name="date_pay" id="date_pay" class="form-control">
                </div>
                            
            </div>
            <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Aprovar Orçamento</button>
          </form>
    </div>    
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
// Oculta recebimento caso venda aprazo esteja selecionado
$(document).ready(function(){
    $(".date-pay").hide()
    $(".entrada-pay").hide()
    $( "#aprazo" ).click(function() {
        $(".fpag").toggle();
                
        $(".date-pay").toggle();
    });
    $( "#pentrada" ).click(function() {
        $(".date-pay").toggle();
        $(".entrada-pay").toggle();
    });
}) 
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
