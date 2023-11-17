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
                    <x-bootstrap::form.form class="row g-3" action="{{route('expense_requests.store')}}">
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
                                        <div class="col-8">
                                            <x-bootstrap::form.input name="description" label="Descrição" required/>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="amount" label="Valor da Transação" required/>
                                        </div>
{{--                                        <div class="col-4">--}}
{{--                                            <x-bootstrap::form.select name="transaction_account_id" label="Conta da Transação"--}}
{{--                                            :options="$transactionAccount"/>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-4">--}}
{{--                                            <x-bootstrap::form.input name="transfer_account_number" label="Número da Conta"/>--}}
{{--                                        </div>--}}

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
