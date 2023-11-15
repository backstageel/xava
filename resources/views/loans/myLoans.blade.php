@extends("layouts.app")

@section("style")
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection

@section("wrapper")
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Emprestimos</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Meus Emprestimos</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <h6 class="mb-0 text-uppercase">Minhas simulacoes </h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Valor de Emprestimo</th>
                        <th>Estado do Emprestimo</th>
                        <th><p style="display: none;">.</p></th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($loans as $loan)
                        @if($loan->status == 'Simulacao')
                        <tr>
                            <td>{{$loan->internal_reference}}</td>
                            <td>{{$loan->employee->person->full_name}}</td>
                            <td>@money($loan->amount)</td>
                            <td>{{$loan->status}}</td>
                            <td>
                                <a href="{{route('loans.show', $loan)}}"> mostrar detalhes </a>
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
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Pedidos de Emprestimos </h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Valor de Emprestimo</th>
                        <th>Estado do Emprestimo</th>
                        <th><p style="display: none;">.</p></th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($loans as $loan)
                        @if($loan->status == 'Pendente')
                        <tr>
                            <td>{{$loan->internal_reference}}</td>
                            <td>{{$loan->employee->person->full_name}}</td>
                            <td>@money($loan->amount)</td>
                            <td>{{$loan->status}}</td>
                            <td>
                                <a href="{{route('loans.show', $loan)}}"> mostrar detalhes </a>
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
    <h6 class="mb-0 text-uppercase">Emprestimos Activos Aprovados</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Data do Pedido</th>
                        <th>Valor de Emprestimo</th>
                        <th>Valor da Divida</th>
                        <th>Responsavel</th>
                        <th>Motivos</th>
                        <th>Estado do Emprestimo</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($loans as $loan)
                        @if($loan->status == 'Aprovado')
                            <tr>
                                <td>{{$loan->internal_reference}}</td>
                                <td>{{$loan->employee->person->full_name}}</td>
                                <td>{{$loan->created_at}}</td>
                                <td>@money($loan->amount)</td>
                                <td>{{$loan->debt}}</td>
                                <td>{{$loan->user->name}}</td>
                                <td>{{$loan->reason}}</td>
                                <td>{{$loan->status}}</td>
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
    <h6 class="mb-0 text-uppercase">Emprestimos Recusados</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Data do Pedido</th>
                        <th>Valor de Emprestimo</th>
                        <th>Valor da Divida</th>
                        <th>Responsavel</th>
                        <th>Motivos</th>
                        <th>Estado do Emprestimo</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($loans as $loan)
                        @if($loan->status == 'Rejeitado')
                            <tr>
                                <td>{{$loan->internal_reference}}</td>
                                <td>{{$loan->employee->person->full_name}}</td>
                                <td>{{$loan->created_at}}</td>
                                <td>@money($loan->amount)</td>
                                <td>{{$loan->debt}}</td>
                                <td>{{$loan->user->name}}</td>
                                <td>{{$loan->reason}}</td>
                                <td>{{$loan->status}}</td>
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
            var table = $('#example1').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
                },
                lengthChange: false,
            });
        });
    </script><script>
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
@endsection
