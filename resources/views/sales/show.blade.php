'

@extends("layouts.app")
@section("wrapper")

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vendas</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Dados Das Vendas</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">

                        <a href="{{route('sales.edit', $sale)}}" class="btn btn-primary">Editar</a>

            </div>
        </div>


    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">

                        </div>
                        <hr class="my-4"/>
                        <h5 class="d-flex align-items-center mb-3">Dados da Venda</h5>
                        <ul class="list-group list-group-flush">


                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">ID da venda</h6>
                                <span class="text-secondary">{{$sale->id}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Referencia </h6>
                                <span class="text-secondary">{{$sale->sale_ref}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Nome do Cliente</h6>

                                    <span class="text-secondary">{{$sale->customer_name}}</span>


                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Descricao da Venda</h6>
                                <span class="text-secondary">{{$sale->notes}}</span>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-striped table-bordered">
                                <thead>
                                <tr>

                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Preco de Venda</th>
                                    <th>Valor de Venda</th>
                                    <th>Preco de Compra</th>
                                    <th>Valor de Compra</th>
                                    <th>Impostos</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sale_items as $saleitem)
                                    <tr>
                                        <td>{{$saleitem->product->name}}</td>
                                        <td>{{$saleitem->quantity}}</td>
                                        <td>{{$saleitem->unit_price}}</td>
                                        <td>{{$saleitem->sub_total}}</td>
                                        <td>{{$saleitem->product->purchase_price}}</td>
                                        <td>{{$saleitem->product->purchase_price * $saleitem->quantity}}</td>





                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


