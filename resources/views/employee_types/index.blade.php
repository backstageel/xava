@extends("layouts.app")

@section("style")
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection

@section("wrapper")
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Colaboradores</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tipos de Colaborador</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('employee_types.create')}}" class="btn btn-primary">Adicionar</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Tipos de Colaboradores Registados</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Tipo de Colaborador</th>
                        <th>Data de Criação</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employeeTypes as $employeeType)
                        <tr>
                            <td>{{$employeeType->id}}</td>
                            <td>{{$employeeType->name}}</td>
                            <td>{{$employeeType->created_at}}</td>
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
