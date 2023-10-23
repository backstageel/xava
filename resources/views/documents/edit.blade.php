@extends("layouts.app")
@section("style")

    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
          type="text/css"/>
@endsection
@section("wrapper")
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Documentos</div>

    </div>
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <hr/>
            <div class="card">
                <div class="card-body">
                    <x-bootstrap::form.form method="PUT" class="row g-3" action="{{route('documents.update', $document)}}"
                                            enctype="multipart/form-data">
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1">
                                        <div class="num">1</div>

                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="name" label="Nome do documento"
                                                                     default="{{$document->name}}" required/>
                                        </div>
                                        <div class="col-2" style="display:none">
                                            <x-bootstrap::form.input name="path" label="path"
                                                                     :value="$path"/>
                                        </div>
                                        <div class="col-4">
                                                <x-bootstrap::form.date-picker name="meeting_date" label="Data de Validade" required/>
                                        </div>


                                    <div class="row float-end">
                                        <div class="col-12">
                                            <button class="btn btn-success" type="submit">editar</button>
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
