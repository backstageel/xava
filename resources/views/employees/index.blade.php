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
                    <li class="breadcrumb-item active" aria-current="page">Lista de Colaboradores</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('employees.create')}}" class="btn btn-primary">Adicionar</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Colaboradores Registados</h6>
    <hr/>
    <div class="row row-cols-1 row-cols-lg-4 row-cols-xl-5">
        @foreach($employees as $employee)
            <div class="col">
                <div class="card radius-15">
                    <div class="card-body text-center">
                        <div class="p-1 border radius-15">
                            <img src="{{asset('assets/images/avatars/avatar-1.png')}}" width="110" height="110" class="rounded-circle shadow" alt="">
                            <h5 class="mb-0 mt-0">{{$employee->person->full_name}}</h5>
                            <p class="mb-3">{{$employee->employeePosition->name}}</p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Celular</h6>
                                    <span class="text-secondary">{{$employee->person->cellphone}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Email</h6>
                                    <span class="text-secondary">{{$employee->person->personal_email}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Contracto</h6>
                                    <span class="text-secondary">{{$employee->contractType->name}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Estado</h6>
                                    <span class="text-secondary">{{$employee->contractStatus->name}}</span>
                                </li>
                            </ul>
                            <div class="d-grid"> <a href="{{route('employees.show',$employee->id)}}" class="btn btn-outline-primary radius-15">Ver perfil</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
