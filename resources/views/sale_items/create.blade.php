@extends("layouts.app")
@section("style")
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- Biblioteca CSS do Select2 -->
    <link href="{{asset('')}}assets/plugins/select2/css/select2.min.css" rel="stylesheet"
          type="text/css">
    <link href="{{asset('')}}assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet"
          type="text/css">
    <style>
        .sw-btn-next,
        .sw-btn-prev {
            display: none !important;
        }
    </style>

@endsection
@section("wrapper")
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Escolher Produtos</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Produtos</li>
                </ol>
            </nav>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Adicionar Productos a Venda</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <x-bootstrap::form.form class="row g-3" action="{{route('sale_items.store')}}"
                                            enctype="multipart/form-data">
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1">
                                        <div class="num">1</div>
                                         Seleção de productos
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-4">
                                                <x-bootstrap::form.select id="mySelect" name="product_id" label="Produtos"
                                                                         :options="$products" required/>
                                            </div>
                                            <div class="col-4">
                                                <x-bootstrap::form.select  name="supplier_id" label="Fornecedor"
                                                                          :options="$suppliers" />
                                            </div>
                                            <div class="col-3">
                                                <x-bootstrap::form.input type="number" name="quantity"   label="Quantidade" required/>
                                            </div>
                                            <div class="col-1">
                                                <x-bootstrap::form.input type="hidden" name="sale_id" class="form-control" value="{{$sale->id}}"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <x-bootstrap::form.input  name="purchase_price" label="Preco de Compra" required/>
                                            </div>
                                            <div class="col-3">
                                                <x-bootstrap::form.input  name="unit_price" label="Preco Unitário de Venda"
                                                                        required/>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-success"  type="submit">Adicionar</button>
                                            <a href="{{route('sales.index')}}" class="btn btn-secondary" >Terminar</a>
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

