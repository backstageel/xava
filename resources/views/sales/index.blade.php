@extends("layouts.app")

@section("style")
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection

@section("wrapper")
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
            <div class="btn-group">

            </div>
            <x-bootstrap::form.form class="row g-3" action="{{route('sales.store')}}">
                @csrf
                <input type="text" class="border-primary" name="name"  placeholder="Pesquisar" required/>
                <button class="hidden-button" name="search" type="submit">P</button>
            </x-bootstrap::form.form>
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
                            <td>{{$sale->intermediary_committe}} </td>
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
