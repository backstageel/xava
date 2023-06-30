@extends("layouts.app")

@section("style")
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection

@section("wrapper")
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
                        <span class="badge bg-success rounded-pill">{{$sale_cotacao}}</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        {{"Facturado"}}
                        <span class="badge bg-success rounded-pill">{{$sale_facturado}}</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        {{"Pago"}}
                        <span class="badge bg-success rounded-pill">{{$sale_pago}}</span>
                    </li>

                </ul>
            </div>
        </div>
    </div><!--end row-->

    <!--breadcrumb-->
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
                <table id="example2" class="table table-striped table-bordered">
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
@endsection
