'

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
            <div class="btn-group">
                @if($loan->order_status == 'Pendente de aprovacao')
                    <a href="{{route('loans.edit', $loan)}}" class="btn btn-primary">Editar</a>

                @endif



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

                        </div>
                        <hr class="my-4"/>
                        <h5 class="d-flex align-items-center mb-3">Dados do Colaborador</h5>
                        <ul class="list-group list-group-flush">


                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Nome Do Colaborados</h6>
                                <span class="text-secondary">{{$employee->name}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Contacto</h6>
                                <span class="text-secondary">{{$employee->person->cellphone}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Email</h6>
                                <span class="text-secondary">{{$employee->person->personal_email}}</span>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="d-flex align-items-center mb-3">Dados do Empretimo</h5>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Valor Do Empretimo</h6>
                            <span class="text-secondary">{{$loan->amount}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Nr de meses a pagar</h6>

                            <span class="text-secondary">{{$loan->months}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Total Pago</h6>
                            <span class="text-secondary">{{$loan->total_paid}}</span>

                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Divida</h6>
                            <span class="text-secondary">{{$loan->amount-$loan->total_paid}}</span>
                        </li>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



