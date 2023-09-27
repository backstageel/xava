@extends("layouts.app")
@section("wrapper")
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Colaboradores</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Perfil do colaborador</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

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
                                @if ($employee->person->profile_picture)
                                    <img src="{{  asset('storage/'.$employee->person->profile_picture)}}" width="110"
                                         height="110" class="rounded-circle shadow"
                                         alt="s Profile Picture">
                                @else
                                    <img src="{{ asset('assets/images/default-profile-picture.png') }}" width="110"
                                         height="110" class="rounded-circle shadow" alt="Default Profile Picture">
                                @endif

                                <div class="mt-3">
                                    <h4>{{$employee->person->prefix->code}} {{$employee->person->full_name}}</h4>
                                    <p class="text-secondary mb-1">{{$employee->employeePosition->name}}</p>
                                    <p class="text-muted font-size-sm">{{$employee->department->name}}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="d-flex align-items-center mb-3">Detalhes Pessoais</h5>
                            <hr class="my-4"/>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Gênero</h6>
                                    <span class="text-secondary">{{$employee->person->gender->name}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Data de Nascimento</h6>
                                    <span class="text-secondary">{{$employee->person->birth_date}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Celular</h6>
                                    <span class="text-secondary">{{$employee->person->cellphone}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Email Pessoal</h6>
                                    <span class="text-secondary">{{$employee->person->personal_email}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">NUIT</h6>
                                    <span class="text-secondary">{{$employee->person->nuit}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
                    <div class="row">
                        <div class="col-sm-12">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="d-flex align-items-center mb-3">Detalhes do Contrato</h5>
                                        <div class="mb-3 row">
                                            <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Data de
                                                Inicio</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                       value="{{$employee->start_date}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Tipo de
                                                Contrato</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                       value="{{$employee->contractType->name}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Estado do
                                                Contrato</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                       value="{{$employee->contractStatus->name}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Salário
                                                Base</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                       value="0MT">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Contacto de
                                                Emergencia</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                       value="{{$employee->emergency_name}} ({{$employee->emergency_phone}})">
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection



