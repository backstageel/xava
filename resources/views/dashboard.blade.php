@extends("layouts.app")
@section("style")
    <link href="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
@endsection

@section("wrapper")


    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total de Colaboradores</p>
                            <h4 class="my-1 text-info">{{$totalEmployees}}</h4>
                            <p class="mb-0 font-13">.</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                class='bx bxs-cart'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total de Vendas<br></p><br>
                            <h4 class="my-1 text-danger">@money($total_amount_sales)</h4>
                            <p class="mb-0 font-13"></p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i
                                class='bx bxs-wallet'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Nr Total de Concursos</p>
                            <h4 class="my-1 text-success">{{$total_competitions}}</h4>
                            <p class="mb-0 font-13"></p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                class='bx bxs-bar-chart-alt-2'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total de Clientes</p>
                            <h4 class="my-1 text-warning">{{$totalCustomers}}</h4>
                            <p class="mb-0 font-13"></p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i
                                class='bx bxs-group'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->


<br>
    <div class="row">

        <div class="col-12 col-lg-4">
            <div class="card radius-10 d-flex">
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
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        {{"Perdido"}}
                        <span class="badge bg-success rounded-pill">{{$sales_by_month['Perdido']->sum('count')}}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Equipamento Electrónico</h6>
                                <br>
                                <spam><strong>meta:</strong>100.000.000,00 MT</spam>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-0">
                            <canvas id="chart6"></canvas>
                        </div>
                    </div>
                    <div>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div><!--end row-->

        <div class="col-12 col-lg-4">
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Meios circulantes</h6>
                                <br>
                                <spam><strong>meta:</strong>140.000.000,00 MT</spam>
                                <br>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-0">
                            <br>
                            <canvas id="chart7"></canvas>
                        </div>
                    </div>
                    <div>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div><!--end row-->
    <br>
    <br>
    <hr class="dropdown-divider">

    <h6 class="mb-0 text-uppercase">Vendas Facturadas(Não Pagas)</h6>
    <hr/>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                    <tr>

                        <th>Codigo</th>
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
                                <td>{{$sale->internal_reference}}</td>
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




{{--    <div class="card radius-10">--}}
{{--        <div class="card-body">--}}
{{--            <div class="d-flex align-items-center">--}}
{{--                <div>--}}
{{--                    <h6 class="mb-0">Últimos Produtos Vendidos</h6>--}}
{{--                </div>--}}
{{--                <div class="dropdown ms-auto">--}}
{{--                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i--}}
{{--                            class='bx bx-dots-horizontal-rounded font-22 text-option'></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="table-responsive">--}}
{{--                <table class="table align-middle mb-0">--}}
{{--                    <thead class="table-light">--}}
{{--                    <tr>--}}
{{--                        <th>Nome</th>--}}
{{--                        <th>Foto</th>--}}
{{--                        <th>Factura</th>--}}
{{--                        <th>Estado da Venda</th>--}}
{{--                        <th>Valor da Venda</th>--}}
{{--                        <th>Data da Venda</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach($lastSoldProducts as $item)--}}
{{--                        <tr>--}}
{{--                            <td>{{$item->product->name}}</td>--}}
{{--                            <td><img src="{{asset('assets/images/products/01.png')}}" class="product-img-2"--}}
{{--                                     alt="product img"></td>--}}
{{--                            <td>{{$item->sale->customer->toArray()['customerable']['name']}}</td>--}}
{{--                            <td><span--}}
{{--                                    class="badge bg-gradient-quepal text-white shadow-sm w-100">{{$item->sale->saleStatus->name}}</span>--}}
{{--                            </td>--}}
{{--                            <td>@money($item->unit_price)</td>--}}
{{--                            <td>{{$item->sale->sale_date}}</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="row row-cols-1 row-cols-lg-3">--}}
{{--        <div class="col d-flex">--}}
{{--            <div class="card radius-10 w-100">--}}
{{--                <div class="card-body">--}}
{{--                    <p class="font-weight-bold mb-1 text-secondary">Receita Semanal</p>--}}
{{--                    <div class="d-flex align-items-center mb-4">--}}
{{--                        <div>--}}
{{--                            <h4 class="mb-0">$89,540</h4>--}}
{{--                        </div>--}}
{{--                        <div class="">--}}
{{--                            <p class="mb-0 align-self-center font-weight-bold text-success ms-2">4.4% <i--}}
{{--                                    class="bx bxs-up-arrow-alt mr-2"></i>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="chart-container-0">--}}
{{--                        <canvas id="chart3"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col d-flex">--}}
{{--            <div class="card radius-10 w-100">--}}
{{--                <div class="card-header bg-transparent">--}}
{{--                    <div class="d-flex align-items-center">--}}
{{--                        <div>--}}
{{--                            <h6 class="mb-0">Resumo das Vendas</h6>--}}
{{--                        </div>--}}
{{--                        <div class="dropdown ms-auto">--}}
{{--                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i--}}
{{--                                    class='bx bx-dots-horizontal-rounded font-22 text-option'></i>--}}
{{--                            </a>--}}
{{--                            <ul class="dropdown-menu">--}}
{{--                                <li><a class="dropdown-item" href="javascript:;">Action</a>--}}
{{--                                </li>--}}
{{--                                <li><a class="dropdown-item" href="javascript:;">Another action</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <hr class="dropdown-divider">--}}
{{--                                </li>--}}
{{--                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="chart-container-1">--}}
{{--                        <canvas id="chart4"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <ul class="list-group list-group-flush">--}}
{{--                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">--}}
{{--                        Completed <span class="badge bg-gradient-quepal rounded-pill">25</span>--}}
{{--                    </li>--}}
{{--                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Pending--}}
{{--                        <span class="badge bg-gradient-ibiza rounded-pill">10</span>--}}
{{--                    </li>--}}
{{--                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Process--}}
{{--                        <span class="badge bg-gradient-deepblue rounded-pill">65</span>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col d-flex">--}}
{{--            <div class="card radius-10 w-100">--}}
{{--                <div class="card-header bg-transparent">--}}
{{--                    <div class="d-flex align-items-center">--}}
{{--                        <div>--}}
{{--                            <h6 class="mb-0">Categorias mais vendidas</h6>--}}
{{--                        </div>--}}
{{--                        <div class="dropdown ms-auto">--}}
{{--                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i--}}
{{--                                    class='bx bx-dots-horizontal-rounded font-22 text-option'></i>--}}
{{--                            </a>--}}
{{--                            <ul class="dropdown-menu">--}}
{{--                                <li><a class="dropdown-item" href="javascript:;">Action</a>--}}
{{--                                </li>--}}
{{--                                <li><a class="dropdown-item" href="javascript:;">Another action</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <hr class="dropdown-divider">--}}
{{--                                </li>--}}
{{--                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="chart-container-0">--}}
{{--                        <canvas id="chart5"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row row-group border-top g-0">--}}
{{--                    <div class="col">--}}
{{--                        <div class="p-3 text-center">--}}
{{--                            <h4 class="mb-0 text-danger">$45,216</h4>--}}
{{--                            <p class="mb-0">Clothing</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col">--}}
{{--                        <div class="p-3 text-center">--}}
{{--                            <h4 class="mb-0 text-success">$68,154</h4>--}}
{{--                            <p class="mb-0">Electronic</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div><!--end row-->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div><!--end row-->--}}

@endsection

@section("script")
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
        $(function () {
            "use strict";


// chart 1

{{--            var ctx = document.getElementById("chart1").getContext('2d');--}}

{{--            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);--}}
{{--            gradientStroke1.addColorStop(0, '#6078ea');--}}
{{--            gradientStroke1.addColorStop(1, '#17c5ea');--}}

{{--            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);--}}
{{--            gradientStroke2.addColorStop(0, '#ff8359');--}}
{{--            gradientStroke2.addColorStop(1, '#ffdf40');--}}

{{--            var myChart = new Chart(ctx, {--}}
{{--                type: 'bar',--}}
{{--                data: {--}}
{{--                    labels: @json($invoicesByMonth->pluck('month')),--}}
{{--                    datasets: [{--}}
{{--                        label: 'Vendas',--}}
{{--                        data: @json($invoicesByMonth->pluck('total')),--}}
{{--                        borderColor: gradientStroke1,--}}
{{--                        backgroundColor: gradientStroke1,--}}
{{--                        hoverBackgroundColor: gradientStroke1,--}}
{{--                        pointRadius: 0,--}}
{{--                        fill: false,--}}
{{--                        borderWidth: 0--}}
{{--                    }, {--}}
{{--                        label: 'Facturas',--}}
{{--                        data: @json($invoicesByMonth->pluck('count')),--}}
{{--                        borderColor: gradientStroke2,--}}
{{--                        backgroundColor: gradientStroke2,--}}
{{--                        hoverBackgroundColor: gradientStroke2,--}}
{{--                        pointRadius: 0,--}}
{{--                        fill: false,--}}
{{--                        borderWidth: 0--}}
{{--                    }]--}}
{{--                },--}}

{{--                options: {--}}
{{--                    maintainAspectRatio: false,--}}
{{--                    legend: {--}}
{{--                        position: 'bottom',--}}
{{--                        display: false,--}}
{{--                        labels: {--}}
{{--                            boxWidth: 8--}}
{{--                        }--}}
{{--                    },--}}
{{--                    tooltips: {--}}
{{--                        displayColors: false,--}}
{{--                    },--}}
{{--                    scales: {--}}
{{--                        xAxes: [{--}}
{{--                            barPercentage: .5--}}
{{--                        }]--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}


{{--// chart 2--}}

{{--            var ctx = document.getElementById("chart2").getContext('2d');--}}

{{--            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);--}}
{{--            gradientStroke1.addColorStop(0, '#fc4a1a');--}}
{{--            gradientStroke1.addColorStop(1, '#f7b733');--}}

{{--            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);--}}
{{--            gradientStroke2.addColorStop(0, '#4776e6');--}}
{{--            gradientStroke2.addColorStop(1, '#8e54e9');--}}


{{--            var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);--}}
{{--            gradientStroke3.addColorStop(0, '#ee0979');--}}
{{--            gradientStroke3.addColorStop(1, '#ff6a00');--}}

{{--            var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);--}}
{{--            gradientStroke4.addColorStop(0, '#42e695');--}}
{{--            gradientStroke4.addColorStop(1, '#3bb2b8');--}}

{{--            var myChart = new Chart(ctx, {--}}
{{--                type: 'doughnut',--}}
{{--                data: {--}}
{{--                    labels: @json($mostSoldProducts->pluck('product_name')),--}}
{{--                    datasets: [{--}}
{{--                        backgroundColor: [--}}
{{--                            gradientStroke1,--}}
{{--                            gradientStroke2,--}}
{{--                            gradientStroke3,--}}
{{--                            gradientStroke4--}}
{{--                        ],--}}
{{--                        hoverBackgroundColor: [--}}
{{--                            gradientStroke1,--}}
{{--                            gradientStroke2,--}}
{{--                            gradientStroke3,--}}
{{--                            gradientStroke4--}}
{{--                        ],--}}
{{--                        data: @json($mostSoldProducts->pluck('total_quantity')),--}}
{{--                        borderWidth: [1, 1, 1, 1]--}}
{{--                    }]--}}
{{--                },--}}
{{--                options: {--}}
{{--                    maintainAspectRatio: false,--}}
{{--                    cutoutPercentage: 75,--}}
{{--                    legend: {--}}
{{--                        position: 'bottom',--}}
{{--                        display: false,--}}
{{--                        labels: {--}}
{{--                            boxWidth: 8--}}
{{--                        }--}}
{{--                    },--}}
{{--                    tooltips: {--}}
{{--                        displayColors: false,--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}


{{--// worl map--}}

{{--            jQuery('#geographic-map-2').vectorMap(--}}
{{--                {--}}
{{--                    map: 'world_mill_en',--}}
{{--                    backgroundColor: 'transparent',--}}
{{--                    borderColor: '#818181',--}}
{{--                    borderOpacity: 0.25,--}}
{{--                    borderWidth: 1,--}}
{{--                    zoomOnScroll: false,--}}
{{--                    color: '#009efb',--}}
{{--                    regionStyle: {--}}
{{--                        initial: {--}}
{{--                            fill: '#008cff'--}}
{{--                        }--}}
{{--                    },--}}
{{--                    markerStyle: {--}}
{{--                        initial: {--}}
{{--                            r: 9,--}}
{{--                            'fill': '#fff',--}}
{{--                            'fill-opacity': 1,--}}
{{--                            'stroke': '#000',--}}
{{--                            'stroke-width': 5,--}}
{{--                            'stroke-opacity': 0.4--}}
{{--                        },--}}
{{--                    },--}}
{{--                    enableZoom: true,--}}
{{--                    hoverColor: '#009efb',--}}
{{--                    markers: [{--}}
{{--                        latLng: [21.00, 78.00],--}}
{{--                        name: 'Lorem Ipsum Dollar'--}}

{{--                    }],--}}
{{--                    hoverOpacity: null,--}}
{{--                    normalizeFunction: 'linear',--}}
{{--                    scaleColors: ['#b6d6ff', '#005ace'],--}}
{{--                    selectedColor: '#c9dfaf',--}}
{{--                    selectedRegions: [],--}}
{{--                    showTooltip: true,--}}
{{--                });--}}


{{--// chart 3--}}

{{--            var ctx = document.getElementById('chart3').getContext('2d');--}}

{{--            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);--}}
{{--            gradientStroke1.addColorStop(0, '#008cff');--}}
{{--            gradientStroke1.addColorStop(1, 'rgba(22, 195, 233, 0.1)');--}}

{{--            var myChart = new Chart(ctx, {--}}
{{--                type: 'line',--}}
{{--                data: {--}}
{{--                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],--}}
{{--                    datasets: [{--}}
{{--                        label: 'Revenue',--}}
{{--                        data: [3, 30, 10, 10, 22, 12, 5],--}}
{{--                        pointBorderWidth: 2,--}}
{{--                        pointHoverBackgroundColor: gradientStroke1,--}}
{{--                        backgroundColor: gradientStroke1,--}}
{{--                        borderColor: gradientStroke1,--}}
{{--                        borderWidth: 3--}}
{{--                    }]--}}
{{--                },--}}
{{--                options: {--}}
{{--                    maintainAspectRatio: false,--}}
{{--                    legend: {--}}
{{--                        position: 'bottom',--}}
{{--                        display: false--}}
{{--                    },--}}
{{--                    tooltips: {--}}
{{--                        displayColors: false,--}}
{{--                        mode: 'nearest',--}}
{{--                        intersect: false,--}}
{{--                        position: 'nearest',--}}
{{--                        xPadding: 10,--}}
{{--                        yPadding: 10,--}}
{{--                        caretPadding: 10--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}


{{--// chart 4--}}

{{--            var ctx = document.getElementById("chart4").getContext('2d');--}}

{{--            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);--}}
{{--            gradientStroke1.addColorStop(0, '#ee0979');--}}
{{--            gradientStroke1.addColorStop(1, '#ff6a00');--}}

{{--            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);--}}
{{--            gradientStroke2.addColorStop(0, '#283c86');--}}
{{--            gradientStroke2.addColorStop(1, '#39bd3c');--}}

{{--            var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);--}}
{{--            gradientStroke3.addColorStop(0, '#7f00ff');--}}
{{--            gradientStroke3.addColorStop(1, '#e100ff');--}}

{{--            var myChart = new Chart(ctx, {--}}
{{--                type: 'pie',--}}
{{--                data: {--}}
{{--                    labels: ["Completed", "Pending", "Process"],--}}
{{--                    datasets: [{--}}
{{--                        backgroundColor: [--}}
{{--                            gradientStroke1,--}}
{{--                            gradientStroke2,--}}
{{--                            gradientStroke3--}}
{{--                        ],--}}

{{--                        hoverBackgroundColor: [--}}
{{--                            gradientStroke1,--}}
{{--                            gradientStroke2,--}}
{{--                            gradientStroke3--}}
{{--                        ],--}}

{{--                        data: [50, 50, 50],--}}
{{--                        borderWidth: [1, 1, 1]--}}
{{--                    }]--}}
{{--                },--}}
{{--                options: {--}}
{{--                    maintainAspectRatio: false,--}}
{{--                    cutoutPercentage: 0,--}}
{{--                    legend: {--}}
{{--                        position: 'bottom',--}}
{{--                        display: false,--}}
{{--                        labels: {--}}
{{--                            boxWidth: 8--}}
{{--                        }--}}
{{--                    },--}}
{{--                    tooltips: {--}}
{{--                        displayColors: false,--}}
{{--                    },--}}
{{--                }--}}
{{--            });--}}


{{--            // chart 5--}}

{{--            var ctx = document.getElementById("chart5").getContext('2d');--}}

{{--            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);--}}
{{--            gradientStroke1.addColorStop(0, '#f54ea2');--}}
{{--            gradientStroke1.addColorStop(1, '#ff7676');--}}

{{--            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);--}}
{{--            gradientStroke2.addColorStop(0, '#42e695');--}}
{{--            gradientStroke2.addColorStop(1, '#3bb2b8');--}}

{{--            var myChart = new Chart(ctx, {--}}
{{--                type: 'bar',--}}
{{--                data: {--}}
{{--                    labels: [1, 2, 3, 4, 5, 6, 7, 8],--}}
{{--                    datasets: [{--}}
{{--                        label: 'Clothing',--}}
{{--                        data: [40, 30, 60, 35, 60, 25, 50, 40],--}}
{{--                        borderColor: gradientStroke1,--}}
{{--                        backgroundColor: gradientStroke1,--}}
{{--                        hoverBackgroundColor: gradientStroke1,--}}
{{--                        pointRadius: 0,--}}
{{--                        fill: false,--}}
{{--                        borderWidth: 1--}}
{{--                    }, {--}}
{{--                        label: 'Electronic',--}}
{{--                        data: [50, 60, 40, 70, 35, 75, 30, 20],--}}
{{--                        borderColor: gradientStroke2,--}}
{{--                        backgroundColor: gradientStroke2,--}}
{{--                        hoverBackgroundColor: gradientStroke2,--}}
{{--                        pointRadius: 0,--}}
{{--                        fill: false,--}}
{{--                        borderWidth: 1--}}
{{--                    }]--}}
{{--                },--}}
{{--                options: {--}}
{{--                    maintainAspectRatio: false,--}}
{{--                    legend: {--}}
{{--                        position: 'bottom',--}}
{{--                        display: false,--}}
{{--                        labels: {--}}
{{--                            boxWidth: 8--}}
{{--                        }--}}
{{--                    },--}}
{{--                    scales: {--}}
{{--                        xAxes: [{--}}
{{--                            barPercentage: .5--}}
{{--                        }]--}}
{{--                    },--}}
{{--                    tooltips: {--}}
{{--                        displayColors: false,--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}


{{--        });--}}

    // -}}
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

        var ctx = document.getElementById("chart6").getContext('2d');

        var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
        gradientStroke1.addColorStop(0, '#f54ea2');
        gradientStroke1.addColorStop(1, '#ff7676');

        var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
        gradientStroke2.addColorStop(0, '#42e695');
        gradientStroke2.addColorStop(1, '#3bb2b8');

        var max_data_value_computer_equipament = Math.max(
            {{$computer_equipament_sales}},
            {{$on_going_computer_equipament_sales}},
            {{$paid_computer_equipament_sales}},
            {{$profit_computer_equipament_sales}}
        );

        // Arredonde para cima para o próximo múltiplo de 20 milhões
        var max_y_value_computer_equipament = Math.ceil(max_data_value_computer_equipament / 20000000) * 20000000;

        // Defina um valor máximo para o eixo Y, mas apenas se for maior que 100 milhões
        var y_max_computer_equipament = Math.max({{$computer_equipament_limit}}, max_y_value_computer_equipament);

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Geral", "Facturado", "Pago", "Lucro"],
                datasets: [{
                    label: 'Valor',
                    data: [{{$computer_equipament_sales}}, {{$on_going_computer_equipament_sales}},
                        {{$paid_computer_equipament_sales}}, {{$profit_computer_equipament_sales}}],
                    borderColor: gradientStroke1,
                    backgroundColor: gradientStroke1,
                    hoverBackgroundColor: gradientStroke1,
                    pointRadius: 0,
                    fill: false,
                    borderWidth: 1
                }]
            },
            options: {
                legend: { display: false },
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        barPercentage: 0.5
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 20000000,
                            max: y_max_computer_equipament,//maxValue + (maxValue * 0.1) // Defina uma margem de 10% acima do maior valor
                            callback: function(value, index, values) {
                                return value.toLocaleString(); // Formata os valores com separadores de milhares
                            }
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Valor'
                        }
                    }]
                },

                tooltips: {
                    displayColors: false,
                }
            }
        });



        var ctx = document.getElementById("chart7").getContext('2d');

        var max_data_value_rolling_stock = Math.max(
            {{$rolling_stock_sales}},
            {{$on_going_rolling_stock_sales}},
            {{$paid_rolling_stock_sales}},
            {{$profit_rolling_stock_sales}}
        );

        // Arredonde para cima para o próximo múltiplo de 20 milhões
        var max_y_value_rolling_stock = Math.ceil(max_data_value_rolling_stock / 20000000) * 20000000;

        // Defina um valor máximo para o eixo Y, mas apenas se for maior que 100 milhões
        var y_max_rolling_stock = Math.max({{$rolling_stock_limit}}, max_y_value_rolling_stock);

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Geral", "Facturado", "Pago", "Lucro"],
                datasets: [{
                    label: 'Vendas',
                    data: [{{$rolling_stock_sales}}, {{$on_going_rolling_stock_sales}},
                        {{$paid_rolling_stock_sales}}, {{$profit_rolling_stock_sales}}],
                    borderColor: gradientStroke2,
                    backgroundColor: gradientStroke2,
                    hoverBackgroundColor: gradientStroke2,
                    pointRadius: 0,
                    fill: false,
                    borderWidth: 1
                }]
            },
            options: {
                legend: {display: false},

                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    display: false,
                    labels: {
                        boxWidth: 8
                    }
                },
                scales: {
                    xAxes: [{
                        barPercentage: .5
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 20000000,
                            max: y_max_rolling_stock,// Define o tamanho do intervalo entre os ticks no eixo y
                            callback: function(value, index, values) {
                                return value.toLocaleString(); // Formata os valores com separadores de milhares
                            }
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Valor'
                        }
                    }]
                },
                tooltips: {
                    displayColors: false,
                }
            }
        });
    </script>
    
@endsection
