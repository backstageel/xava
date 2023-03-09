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
                        <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
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
                            <p class="mb-0 text-secondary">Total de Vendas</p>
                            <h4 class="my-1 text-danger">@money($totalInvoicesAmount)</h4>
                            <p class="mb-0 font-13"></p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bxs-wallet'></i>
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
                            <p class="mb-0 text-secondary">Total de Facturas</p>
                            <h4 class="my-1 text-success">{{$totalInvoices}}</h4>
                            <p class="mb-0 font-13"></p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
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
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-group'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Vendas Mensais</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
                        <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #14abef"></i>Vendas</span>
                        <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #ffc107"></i>Facturas</span>
                    </div>
                    <div class="chart-container-1">
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">@money($totalInvoicesAmount)</h5>
                            <small class="mb-0">Total de Vendas <span> <i class="bx bx-up-arrow-alt align-middle"></i> 2.43%</span></small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">{{$totalInvoices}}</h5>
                            <small class="mb-0">Total de Facturas <span> <i class="bx bx-up-arrow-alt align-middle"></i> 12.65%</span></small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">639.82</h5>
                            <small class="mb-0">Pages/Visit <span> <i class="bx bx-up-arrow-alt align-middle"></i> 5.62%</span></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Produtos mais vendidos</h6>
                        </div>
                    </div>
                    <div class="chart-container-2 mt-4">
                        <canvas id="chart2"></canvas>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($mostSoldProducts as $product)
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            {{$product->product_name}}
                            <span class="badge bg-success rounded-pill">{{$product->total_quantity}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div><!--end row-->

    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">Últimos Produtos Vendidos</h6>
                </div>
                <div class="dropdown ms-auto">
                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Foto</th>
                        <th>Factura</th>
                        <th>Estado da Venda</th>
                        <th>Valor da Venda</th>
                        <th>Data da Venda</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lastSoldProducts as $item)
                        <tr>
                            <td>{{$item->product->name}}</td>
                            <td><img src="{{asset('assets/images/products/01.png')}}" class="product-img-2" alt="product img"></td>
                            <td>{{$item->sale->customer->toArray()['customerable']['name']}}</td>
                            <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">{{$item->sale->saleStatus->name}}</span></td>
                            <td>@money($item->unit_price)</td>
                            <td>{{$item->sale->sale_date}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-lg-3">
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <p class="font-weight-bold mb-1 text-secondary">Receita Semanal</p>
                    <div class="d-flex align-items-center mb-4">
                        <div>
                            <h4 class="mb-0">$89,540</h4>
                        </div>
                        <div class="">
                            <p class="mb-0 align-self-center font-weight-bold text-success ms-2">4.4% <i class="bx bxs-up-arrow-alt mr-2"></i>
                            </p>
                        </div>
                    </div>
                    <div class="chart-container-0">
                        <canvas id="chart3"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Resumo das Vendas</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
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
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Completed <span class="badge bg-gradient-quepal rounded-pill">25</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Pending <span class="badge bg-gradient-ibiza rounded-pill">10</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Process <span class="badge bg-gradient-deepblue rounded-pill">65</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Categorias mais vendidas</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
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
                    <div class="chart-container-0">
                        <canvas id="chart5"></canvas>
                    </div>
                </div>
                <div class="row row-group border-top g-0">
                    <div class="col">
                        <div class="p-3 text-center">
                            <h4 class="mb-0 text-danger">$45,216</h4>
                            <p class="mb-0">Clothing</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 text-center">
                            <h4 class="mb-0 text-success">$68,154</h4>
                            <p class="mb-0">Electronic</p>
                        </div>
                    </div>
                </div><!--end row-->
            </div>
        </div>
    </div><!--end row-->
@endsection

@section("script")
    <script src="{{asset('')}}assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{asset('')}}assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{{asset('')}}assets/plugins/chartjs/js/Chart.min.js"></script>
    <script src="{{asset('')}}assets/plugins/chartjs/js/Chart.extension.js"></script>
    <script src="{{asset('')}}assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>

    <script>
        $(function() {
            "use strict";


// chart 1

            var ctx = document.getElementById("chart1").getContext('2d');

            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#6078ea');
            gradientStroke1.addColorStop(1, '#17c5ea');

            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke2.addColorStop(0, '#ff8359');
            gradientStroke2.addColorStop(1, '#ffdf40');

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($invoicesByMonth->pluck('month')),
                    datasets: [{
                        label: 'Vendas',
                        data: @json($invoicesByMonth->pluck('total')),
                        borderColor: gradientStroke1,
                        backgroundColor: gradientStroke1,
                        hoverBackgroundColor: gradientStroke1,
                        pointRadius: 0,
                        fill: false,
                        borderWidth: 0
                    }, {
                        label: 'Facturas',
                        data: @json($invoicesByMonth->pluck('count')),
                        borderColor: gradientStroke2,
                        backgroundColor: gradientStroke2,
                        hoverBackgroundColor: gradientStroke2,
                        pointRadius: 0,
                        fill: false,
                        borderWidth: 0
                    }]
                },

                options:{
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth:8
                        }
                    },
                    tooltips: {
                        displayColors:false,
                    },
                    scales: {
                        xAxes: [{
                            barPercentage: .5
                        }]
                    }
                }
            });


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
                    labels: @json($mostSoldProducts->pluck('product_name')),
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
                        data: @json($mostSoldProducts->pluck('total_quantity')),
                        borderWidth: [1, 1, 1, 1]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutoutPercentage: 75,
                    legend: {
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth:8
                        }
                    },
                    tooltips: {
                        displayColors:false,
                    }
                }
            });



// worl map

            jQuery('#geographic-map-2').vectorMap(
                {
                    map: 'world_mill_en',
                    backgroundColor: 'transparent',
                    borderColor: '#818181',
                    borderOpacity: 0.25,
                    borderWidth: 1,
                    zoomOnScroll: false,
                    color: '#009efb',
                    regionStyle : {
                        initial : {
                            fill : '#008cff'
                        }
                    },
                    markerStyle: {
                        initial: {
                            r: 9,
                            'fill': '#fff',
                            'fill-opacity':1,
                            'stroke': '#000',
                            'stroke-width' : 5,
                            'stroke-opacity': 0.4
                        },
                    },
                    enableZoom: true,
                    hoverColor: '#009efb',
                    markers : [{
                        latLng : [21.00, 78.00],
                        name : 'Lorem Ipsum Dollar'

                    }],
                    hoverOpacity: null,
                    normalizeFunction: 'linear',
                    scaleColors: ['#b6d6ff', '#005ace'],
                    selectedColor: '#c9dfaf',
                    selectedRegions: [],
                    showTooltip: true,
                });


// chart 3

            var ctx = document.getElementById('chart3').getContext('2d');

            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#008cff');
            gradientStroke1.addColorStop(1, 'rgba(22, 195, 233, 0.1)');

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Revenue',
                        data: [3, 30, 10, 10, 22, 12, 5],
                        pointBorderWidth: 2,
                        pointHoverBackgroundColor: gradientStroke1,
                        backgroundColor: gradientStroke1,
                        borderColor: gradientStroke1,
                        borderWidth: 3
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        display:false
                    },
                    tooltips: {
                        displayColors:false,
                        mode: 'nearest',
                        intersect: false,
                        position: 'nearest',
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    }
                }
            });



// chart 4

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

            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ["Completed", "Pending", "Process"],
                    datasets: [{
                        backgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3
                        ],

                        hoverBackgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3
                        ],

                        data: [50, 50, 50],
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
                            boxWidth:8
                        }
                    },
                    tooltips: {
                        displayColors:false,
                    },
                }
            });


            // chart 5

            var ctx = document.getElementById("chart5").getContext('2d');

            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#f54ea2');
            gradientStroke1.addColorStop(1, '#ff7676');

            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke2.addColorStop(0, '#42e695');
            gradientStroke2.addColorStop(1, '#3bb2b8');

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [1, 2, 3, 4, 5, 6, 7, 8],
                    datasets: [{
                        label: 'Clothing',
                        data: [40, 30, 60, 35, 60, 25, 50, 40],
                        borderColor: gradientStroke1,
                        backgroundColor: gradientStroke1,
                        hoverBackgroundColor: gradientStroke1,
                        pointRadius: 0,
                        fill: false,
                        borderWidth: 1
                    }, {
                        label: 'Electronic',
                        data: [50, 60, 40, 70, 35, 75, 30, 20],
                        borderColor: gradientStroke2,
                        backgroundColor: gradientStroke2,
                        hoverBackgroundColor: gradientStroke2,
                        pointRadius: 0,
                        fill: false,
                        borderWidth: 1
                    }]
                },
                options:{
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth:8
                        }
                    },
                    scales: {
                        xAxes: [{
                            barPercentage: .5
                        }]
                    },
                    tooltips: {
                        displayColors:false,
                    }
                }
            });




        });
    </script>
@endsection
