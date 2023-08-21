@extends("layouts.app")

@section("style")
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    <style>
        .document-card {
            width: 15rem;
            display: inline-block;
            vertical-align: top;
            margin-right: 20px;
        }

        .document-card img {
            width: 50%;
            height: 50%;
            display: block;
            margin: 0 auto;
        }

        .document-card .card-title {
            text-align: center;
        }

        .document-card .btn-primary {
            display: block;
            margin: 0 auto;
        }
    </style>
@endsection

@section("wrapper")
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Documentos</div>

        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('documents.create')}}" class="btn btn-primary">Carregar Documento</a>&nbsp;&nbsp;
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap">
        @foreach($documents as $document)
            <div class="card document-card">
                <img class="card-img-top" src="/assets/images/icons/pdf.png" alt=" ">
                <div class="card-body">
                    <h6 class="card-title"> {{basename($document) }}</h6>
                    <a href="{{route('documents.view', ['filename' => basename($document)]) }}"
                       class="btn btn-primary" target="_blank">Visualizar PDF</a>
                </div>
            </div>
        @endforeach
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
