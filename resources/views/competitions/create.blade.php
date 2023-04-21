@extends("layouts.app")
@section("style")
    <
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
                    <li class="breadcrumb-item active" aria-current="page">Concurso</li>
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
            <h6 class="mb-0 text-uppercase">Registar Novo Concurso</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <x-bootstrap::form.form class="row g-3" action="{{route('competitions.store')}}"
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
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="institution_type" label="Tipo da Instituição"
                                                                      :options="$institution_types"/>
                                        </div>

                                        <div class="col-4">
                                            <x-bootstrap::form.select name="competition_type" label="Tipo de Concurso"
                                                                      :options="$competition_types"/>
                                        </div>
                                        <div class="col-5">
                                            <x-bootstrap::form.select
                                                name="institution_name"
                                                label="Nome da Instituição"
                                                :options="$company"
                                                :value="$selected_company_name ?? null"
                                            />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="competition_reference" label="Referência do Concurso"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="nature"
                                                                           label="Indústria do Concurso" :options="$nature"  :value="$selected_nature_name ?? null"/>
                                        </div>
                                        <div class="col-5">
                                            <x-bootstrap::form.input name="product_type" label="Tipo de produto"/>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.date-time-picker name="proposal_delivery_date" label="Data e hora da Entrega da proposta"/>
                                        </div>


                                        <div class="col-3">
                                            <x-bootstrap::form.input name="bidding_documents_value" label="Preço do caderno.Enc"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="proposal_value"
                                                                      label="Valor da Proposta"/>
                                        </div>
                                    </div>


                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="provisional_bank_guarantee" label="Garantia Bancária Provisoria"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="provisional_bank_guarantee_award" label="Prémio da garantia"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="definitive_guarantee" label="Garantia Definitiva"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="definitive_guarantee_award" label="Prémio da garantia"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="advance_guarantee" label="Garantia de adiatamento"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="advance_guarantee_award" label="Prémio da garantia"/>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="responsible" label="Responsável do concurso" :options="$employee"
                                                                      :value="$selected_employee_name ?? null"/>
                                        </div>
                                        <div class="col-5">
                                            <x-bootstrap::form.select name="technical_proposal_review" label="Responsável pela revisão da proposta" :options="$employee"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="documentary_review" label="Responsável pela revisão documental" :options="$employee"/>
                                        </div>
                                        <div class="col-2">
                                            <x-bootstrap::form.input name="to_do" label="Por fazer"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="reason" label="Motivo de derrota" :options="$reason"/>
                                        </div>
                                    </div>
                                    <div class="row float-end">
                                        <div class="col-12">
                                           <button class="btn btn-success" type="submit">Gravar</button>
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
    </script>
@endsection
