@extends("layouts.app")
@section("style")

    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
                                        <div class="col-6">
                                            <x-bootstrap::form.select
                                                name="customer_id"
                                                label="Nome da Instituição"
                                                :options="$companies"
                                            />
                                        </div>
                                        <div class="col-5">
                                            <x-bootstrap::form.select name="competition_type_id"
                                                                      label="Tipo de Concurso"

                                                                      :options="$competitionTypes"/>
                                        </div>




                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <x-bootstrap::form.input name="competition_reference"
                                                                     label="Referência do Concurso"/>
                                        </div>
                                        <div class="col-5">
                                            <x-bootstrap::form.select name="company_type_id"
                                                                      label="Tipo de Instituição"
                                                                      :options="$companyTypes" />

                                        </div>

{{--                                        <div class="col-6">--}}
{{--                                            <x-bootstrap::form.select name="product_category_id"--}}
{{--                                                                      label="Indústria do Concurso"--}}
{{--                                                                      :options="$productCategories"--}}
{{--                                                                      :value="$selected_nature_name ?? null"/>--}}
{{--                                        </div>--}}
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.date-time-picker name="proposal_delivery_date"
                                                                                label="Data e hora da Entrega da Proposta"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="bidding_documents_value"
                                                                     label="Preço do Caderno.Enc"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="proposal_value"
                                                                     label="Valor da Proposta"/>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                        <fieldset class="border p-2 position-relative">
                                            <legend class="border-bottom mb-0 px-3 position-absolute top-0 start-50 translate-middle-x"
                                                    style="background-color: white; font-size: 14px;">
                                                <strong>Indústria do Concurso</strong>
                                            </legend><br><br>

                                            <div class="col-9">
                                                @foreach($productCategories as $category)
                                                    <div onchange="verify_check()">

                                                        <input type="checkbox" class="form-check-input" id="_{{$category->id}}" name="product_category_id[]" value="{{$category->id}}">
                                                        <label class="form-check-label">{{ $category->name }}</label>
                                                    </div>

                                                @endforeach
                                            </div>


                                            </fieldset>
                                        </div>
{{--                                            <div class="col-4">--}}
{{--                                                <x-bootstrap::form.select name="rolling_stock_subcategory_ids[]"--}}
{{--                                                                          label="Sub-categoria de Meios Circulantes"--}}
{{--                                                                          :options="$rolling_stock_subcategory" multiple />--}}
{{--                                            </div>--}}

                                        <div class="col-3" >
                                        <div class="dropdown" id="rolling_stock" style=" display: none">
                                            <button class="btn btn-secondary dropdown-toggle custom-button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:rgb(89,192,250);color: #ffffff; border: 1px solid #cccccc;  ">
                                                Meios Circulantes
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                @foreach($productsubcategory as $subcategory)
                                                    @if($subcategory->product_category_id==3)
                                                <a class="dropdown-item" href="#">

                                                    <input type="checkbox" id="item1" name="rolling_stock_subcategory_ids[]"  value="{{$subcategory->id}}">
                                                    <label for="item1">{{ $subcategory->name }}</label>
                                                </a>@endif @endforeach

                                                                                        </div>
                                        </div>

                                        </div>

                                        <div class="col-5">
                                            <div class="dropdown" id="electronic" style=" display: none">
                                                <button class="btn btn-secondary dropdown-toggle custom-button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:rgb(89,192,250);color: #ffffff; border: 1px solid #cccccc; ">
                                                    Equipamento Electrónico
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @foreach($productsubcategory as $subcategory)
                                                        @if($subcategory->product_category_id==11)
                                                        <a class="dropdown-item" href="#">

                                                            <input type="checkbox" id="item1" name="electronic_subcategory_ids[]"  value="{{$subcategory->id}}">
                                                            <label for="item1">{{ $subcategory->name }}</label>
                                                        </a>@endif @endforeach

                                                </div>
                                            </div><br><br><br><br><br><br><br><br><br><br><br><br>

                                        </div>

{{--                                        <div class="col-3">--}}
{{--                                            <x-bootstrap::form.select name="electronic_subcategory_ids[]"--}}
{{--                                                                      label="Sub-categoria de Electronica"--}}
{{--                                                                      :options="$electronic_subcategory" multiple />--}}
{{--                                        </div>--}}
{{--                                        </div>--}}

                                    </div>
                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="provisional_bank_guarantee"
                                                                     label="Garantia Provisoria"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="provisional_bank_guarantee_award"
                                                                     label="Prémio da Garantia"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="definitive_guarantee"
                                                                     label="Garantia Definitiva"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="definitive_guarantee_award"
                                                                     label="Prémio da Garantia"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="advance_guarantee"
                                                                     label="Garantia de Adiatamento"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="advance_guarantee_award"
                                                                     label="Prémio da Garantia"/>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="responsible" label="Responsável do concurso"
                                                                      :options="$employees"
                                                                      :value="$selected_employee_name ?? null"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="technical_proposal_review"
                                                                      label="Responsável pela revisão da Proposta"
                                                                      :options="$employees"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="documentary_review"
                                                                      label="Responsável pela Revisão Documental"
                                                                      :options="$employees"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4" >
                                            <x-bootstrap::form.select name="competition_status_id" label="Fase/Estágio do Concurso"
                                                                      :options="$competitionStatuses"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="competition_result_id " onchange="verify_result()"
                                                                      label="Resultado"
                                                                      :options="$competitionResult" id="status" :default="1"/>
                                        </div>
                                        <div class="col-4" id="reason" style="display: none">
                                            <x-bootstrap::form.select name="competition_reason_id" label="Motivo"
                                                                      :options="$competitionReasons" />
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6" id="reason_description" style="display: none">
                                            <x-bootstrap::form.input name="reason_description" label="Descrição do Motivo"/>
                                        </div>
                                        <div class="row float-end">

                                            <div class="col-12">

                                                <button class="btn btn-success" type="submit">Gravar</button>
                                            </div>
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
        function verify_result() {
            var status = document.getElementById("status").value;
            var reason_field = document.getElementById("reason");
            var reason_description_field =document.getElementById('reason_description');

            if (status==2) {
                reason_field.style.display = "block";
                reason_description_field.style.display="block";
            } else if(status==3){
                reason_field.style.display = "block";
                reason_description_field.style.display="block";
            }else if(status==4){
                reason_description_field.style.display="block";
                reason_field.style.display = "block";
            }else{
                reason_field.style.display = "none";
                reason_description_field.style.display="none";
            }
        }
        function verify_check() {

            var checkboxElectronic = document.getElementById("_11");//id dos eletronicos
            var checkboxRollingStock = document.getElementById("_3");//id dos meios circulantes
            var electronicField = document.getElementById("electronic");
            var rollingStockField = document.getElementById("rolling_stock");

            if (checkboxElectronic.checked && checkboxRollingStock.checked) {
                electronicField.style.display = "block";
                rollingStockField.style.display = "block";
            } else if (checkboxElectronic.checked) {
                electronicField.style.display = "block";
                rollingStockField.style.display = "none";
            } else if (checkboxRollingStock.checked) {
                electronicField.style.display = "none";
                rollingStockField.style.display = "block";
            } else {
                electronicField.style.display = "none";
                rollingStockField.style.display = "none";
            }
        }

    </script>
@endsection
