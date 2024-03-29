@extends("layouts.app")
@section("style")

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
            <h6 class="mb-0 text-uppercase">Editar Colaborador {{$employee->person->full_name}}</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <x-bootstrap::form.form method='PUT' class="row g-3" action="{{route('employees.update', $employee)}}"
                                            enctype="multipart/form-data">
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
                                            <x-bootstrap::form.select name="person_prefix_id" label="Prefixo"
                                                                      :options="$personPrefixes" :default="$employee->person->person_prefix_id"/>
                                        </div>

                                        <div class="col-4">
                                            <x-bootstrap::form.input name="last_name" label="Apelido" :value="$employee->person->last_name"/>
                                        </div>
                                        <div class="col-5">
                                            <x-bootstrap::form.input name="first_name" label="Primeiros Nomes"  :value="$employee->person->first_name"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <x-bootstrap::form.select name="gender_id" label="Gênero"
                                                                      :options="$genders"  :default="$employee->person->gender_id"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.date-picker name="birth_date"
                                                                           label="Data de Nascimento"
                                                                           :default="$employee->person->birth_date"/>
                                        </div>
                                        <div class="col-2">
                                            <x-bootstrap::form.select name="civil_state_id" label="Estado Civil"
                                                                      :options="$civilStates"  :default="old('civil_state_id',$employee->person->civil_state_id)"/>
                                        </div>
                                        <div class="col-5">
                                            <x-bootstrap::form.input name="image" label="Foto do Colaborador"
                                                                     type="file" accept="image/*"/>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="birth_country_id" label="País de Nascimento"
                                                                      :options="$countries" :default="old('birth_country_id',$employee->person->birth_country_id)"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="birth_province_id"
                                                                      label="Província de Nascimento"
                                                                      :options="$provinces"   :default="old('birth_province_id',$employee->person->birth_province_id)"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="birth_district_id"
                                                                      label="Distrito de Nascimento"
                                                                      :options="$districts"   :default="old('birth_district_id',$employee->person->birth_district_id)"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="identity_document_type_id"
                                                                      label="Tipo de Documento"
                                                                      :options="$identityDocumentTypes"   :default="old('identity_document_type_id',$employee->person->identity_document_type_id)"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="identity_document_number"
                                                                     label="Número de Documento"
                                                                     :default="old('identity_document_number',$employee->person->identity_document_number)"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.date-picker name="identity_document_emission_date"
                                                                           label="Data de Emissão"
                                                                           :default="old('identity_document_emission_date',$employee->person->identity_document_emission_date)"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.date-picker name="identity_document_expiry_date"
                                                                           label="Data de Validade"
                                                                           :default="old('identity_document_number',$employee->person->identity_document_expiry_date)"/>
                                        </div>

                                    </div>

                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.date-picker name="start_date" label="Data de Admissão"
                                                                           :default="old('start_date', $employee->start_date)"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="department_id" label="Departamento"
                                                                      :options="$departments"    :default="old('department_id',$employee->department_id)" />
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="employee_position_id" label="Cargo"
                                                                      :options="$employeePositions"   :default="old('employee_position_id',$employee->employee_position_id)"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="contract_type_id"
                                                                      label="Tipo de Colaborador"
                                                                      :options="$contractTypes"    :default="old('contract_type_id',$employee->contract_type_id)"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="base_salary" label="Salário"    :value="old('base_salary',$employee->base_salary)"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="nuit" label="NUIT"
                                                                     :value="old('nuit',$employee->person->nuit)"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="corporate_email"
                                                                     label="Email Corporativo"
                                                                     :value="old('corporate_email',$employee->person->user->email)"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <x-bootstrap::form.input name="emergency_name"
                                                                     label="Nome para Emergencias"
                                                                     :value="old('emergency_name',$employee->emergency_name)"/>
                                        </div>
                                        <div class="col-6">
                                            <x-bootstrap::form.input name="emergency_phone"
                                                                     label="Telemóvel para Emergencias"    :value="old('emergency_phone',$employee->emergency_phone)"/>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <x-bootstrap::form.input name="address" label="Endereço de Morada"   :value="old('address',$employee->person->address)"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="address_country_id"
                                                                      label="Pais de Morada" :options="$countries"
                                                                      :default="old('address_country_id',$employee->person->address_country_id)"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="address_province_id"
                                                                      label="Provincia de Morada"
                                                                      :options="$provinces"
                                                                      :default="old('address_province_id',$employee->person->address_province_id)"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="address_district_id"
                                                                      label="Distrito de Morada"
                                                                      :options="$districts"
                                                                      :default="old('address_district_id',$employee->person->address_district_id)"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <x-bootstrap::form.input name="cellphone" label="Telemovel Pessoal"
                                                                     :default="old('cellphone',$employee->person->phone)"/>

                                        </div>
                                        <div class="col-6">
                                            <x-bootstrap::form.input name="personal_email" label="Email Pessoal"
                                                                     :default="old('personal_email', $employee->person->email)"/>

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
