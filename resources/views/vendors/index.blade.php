
@extends("layouts.app")

@section("style")
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection

@section("wrapper")
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Fornecedor</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Fornecedores</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('vendors.create')}}" class="btn btn-primary">Adicionar</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Fornecedores Registados</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>NUIT</th>
                        <th>contacto 1</th>
                        <th>Contacto 2</th>
                        <th>País</th>
                        <th>Província</th>
                        <th>Distríto</th>
                        <th>Endereço</th>
                        <th>WEB</th>
                        <th>Data criação</th>


                    </tr>
                    </thead>
                    <tbody>
                       @foreach($vendors as $vendor)
                           <tr>
                               <td>{{$vendor->name}}</td>
                               <td>{{$vendor->email}}</td>
                               <td>{{$vendor->nuit}}</td>
                               <td>{{$vendor->phone_number_1}}<td>
                               <td>{{$vendor->country->name}}</td>
                               <td>{{$vendor->province_id}}</td>
                               <td>{{$vendor->district_id}}</td>
                               <td>{{$vendor->web}}<td>
                               <td>{{$vendor->created_at}}</td>
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
        $(document).ready(function() {
            var table = $('#example2').DataTable( {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
                },
                lengthChange: false,
            } );
        } );
    </script>
@endsection
