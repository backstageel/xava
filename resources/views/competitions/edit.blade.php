@extends("layouts.app")
@section("style")

    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
          type="text/css"/>
@endsection
@section("wrapper")
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
    <div class="row">
        <div class="col-xl-12 mx-auto">

            <hr/>
            <div class="card">
                <div class="card-body">
                    <x-bootstrap::form.form  method='PUT' action="{{route('competitions.update',$competition)}}"
                                            enctype="multipart/form-data">
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1">
                                        <div class="num">1</div>
                                        Dados do Concurso
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-2">
                                        <span class="num">2</span>
                                        Garantias
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-3">
                                        <span class="num">3</span>
                                        Responsáveis
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <div class="row">
                                        <div class="col-6">
                                            <x-bootstrap::form.select
                                                name="customer_id"
                                                label="Nome da Instituição"
                                                :options="$companies"
                                                default="{{old('customer_id',$competition->customer_id)}}"
                                            />
                                        </div>
                                        <div class="col-6">
                                            <x-bootstrap::form.select name="competition_type_id"
                                                                      label="Tipo de Concurso"
                                                                      :options="$competitionTypes"
                                            default="{{old('competition_type_id',$competition->competition_type_id)}}"
                                            />
                                        </div>


                                    </div>
                                    <div class="row">
{{--                                        <div class="col-4">--}}
{{--                                            <x-bootstrap::form.select name="product_category_id"--}}
{{--                                                                      label="Indústria do Concurso"--}}
{{--                                                                      :options="$productCategories"--}}
{{--                                                                      default="{{old('product_category_id',$competition->product_category_id)}}"/>--}}
{{--                                        </div>--}}
                                         <div class="col-4">
                                            <x-bootstrap::form.input name="competition_reference"
                                                                     label="Referência do Concurso"
                                                                     value="{{old('competition_reference', $competition->competition_reference)}}"/>

                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="company_type_id"
                                                                     label="Tipo de Instituição"
                                                                      :options="$companyTypes"
                                                                     default="{{old('company_type_id', $competition->company_type_id)}}"/>

                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.date-time-picker name="proposal_delivery_date"
                                                                                label="Data e hora da Entrega da Proposta"
                                            default="{{old('proposal_delivery_date', $competition->proposal_delivery_date)}}"/>

                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="bidding_documents_value"
                                                                     label="Preço do Caderno.Enc"
                                            value="{{old('bidding_documents_value', $competition->bidding_documents_value)}}"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="proposal_value"
                                                                     label="Valor da Proposta"
                                                                     value="{{old('proposal_value', $competition->proposal_value)}}"
                                            />

                                        </div>
                                    </div>


                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="provisional_bank_guarantee"
                                                                     label="Garantia Bancária Provisoria"
                                                                     value="{{old('provisional_bank_guarantee', $competition->provisional_bank_guarantee)}}"/>

                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="provisional_bank_guarantee_award"
                                                                     label="Prémio da Garantia"
                                                                     value="{{old('provisional_bank_guarantee_award', $competition->provisional_bank_guarantee_award)}}"/>


                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="definitive_guarantee"
                                                                     label="Garantia Definitiva"
                                            value="{{old('definite_guarantee', $competition->definitive_guarantee)}}"/>

                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="definitive_guarantee_award"
                                                                     label="Prémio da Garantia"
                                                                     value="{{old('definite_guarantee_award', $competition->definitive_guarantee_award)}}"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="advance_guarantee"
                                                                     label="Garantia de Adiatamento"
                                                                     value="{{old('advance_guarantee', $competition->advance_guarantee)}}"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="advance_guarantee_award"
                                                                     label="Prémio da Garantia"
                                                                     value="{{old('advance_guarantee_award', $competition->advance_guarantee_award)}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <div class="row">
{{--                                        <div class="col-4">--}}
{{--                                            <x-bootstrap::form.select name="responsible" label="Responsável do concurso"--}}
{{--                                                                      :options="$employees"--}}
{{--                                                                      default="{{old('responsible',$competition->responsible)}}"/>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-4">--}}
{{--                                            <x-bootstrap::form.select name="technical_proposal_review"--}}
{{--                                                                      label="Responsável pela revisão da Proposta"--}}
{{--                                                                      :options="$employees"--}}
{{--                                                                      default="{{old('technical_proposal_review',$competition->technical_proposal_review)}}"/>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-4">--}}
{{--                                            <x-bootstrap::form.select name="documentary_review"--}}
{{--                                                                      label="Responsável pela Revisão Documental"--}}
{{--                                                                      :options="$employees"--}}
{{--                                                                      default="{{old('documentary_review',$competition->documentary_review)}}"/>--}}

{{--                                        </div>--}}
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="competition_status_id" label="Estado do concurso"
                                                                      :options="$competitionStatuses"
                                                                      default="{{old('competition_status_id',$competition->competition_status_id)}}"/>

                                        </div>
                                        <div class="col-4" >
                                            <x-bootstrap::form.select name="competition_result_id" label="Resultado"
                                                                      :options="$competitionResult" onchange="verify_result()" id="status"
                                                                      default="{{old('competition_result_id',$competition->competition_result_id)}}"/>

                                        </div>
                                        <div class="col-4" style="display: none" id="reason">
                                            <x-bootstrap::form.select name="competition_reason_id" label="Motivo"
                                                                      :options="$competitionReasons"
                                                                      default="{{old('competition_reason_id',$competition->competition_reason_id)}}"/>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6" style="display: none" id="reason_description">
                                            <x-bootstrap::form.input name="reason_description" label="Descrição do Motivo"

                                                                      default="{{old('reason_description',$competition->reason_description)}}"/>

                                        </div>
                                    </div>
                                    <div class="row float-end">
                                        <div class="col-12">
                                            <button class="btn btn-success" type="submit">Actualizar</button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>


                            <!-- Include optional progressbar HTML -->
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </x-bootstrap::form.form>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
@endsection

@section("script")
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js"
            type="text/javascript"></script>
    <script>
        $(function () {
            $('#smartwizard').smartWizard({
                theme: 'arrows',
            })
        });
        $(function () {
            $('#smartwizard').smartWizard({
                theme: 'arrows',
            })
        });
        function verify_result() {
            var status = document.getElementById("status").value;
            var reason_field = document.getElementById("reason");
            var reason_description_field=document.getElementById('reason_description');



            if (status==2) {
                reason_field.style.display = "block";
                reason_description_field.style.display="block";
            } else if(status==3){
                reason_field.style.display = "block";
                reason_description_field.style.display="block";
            }else if(status==4){
                reason_field.style.display = "block";
                reason_description_field.style.display="block";
            }else{
                reason_field.style.display = "none";
                reason_description_field.style.display="none";
            }
        }


    </script>
@endsection
