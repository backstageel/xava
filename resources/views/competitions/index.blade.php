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
                <a href="{{route('competitions.create')}}" class="btn btn-primary">Adicionar</a>&nbsp;&nbsp;
                <a href="{{route('competitions.export')}}" class="btn btn-primary">Imprimir Lista de Concursos</a>
            </div>

        </div>
    </div>
    <!--end breadcrumb-->
    <hr/>
    <h6 class="mb-0 text-uppercase">Lista de Concursos pendentes</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Mês</th>
                        <th>Tipo Instituição</th>
                        <th>Instituição</th>
                        <th>Tipo Concurso</th>
                        <th>Referência</th>
                        <th>Categoria</th>
                        <th>Sub-Categoria</th>
                        <th>Fase/Estágio</th>
                        <th>Data Entrega Proposta</th>
                        <th><p style="display: none;">.</p></th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($competitions as $competition)

                            @if($competition->competition_status_id!=36)
                                <tr>
                            <td>{{$competition->id}}</td>
                            <td>{{$competition->internal_reference}}</td>
                            <td>{{$competition->competition_month}}</td>
                            <td>{{$competition->companyType->name?? ''}}</td>
                            <td>{{\App\Models\Company::find($competition->customer_id)->name}}</td>
                            <td>{{$competition->competitionType->name}}</td>
                            <td>{{$competition->competition_reference}}</td>
                            <td>
                                @foreach ($competition->productCategory as $categoria)
                                    {{ '-'.$categoria->name }}<br>
                                @endforeach</td>
                            <td>
                                @foreach (\App\Models\ProductCategorySubCategory::where('competition_id', $competition->id)->get()
                                     as $subcategory)
                                    {{'-'.\App\Models\ProductSubCategory::find($subcategory->product_sub_category_id)->name}}<br>
                                @endforeach</td>
                            <td>{{$competition->competitionStatus->name??''}}</td>
                            <td>{{$competition->proposal_delivery_date}}</td>
                            <td>
                                <a href="{{route('competitions.edit',$competition)}}"> Editar </a>
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

    <hr/>
    <h6 class="mb-0 text-uppercase">Lista de Concursos</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Mês</th>
                        <th>Tipo Instituição</th>
                        <th>Instituição</th>
                        <th>Tipo Concurso</th>
                        <th>Referência</th>
                        <th>Categoria</th>
                        <th>Sub-Categoria</th>
                        <th>Garantia Provisoria</th>
                        <th>Prémio</th>
                        <th>Garantia Definitiva</th>
                        <th>Prémio</th>
                        <th>Garantia Adiatamento</th>
                        <th>Prémio</th>
                        <th>Data Entrega Proposta</th>
                        <th>Valor do Caderno.Enc</th>
                        <th>Resultado</th>
                        <th>Motivo</th>
                        <th>Descrição do Motivo</th>
                        <th>Fase/Estágio</th>
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
{{--                            <td>{{$competition->product->productCategory->name}}</td>--}}
                            <td>

                            @foreach ($competition->productCategory as $categoria)

                                {{ '-'.$categoria->name }}<br>
                                @endforeach</td>
                            <td>


                                    @foreach (\App\Models\ProductCategorySubCategory::where('competition_id', $competition->id)->get()
                                         as $subcategory)
                                        {{'-'.\App\Models\ProductSubCategory::find($subcategory->product_sub_category_id)->name}}<br>

                                    @endforeach


                            </td>
                            <td>{{$competition->provisional_bank_guarantee}}</td>
                            <td>{{$competition->provisional_bank_guarantee_award}}</td>
                            <td>{{$competition->definitive_guarantee}}</td>
                            <td>{{$competition->definitive_guarantee_award}}</td>
                            <td>{{$competition->advance_guarantee}}</td>
                            <td>{{$competition->advance_guarantee_award}}</td>
                            <td>{{$competition->proposal_delivery_date}}</td>
                            <td>{{$competition->bidding_documents_value}}</td>
                            <td>{{$competition->competitionResult->name?? ''}}</td>
                            <td>{{$competition->competitionReason->name?? ''}}</td>
                            <td>{{$competition->reason_description}}</td>
                            <td>{{$competition->competitionStatus->name??''}}</td>
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
    <script>
        $(document).ready(function () {

            var table = $('#example3').DataTable({
                language: {
                    //url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
                },
                lengthChange: false,
            });
        });

    </script>
@endsection
