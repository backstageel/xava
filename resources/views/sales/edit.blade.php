@extends("layouts.app")
@section("style")

    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- Biblioteca CSS do Select2 -->
    <link href="{{asset('')}}assets/plugins/select2/css/select2.min.css" rel="stylesheet"
          type="text/css">
    <link href="{{asset('')}}assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet"
          type="text/css">

@endsection

@section("wrapper")
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vendas</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Venda</li>
                </ol>
            </nav>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Editar Venda</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <x-bootstrap::form.form class="row g-3" method='PUT'  action="{{route('sales.update', $sale)}}"
                                            enctype="multipart/form-data">
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1">
                                        <div class="num">1</div>
                                        Dados do Venda
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-2">
                                        <span class="num">2</span>
                                        Despesas
                                    </a>
                                </li>


                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <div class="row">
                                        <div class="col-7">
                                            <x-bootstrap::form.select id="mySelect" name="customer_id" label="Cliente"
                                               :options="$customers"
                                               default="{{old('customer_id', $sale->customer_id)}}"/>
                                        </div>
                                        <div class="col-5"> <!-- Adicione a classe form-select -->
                                            <x-bootstrap::form.select   name="category_id" label="Departamento" :options="$categories"
                                               value="{{old('category_id', isset($sale->category_id) ? $sale->category_id : '')}}"/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="sale_ref" label="Referência"
                                                 value="{{old('sale_ref',isset($sale->sale_ref) ? $sale->sale_ref : '')}}"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="invoice_id" label="Nr da Factura"
                                                                     value="{{old('invoice_id', isset($sale->invoice_id) ? $sale->invoice_id : '')}}" />
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="payment_method" label="Método de Pagamento"
                                                                     value="{{old('payment_method',isset($sale->payment_method) ? $sale->payment_method : '')}}"/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="notes" label="Descrição da Venda"
                                              value="{{old('notes',isset($sale->notes) ? $sale->notes : '')}}"/>
                                        </div>

                                        <div class="col-4">
                                            <x-bootstrap::form.select name="sale_status_id" label="Estado da Venda"
                                                                      :options="$sale_statuses"
                                              default="{{old('sale_status_id', isset($sale->sale_status_id) ? $sale->sale_status_id : '')}}"
                                                                      />
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.date-picker name="sale_date" label="Data da Venda"
                                                 value="{{old('sale_date',isset($sale->sale_date) ? $sale->sale_date : '')}}"/>
                                        </div>



                                    </div>

                                    <div>
                                        <p style="color: red;"> Todos campos são opcionais</p>
                                    </div>

                                </div>


                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="receipt_id" label="Nr do Recibo"
                                              value="{{old('receipt_id',isset($sale->receipt_id) ? $sale->receipt_id : '')}}"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="amount_received" label="Valor Recebido"
                                             value="{{old('amount_received',isset($sale->amount_received) ? $sale->amount_received : '')}}"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="transport_value" label="Valor do Transporte"
                                              value="{{old('transport_value',isset($sale->transport_value) ? $sale->transport_value : '')}}"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.date-picker name="payment_date" label="Data de Pagamento"
                                              value="{{old('payment_date',isset($sale->payment_date) ? $sale->payment_date : '')}}"/>
                                        </div>

                                        <div class="col-4">
                                            <x-bootstrap::form.input name="other_expenses" label="Valor de Outras Despesas"
                                               value="{{old('other_expenses',isset($sale->other_expenses) ? $sale->other_expenses : '')}}"/>
                                        </div>

                                        <div class="col-4">
                                            <x-bootstrap::form.input name="intermediary_committee" label="Comissão de Intermediários"
                                               value="{{old('intermediary_committee',isset($sale->intermediary_committee) ? $sale->intermediary_committee : '')}}"/>
                                        </div>
                                    </div>
                                    <div>
                                        <p style="color: red;"> Todos campos são opcionais</p>
                                    </div>


                                    <div class="row float-end">
                                            <button class="btn btn-success"  type="submit">Salvar</button>
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
    <script src="{{asset('')}}assets/plugins/select2/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#smartwizard').smartWizard({
                theme: 'arrows',
            });

            $('#mySelect').select2();
        });
    </script>
@endsection

