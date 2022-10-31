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
        <div class="">
        <form action="{{route('store_sell')}}" method="POST" class="m-3">
            @csrf
            <div class="">
                <div class="cliente d-flex gap-5">
                    <div class="mb-3 cliente-name">
                        <label for="client" class="form-label">Cliente:</label>
                        <input type="text" class="form-control" id="client" name="client" placeholder="Nome Completo">                    
                    </div>
                    <div class="mb-3 cliente-contact">
                        <label for="contact" class="form-label">Contato:</label>
                        <input type="text" class="form-control" id="contact" name="contact" placeholder="Telefone para Contato">                    
                    </div>
                </div>
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
                
                <div class="mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" name="description_service" placeholder="Leave a comment here" id="description_service" style="height: 100px"></textarea>
                        <label for="description_service">Descrição do Serviço</label>
                    </div>
                </div>
            </div>
            <div class="">
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
                           <input type="number" placeholder="Qtd" class="form-control ms-3 qtd" name="product_1_qtd" id="qtd1">
                           <input type="text" placeholder="R$ Unit" class="form-control ms-3 qtd" name="product_1_value" id="valor1">                        
                       </div>                   
                   </div>
               </div>
            </div>
            <div class="">
                <div class="mb-3 d-flex mb-3" id="tt">
                    <div class="me-3">
                        <label for="price" class="form-label">Valor R$:
                        <input type="text" class="form-control" name="price" id="price"> 
                        </label>
                    </div>
                    <div class="me-3">
                        <label for="price" class="form-label">Mão de Obra R$:
                        <input type="text" class="form-control" name="labor" id="price" value="0"> 
                        </label>
                    </div> 
                    <div class="me-3">
                        <label for="discount" class="form-label">Desconto R$:
                        <input type="text" class="form-control input_fields_wrap" name="discount" id="discount" value="0">
                        </label>
                    </div>                
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
      $(wrapper).append('<div class="form-group mt-3 d-flex w-100 ddd"><div class="select-prod d-flex flex-nowrap"><select class="form-select" name="product_'+(length+1)+'_id" aria-label="Default select example"><option selected>Selecione Outro Material</option>@foreach ($inventory as $item) <option value="{{$item->id}}">{{$item->product->name}} - {{$item->product->description}}</option>@endforeach</select><input type="number" placeholder="Qtd" class="form-control ms-3 qtd" name="product_'+(length+1)+'_qtd" id="qtd'+(length+1)+'"><input type="text" placeholder="R$ Unit" class="form-control ms-3 qtd" name="product_1_value" id="valor'+(length+1)+'"></div><button type="button" class="btn btn-danger ms-3" id="remove"> - </button></div>'); //add input box
    }    
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

    $('#itens').change( function(){
        
        var valor1 = $('#valor1').val()  
        var valor2 = $('#valor2').val()    
        var valor3 = $('#valor3').val()        
        var valor4 = $('#valor4').val()        
        var valor5 = $('#valor5').val()        
        var valor6 = $('#valor6').val()        
        var valor7 = $('#valor7').val()        
        var valor8 = $('#valor8').val()        
        var valor9 = $('#valor9').val()         
        var qtd1 =   $('#qtd1').val()
        var qtd2 =   $('#qtd2').val()
        var qtd3 =   $('#qtd3').val()
        var qtd4 =   $('#qtd4').val()
        var qtd5 =   $('#qtd5').val()
        var qtd6 =   $('#qtd6').val()
        var qtd7 =   $('#qtd7').val()
        var qtd8 =   $('#qtd8').val()
        var qtd9 =   $('#qtd9').val()

        
        $('#price').keyup(function(){
            if(valor1){
                
                var v1 = parseFloat(valor1.replace(",", "."))
                var q1 = parseInt(qtd1)
                console.log(q1)
                var soma = v1 * q1
            }
            if(valor1 && valor2){
                var v2 = parseFloat(valor2.replace(",", "."))
                var q2 = parseInt(qtd2)
                var soma = (v1 * q1)+(v2 * q2)
            }
            if(valor1 && valor2 && valor3){
                var v3 = parseFloat(valor3.replace(",", "."))
                var q3 = parseInt(qtd3)
                var soma = (v1 * q1)+(v2 * q2)+(v3 * q3)
            }
            if(valor1 && valor2 && valor3 && valor4){
                var v4 = parseFloat(valor4.replace(",", "."))
                var q4 = parseInt(qtd4)
                var soma = (v1 * q1)+(v2 * q2)+(v3 * q3)+(v4 * q4)
            }
            if(valor1 && valor2 && valor3 && valor4 && valor5){
                var v5 = parseFloat(valor5.replace(",", "."))
                var q5 = parseInt(qtd5)
                var soma = (v1 * q1)+(v2 * q2)+(v3 * q3)+(v4 * q4)+(v5 * q5)
            }
            if(valor1 && valor2 && valor3 && valor4 && valor5 && valor6){
                var v6 = parseFloat(valor6.replace(",", "."))
                var q6 = parseInt(qtd6)
                var soma = (v1 * q1)+(v2 * q2)+(v3 * q3)+(v4 * q4)+(v5 * q5)+(v6 * q6)
            }
            if(valor1 && valor2 && valor3 && valor4 && valor5 && valor6 && valor7){
                var v7 = parseFloat(valor7.replace(",", "."))
                var q7 = parseInt(qtd7)
                var soma = (v1 * q1)+(v2 * q2)+(v3 * q3)+(v4 * q4)+(v5 * q5)+(v6 * q6)+(v7 * q7)
            }
            if(valor1 && valor2 && valor3 && valor4 && valor5 && valor6 && valor7 && valor8){
                var v8 = parseFloat(valor8.replace(",", "."))
                var q8 = parseInt(qtd8)
                var soma = (v1 * q1)+(v2 * q2)+(v3 * q3)+(v4 * q4)+(v5 * q5)+(v6 * q6)+(v7 * q7)+(v8 * q8)
            }
            if(valor1 && valor2 && valor3 && valor4 && valor5 && valor6 && valor7 && valor8 && valor9){
                var v9 = parseFloat(valor9.replace(",", "."))
                var q9 = parseInt(qtd9)
                var soma = parseFloat((v1 * q1)+(v2 * q2)+(v3 * q3)+(v4 * q4)+(v5 * q5)+(v6 * q6)+(v7 * q7)+(v8 * q8)+(v9 * q9))
            }
            console.log(soma)
            $('#price').val(soma)
        })
    })
</script>
@endsection  
