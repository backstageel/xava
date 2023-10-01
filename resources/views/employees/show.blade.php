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
{{--                <form action="{{ route('employee.destroy', $employee) }}" method="POST">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este colaborador?')">Remover</button>--}}
{{--                </form>--}}
                <a href="{{route('employees.edit', $employee)}}" class="btn btn-primary">Editar</a>
{{--                <a href="{{route('employees.create')}}" class="btn btn-primary">Remover</a>--}}
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
                                @if ($employee->person->profile_picture)
                                    <img src="{{  asset('storage/'.$employee->person->profile_picture)}}" width="110"
                                         height="110" class="rounded-circle shadow"
                                         alt="s Profile Picture">
                                @else
                                    <img src="{{ asset('assets/images/default-profile-picture.png') }}" width="110"
                                         height="110" class="rounded-circle shadow" alt="Default Profile Picture">
                                @endif

                                <div class="mt-3">
                                    <br>
                                    <h4>{{$employee->person->prefix->code}} {{$employee->person->full_name}}</h4><br>
                                    <p class="text-secondary mb-1">{{$employee->employeePosition->name}}</p><br>
                                    <p class="text-muted font-size-sm">{{$employee->department->name}}</p>
                                    <button class="btn btn-primary">Ligar</button>
                                    <button class="btn btn-outline-primary">Enviar Mensagem</button>
                                </div>
                            </div>
                            <hr class="my-4"/>


                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="d-flex align-items-center mb-3">Detalhes do Contrato</h5>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Data de
                                    Ínicio</label>
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
                                           value="{{$employee->base_salary}}">
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
{{--                                <div class="col-sm-9 text-secondary">--}}
{{--                                    <input type="button" class="btn btn-primary px-4" value="Renovar Contrato"/>--}}
{{--                                    <input type="button" class="btn btn-primary px-4" value="Cancelar Contrato"/>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="d-flex align-items-center mb-3">Detalhes Pessoais</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div >
                                        <div class="card-body">
                                            <div class="mb-3 row">
                                                <label for="staticEmail" class="col-sm-6 col-form-label text-start fw-bold">Gênero</label>
                                                <div class="col-sm-5">
                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                           value="{{$employee->person->gender->name}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="staticEmail" class="col-sm-6 col-form-label text-start fw-bold">Data de Nascimento</label>
                                                <div class="col-sm-5">
                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                           value="{{$employee->person->birth_date}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="staticEmail" class="col-sm-6 col-form-label text-start fw-bold">Celular</label>
                                                <div class="col-sm-5">
                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                           value="{{$employee->person->phone}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="staticEmail" class="col-sm-6 col-form-label text-start fw-bold">Email Pessoal</label>
                                                <div class="col-sm-5">
                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                           value="{{$employee->person->email}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="staticEmail" class="col-sm-6 col-form-label text-start fw-bold">NUIT</label>
                                                <div class="col-sm-5">
                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                           value="{{$employee->person->nuit}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="staticEmail" class="col-sm-6 col-form-label text-start fw-bold">Estado Cívil</label>
                                                <div class="col-sm-5">
                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                           value="{{$employee->person->civilStates->name}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div >
                                        <div class="card-body">
                                            <div class="mb-3 row">
                                                <label for="staticEmail" class="col-sm-6 col-form-label text-start fw-bold">País de Nascimento</label>
                                                <div class="col-sm-5">
                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                           value="{{$employee->person->countryOfBirth->name}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="staticEmail" class="col-sm-6 col-form-label text-start fw-bold">Provincia de Nascimento</label>
                                                <div class="col-sm-5">
                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                           value="{{$employee->person->provinceOfBirth->name}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="staticEmail" class="col-sm-6 col-form-label text-start fw-bold">Tipo de Documento</label>
                                                <div class="col-sm-5">
                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                           value="{{$employee->person->typeOfIdentityDocument->name}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="staticEmail" class="col-sm-6 col-form-label text-start fw-bold">Número do Documento</label>
                                                <div class="col-sm-5">
                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                           value="{{$employee->person->identity_document_number}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="staticEmail" class="col-sm-6 col-form-label text-start fw-bold">Data de Emissão</label>
                                                <div class="col-sm-5">
                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                           value="{{$employee->person->identity_document_emission_date}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="staticEmail" class="col-sm-6 col-form-label text-start fw-bold">Data de Validade</label>
                                                <div class="col-sm-5">
                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                           value="{{$employee->person->identity_document_expiry_date}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--                    <div class="row">--}}
{{--                        <div class="col-sm-12">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-body">--}}
{{--                                    <h5 class="d-flex align-items-center mb-3">Projectos Envolvidos</h5>--}}
{{--                                    --}}{{--<p>Web Design</p>--}}
{{--                                    <div class="progress mb-3" style="height: 5px">--}}
{{--                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"--}}
{{--                                             aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                    <p>Website Markup</p>--}}
{{--                                    <div class="progress mb-3" style="height: 5px">--}}
{{--                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 72%"--}}
{{--                                             aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                    <p>One Page</p>--}}
{{--                                    <div class="progress mb-3" style="height: 5px">--}}
{{--                                        <div class="progress-bar bg-success" role="progressbar" style="width: 89%"--}}
{{--                                             aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                    <p>Mobile Template</p>--}}
{{--                                    <div class="progress mb-3" style="height: 5px">--}}
{{--                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 55%"--}}
{{--                                             aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                    <p>Backend API</p>--}}
{{--                                    <div class="progress" style="height: 5px">--}}
{{--                                        <div class="progress-bar bg-info" role="progressbar" style="width: 66%"--}}
{{--                                             aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>

@endsection



