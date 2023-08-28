@extends("layouts.app")
@section("style")
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection

@section("wrapper")
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
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
        <div class="ms-auto">
        <x-bootstrap::form.form class="row g-3" method='GET' action="{{route('sales.export')}}">
            @csrf
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

                    <div class="btn-group ">
                        <button name="objectivesIT" class="btn btn-primary">Imprimir Obj IT</button>&nbsp;&nbsp;
                        <button name="objectivesRollingStock" class="btn btn-primary">Imprimir Obj Motas</button>
                    </div>


            </div>
        </x-bootstrap::form.form>
        </div>
    </div>
    <div style="position: relative; z-index: 1; font-size: 20px;  border-radius: 10px 10px 0 0; padding: 10px;">
        Equipamento Informático
    </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Vendas Gerais<br></p><br>
                                <h4 class="my-1 text-info">@money($computer_equipament_sales)</h4>
                                <p class="mb-0 font-13"> </p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                    class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Vendas em Execução<br></p><br>
                                <h4 class="my-1 text-info">@money($on_going_computer_equipament_sales)</h4>
                                <p class="mb-0 font-13"> </p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                    class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Vendas Pagas</p><br>
                                <h4 class="my-1 text-info">@money($paid_computer_equipament_sales)</h4>
                                <p class="mb-0 font-13"></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                    class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Lucro</p><br>
                                <h4 class="my-1 text-info">@money($profit_computer_equipament_sales)</h4>
                                <p class="mb-0 font-13"></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                    class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->


    <div style="position: relative; z-index: 1; font-size: 20px;  border-radius: 10px 10px 0 0; padding: 10px;">
        Meios Circulantes
    </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Vendas Gerais/p>
                                <h4 class="my-1 text-info">@money($rolling_stock_sales)</h4>
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
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Vendas em Execução<br></p><br>
                                <h4 class="my-1 text-info">@money($on_going_rolling_stock_sales)</h4>
                                <p class="mb-0 font-13"></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                    class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Vendas Pagas</p>
                                    <h4 class="my-1 text-info">@money($paid_rolling_stock_sales)</h4>
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
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Lucro<br></p><br>
                                <h4 class="my-1 text-info">@money($profit_rolling_stock_sales)</h4>
                                <p class="mb-0 font-13"></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                    class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!--end row-->

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
{{--        <div class="col-12 col-lg-4">--}}
{{--            <div class="card radius-10 w-100">--}}
{{--                <div class="card-header bg-transparent">--}}
{{--                    <div class="d-flex align-items-center">--}}
{{--                        <div>--}}
{{--                            <h6 class="mb-0">Objectivo das Vendas IT</h6>--}}
{{--                        </div>--}}
{{--                        <div class="dropdown ms-auto">--}}
{{--                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">--}}
{{--                                <i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>--}}
{{--                            </a>--}}
{{--                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">--}}
{{--                                <li class="dropdown">--}}
{{--                                    <a class="dropdown-item dropdown-toggle" href="javascript:;">Escolher Ano</a>--}}
{{--                                    <ul id="options_computer_equipament" class="dropdown-menu" style="position: static;">--}}
{{--                                        <li><a class="dropdown-item" href="#" id="current_year_computer_equipament">Ano Actual</a></li>--}}
{{--                                        <li><a class="dropdown-item" href="#" id="last_year_computer_equipament">Ano Passado</a></li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                <li><hr class="dropdown-divider"></li>--}}
{{--                                <li><a class="dropdown-item" href="javascript:;">Imprimir Relatório</a></li>--}}
{{--                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="chart-container-1">--}}
{{--                        <canvas id="chart4"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div id="current_description_computer_equipament">--}}
{{--                    <ul class="list-group list-group-flush">--}}
{{--                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">--}}
{{--                            Geral <span class="badge bg-pink rounded-pill">@money($computer_equipament_sales)</span>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Em Execução--}}
{{--                            <span class="badge bg-darkblue rounded-pill">@money($on_going_computer_equipament_sales)</span>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Pago--}}
{{--                            <span class="badge bg-lightblue rounded-pill">@money($paid_computer_equipament_sales)</span>--}}
{{--                        </li>--}}

{{--                    </ul>--}}

{{--                </div>--}}
{{--                <div id="last_description_computer_equipament" style="display: none">--}}
{{--                    <ul class="list-group list-group-flush">--}}
{{--                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">--}}
{{--                            Geral <span class="badge bg-orange rounded-pill">@money($last_computer_equipament_sales)</span>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Em Execução--}}
{{--                            <span class="badge bg-green rounded-pill">@money($last_on_going_computer_equipament_sales)</span>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Pago--}}
{{--                            <span class="badge bg-lilaz rounded-pill">@money($last_paid_computer_equipament_sales)</span>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-12 col-lg-4">--}}
{{--            <div class="card radius-10 w-100">--}}
{{--                <div class="card-header bg-transparent">--}}
{{--                    <div class="d-flex align-items-center">--}}
{{--                            <div>--}}
{{--                                <h6 class="mb-0">Objectivo das Vendas Meios Circulantes</h6>--}}
{{--                            </div>--}}
{{--                            <div class="dropdown ms-auto">--}}
{{--                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">--}}
{{--                                    <i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>--}}
{{--                                </a>--}}
{{--                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">--}}
{{--                                    <li class="dropdown">--}}
{{--                                        <a class="dropdown-item dropdown-toggle" href="javascript:;">Escolher Ano</a>--}}
{{--                                        <ul id="options_rolling_stock" class="dropdown-menu" style="position: static;">--}}
{{--                                            <li><a class="dropdown-item" href="#" id="current_year_rolling_stock">Ano Actual</a></li>--}}
{{--                                            <li><a class="dropdown-item" href="#" id="last_year_rolling_stock">Ano Passado</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li><hr class="dropdown-divider"></li>--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Imprimir Relatório</a></li>--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="chart-container-1">--}}
{{--                            <canvas id="chart5"></canvas>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div id="current_description_rolling_stock">--}}
{{--                        <ul class="list-group list-group-flush">--}}
{{--                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">--}}
{{--                                Geral <span class="badge bg-pink rounded-pill">@money($rolling_stock_sales)</span>--}}
{{--                            </li>--}}
{{--                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Em Execução--}}
{{--                                <span class="badge bg-darkblue rounded-pill">@money($on_going_rolling_stock_sales)</span>--}}
{{--                            </li>--}}
{{--                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Pago--}}
{{--                                <span class="badge bg-lightblue rounded-pill">@money($paid_rolling_stock_sales)</span>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div id="last_description_rolling_stock" style="display: none">--}}
{{--                        <ul class="list-group list-group-flush">--}}
{{--                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">--}}
{{--                                Geral <span class="badge bg-orange rounded-pill">@money($last_rolling_stock_sales)</span>--}}
{{--                            </li>--}}
{{--                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Em Execução--}}
{{--                                <span class="badge bg-green rounded-pill">@money($last_on_going_rolling_stock_sales)</span>--}}
{{--                            </li>--}}
{{--                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Pago--}}
{{--                                <span class="badge bg-lilaz rounded-pill">@money($last_paid_rolling_stock_sales)</span>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                    </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--        <div class="row">--}}

            <div class="col-12 col-lg-4">
                <div class="col d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Equipamento Electrónico</h6>
                                    <br>
                                    <spam><strong>meta:</strong> @money($computer_equipament_limit)</spam>
                                    <br>
                                </div>
{{--                                <div class="dropdown ms-auto">--}}
{{--                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i--}}
{{--                                            class='bx bx-dots-horizontal-rounded font-22 text-option'></i>--}}
{{--                                    </a>--}}
{{--                                    <ul class="dropdown-menu">--}}
{{--                                        <li><a class="dropdown-item" href="javascript:;">Action</a>--}}
{{--                                        </li>--}}
{{--                                        <li><a class="dropdown-item" href="javascript:;">Another action</a>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <hr class="dropdown-divider">--}}
{{--                                        </li>--}}
{{--                                        <li><a class="dropdown-item" href="javascript:;">Something else here</a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
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
{{--                        <div class="row row-group border-top g-0">--}}
{{--                            <div class="col">--}}
{{--                                <div class="p-3 text-center">--}}
{{--                                    <h4 class="mb-0 text-danger">$45,216</h4>--}}
{{--                                    <p class="mb-0">Clothing</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            --}}
{{--                        </div><!--end row-->--}}
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
                                    <spam><strong>meta:</strong> @money($rolling_stock_limit)</spam>
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
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Data de Venda</th>
                        <th>Nome Cliente</th>
                        <th>Departamento Da Venda</th>
                        <th>Descricao</th>
                        <th>Referencia</th>
                        <th>Estado da Venda</th>
                        <th>Preco de Venda Total</th>
                        <th>Lucro</th>
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
                        @if($sale->saleStatus->name == "Facturado")
                        <tr>
                            <td>{{$sale->internal_reference}}</td>
                            <td>{{$sale->sale_date}}</td>
                            <td>{{$sale->customer_name}}</td>
                            <td>{{ isset($sale->ProductCategory) ? $sale->ProductCategory->name : '' }}</td>
                            <td>{{$sale->notes}}</td>
                            <td>{{$sale->sale_ref}}</td>
                            <td>{{$sale->saleStatus->name}}</td>
                            <td>@money($sale->total_amount)</td>
                            <td>@money($sale->profit)</td>
                            <td>{{$sale->invoice_id}} </td>
                            <td>{{$sale->payment_method}}</td>
                            <td>@money($sale->amount_received)</td>
                            <td>{{$sale->receipt_id}}</td>
                            <td>@money($sale->transport_value) </td>
                            <td>@money($sale->intermediary_committee) </td>
                            <td>@money($sale->other_expenses) </td>
                            <td>@money($sale->debt_amount) </td>
                            <td>{{$sale->payment_date}} </td>
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
    <hr class="dropdown-divider">

    <h6 class="mb-0 text-uppercase">Vendas em Cotação e Draft</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>codigo</th>
                        <th>Data de Venda</th>
                        <th>Nome Cliente</th>
                        <th>Departamento Da Venda</th>
                        <th>Descricao</th>
                        <th>Referencia</th>
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
                        @if($sale->saleStatus->name == "Cotação" || $sale->saleStatus->name == "Draft")
                        <tr>
                            <td>{{$sale->internal_reference}}</td>
                            <td>{{$sale->sale_date}}</td>
                            <td>{{$sale->customer_name}}</td>
                            <td>{{ isset($sale->ProductCategory) ? $sale->ProductCategory->name : '' }}</td>
                            <td>{{$sale->notes}}</td>
                            <td>{{$sale->sale_ref}}</td>
                            <td>{{$sale->saleStatus->name}}</td>
                            <td>@money($sale->total_amount)</td>
                            <td>{{$sale->invoice_id}} </td>
                            <td>{{$sale->payment_method}}</td>
                            <td>@money($sale->amount_received)</td>
                            <td>{{$sale->receipt_id}}</td>
                            <td>@money($sale->transport_value) </td>
                            <td>@money($sale->intermediary_committee) </td>
                            <td>@money($sale->other_expenses) </td>
                            <td>@money($sale->debt_amount) </td>
                            <td>{{$sale->payment_date}} </td>
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
    <h6 class="mb-0 text-uppercase">Vendas Pagas</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>codigo</th>
                        <th>Data de Venda</th>
                        <th>Nome Cliente</th>
                        <th>Departamento Da Venda</th>
                        <th>Descricao</th>
                        <th>Referencia</th>
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
                        @if($sale->saleStatus->name == "Pago" )
                            <tr>
                                <td>{{$sale->internal_reference}}</td>
                                <td>{{$sale->sale_date}}</td>
                                <td>{{$sale->customer_name}}</td>
                                <td>{{ isset($sale->ProductCategory) ? $sale->ProductCategory->name : '' }}</td>
                                <td>{{$sale->notes}}</td>
                                <td>{{$sale->sale_ref}}</td>
                                <td>{{$sale->saleStatus->name}}</td>
                                <td>@money($sale->total_amount)</td>
                                <td>{{$sale->invoice_id}} </td>
                                <td>{{$sale->payment_method}}</td>
                                <td>@money($sale->amount_received)</td>
                                <td>{{$sale->receipt_id}}</td>
                                <td>@money($sale->transport_value) </td>
                                <td>@money($sale->intermediary_committee) </td>
                                <td>@money($sale->other_expenses) </td>
                                <td>@money($sale->debt_amount) </td>
                                <td>{{$sale->payment_date}} </td>
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
    <h6 class="mb-0 text-uppercase">Vendas Perdidas</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example4" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>codigo</th>
                        <th>Data de Venda</th>
                        <th>Nome Cliente</th>
                        <th>Departamento Da Venda</th>
                        <th>Descricao</th>
                        <th>Referencia</th>
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
                        @if($sale->saleStatus->name == "Perdido")
                            <tr>
                                <td>{{$sale->internal_reference}}</td>
                                <td>{{$sale->sale_date}}</td>
                                <td>{{$sale->customer_name}}</td>
                                <td>{{ isset($sale->ProductCategory) ? $sale->ProductCategory->name : '' }}</td>
                                <td>{{$sale->notes}}</td>
                                <td>{{$sale->sale_ref}}</td>
                                <td>{{$sale->saleStatus->name}}</td>
                                <td>@money($sale->total_amount)</td>
                                <td>{{$sale->invoice_id}} </td>
                                <td>{{$sale->payment_method}}</td>
                                <td>@money($sale->amount_received)</td>
                                <td>{{$sale->receipt_id}}</td>
                                <td>@money($sale->transport_value) </td>
                                <td>@money($sale->intermediary_committee) </td>
                                <td>@money($sale->other_expenses) </td>
                                <td>@money($sale->debt_amount) </td>
                                <td>{{$sale->payment_date}} </td>
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
                <a href="{{route('sales.create')}}" class="btn btn-primary">Adicionar</a>&nbsp;&nbsp;
                <a href="{{route('sales.export')}}" class="btn btn-primary">Imprimir Lista de Vendas</a>
            </div>
        </div>
    </div>

    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Vendas Registados</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example5" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Data de Venda</th>
                        <th>Nome Cliente</th>
                        <th>Departamento Da Venda</th>
                        <th>Descricao</th>
                        <th>Referencia</th>
                        <th>Estado da Venda</th>
                        <th>Preco de Venda Total</th>
                        <th>Preco total da Compra</th>
                        <th>Nr da Factura</th>
                        <th>Método de Pagamento</th>
                        <th>Valor Recebido</th>
                        <th>Nr De Recibo</th>
                        <th>Despesas de Transporte</th>
                        <th>Comissão de Intermediários</th>
                        <th>Imposto</th>
                        <th>Outras Despesas</th>
                        <th>Divida</th>
                        <th>Data de Pagamento</th>
                        <th>Lucro</th>
                        <th><p style="display: none;">.</p></th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $sale)
                        <tr>
                            <td>{{$sale->internal_reference}}</td>
                            <td>{{$sale->sale_date}}</td>
                            <td>{{$sale->customer_name}}</td>
                            <td>{{ isset($sale->ProductCategory) ? $sale->ProductCategory->name : '' }}</td>
                            <td>{{$sale->notes}}</td>
                            <td>{{$sale->sale_ref}}</td>
                            <td>{{$sale->saleStatus->name}}</td>
                            <td>@money($sale->total_amount)</td>
                            <td>{{$sale->purchase_price}}</td>
                            <td>{{$sale->invoice_id}} </td>
                            <td>{{$sale->payment_method}}</td>
                            <td>@money($sale->amount_received)</td>
                            <td>{{$sale->receipt_id}}</td>
                            <td>@money($sale->transport_value) </td>
                            <td>@money($sale->intermediary_committee) </td>
                            <td>@money($sale->tax)}</td>
                            <td>@money($sale->other_expenses) </td>
                            <td>@money($sale->debt_amount) </td>
                            <td>{{$sale->payment_date}} </td>
                            <td>@money($sale->profit)</td>
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
{{--    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>--}}

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
            var table = $('#example1').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
                },
                lengthChange: false,
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
        $(document).ready(function () {
            var table = $('#example4').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
                },
                lengthChange: false,
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            var table = $('#example5').DataTable({
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
