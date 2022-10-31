@extends('layouts.dashboard')
@section('title', 'Admin')

@section('dashboard')
<div class="graf">
    <div class="valores">
        <div class="total-recebido">
            <div class="d-flex align-items-center border rounded">
                <div class="me-3"><i class="bi bi-cash-coin bg-primary text-light p-1 fs-1 rounded-start"></i></div>
                <div>
                    @php
                    $totalrecebido = 0;
                    @endphp
                    @foreach ($sell as $item)
                        @php
                            $totalrecebido += $item->recebido
                        @endphp
                    @endforeach
                    <div class="fw-bolder">Recebido</div> 
                    <div>
                        R$:{{$totalrecebido}}
                    </div>
                </div>
            </div>
        </div>
        <div class="total-areceber">
            <div class="d-flex align-items-center border rounded">
                <div class="me-3"><i class="bi bi-wallet2 bg-warning text-light p-1 fs-1 rounded-start"></i></div>
                <div>
                    @php
                        $totalareceber = 0;
                    @endphp
                    @foreach ($sell as $item)
                        @php
                            $totalareceber += $item->areceber
                        @endphp
                    @endforeach
                    <div class="fw-bolder">A receber</div>
                    <div>
                        R$:{{$totalareceber}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="resumo-mes border p-2">
        <canvas id="myChart"></canvas>
    </div>
    <div class="total-venda border p-2">
        <canvas id="myChart2"></canvas>
    </div>
    <div class="total-venda-x-orcamento border p-2">
        <canvas id="myChart3"></canvas>
    </div>
</div> 
<div class="text-center my-2">
    <div>
        @foreach ($sell as $item)
        @if ($item->aprazo == true && $item->date_pay == today()->format('Y-m-d') && $item->status !== "Finalizado")
        <script>
            $(document).ready(function(){
                $('#exampleModal').modal('show')
            })
        </script> 
         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pagamentos Pendentes de Hoje {{today()->format('d-m-Y')}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                @foreach ($datepay as $pp)
                @if ($pp->aprazo == true && $pp->date_pay == today()->format('Y-m-d') && $pp->status !== "Finalizado")
                <div class="card p-1 bg-danger bg-opacity-10 mb-2 shadow-sm">
                    <div class="info-client d-flex align-items-center justify-content-between">
                        <div class="area-cliente">
                            <h6>{{$pp->client}}</h6>
                            <div>{{$pp->contact}}</div>
                        </div>
                        <div class="area-valores">
                            <h6>Valor da venda</h6>
                            <div>R$: {{$pp->total}}</div>
                        </div>
                        <div class="area-valores">
                            <h6>Valor recebido</h6>
                            <div>R$: {{$pp->recebido}}</div>
                        </div>
                        <div class="area-valores">
                            <h6>Valor a receber</h6>
                            <div>R$: {{$pp->areceber}}</div>
                        </div>
                        <div class="options">
                            <div class="dropdown">
                                <span class="dropdown-toggle btn btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-gear"></i>
                                </span>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="{{route('edit_sell', $pp->id)}}"><i class="bi bi-check-lg"></i> Recebido</a></li>
                                  <li><a class="dropdown-item" href="{{route('parcial_sell', $pp->id)}}"><i class="bi bi-calendar-check"></i> Recebido Parcial</a></li>
                                  <li><a class="dropdown-item" href="{{route('reag_sell', $pp->id)}}"><i class="bi bi-calendar"></i> Reagendar Recebimento</a></li>
                                </ul>
                              </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
            </div>
        </div>            
        @endif
    @endforeach

    </div>
</div>
@section('scripts')
<script>
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [{
                label: 'Vendas',
                data: ["<?=count($selljan)?>", "<?=count($sellfev)?>", "<?=count($sellmar)?>", "<?=count($sellabr)?>", "<?=count($sellmai)?>", "<?=count($selljun)?>", "<?=count($selljul)?>", "<?=count($sellago)?>", "<?=count($sellset)?>", "<?=count($sellout)?>", "<?=count($sellnov)?>", "<?=count($selldez)?>"],
                backgroundColor: [
                    'rgba(255, 99, 132 )',
                    'rgba(54, 162, 235)',
                    'rgba(255, 206, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(153, 102, 255)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 99, 132 )',
                    'rgba(54, 162, 235)',
                    'rgba(255, 206, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(153, 102, 255)',
                    'rgba(255, 159, 64)'
                ],                
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    fontSize: 20,
                    fontStyle: 'bold',
                    text: 'Resumo de Vendas'
                }
            }
        }
    });
    const ctx2 = document.getElementById('myChart2');
    const myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Total de Vendas'],
            datasets: [{
            label: "Vendas",
            data: ["<?= count($sell)?>"],
            backgroundColor: ['red'], 
            }],
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    fontSize: 20,
                    fontStyle: 'bold',
                    text: 'Total de Vendas'
                }
            }
        }
    });
    const ctx3 = document.getElementById('myChart3');
    const myChart3 = new Chart(ctx3, {
        type: 'doughnut',
        data: {
            labels: ['Vendas', 'Orcamento'],
            datasets: [{            
            data: ["<?= count($sell)?>","<?= count($budget)?>"],
            backgroundColor: [
                'red',
                'blue'
            ], 
            }],
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    fontSize: 20,
                    fontStyle: 'bold',
                    text: 'Orçamento X Vendas'
                }
            }
        }
    });
    </script>
@endsection
@endsection
