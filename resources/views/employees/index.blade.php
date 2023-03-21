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

                @php
                    //caso o user nao estiver nesse conjunto nao terá possibilidade de adicionar novo colaborador
                    $valid_position=[1,2,3];
               @endphp
                @if(in_array($employee_position_id,$valid_position))
                <div class="btn-group">
                    <a href="{{route('employees.create')}}" class="btn btn-primary">Adicionar</a>
                </div>
                @endif

        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Colaboradores Registados</h6>
    <hr/>


    <div class="row row-cols-1 row-cols-lg-3 row-cols-xl-30">

        @foreach($employees as $employee)

                    <div class="col">
                <div class="card radius-15">
                    <div class="card-body text-center">
                        <div class="p-1 border radius-15">
                            @php
                            $employee_id = $employee->id;

                            $image_path = DB::table('employees')
                            ->join('people', 'employees.person_id', '=', 'people.id')
                            ->where('employees.id', '=', $employee_id)
                            ->value('people.image_path');
                            //dd(asset('storage/app/'.$image_path));
                            @endphp

                            <img src="{{asset('storage/app/'.$image_path)}}" width="110" height="110" class="rounded-circle shadow" alt="admin">
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
