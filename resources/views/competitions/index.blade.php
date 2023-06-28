@extends("layouts.app")

@section("style")
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection

@section("wrapper")
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Concursos</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Concursos</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('competitions.create')}}" class="btn btn-primary">Adicionar</a>

            </div>

        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Lista de Concursos</h6>
    <hr/>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Mês</th>
                        <th>Tipo Instituição</th>
                        <th>Instituição</th>
                        <th>Tipo Concurso</th>
                        <th>Referência</th>
                        <th>Natureza</th>
                        <th>Tipo Produto</th>
                        <th>Garantia B.Provisoria</th>
                        <th>Prémio</th>
                        <th>Garantia Definitiva</th>
                        <th>Prémio</th>
                        <th>Garantia Adiatamento</th>
                        <th>Prémio</th>
                        <th>Data Entrega Proposta</th>
                        <th>Valor do Caderno.Enc</th>
                        <th>Motivo</th>
                        <th>Por Fazer</th>
                        <th>Valor Proposta</th>
                        <th>Responsável</th>
                        <th>Responsável Rev.Prop.Técnica</th>
                        <th>Responsável Rev.Documental</th>
                        <th><p style="display: none;">.</p></th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($competitions as $competition)
                        <tr>

                            <td>{{$competition->id}}</td>
                            <td>{{$competition->internal_reference}}</td>
                            <td>{{$competition->competition_month}}</td>
                            <td>{{$competition->companyType->name?? ''}}</td>
                            <td>{{\App\Models\Company::find($competition->customer_id)->name}}</td>
                            <td>{{$competition->competitionType->name}}</td>
                            <td>{{$competition->competition_reference}}</td>
                            <td>{{$competition->product->productCategory->name}}</td>
                            <td>{{$competition->product_type}}</td>
                            <td>{{$competition->provisional_bank_guarantee}}</td>
                            <td>{{$competition->provisional_bank_guarantee_award}}</td>
                            <td>{{$competition->definitive_guarantee}}</td>
                            <td>{{$competition->definitive_guarantee_award}}</td>
                            <td>{{$competition->advance_guarantee}}</td>
                            <td>{{$competition->advance_guarantee_award}}</td>
                            <td>{{$competition->proposal_delivery_date}}</td>
                            <td>{{$competition->bidding_documents_value}}</td>
                            <td>{{$competition->competitionReason->name}}</td>
                            <td>{{$competition->competitionStatus->name}}</td>
                            <td>{{$competition->proposal_value}}</td>
                            <td>{{$competition->responsible}}</td>
                            <td>{{$competition->technical_proposal_review}}</td>
                            <td>{{$competition->documentary_review}}</td>
                            <td>
                                <a href="{{route('competitions.edit',$competition)}}"> Editar </a>
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
                    //url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
                },
                lengthChange: false,
            });
        });
    </script>
@endsection
