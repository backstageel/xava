@extends("layouts.app")
@section("style")
    <
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
          type="text/css"/>
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
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('sales.create')}}" class="btn btn-primary">Adicionar</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Registar Nova Venda</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <x-bootstrap::form.form class="row g-3" action="{{route('sales.store')}}"
                                            enctype="multipart/form-data">
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1">
                                        <div class="num">1</div>
                                        Dados da Venda
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

                                        <div class="col-3">
                                            <x-bootstrap::form.select name="customer_id" label="Cliente"
                                                    :options="$customers"  required
                                           />

                                        </div>

                                        <div class="col-4">
                                            <x-bootstrap::form.input name="sale_ref" label="Referência" required/>
                                        </div>
                                        <div class="col-5">
                                            <x-bootstrap::form.input name="invoice_id" label="Nr da Factura"/>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="notes" label="Descrição da Venda"/>
                                        </div>

                                        <div class="col-3">
                                            <x-bootstrap::form.select name="sale_status_id" label="Estado da Venda"
                                                                      :options="$sale_statuses"/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.date-picker name="sale_date" label="Data da Venda" required/>
                                        </div>
                                        <div class="col-3">
                                            <x-bootstrap::form.input name="payment_method" label="Método de Pagamento"/>
                                        </div>

                                    </div>



                                </div>


                                     <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="receipt_id" label="Nr do Recibo"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="amount_received" label="Valor Recebido"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="transport_value" label="Valor do Transporte"
                                            />
                                        </div>
                                    </div>
                                    <div class="row">
                                                <div class="col-4">
                                                    <x-bootstrap::form.date-picker name="payment_date" label="Data de Pagamento" />
                                                </div>

                                        <div class="col-4">
                                            <x-bootstrap::form.input name="other_expenses" label="Valor de Outras Despesas" />
                                        </div>

                                        <div class="col-4">
                                            <x-bootstrap::form.input name="intermediary_committee" label="Comissão de Intermediários" />
                                        </div>
                                        <div>
                                            <p style="color: red;"> Formatação para campos númericos = (20.00)</p>
                                        </div>
                                        </div>
                                         <div class="row float-end">
                                             <div class="col-12">
                                                 <button class="btn btn-success" name="create_sale" type="submit">Gravar</button>
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

