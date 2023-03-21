@extends("layouts.app")
@section("style")
    <
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
          type="text/css"/>
@endsection
@section("wrapper")
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Fornecedor</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Lista de Fornecedores</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('suppliers.create')}}" class="btn btn-primary">Adicionar</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Registar Novo Fornecedor</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <x-bootstrap::form.form class="row g-3" action="{{route('suppliers.store')}}">
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1">
                                        <div class="num">1</div>
                                        Dados do Fornecedor
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-2">
                                        <span class="num">2</span>
                                        Contactos
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <div class="row">
                                        <div class="col-5">
                                            <x-bootstrap::form.input name="name" label="Nome"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="email" label="Email"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="supplier_type" label="Tipo de Fornecedor"
                                                                      :options="$supplierTypes"/>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="nuit" label="NUIT"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="country_id" label="Nacionalidade"
                                                                      :options="$countries" :default="152"/>
                                        </div>

                                        <div class="col-3">
                                            <x-bootstrap::form.select name="province_id" label="Província"
                                                                      :options="$provinces"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.select name="district_id" label="Distrito"
                                                                      :options="$districts"/>
                                        </div>
                                    </div>

                                </div>

                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <div class="row">

                                        <div class="col-6">
                                            <x-bootstrap::form.input name="phone" label="Contacto 1"/>
                                        </div>
                                        <div class="col-6">
                                            <x-bootstrap::form.input name="website" label="Pagina WEB"/>
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
