
@extends("layouts.app")
@section("style")
    <style>
        .custom-select {

            height: 45px; /* Ajuste a altura desejada */
            font-size: 10px;
        }
        .opt{
            font-size: 13px;
        }
        .custom-select ::selection {
            background-color: #007bff; /* Cor de fundo da seleção */
            color: white; /* Cor do texto selecionado */
            font-size: 12px; /* Ajuste o tamanho da fonte desejado para o texto selecionado */
        }
    </style>
@endsection
@section("wrapper")

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Requisição</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Informação da Dispesa</li>

                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <h5 class="d-flex align-items-center mb-3">Dados da Requisição</h5>
                            <div class="mb-3 row">
                                <label for="staticEmail"
                                       class="col-sm-3 col-form-label text-end fw-bold">Requerente</label>
                                <div class="col-sm-9">

                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{\App\Models\User::find($expenseRequest->requester_user_id)->name}}">

                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Tipo da Requisição</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{\App\Models\ExpenseRequestType::find($expenseRequest->type_id)->name}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail"
                                       class="col-sm-3 col-form-label text-end fw-bold">Descrição</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$expenseRequest->description}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail"
                                       class="col-sm-3 col-form-label text-end fw-bold">Valor Requisitado</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$expenseRequest->amount.' MT'}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail"
                                       class="col-sm-3 col-form-label text-end fw-bold">Estado da Requisição</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$expenseRequest->approvalStatus->name??''}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail"
                                       class="col-sm-3 col-form-label text-end fw-bold">Estado da Contabilistico</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$expenseRequest->accountingStatus->name??''}}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">

                            <h5 class="d-flex align-items-center mb-3">Dados da Requisição</h5>
                            <div class="mb-3 row">
                                <label for="staticEmail"
                                       class="col-sm-3 col-form-label text-end fw-bold">Aprovado por</label>
                                <div class="col-sm-9">

                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$expenseRequest->approvedByUser->name??''}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Tipo da Requisição</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$expenseRequest->accoutantUser->name??''}}">
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection



