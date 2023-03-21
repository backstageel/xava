@extends("layouts.app")

@section("wrapper")
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Utilizadores</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Alterar Senha</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">Alterar Senha de Utilizador</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <x-bootstrap::form.form class="row g-3" action="{{route('change_passwords.store')}}">
                            <div class="row">
                                <div class="col">
                                    <x-bootstrap::form.input name="email" label="Email" value="{{Auth::user()->email}}"
                                                             class="form-control-plaintext" autocomplete="off"/>
                                    <x-bootstrap::form.input type="password" name="current_password"
                                                             label="Senha Actual"/>
                                    <x-bootstrap::form.input type="password" name="password" label="Nova Senha"/>
                                    <x-bootstrap::form.input type="password" name="password_confirmation"
                                                             label="Confirmar Nova Senha"/>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Alterar Senha</button>
                                </div>
                            </div>

                        </x-bootstrap::form.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
@endsection
