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
                        <span class="badge bg-success rounded-pill">{{$sale_draft}}</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        {{"Cotação"}}
                        <span class="badge bg-success rounded-pill">{{$sale_quotation}}</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        {{"Facturado"}}
                        <span class="badge bg-success rounded-pill">{{$sale_billed}}</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        {{"Pago"}}
                        <span class="badge bg-success rounded-pill">{{$sale_paid}}</span>
                    </li>

                </ul>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Objectivo das Vendas</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                                    class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Imprimir Relatorio</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;"></a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container-1">
                        <canvas id="chart4"></canvas>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        Geral <span class="badge bg-gradient-quepal rounded-pill">{{$total_sales}}</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Meios Circulantes
                        <span class="badge bg-gradient-ibiza rounded-pill">{{$total_bikes}}</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Equipamento Informático
                        <span class="badge bg-gradient-deepblue rounded-pill">{{$total_computer_equipment}}</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center"> Total Pago
                        <span class="badge bg-gradient-deepblue rounded-pill">{{$total_paid}}</span>
                    </li>
                </ul>
            </div>
        </div>

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
                            <td>{{$sale->total_amount}}</td>
                            <td>{{$sale->amount_received}}</td>
                            <td>{{$sale->debt_amount}} </td>
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

    <hr class="dropdown-divider">
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
                            <td>{{$sale->total_amount}}</td>
                            <td>{{$sale->invoice_id}} </td>
                            <td>{{$sale->payment_method}}</td>
                            <td>{{$sale->amount_received}}</td>
                            <td>{{$sale->receipt_id}}</td>
                            <td>{{$sale->transport_value}} </td>
                            <td>{{$sale->intermediary_committee}} </td>
                            <td>{{$sale->other_expenses}} </td>
                            <td>{{$sale->debt_amount}} </td>
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

            // var ctx = document.getElementById('chart2').getContext('2d');
            //
            // var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 250);
            // gradientStroke1.addColorStop(0, "#FF6384");
            // gradientStroke1.addColorStop(1, "#FF6384");
            //
            // var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 250);
            // gradientStroke2.addColorStop(0, "#36A2EB");
            // gradientStroke2.addColorStop(1, "#36A2EB");
            //
            // var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 250);
            // gradientStroke3.addColorStop(0, "#FFCE56");
            // gradientStroke3.addColorStop(1, "#FFCE56");
            //
            // var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 250);
            // gradientStroke4.addColorStop(0, "#4BC0C0");
            // gradientStroke4.addColorStop(1, "#4BC0C0");

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
                        data: [{{$sale_paid}}, {{$sale_billed}}, {{$sale_draft}}, {{$sale_quotation}}],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });



            var ctx = document.getElementById("chart4").getContext('2d');

            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#ee0979');
            gradientStroke1.addColorStop(1, '#ff6a00');

            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke2.addColorStop(0, '#283c86');
            gradientStroke2.addColorStop(1, '#39bd3c');

            var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke3.addColorStop(0, '#7f00ff');
            gradientStroke3.addColorStop(1, '#e100ff');

            var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
             gradientStroke4.addColorStop(0, "#4BC0C0");
             gradientStroke4.addColorStop(1, "#4BC0C0");


            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ["Geral", "Meios Circulantes", "Equipamento Informatico", "Total Pago"],
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

                        data: [{{$total_sales*100/$limit}}, {{$total_bikes*100/$limit}}, {{$total_computer_equipment*100/$limit}},
                            {{$total_paid*100/$limit}}],
                        {{--data: [`${{$total_sales*100/$limit}}%`, `${{$total_bikes*100/$limit}}%`, `${{$total_computer_equipment*100/$limit}}%`,--}}
                        {{--    `${{$total_paid*100/$limit}}%`],--}}

                        borderWidth: [1, 1, 1,1]
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




        });
    </script>

@endsection
