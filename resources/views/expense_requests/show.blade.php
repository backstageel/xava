
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

    <!--breadcrumb-->
    @php
        $userID = Auth::user()->id;
        $personID = \App\Models\Person::where('user_id',$userID)->value('id');
        $employee_position_id = \App\Models\Employee::where('person_id',$personID)->value('employee_position_id');
        $accounting_statuses=\App\Models\AccountingStatus::get();
    @endphp
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
                            <div class="mb-3 row">
                                <label for="staticEmail"
                                       class="col-sm-3 col-form-label text-end fw-bold">Estado da Requisição</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$expenseRequest->approvalStatus->name??''}}">
                                </div>

                            </div>
                            @if($employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_FINANCEIRO)
                            <form method="POST" action="{{ route('expense_requests.accountingStatus', $expenseRequest) }}">
                                @csrf
                            <div class="mb-1 row">
                                <label for="staticEmail"
                                       class="col-sm-3 col-form-label text-end fw-bold">Estado Contabilistico</label>
                                <div class="col-sm-6">
                                    <select name="accounting_status_id" class="form-select form-select-lg mb-1 custom-select" aria-label=".form-select-lg example">
                                        @foreach($accounting_statuses as $status)
                                            @if($status->name=="Contabilizado")
                                            <option class ="opt" value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <div class="mb-2 row">
                                    <label for="staticEmail"
                                           class="col-sm-3 col-form-label text-end fw-bold">Conta da Transação</label>
                                    <div class="col-sm-6">
                                        <select name="transaction_account_id" class="form-select form-select-lg mb-1 custom-select" aria-label=".form-select-lg example">
                                            @foreach($transactionAccount as $transaction)
                                                    <option class ="opt" value="{{ $transaction->id }}">{{ $transaction->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="staticEmail"
                                           class="col-sm-3 col-form-label text-end fw-bold">Nr da Conta</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="transfer_account_number" class="form-control-plaintext" id="staticEmail">
                                    </div>

                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                        @csrf
                                    <button class="btn btn-success" type="submit">Gravar</button>
                                </div>
                            </form>
                            @endif
                            @if(($employee_position_id==\App\Enums\EmployeePosition::GESTOR_ESCRITORIO || $userID == 1) && $expenseRequest->transactionAccount->name == "Caixa")

                                <form method="POST" action="{{ route('expense_requests.confirm', $expenseRequest)}}">
                                    @csrf
                                <div class="mb-3 row">
                                    <label for="staticEmail"
                                           class="col-sm-3 col-form-label text-end fw-bold">Estado Contabilistico</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                               value="{{$expenseRequest->accountingStatus->name??''}}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Trocos</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="change" class="form-control-plaintext" id="staticEmail">
                                        </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    @csrf
                                        <button class="btn btn-success" type="submit">Fechar</button>
                                </div>
                                </form>
                            @endif

                            <div class="row">
                                @if($employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_GERAL||$employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_OPERATIVO)

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
                                @endif
                            </div>

                        </div>


                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection



