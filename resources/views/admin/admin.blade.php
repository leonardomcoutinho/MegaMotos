@extends('layouts.dashboard')
@section('title', 'Admin')

@section('dashboard')
<div class="graf d-flex gap-5 justify-content-center flex-wrap">
    <div class="resumo-mes">
        <canvas id="myChart"></canvas>
    </div>
    <div class="total-venda">
        <canvas id="myChart2"></canvas>
    </div>
    <div class="total-venda-x-orcamento">
        <canvas id="myChart3"></canvas>
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
