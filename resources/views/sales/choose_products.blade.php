@extends("layouts.app")
@section("style")
    <
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
          type="text/css"/>
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
            <h6 class="mb-0 text-uppercase">Adicionar productos a venda</h6>
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
                                        Productos
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">


                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-2">
                                                <x-bootstrap::form.input type="hidden" name="sale_id" class="form-control" value="{{$sale->id}}"/>
                                            </div>
                                            <div class="col-2">
                                                <x-bootstrap::form.input name="notes" class="form-control" label="Descrição do Produto"/>
                                            </div>
                                            <div class="col-3">
                                                <x-bootstrap::form.select name="product_id" label="Produtos"
                                                                          class="form-control" :options="$products" required/>
                                            </div>
                                            <div class="col-2">
                                                <x-bootstrap::form.input name="unit_price" label="Preco Unitario de Venda"
                                                                         class="form-control" required/>
                                            </div>
                                            <div class="col-5">
                                                <x-bootstrap::form.input name="quantity"   class="form-control" label="Quantidade" required/>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-success" name="form_products" type="submit">Gravar</button>
                                            <a href="{{route('sales.index')}}" class="btn btn-secondary" >Cancelar</a>
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

