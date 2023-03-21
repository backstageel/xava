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
            <div class="btn-group">
                <a href="{{route('employees.create')}}" class="btn btn-primary">Editar</a>
                <a href="{{route('employees.create')}}" class="btn btn-primary">Remover</a>
                <a href="{{route('employees.create')}}" class="btn btn-primary">Adicionar</a>
                <a href="{{route('employees.create')}}" class="btn btn-primary">Adicionar</a>
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
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{asset('assets/images/avatars/avatar-2.png')}}" alt="Admin"
                                     class="rounded-circle p-1 bg-primary" width="110">

                                <div class="mt-3">
                                    <h4>{{$employee->person->prefix->code}} {{$employee->person->full_name}}</h4>
                                    <p class="text-secondary mb-1">{{$employee->employeePosition->name}}</p>
                                    <p class="text-muted font-size-sm">{{$employee->department->name}}</p>
                                    <button class="btn btn-primary">Ligar</button>
                                    <button class="btn btn-outline-primary">Enviar Mensagem</button>
                                </div>
                            </div>
                            <hr class="my-4"/>
                            <h5 class="d-flex align-items-center mb-3">Detalhes Pessoais</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Genero</h6>
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
                <div class="col-lg-8">
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
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="button" class="btn btn-primary px-4" value="Renovar Contrato"/>
                                    <input type="button" class="btn btn-primary px-4" value="Cancelar Contrato"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-flex align-items-center mb-3">Projectos Envolvidos</h5>
                                    {{--<p>Web Design</p>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"
                                             aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>Website Markup</p>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 72%"
                                             aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>One Page</p>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 89%"
                                             aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>Mobile Template</p>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 55%"
                                             aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p>Backend API</p>
                                    <div class="progress" style="height: 5px">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 66%"
                                             aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



