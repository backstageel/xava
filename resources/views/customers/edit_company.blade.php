@extends("layouts.app")
@section("style")

    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
          type="text/css"/>

@endsection
@section("wrapper")
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Clientes</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Lista de Clientes</li>
                </ol>
            </nav>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Editar Cliente</h6>
            <hr/>
            <div class="card">
                <div class="card-body">

                    <x-bootstrap::form.form method='PUT' action="{{route('customers.update', $customer)}}">
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1">
                                        <div class="num">1</div>
                                        Dados do Cliente
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-2">
                                        <span class="num">2</span>
                                        Contacto do Cliente
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <div class="row">
                                        <div class="col-6">
                                            <x-bootstrap::form.input name="name" label="Nome da Empresa"
                                                                     value="{{old('name', $company->name)}}"/>
                                        </div>

                                        <div class="col-6">
                                            <x-bootstrap::form.input name="email" label="Email"
                                                                     value="{{old('email', $company->email)}}"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="nuit" label="NUIT"
                                                                     value="{{old('nuit', $company->nuit)}}"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="address_country_id" label="Nacionalidade"
                                                                      :options="$countries"
                                                                      default="{{old('country_id', $company->country_id)}}"/>
                                        </div>

                                        <div class="col-3">
                                            <x-bootstrap::form.select name="address_province_id" label="Província"
                                                                      :options="$provinces"
                                                                      default="{{old('province_id', $company->province_id)}}"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="address_district_id" label="Distrito"
                                                                      :options="$districts"
                                                                      default="{{old('district_id', $company->district_id)}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <x-bootstrap::form.input name="phone" label="Telemovel"
                                                                     value="{{old('phone', $company->phone)}}"/>
                                        </div>
                                        <div class="col-6">
                                            <x-bootstrap::form.input name="website" label="Pagina WEB"
                                                                     value="{{old('website', $company->website)}}"/>
                                        </div>
                                    </div>
                                    <div class="row float-end">
                                        <div class="col-12">
                                            <button class="btn btn-success" type="submit">Update</button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                        </div>

                        <!-- Include optional progressbar HTML -->
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0"
                                 aria-valuemin="0" aria-valuemax="100"></div>
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

