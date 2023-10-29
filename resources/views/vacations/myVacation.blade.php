@extends("layouts.app")

@section("style")
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection

@section("wrapper")
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Minhas Férias</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Férias</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('vacations.create')}}" class="btn btn-primary">Adicionar</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Pedidos de Férias</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome do Colaborador</th>
                        <th>Data Inicio</th>
                        <th>Data Fim</th>
                        <th>Nr de Dias</th>
                        <th>Estado</th>
                        <th><p style="display: none;"> </p></th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vacations as $vacation)

                        @if($vacation->vacationStatus->name=='Pendente')
                            <tr>
                                <td>{{$vacation->internal_reference}}</td>
                                <td>{{$vacation->user->name}}</td>
                                <td>{{$vacation->start_date}}</td>
                                <td>{{$vacation->end_date}}</td>
                                <td>{{$vacation->number_of_days}}</td>
                                <td>{{$vacation->vacationStatus->name}}</td>
                                <td>
                                    <a href="{{route('vacations.show', $vacation)}}"> editar </a>
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
    <h6 class="mb-0 text-uppercase">Férias Aprovadas</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome do Colaborador</th>
                        <th>Data Inicio</th>
                        <th>Data Fim</th>
                        <th>Nr de Dias</th>
                        <th>Estado</th>
{{--                        <th><p style="display: none;"> </p></th>--}}


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vacations as $vacation)

                        @if($vacation->vacationStatus->name=='Aprovado')
                            <tr>
                                <td>{{$vacation->internal_reference}}</td>
                                <td>{{$vacation->user->name}}</td>
                                <td>{{$vacation->start_date}}</td>
                                <td>{{$vacation->end_date}}</td>
                                <td>{{$vacation->number_of_days}}</td>
                                <td>{{$vacation->vacationStatus->name}}</td>
{{--                                <td>--}}
{{--                                    <a href="{{route('vacations.show', $vacation)}}"> editar </a>--}}
{{--                                </td>--}}
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
    <h6 class="mb-0 text-uppercase">Férias em Andamento</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example4" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome do Colaborador</th>
                        <th>Data Inicio</th>
                        <th>Data Fim</th>
                        <th>Nr de Dias</th>
                        <th>Dias Gozados</th>
                        <th>Estado</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vacations as $vacation)
                        @if($vacation->vacationStatus->name == 'Em andamento')
                            <tr>
                                <td>{{$vacation->internal_reference}}</td>
                                <td>{{$vacation->user->name}}</td>
                                <td>{{$vacation->start_date}}</td>
                                <td>{{$vacation->end_date}}</td>
                                <td>{{$vacation->number_of_days}}</td>
                                <td>{{$vacation->used_days}}</td>
                                <td>{{$vacation->vacationStatus->name}}</td>
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
    <h6 class="mb-0 text-uppercase">Rejeitado</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example4" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome do Colaborador</th>
                        <th>Data Inicio</th>
                        <th>Data Fim</th>
                        <th>Nr de Dias</th>
                        <th>Estado</th>
{{--                        <th><p style="display: none;"> </p></th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vacations as $vacation)
                        @if($vacation->vacationStatus->name == 'Rejeitado')
                            <tr>
                                <td>{{$vacation->internal_reference}}</td>
                                <td>{{$vacation->user->name}}</td>
                                <td>{{$vacation->start_date}}</td>
                                <td>{{$vacation->end_date}}</td>
                                <td>{{$vacation->number_of_days}}</td>
                                <td>{{$vacation->vacationStatus->name}}</td>
{{--                                <td>--}}
{{--                                    <a href="{{route('vacations.show', $vacation)}}"> editar </a>--}}
{{--                                </td>--}}
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
    <h6 class="mb-0 text-uppercase">Cancelado</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example4" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome do Colaborador</th>
                        <th>Data Inicio</th>
                        <th>Data Fim</th>
                        <th>Nr de Dias</th>
                        <th>Dias Gozados</th>
                        <th>Estado</th>
{{--                        <th><p style="display: none;"> </p></th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vacations as $vacation)
                        @if($vacation->vacationStatus->name == 'Cancelado')
                            <tr>
                                <td>{{$vacation->internal_reference}}</td>
                                <td>{{$vacation->user->name}}</td>
                                <td>{{$vacation->start_date}}</td>
                                <td>{{$vacation->end_date}}</td>
                                <td>{{$vacation->number_of_days}}</td>
                                <td>{{$vacation->used_days}}</td>
                                <td>{{$vacation->vacationStatus->name}}</td>
{{--                                <td>--}}
{{--                                    <a href="{{route('vacations.show', $vacation)}}"> editar </a>--}}
{{--                                </td>--}}
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
            var table = $('#example3').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
                },
                lengthChange: false,
            });
        });
    </script>
@endsection
