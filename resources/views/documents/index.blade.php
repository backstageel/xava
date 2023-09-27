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
        .document-card {
            position: relative; /* Certifique-se de que a posição do cartão seja relativa */
        }

        .close-button {
            position: absolute;
            top: 0;
            right: 0;
            padding: 5px; /* Adapte o espaçamento conforme necessário */
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
    @php
        $userID = Auth::user()->id;
        $personID = \App\Models\Person::where('user_id',$userID)->value('id');
        $employee_position_id = \App\Models\Employee::where('person_id',$personID)->value('employee_position_id');
    @endphp
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Documentos</div>

        @if($employee_position_id==\App\Enums\EmployeePosition::GESTOR_ESCRITORIO
                                    || $userID == 1)
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('documents.create', $path)}}" class="btn btn-primary">Carregar Documento</a>&nbsp;&nbsp;
            </div>
        </div>
        @endif
    </div>

        @if($path == 'IT' || $path == 'motas')
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Data da Reunião</th>
                                <th><p style="display: none;">. </p></th>
                                <th><p style="displey: none"> </p> </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($documents_in_table as $document)
                                    <tr>
                                        <td>{{$document->name}}</td>
                                        <td>{{$document->meeting_date}}</td>
                                        <td>
                                            <a href="{{route('documents.view', ['filename' => $document->name,'path' => $path])}}"> Visualizar </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('documents.destroy', ['filename' => $document->name,'path' => $path]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este Documento?')">Remover</button>
                                            </form>
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
        @else

            <div class="d-flex flex-wrap">
        @foreach($documents as $document)

            <div class="card document-card">
                <div class="close-button">

                    <form action="{{ route('documents.destroy', ['filename' => basename($document),'path' => $path]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este Documento?')">X</button>
                    </form>
                </div>
                @php
                    $extension = pathinfo($document, PATHINFO_EXTENSION);
                    $icon = '';

                    // Verificar a extensão do documento e definir o ícone correspondente
                    switch ($extension) {
                        case 'pdf':
                            $icon = 'pdf.png';
                            break;
                        case 'doc':
                        case 'docx':
                            $icon = 'word.png';
                            break;
                        case 'xls':
                        case 'xlsx':
                            $icon = 'excel.png';
                            break;

                        default:

                            $icon = 'pdf.png';
                            break;
                    }
                @endphp


                <img class="card-img-top" src="/assets/images/icons/{{ $icon }}" alt="">

                <div class="card-body">
                    <h6 class="card-title">{{ basename($document) }}</h6>
                    <a href="{{ route('documents.view', ['filename' => basename($document), 'path' => $path]) }}"
                       class="btn btn-primary" target="_blank">Visualizar {{ strtoupper($extension) }}</a>
                </div>
            </div>

        @endforeach
            </div>
        @endif
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
    </script>

@endsection
