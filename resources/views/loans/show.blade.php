

@extends("layouts.app")
@section("wrapper")

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Empretimos</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Dados Do Emprestimo</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            @php
                $userID = Auth::user()->id;
                $personID = \App\Models\Person::where('user_id',$userID)->value('id');
                $employee_position_id = \App\Models\Employee::where('person_id',$personID)->value('employee_position_id');
            @endphp





            @if(($employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_OPERATIVO ||
                                    $employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_GERAL
                                    || $userID == 1) &&
                                    $userID != \App\Models\User::where('id',
                                        \App\Models\Person::where('id', $loan->employee->person_id)->value('user_id'))->value('id') &&
                                    $loan->status == "Aprovado")

                <a href="{{route('payments.create', $loan)}}" class="btn btn-primary">Efectuar Pagamento</a>


{{--                    <x-bootstrap::form.form class="row g-3" action="{{route('payments.store')}}">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="loan_id" value="{{$loan->id}}"/>--}}

{{--                        <button class="btn btn-primary" >Ver Pagamentos</button>--}}
{{--                    </x-bootstrap::form.form>--}}


            @endif




        </div>
        </div>

    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    @if ($loan->employee->person->profile_picture)
                                        <img src="{{asset('storage/'.$employee->person->profile_picture)}}" width="110"
                                             height="110" class="rounded-circle shadow"
                                             alt="s Profile Picture">
                                    @else
                                        <img src="{{ asset('assets/images/default-profile-picture.png') }}" width="110"
                                             height="110" class="rounded-circle shadow" alt="Default Profile Picture">
                                    @endif

                                    <div class="mt-3">
                                        <br>
                                        <h4>{{$employee->person->prefix->code}} {{$employee->person->full_name}}</h4>
                                        <p class="text-secondary mb-1">{{$employee->employeePosition->name}}</p>
                                        <p class="text-muted font-size-sm">{{$employee->department->name}}</p>
                                    </div>
                                </div>


                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">

                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Contacto</h6>
                                <span class="text-secondary">{{$employee->person->phone}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Email Pessoal</h6>
                                <span class="text-secondary">{{$employee->person->email}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">NUIT</h6>
                                <span class="text-secondary">{{$employee->person->nuit}}</span>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="d-flex align-items-center mb-3">Dados do Empretimo</h5><br>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Valor Do Empretimo</h6>
                            <span class="text-secondary">{{$loan->amount}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Nr de meses a pagar</h6>

                            <span class="text-secondary">{{$loan->months}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Prestação Mensal</h6>
                            <span class="text-secondary">{{$loan->installment}}</span>

                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Total Pago</h6>
                            <span class="text-secondary">{{$loan->total_paid}}</span>

                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Divida</h6>
                            <span class="text-secondary">{{$loan->debt}}</span>
                        </li>

                    </div>
                    @if(($employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_OPERATIVO ||
                                    $employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_GERAL
                                    || $userID == 1) &&
                                    $userID != \App\Models\User::where('id',
                                        \App\Models\Person::where('id', $loan->employee->person_id)->value('user_id'))->value('id') &&
                                    $loan->status == "Pendente")

                    <div class="d-flex justify-content-end">
                        <form method="POST" action="{{ route('loans.approve', $loan) }}">
                            @csrf
                            <button class="btn btn-success" type="submit">Aprovar</button>
                        </form>
                        &nbsp;
                        <form method="POST" action="{{ route('loans.reject', $loan) }}">
                            @csrf
                            <button class="btn btn-danger" type="submit">Recusar</button>
                        </form>
                    </div>
                    <br>
                    @endif

                    @if(($userID == \App\Models\User::where('id',
                                        \App\Models\Person::where('id', $loan->employee->person_id)->value('user_id'))->value('id'))  &&
                                    $loan->status == "Simulacao"
                                   )

                        <div class="d-flex justify-content-end">
                            <form method="POST" action="{{ route('loans.submit', $loan) }}">
                                @csrf
                                <button class="btn btn-success" type="submit">Submeter Pedido</button>
                            </form>

                        <form action="{{ route('loans.destroy', $loan) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta simulação?')">Remover</button>
                        </form>
                        </div>
                        <br>
                    @endif
                    @if($userID == \App\Models\User::where('id',
                                        \App\Models\Person::where('id', $loan->employee->person_id)->value('user_id'))->value('id')  &&
                                    $loan->status == "Pendente")

                        <div class="d-flex justify-content-end">
                            <form method="POST" action="{{ route('loans.cancel', $loan) }}">
                                @csrf
                                <button class="btn btn-success" type="submit">Cancelar Pedido</button>
                            </form>
                        </div>
                        <br>
                    @endif
                    @if(($employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_OPERATIVO ||
                                    $employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_GERAL
                                    || $userID == 1) &&
                                    $userID != \App\Models\User::where('id',
                                        \App\Models\Person::where('id', $loan->employee->person_id)->value('user_id'))->value('id')  &&
                                    $loan->status == "Aprovado")

                        <div class="d-flex justify-content-end">
                            <form method="POST" action="{{ route('loans.cancel', $loan) }}">
                                @csrf
                                <button class="btn btn-light-warning" type="submit">Cancelar</button>
                            </form>
                            &nbsp;
                            <form method="POST" action="{{ route('vacations.reject', $loan) }}">
                                @csrf
                                <button class="btn btn-danger" type="submit">Recusar</button>
                            </form>
                        </div>
                        <br>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </div>

@endsection



