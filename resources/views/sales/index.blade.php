@extends("layouts.app")
@section("style")
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection

@section("wrapper")
    <div class="row">
        <div class="breadcrumb-title pe-3">Vendas</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Lista de Vendas</li>
                </ol>
            </nav>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Total Vendas </h6>
                        </div>
                    </div>
                    <div class="chart-container-2 mt-4">
                        <canvas id="chart2"></canvas>
                    </div>
                </div>
                <ul class="list-group list-group-flush">

                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        {{"draft"}}
                        <span class="badge bg-success rounded-pill">{{$sales_by_month['Draft']->sum('count')}}</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        {{"Cotação"}}
                        <span class="badge bg-success rounded-pill">{{$sales_by_month['Cotacao']->sum('count')}}</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        {{"Facturado"}}
                        <span class="badge bg-success rounded-pill">{{$sales_by_month['Facturado']->sum('count')}}</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        {{"Pago"}}
                        <span class="badge bg-success rounded-pill">{{$sales_by_month['Pago']->sum('count')}}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Objectivo das Vendas IT</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                <i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li class="dropdown">
                                    <a class="dropdown-item dropdown-toggle" href="javascript:;">Escolher Ano</a>
                                    <ul id="options_computer_equipament" class="dropdown-menu" style="position: static;">
                                        <li><a class="dropdown-item" href="#" id="current_year_computer_equipament">Ano Actual</a></li>
                                        <li><a class="dropdown-item" href="#" id="last_year_computer_equipament">Ano Passado</a></li>
                                    </ul>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="javascript:;">Imprimir Relatório</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container-1">
                        <canvas id="chart4"></canvas>
                    </div>
                </div>
                <div id="current_description_computer_equipament">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Geral <span class="badge bg-pink rounded-pill">@money($computer_equipament_sales)</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Em Execução
                            <span class="badge bg-darkblue rounded-pill">@money($on_going_computer_equipament_sales)</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Pago
                            <span class="badge bg-lightblue rounded-pill">@money($paid_computer_equipament_sales)</span>
                        </li>

                    </ul>
                </div>
                <div id="last_description_computer_equipament" style="display: none">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Geral <span class="badge bg-orange rounded-pill">@money($last_computer_equipament_sales)</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Em Execução
                            <span class="badge bg-green rounded-pill">@money($last_on_going_computer_equipament_sales)</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Pago
                            <span class="badge bg-lilaz rounded-pill">@money($last_paid_computer_equipament_sales)</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Objectivo das Vendas Meios Circulantes</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                    <i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li class="dropdown">
                                        <a class="dropdown-item dropdown-toggle" href="javascript:;">Escolher Ano</a>
                                        <ul id="options_rolling_stock" class="dropdown-menu" style="position: static;">
                                            <li><a class="dropdown-item" href="#" id="current_year_rolling_stock">Ano Actual</a></li>
                                            <li><a class="dropdown-item" href="#" id="last_year_rolling_stock">Ano Passado</a></li>
                                        </ul>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="javascript:;">Imprimir Relatório</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                </ul>
                            </div>
                    </div>
                </div>
                    <div class="card-body">
                        <div class="chart-container-1">
                            <canvas id="chart5"></canvas>
                        </div>
                    </div>
                    <div id="current_description_rolling_stock">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                Geral <span class="badge bg-pink rounded-pill">@money($rolling_stock_sales)</span>
                            </li>
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Em Execução
                                <span class="badge bg-darkblue rounded-pill">@money($on_going_rolling_stock_sales)</span>
                            </li>
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Pago
                                <span class="badge bg-lightblue rounded-pill">@money($paid_rolling_stock_sales)</span>
                            </li>

                        </ul>
                    </div>
                    <div id="last_description_rolling_stock" style="display: none">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                Geral <span class="badge bg-orange rounded-pill">@money($last_rolling_stock_sales)</span>
                            </li>
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Em Execução
                                <span class="badge bg-green rounded-pill">@money($last_on_going_rolling_stock_sales)</span>
                            </li>
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Pago
                                <span class="badge bg-lilaz rounded-pill">@money($last_paid_rolling_stock_sales)</span>
                            </li>

                        </ul>
                    </div>
            </div>
        </div>


{{--            <div class="col-12 col-lg-8">--}}
{{--                <div class="card radius-10">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div>--}}
{{--                                <h6 class="mb-0">Vendas Mensais</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">--}}
{{--                        <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"--}}
{{--                                                                            style="color: #14abef"></i>Facturado</span>--}}
{{--                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"--}}
{{--                                                                                style="color: #ffc107"></i>Pago</span>--}}
{{--                        </div>--}}
{{--                        <div class="chart-container-1">--}}
{{--                            <canvas id="chart1"></canvas>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

    </div><!--end row-->
    <br>
    <br>
    <hr class="dropdown-divider">

    <h6 class="mb-0 text-uppercase">Vendas Facturadas</h6>
    <hr/>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                    <tr>

                        <th>Data de Venda</th>
                        <th>Nome Cliente</th>
                        <th>Descricao</th>
                        <th>Estado da Venda</th>
                        <th>Preco de Venda Total</th>
                        <th>Valor Recebido</th>
                        <th>Divida</th>
                        <th><p style="display: none;">.</p></th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $sale)
                        @if($sale->saleStatus->name == "Facturado")
                        <tr>
                            <td>{{$sale->sale_date}}</td>
                            <td>{{$sale->customer_name}}</td>
                            <td>{{$sale->notes}}</td>
                            <td>{{$sale->saleStatus->name}}</td>
                            <td>@money($sale->total_amount)</td>
                            <td>@money($sale->amount_received)</td>
                            <td>@money($sale->debt_amount)</td>
                            <td>
                                <a href="{{route('sales.show', $sale)}}"> mostrar detalhes </a>
                            </td>
                        </tr>
                        @endif
                    @endforeach

                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <br>
    <br>

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('sales.create')}}" class="btn btn-primary">Adicionar</a>
            </div>
        </div>
    </div>

    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Vendas Registados</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="table table-striped table-bordered">
                    <thead>
                    <tr>

                        <th>Data de Venda</th>
                        <th>Nome Cliente</th>
                        <th>Descricao</th>
                        <th>Estado da Venda</th>
                        <th>Preco de Venda Total</th>
                        <th>Nr da Factura</th>
                        <th>Método de Pagamento</th>
                        <th>Valor Recebido</th>
                        <th>Nr De Recibo</th>
                        <th>Despesas de Transporte</th>
                        <th>Comissão de Intermediários</th>
                        <th>Outras Despesas</th>
                        <th>Divida</th>
                        <th>Data de Pagamento</th>
                        <th><p style="display: none;">.</p></th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $sale)
                        <tr>
                            <td>{{$sale->sale_date}}</td>
                            <td>{{$sale->customer_name}}</td>
                            <td>{{$sale->notes}}</td>
                            <td>{{$sale->saleStatus->name}}</td>
                            <td>@money($sale->total_amount)</td>
                            <td>{{$sale->invoice_id}} </td>
                            <td>{{$sale->payment_method}}</td>
                            <td>@money($sale->amount_received)</td>
                            <td>{{$sale->receipt_id}}</td>
                            <td>@money($sale->transport_value) </td>
                            <td>{{$sale->intermediary_committee}} </td>
                            <td>@money($sale->other_expenses) </td>
                            <td>@money($sale->debt_amount) </td>
                            <td>{{$sale->payment_date}} </td>
                            <td>
                                <a href="{{route('sales.show', $sale)}}"> mostrar detalhes </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection

@section("script")
    <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{asset('')}}assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{asset('')}}assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{{asset('')}}assets/plugins/chartjs/js/Chart.min.js"></script>
    <script src="{{asset('')}}assets/plugins/chartjs/js/Chart.extension.js"></script>
    <script src="{{asset('')}}assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>


{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
    <script>
        $(document).ready(function() {
            $('.dropdown-item.dropdown-toggle').on('mouseenter', function() {
                $(this).next('.dropdown-menu').addClass('show');
            });

            $('.dropdown-menu').on('mouseleave', function() {
                $(this).removeClass('show');
            });
        });
    </script>



    <script>
        $(document).ready(function () {
            var table = $('#example2').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
                },
                lengthChange: false,
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            var table = $('#example3').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
                },
                lengthChange: false,
            });
        });
    </script>
    <script>
        $(function () {
            "use strict";

        {{--    var ctx = document.getElementById("chart1").getContext('2d');--}}

        {{--    var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);--}}
        {{--    gradientStroke1.addColorStop(0, '#6078ea');--}}
        {{--    gradientStroke1.addColorStop(1, '#17c5ea');--}}

        {{--    var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);--}}
        {{--    gradientStroke2.addColorStop(0, '#ff8359');--}}
        {{--    gradientStroke2.addColorStop(1, '#ffdf40');--}}

        {{--    var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);--}}
        {{--    gradientStroke3.addColorStop(0, '#ee0979');--}}
        {{--    gradientStroke3.addColorStop(1, '#ff6a00');--}}

        {{--    var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);--}}
        {{--    gradientStroke4.addColorStop(0, '#42e695');--}}
        {{--    gradientStroke4.addColorStop(1, '#3bb2b8');--}}



        {{--var myChart = new Chart(ctx, {--}}
        {{--        type: 'bar',--}}
        {{--        data: {--}}
        {{--            labels: {!! $sales_by_month['month']->pluck('month') !!},--}}
        {{--            datasets: [{--}}
        {{--                label: 'Draft',--}}
        {{--                data: @json($sales_by_month['Draft']->pluck('total')),--}}
        {{--                borderColor: gradientStroke1,--}}
        {{--                backgroundColor: gradientStroke1,--}}
        {{--                hoverBackgroundColor: gradientStroke1,--}}
        {{--                pointRadius: 0,--}}
        {{--                fill: false,--}}
        {{--                borderWidth: 0--}}
        {{--            }, {--}}
        {{--                label: 'Pago',--}}
        {{--                data: @json($sales_by_month['Pago']->pluck('total')),--}}
        {{--                borderColor: gradientStroke2,--}}
        {{--                backgroundColor: gradientStroke2,--}}
        {{--                hoverBackgroundColor: gradientStroke2,--}}
        {{--                pointRadius: 0,--}}
        {{--                fill: false,--}}
        {{--                borderWidth: 0--}}
        {{--            }, {--}}
        {{--                label: 'Facturado',--}}
        {{--                data: @json($sales_by_month['Facturado']->pluck('total')),--}}
        {{--                borderColor: gradientStroke3,--}}
        {{--                backgroundColor: gradientStroke3,--}}
        {{--                hoverBackgroundColor: gradientStroke3,--}}
        {{--                pointRadius: 0,--}}
        {{--                fill: false,--}}
        {{--                borderWidth: 0--}}
        {{--            }, {--}}
        {{--                label: 'Cotação',--}}
        {{--                data: @json($sales_by_month['Cotacao']->pluck('total')),--}}
        {{--                borderColor: gradientStroke4,--}}
        {{--                backgroundColor: gradientStroke4,--}}
        {{--                hoverBackgroundColor: gradientStroke4,--}}
        {{--                pointRadius: 0,--}}
        {{--                fill: false,--}}
        {{--                borderWidth: 0--}}
        {{--            }]--}}
        {{--        },--}}
        {{--        options: {--}}
        {{--            maintainAspectRatio: false,--}}
        {{--            legend: {--}}
        {{--                position: 'bottom',--}}
        {{--                display: false,--}}
        {{--                labels: {--}}
        {{--                    boxWidth: 8--}}
        {{--                }--}}
        {{--            },--}}
        {{--            tooltips: {--}}
        {{--                displayColors: false,--}}
        {{--            },--}}
        {{--            // scales: {--}}
        {{--            //     xAxes: [{--}}
        {{--            //         barPercentage: .5--}}
        {{--            //     }]--}}
        {{--            // }--}}
        {{--        }--}}
        {{--    });--}}


// chart 2

            var ctx = document.getElementById("chart2").getContext('2d');

            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#fc4a1a');
            gradientStroke1.addColorStop(1, '#f7b733');

            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke2.addColorStop(0, '#4776e6');
            gradientStroke2.addColorStop(1, '#8e54e9');

            var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke3.addColorStop(0, '#ee0979');
            gradientStroke3.addColorStop(1, '#ff6a00');

            var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke4.addColorStop(0, '#42e695');
            gradientStroke4.addColorStop(1, '#3bb2b8');

            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Pago", "Facturado", "Draft", "Cotação"],
                    datasets: [{
                        backgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3,
                            gradientStroke4
                        ],
                        hoverBackgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3,
                            gradientStroke4
                        ],
                        data: [{{$sales_by_month['Pago']->sum('count')}},
                            {{$sales_by_month['Facturado']->sum('count')}},
                            {{$sales_by_month['Draft']->sum('count')}},
                            {{$sales_by_month['Cotacao']->sum('count')}}],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });


//chart4
            var ctx = document.getElementById("chart4").getContext('2d');

            function createChartComputerEquipament(data) {
                myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ["Geral", "Execução", "Pago"],
                        datasets: [{
                            backgroundColor: [
                                data.gradientStroke1,
                                data.gradientStroke2,
                                data.gradientStroke3

                            ],
                            hoverBackgroundColor: [
                                data.gradientStroke1,
                                data.gradientStroke2,
                                data.gradientStroke3

                            ],
                            data: data.chartData,
                            borderWidth: [1, 1, 1]
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        cutoutPercentage: 0,
                        legend: {
                            position: 'bottom',
                            display: false,
                            labels: {
                                boxWidth: 8
                            }
                        },
                        tooltips: {
                            displayColors: false,
                        },
                    }
                });

            }
            // Função para criar o gráfico com dados do ano corrente
            function createChartCurrentComputerEquipament() {
                var data = {
                    gradientStroke1: '#ee0979',
                    gradientStroke2: '#283c86',
                    gradientStroke3: '#7f00ff',

                    chartData: [
                        {{$computer_equipament_sales * 100 / $computer_equipament_limit}},
                        {{$on_going_computer_equipament_sales * 100 / $computer_equipament_limit}},
                        {{$paid_computer_equipament_sales * 100 / $computer_equipament_limit}}

                    ]
                };
                createChartComputerEquipament(data);
            }

            // Função para criar o gráfico com dados do ano passado
            function createChartLastComputerEquipament() {
                var data = {
                    gradientStroke1: '#ff6a00',
                    gradientStroke2: '#39bd3c',
                    gradientStroke3: '#e100ff',
                    gradientStroke4: '#4BC0C0',
                    chartData: [
                        {{$last_computer_equipament_sales *100 / $computer_equipament_limit}},
                        {{$last_on_going_computer_equipament_sales * 100 / $computer_equipament_limit}},
                        {{$last_paid_computer_equipament_sales * 100 / $computer_equipament_limit}},

                    ]
                };
                createChartComputerEquipament(data);
            }

            // Evento de clique para a opção "Corrente Ano"
            $('#current_year_computer_equipament').on('click', function() {
                createChartCurrentComputerEquipament();
                var current_description_field = document.getElementById("current_description_computer_equipament");
                var last_description_field = document.getElementById("last_description_computer_equipament");
                current_description_field.style.display = "block";
                last_description_field.style.display = "none";

            });

            // Evento de clique para a opção "Ano Passado"
            $('#last_year_computer_equipament').on('click', function() {
                createChartLastComputerEquipament();
                var current_description_field = document.getElementById("current_description_computer_equipament");
                var last_description_field = document.getElementById("last_description_computer_equipament");
                current_description_field.style.display = "none";
                last_description_field.style.display = "block";
            });

            // Cria o gráfico inicialmente com os dados do ano corrente
            createChartCurrentComputerEquipament();


//chart5
        var ctx2 = document.getElementById("chart5").getContext('2d');


        function createChartRollingStock(data) {
            myChart = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: ["Geral", "Execução", "Pago"],
                    datasets: [{
                        backgroundColor: [
                            data.gradientStroke1,
                            data.gradientStroke2,
                            data.gradientStroke3

                        ],
                        hoverBackgroundColor: [
                            data.gradientStroke1,
                            data.gradientStroke2,
                            data.gradientStroke3

                        ],
                        data: data.chartData,
                        borderWidth: [1, 1, 1]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutoutPercentage: 0,
                    legend: {
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth: 8
                        }
                    },
                    tooltips: {
                        displayColors: false,
                    },
                }
            });

        }
        // Função para criar o gráfico com dados do ano corrente
        function createChartCurrentRollingStock() {
            var data = {
                gradientStroke1: '#ee0979',
                gradientStroke2: '#283c86',
                gradientStroke3: '#7f00ff',

                chartData: [
                    {{$rolling_stock_sales * 100 / $rolling_stock_limit}},
                    {{$on_going_rolling_stock_sales * 100 / $rolling_stock_limit}},
                    {{$paid_rolling_stock_sales * 100 / $rolling_stock_limit}}

                ]
            };
            createChartRollingStock(data);
        }

        // Função para criar o gráfico com dados do ano passado
        function createChartLastRollingStock() {
            var data = {
                gradientStroke1: '#ff6a00',
                gradientStroke2: '#39bd3c',
                gradientStroke3: '#e100ff',
                gradientStroke4: '#4BC0C0',
                chartData: [
                    {{$last_rolling_stock_sales * 100 / $rolling_stock_limit}},
                    {{$last_on_going_rolling_stock_sales * 100 / $rolling_stock_limit}},
                    {{$last_paid_rolling_stock_sales * 100 / $rolling_stock_limit}},

                ]
            };
            createChartRollingStock(data);
        }

        // Evento de clique para a opção "Corrente Ano"
        $('#current_year_rolling_stock').on('click', function() {
            createChartCurrentRollingStock();
            var current_description_field_rolling_stock = document.getElementById("current_description_rolling_stock");
            var last_description_field_rolling_stock = document.getElementById("last_description_rolling_stock");
            current_description_field_rolling_stock.style.display = "block";
            last_description_field_rolling_stock.style.display = "none";

        });

        // Evento de clique para a opção "Ano Passado"
        $('#last_year_rolling_stock').on('click', function() {
            createChartLastRollingStock();
            var current_description_field_rolling_stock = document.getElementById("current_description_rolling_stock");
            var last_description_field_rolling_stock = document.getElementById("last_description_rolling_stock");
            current_description_field_rolling_stock.style.display = "none";
            last_description_field_rolling_stock.style.display = "block";
        });

        // Cria o gráfico inicialmente com os dados do ano corrente
        createChartCurrentRollingStock();

        });
    </script>
@endsection
