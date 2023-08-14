'

@extends("layouts.app")
@section("wrapper")

    <!--breadcrumb-->
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
{{--        <div class="ms-auto">--}}
{{--            <div class="btn-group">--}}
{{--                <a href="{{route('expense_requests.edit', $expense)}}" class="btn btn-primary">Editar</a>--}}
{{--                <a href="{{route('expense_requests.create')}}" class="btn btn-primary">Adicionar</a>--}}
{{--                @php--}}
{{--                    $province = \App\Models\Province::find($supplier->supplierable->address_province_id);--}}
{{--                    $country=\App\Models\Country::find($supplier->supplierable->address_country_id);--}}
{{--                    $district=\App\Models\District::find($supplier->supplierable->address_district_id);--}}
{{--                @endphp--}}
{{--            </div>--}}
{{--        </div>--}}
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

                            <div class="row">

                                <div class="col-12 d-flex justify-content-end">
                                    <form method="POST" action="{{ route('expense_requests.approve', $expenseRequest) }}">
                                        @csrf
                                    <button class="btn btn-success" type="submit">Aprovar</button>
                                    </form>
                                    &nbsp;
                                    <form method="POST" action="{{ route('expense_requests.reject', $expenseRequest) }}">
                                        @csrf
                                    <button class="btn btn-danger" type="submit">Recusar</button>
                                    </form>
                                </div>

                            </div>
                            </form>
                        </div>


                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection



