@extends("layouts.app")
@section("style")
    <
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
                    <li class="breadcrumb-item active" aria-current="page">Criar Emprestimo</li>
                </ol>
            </nav>
        </div>

    </div>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">

                            <hr class="my-4"/>
                            <h5 class="d-flex align-items-center mb-3">Dados do Empretimo</h5>
                            <ul class="list-group list-group-flush">


                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Codigo do Colaborador</h6>
                                    <span class="text-secondary">{{$employee->employee_code}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Valor do emprestimo</h6>
                                    <span class="text-secondary">{{$amount}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Prestacao Mensal</h6>
                                        <span class="text-secondary">{{$installment}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Meses</h6>
                                        <span class="text-secondary">{{$months}}</span>
                                </li>
                               </ul>
                        </div>


                        <button class="btn btn-success" type="submit">Gerar Relatorio</button>
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
