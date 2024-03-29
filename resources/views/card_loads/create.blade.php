@extends("layouts.app")

@section("wrapper")
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Caixa</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Saldo Disponivel </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('card_loads.create')}}" class="btn btn-primary">Recarregar Caixa</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">Recarregar Caixa</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <x-bootstrap::form.form class="row g-3" action="{{route('card_loads.store')}}">
                            <div class="row">
                                <div class="col-4">
                                    <x-bootstrap::form.input name="balance" label="Valor" required/>
                                </div>
                                <div class="col-4">
                                    <x-bootstrap::form.date-picker name="loading_date" label="Dia de Recarga"
                                                                   required/>
                                </div>
                                <div class="col-4">
                                    <x-bootstrap::form.input name="description" label="Descrição" />
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Recarregar</button>
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

