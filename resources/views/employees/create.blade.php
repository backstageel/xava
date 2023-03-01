@extends("layouts.app")
@section("style")
    <
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
          type="text/css"/>
@endsection
@section("wrapper")
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Colaboradores</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Lista de Colaboradores</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('employees.create')}}" class="btn btn-primary">Adicionar</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Registar Novo Colaborador</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <x-bootstrap::form.form class="row g-3" action="{{route('employees.store')}}">
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1">
                                        <div class="num">1</div>
                                        Dados Pessoais
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-2">
                                        <span class="num">2</span>
                                        Dados Profissionais
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-3">
                                        <span class="num">3</span>
                                        Contactos
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="last_name" label="Apelido"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="first_name" label="Primeiros Nomes"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="gender_id" label="Sexo" :options="$genders"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.date-picker name="birth_date" label="Data de Nascimento"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="civil_state_id" label="Estado Civil" :options="$civilStates"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="birth_country_id" label="Pais de Nascimento" :options="$countries" :default="152"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="birth_province_id" label="Provincia de Nascimento" :options="$provinces"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="birth_district_id" label="Distrito de Nascimento" :options="$districts"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="identity_document_type_id" label="Tipo de Documento" :options="$identityDocumentTypes"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="identity_document_number" label="Número de Documento"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.date-picker name="identity_document_emission_date" label="Data de Emissão"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.date-picker name="identity_document_expiry_date" label="Data de Validade"/>
                                        </div>
                                    </div>

                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.date-picker name="start_date" label="Data de Admissão"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="department_id" label="Departamento" :options="$departments"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="employee_position_id" label="Cargo" :options="$employeePositions"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="employee_type_id" label="Tipo de Colaborador" :options="$employeeTypes"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="salary" label="Salário"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="nuit" label="NUIT"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="corporate_email" label="Email Corporativo"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <x-bootstrap::form.input name="emergency_name" label="Nome para Emergencia"/>
                                        </div>
                                        <div class="col-6">
                                            <x-bootstrap::form.input name="emergency_phone" label="Telemóvel para Emergencias"/>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <x-bootstrap::form.input name="living_address" label="Endereço de Morada"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="living_country_id" label="Pais de Nascimento" :options="$countries" :default="152"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="living_province_id" label="Provincia de Nascimento" :options="$provinces"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="living_district_id" label="Distrito de Nascimento" :options="$districts"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <x-bootstrap::form.input name="cellphone" label="Telemovel Pessoal"/>
                                        </div>
                                        <div class="col-6">
                                            <x-bootstrap::form.input name="personal_email" label="Email Pessoal"/>
                                        </div>
                                    </div>
                                    <div class="row float-end" >
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
