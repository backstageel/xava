@extends("layouts.app")
@section("style")

    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
          type="text/css"/>
@endsection
@section("wrapper")
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Emprestimo</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Simulacao Emprestimo</li>
                </ol>
            </nav>
        </div>

    </div>
    <div class="container">
        <div class="main-body">

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">



                                <hr class="my-4"/>
                                <h5 class="d-flex align-items-center mb-3">Dados da Simulação de Emprestimo</h5>
                                <ul class="list-group list-group-flush">


                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Nome do Colaborador</h6>
                                        <span
                                            class="text-secondary">{{$loan->employee->person->first_name}} {{$loan->employee->person->last_name}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Valor do Emprestimo</h6>
                                        <span class="text-secondary">{{ $loan->amount}}</span>

                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Prestação Mensal</h6>
                                        <span class="text-secondary">{{$loan->installment}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Meses</h6>
                                        <span class="text-secondary">{{$loan->months}}</span>
                                    </li>
                                </ul>

                            <x-bootstrap::form.form method="POST" class="row g-3" action="{{route('loans.submit', $loan)}}">
                                @csrf

                                <button class="btn btn-success" type="submit">Gerar Pedido</button>
                            </x-bootstrap::form.form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>
    </div>
@endsection

@section("script")
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js"
            type="text/javascript"></script>
    <script>
        $(function () {
            $('#smartwizard').smartWizard({
                theme: 'arrows',
            })
        });
    </script>
@endsection
