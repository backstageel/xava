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
    @endphp
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Férias</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Pedido de Férias</li>

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

                            <h5 class="d-flex align-items-center mb-3">Dados do Pedido</h5>
                            <div class="mb-3 row">
                                <label for="staticEmail"
                                       class="col-sm-3 col-form-label text-end fw-bold">Requerente</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value= "{{\App\Models\User::find($vacation->user_id)->name}}">

                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Data de Ínicio</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$vacation->start_date}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail"
                                       class="col-sm-3 col-form-label text-end fw-bold">Data de Fim</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$vacation->end_date}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail"
                                       class="col-sm-3 col-form-label text-end fw-bold">Nr de Dias</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$vacation->number_of_days}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail"
                                       class="col-sm-3 col-form-label text-end fw-bold">Estado do Pedido</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$vacation->vacationStatus->name??''}}">
                                </div>

                            </div>

                            @if(($employee_position_id==\App\Enums\EmployeePosition::GESTOR_ESCRITORIO
                                    || $userID == 1) &&
                                    $userID != $vacation->user_id  &&
                                    $vacation->vacationStatus->name == "Pendente")
                                <div class="col-12 d-flex justify-content-end">
                                    <form method="POST" action="{{ route('vacations.approve', $vacation) }}">
                                        @csrf
                                        <button class="btn btn-success" type="submit">Aprovar</button>
                                    </form>
                                    &nbsp;
                                    <form method="POST" action="{{ route('vacations.reject', $vacation) }}">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Recusar</button>
                                    </form>
                                </div>
                            @endif
                            @if(($employee_position_id==\App\Enums\EmployeePosition::GESTOR_ESCRITORIO
                                    || $userID == 1)  &&
                                    $vacation->vacationStatus->name == "Aprovado" &&
                                    $userID != $vacation->user_id)
                                <div class="col-12 d-flex justify-content-end">
                                    <form method="POST" action="{{ route('vacations.cancel', $vacation) }}">
                                        @csrf
                                        <button class="btn btn-success" type="submit">Cancelar</button>
                                    </form>
                                </div>
                            @endif
                            @if($userID == $vacation->user_id &&
                                    $vacation->vacationStatus->name == "Pendente")
                                <div class="col-12 d-flex justify-content-end">
                                    <form method="POST" action="{{ route('vacations.cancel', $vacation) }}">
                                        @csrf
                                        <button class="btn btn-success" type="submit">Cancelar</button>
                                    </form>
                                    &nbsp;
                                    <form method="POST" action="{{route('vacations.edit', $vacation) }}">
                                        @csrf
                                        <button class="btn btn-success" type="submit">Actualizar datas</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>

@endsection



