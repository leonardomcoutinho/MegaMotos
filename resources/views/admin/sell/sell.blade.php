@extends('layouts.dashboard')
@section('title', 'Venda/Serviço - MEGA MOTOS')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
@endsection

@section('dashboard')
<script>
    
</script>
    <div class="mx-3">
        <h3 class="text-center my-3">Lançar Venda/Serviço</h3>
        <div class="card">
        <form action="{{route('store_sell')}}" method="POST" class="m-3">
            @csrf
            <div class="mb-3 d-flex w-100 align-items-center gap-5">
                <div class="fpag">
                    <label for="fpay_id" class="form-label">Selecione a Forma do Recebimento</label>
                    <select class="form-select" name="fpay_id" id="fpay_id" aria-label="Default select example">
                        <option selected disabled>Forma de Recebimento</option>
                        @foreach ($fpay as $item)
                            <option value="{{$item->id}}">{{$item->fpay}}</option>
                        @endforeach
                    </select> 
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
            </div>
            
            <div class="mb-3">
                <div class="form-floating">
                    <textarea class="form-control" name="description_service" placeholder="Leave a comment here" id="description_service" style="height: 100px"></textarea>
                    <label for="description_service">Descrição do Serviço</label>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                 <h6>Material Utilizado</h6>
                 <button type="button" class="btn btn-danger" id="add"> + </button>
            </div>                       
            <div id="itens" class="w-100 mb-3">
                <div class="form-group my-3 d-flex w-100 ddd">
                    <div class="select-prod d-flex flex-nowrap">                        
                        <select class="form-select" name="product_1_id" id="material" aria-label="Default select example"> 
                                <option selected disabled>Selecione o material</option>                           
                            @foreach ($inventory as $item)
                                <option value="{{$item->id}}">{{$item->product->name}} - {{$item->product->description}}</option>
                            @endforeach                        
                        </select>
                        <input type="number" placeholder="Qtd" class="form-control ms-3 qtd" name="product_1_qtd">                        
                    </div>                   
                </div>
            </div>
            <div class="mb-3 d-flex mb-3" id="tt">
                <div class="me-3">
                    <label for="price" class="form-label">Valor R$:
                    <input type="text" class="form-control" name="price" id="price"> 
                    </label>
                </div> 
                <div class="me-3">
                    <label for="discount" class="form-label">Desconto R$:
                    <input type="text" class="form-control input_fields_wrap" name="discount" id="discount" value="0">
                    </label>
                </div>                
            </div>
            <button type="submit" class="btn btn-danger">Enviar</button>
        </form>
    </div>    
    </div>   
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
 $(document).ready(function() {
  var max_fields = 10; //maximum input boxes allowed
  var wrapper = $("#itens"); //Fields wrapper
  var add_button = $("#add"); //Add button ID

  var x = 1; //initlal text box count
  $(add_button).click(function(e) { //on add input button click
    e.preventDefault();
    var length = wrapper.find("select").length;

    if (x < max_fields) { //max input box allowed
      x++; //text box increment
      $(wrapper).append('<div class="form-group mt-3 d-flex w-100 ddd"><div class="select-prod d-flex flex-nowrap"><select class="form-select" name="product_'+(length+1)+'_id" aria-label="Default select example"><option selected>Selecione Outro Material</option>@foreach ($inventory as $item) <option value="{{$item->id}}">{{$item->product->name}} - {{$item->product->description}}</option>@endforeach</select><input type="number" placeholder="Qtd" class="form-control ms-3 qtd" name="product_'+(length+1)+'_qtd"></div><button type="button" class="btn btn-danger ms-3" id="remove"> - </button></div>'); //add input box
    }
    //Fazendo com que cada uma escreva seu name
    wrapper.find("input:text").each(function() {
      $(this).val($(this).attr('name'))
    });
  });

  $(wrapper).on("click", "#remove", function(e) { //user click on remove text
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
  })

});

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
