@extends("layouts.app")
@section("style")

    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
          type="text/css"/>
    <style>
        .sw-btn-next,
        .sw-btn-prev {
            display: none !important;
        }
    </style>
@endsection
@section("wrapper")
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Requisição de Despesa</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Lista de Requisições</li>
                </ol>
            </nav>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Registar Nova Requisição</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <x-bootstrap::form.form class="row g-3" method="POST" action="{{ $is_box ? route('expense_request.store_box_request') : route('expense_requests.store') }}">
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1">
                                        <div class="num">1</div>
                                        Dados da Requesição
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <div class="row">
                                        <div class="col-4">

                                            <x-bootstrap::form.select name="type_id" label="Tipo de Despesa"
                                                                      :options="$expenseRequestType"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="description" label="Descrição" required/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.date-picker name="request_date" label="Data da Requisicão" required/>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <x-bootstrap::form.input name="amount" label="Valor da Transação" required/>
                                        </div>

                                        <div class="col-5">
                                            <x-bootstrap::form.input name="invoice" label="Nr da Factura" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if($is_box)
                                            <div class="col-4">
                                                <x-bootstrap::form.select name="requester_user_id" label="Requerente"
                                                                          :options="$users"/>
                                            </div>
                                            <div class="col-4">
                                                <x-bootstrap::form.input name="change" label="Trocos"/>
                                            </div>
                                            <div class="col-4">
                                                <x-bootstrap::form.group name="requires_receipt" label="Justificativo?">
                                                    <div class="form-check form-check-inline col-4">
                                                        <input class="form-check-input" type="radio" name="requires_receipt" id="requires_receipt_yes" value="1">
                                                        <label class="form-check-label" for="requires_receipt_yes">Sim</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="requires_receipt" id="requires_receipt_no" value="0" checked>
                                                        <label class="form-check-label" for="requires_receipt_no">Não</label>
                                                    </div>
                                                </x-bootstrap::form.group>
                                            </div>
                                        @endif


                                    </div>

                                    </div>

                            </div>
                            <div class="row float-end">
                                <div class="col-12">
                                    <button class="btn btn-success" type="submit">Requisitar</button>
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
