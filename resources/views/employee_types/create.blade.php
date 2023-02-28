@extends("layouts.app")

@section("wrapper")
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pessoas</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Lista de Pessoas</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('people.create')}}" class="btn btn-primary">Adicionar</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">Registar nova Pessoa</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <x-bootstrap::form.form class="row g-3" action="{{route('people.store')}}">
                            <div class="row">
                                <div class="col-5">
                                    <x-bootstrap::form.input name="name" label="Nome Completo" />
                                </div>
                                <div class="col-4">
                                    <x-bootstrap::form.input name="cellphone" label="Telemovel" />
                                </div>
                                <div class="col-3">
                                    <x-bootstrap::form.input name="email" label="Email" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <x-bootstrap::form.date-picker name="birth_date" label="Data de Nascimento"/>
                                </div>
                                <div class="col-4">
                                    <x-bootstrap::form.select name="gender_id" label="Sexo" :options="$genders"/>
                                </div>
                                <div class="col-4">
                                    <x-bootstrap::form.select name="nationality_id" label="Nacionalidade" :options="$countries"/>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Endereço da Pessoa
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="country_id" label="Pais" :options="$countries" :default="152"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="province_id" label="Provincia" :options="$provinces"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.select name="district_id" label="Cidade/Distrito" :options="$districts"/>
                                        </div>
                                    </div>
                                    {{--<div class="row">
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="address_neighborhood" label="Bairro"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="address_avenue" label="Avenida/Rua"/>
                                        </div>
                                        <div class="col-4">
                                            <x-bootstrap::form.input name="address_street_number" label="Número" />
                                        </div>
                                    </div>--}}
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Gravar</button>
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
