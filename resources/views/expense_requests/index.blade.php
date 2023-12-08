@extends("layouts.app")

@section("style")
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection

@section("wrapper")
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Requesições de Despesas</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Requisições</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('expense_requests.create')}}" class="btn btn-primary">Adicionar Requisição</a>
            </div>
            <br>

        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Requisições Abertas</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Data</th>
                        <th>Requerente</th>
                        <th>Tipo Despesa</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Conta Transação</th>
                        <th>Número Conta</th>
                        <th>Factura</th>
                        <th>Estado da Aprovação</th>
                        <th>Estado Contabilistico</th>
                        <th>Estado da Requisição</th>
                        <th><p style="display: none;">.</p></th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expenses as $expense)

                            @if($expense->requestStatus->name=='Aberto')
                                <tr>
                            <td>{{$expense->internal_reference}}</td>
                            <td>{{$expense->request_date}}</td>
                            <td>{{\App\Models\User::find($expense->requester_user_id)->name}}</td>
                            <td>{{\App\Models\ExpenseRequestType::find($expense->type_id)->name??''}}</td>
                            <td>{{$expense->description}}</td>
                            <td>{{$expense->amount}}</td>
                            <td>{{$expense->transactionAccount->name??''}}</td>
                            <td>{{$expense->transfer_account_number}}</td>
                            <td>{{$expense->invoice}}</td>
                            <td>{{$expense->approvalStatus->name??''}}</td>
                            <td>{{$expense->accountingStatus->name??''}}</td>
                            <td>{{$expense->requestStatus->name}}</td>

                            <td>
                                <a href="{{route('expense_requests.show', $expense->id)}}"> Ver </a>
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
    <h6 class="mb-0 text-uppercase">Requisições Fechadas</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Data</th>
                        <th>Requerente</th>
                        <th>Tipo Despesa</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Conta Transação</th>
                        <th>Número Conta</th>
                        <th>Estado da Aprovação</th>
                        <th>Estado Contabilistico</th>
                        <th>Estado da Requisição</th>



                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expenses as $expense)
                        @if($expense->requestStatus->name=='Fechado')
                        <tr>

                            <td>{{$expense->internal_reference}}</td>
                            <td>{{$expense->request_date}}</td>
                            <td>{{\App\Models\User::find($expense->requester_user_id)->name}}</td>
                            <td>{{\App\Models\ExpenseRequestType::find($expense->type_id)->name??''}}</td>
                            <td>{{$expense->description}}</td>
                            <td>{{$expense->amount}}</td>
                            <td>{{$expense->transactionAccount->name??''}}</td>
                            <td>{{$expense->transfer_account_number}}</td>
                            <td>{{$expense->approvalStatus->name??''}}</td>
                            <td>{{$expense->accountingStatus->name??''}}</td>
                            <td>{{$expense->requestStatus->name}}</td>
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
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            var table1 = $('#example2').DataTable({--}}
{{--                language: {--}}
{{--                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'--}}
{{--                },--}}
{{--                lengthChange: false--}}
{{--            });--}}

{{--            // Ocultar colunas vazias--}}
{{--            table1.columns().every(function () {--}}
{{--                var column = this;--}}

{{--                // Verificar se há dados na coluna--}}
{{--                var hasData = column.data().any();--}}

{{--                // Se não houver dados, ocultar a coluna--}}
{{--                if (!hasData) {--}}
{{--                    column.visible(false);--}}
{{--                }--}}
{{--            });--}}

{{--            var table2 = $('#example3').DataTable({--}}
{{--                language: {--}}
{{--                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'--}}
{{--                },--}}
{{--                lengthChange: false--}}
{{--            });--}}

{{--            // Ocultar colunas vazias--}}
{{--            table2.columns().every(function () {--}}
{{--                var column = this;--}}

{{--                // Verificar se há dados na coluna--}}
{{--                var hasData = column.data().any();--}}

{{--                // Se não houver dados, ocultar a coluna--}}
{{--                if (!hasData) {--}}
{{--                    column.visible(false);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}
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
@endsection
