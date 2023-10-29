@extends("layouts.app")

@section("style")
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection

@section("wrapper")
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Ferias Colectivas</div>
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
                <a href="{{route('vacation_collectives.create')}}" class="btn btn-primary">Adicionar</a>
            </div>
            <div class="btn-group">
                <a href="{{route('holidays.create')}}" class="btn btn-primary">Adicionar dia de folga</a>
            </div>
            <br>
            <br>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Férias Coletivas</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Data Inicio</th>
                        <th>Data Fim</th>
                        <th>Nr de Dias</th>
                        <th><p style="display: none;"> </p></th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vacation_collectives as $vacation_collective)
                            <tr>
                                <td>{{$vacation_collective->id}}</td>
                                <td>{{$vacation_collective->start_date}}</td>
                                <td>{{$vacation_collective->end_date}}</td>
                                <td>{{$vacation_collective->number_of_days}}</td>
                                <td>
                                    <a href="{{route('vacation_collectives.edit', $vacation_collective)}}"> editar </a>
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

    <h6 class="mb-0 text-uppercase">Férias Coletivas</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Dia de folga</th>
                        <th><p style="display: none;"> </p></th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($holidays as $holiday)
                        <tr>
                            <td>{{$holiday->holiday_date}}</td>
{{--                            <td>--}}
{{--                                <a href="{{route('holidays.edit', $holiday)}}"> editar </a>--}}
{{--                            </td>--}}
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
@endsection
