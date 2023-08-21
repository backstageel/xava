@extends("layouts.app")
@section("style")

    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
          type="text/css"/>
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
        <div class="breadcrumb-title pe-3">Cartão de Dispesas</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Saldo</li>
                </ol>
            </nav>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Recarregar Cartão</h6>
            <hr/>
            <div class="card">
                <div class="card-body">

                    <x-bootstrap::form.form method='PUT' action="{{route('card_loads.update', $cardLoad)}}">
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1">
                                        <div class="num">1</div>
                                        Recarregar Cartão
                                    </a>
                                </li>


                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="last_balance" label="Saldo Actual "
                                                                     value="{{old('balance', $cardLoad->balance)}}" readonly/>
                                        </div>

                                        <div class="col-8">
                                            <x-bootstrap::form.input name="balance" label="Indique o Montante"
                                                                     value="" required/>
                                        </div>
                                    </div>

                                </div>

                            </div>


                        <div class="row float-end">
                            <div class="col-12">
                                <button class="btn btn-success" type="submit">Recarregar</button>
                            </div>
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

