@extends("layouts.app")
@section("style")
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
                    <li class="breadcrumb-item active" aria-current="page">Editar produto da venda</li>
                </ol>
            </nav>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Editar dados do produto</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <x-bootstrap::form.form class="row g-3" method='PUT'  action="{{route('sale_items.update', $sale_item)}}"
                                            enctype="multipart/form-data">
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1">
                                        <div class="num">1</div>
                                        Dado do Produto da Venda
                                    </a>
                                </li>



                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-4">
                                                <x-bootstrap::form.select name="product_id" label="Produtos"
                                                                          :options="$products"
                                                                          default="{{old('product_id', $sale_item->product_id)}}"/>
                                            </div>
                                            <div class="col-3">
                                                <x-bootstrap::form.input type="number" name="quantity"   label="Quantidade"
                                                                         default="{{old('quantity', $sale_item->quantity)}}"/>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <x-bootstrap::form.input name="purchase_price" label="Preco de Compra"
                                                                         default="{{old('purchase_price', $sale_item->purchase_price)}}"/>
                                            </div>
                                            <div class="col-3">
                                                <x-bootstrap::form.input name="unit_price" label="Preco Unitário de Venda"
                                                                         default="{{old('unit_price', $sale_item->unit_price)}}"/>
                                            </div>

                                        </div>
                                    </div>

                                    <div>
                                        <p style="color: red;"> Todos campos são opcionais</p>
                                    </div>

                                        <div class="row float-end">
                                            <button class="btn btn-success"  type="submit">Actualizar</button>
                                        </div>

                                    <div class="clearfix"></div>

                                </div>
                            </div>



                        </div>

                        <!-- Include optional progressbar HTML -->
{{--                        <div class="progress">--}}
{{--                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0"--}}
{{--                                 aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}

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

