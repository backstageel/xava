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
        <div class="breadcrumb-title pe-3">Editar Dia de Folga</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                </ol>
            </nav>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <hr/>
            <div class="card">
                <div class="card-body">
                    <x-bootstrap::form.form class="row g-3" method="PUT" action="{{route('holidays.update', $holiday)}}">
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1">
                                        <div class="num">1</div>
                                        Dados da Pedido
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.date-picker name="holiday_date" label="Dia de ifolga"
                                                                           :default="$holiday->holiday_date"
                                                                           required/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row float-end">
                                <div class="col-12">
                                    <button class="btn btn-success" type="submit">Submeter</button>
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
