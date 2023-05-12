@extends("layouts.app")

@section("wrapper")
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Categoria</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Lista de Categorias</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('product_categories.create')}}" class="btn btn-primary">Adicionar</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">Registar Categoria</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <x-bootstrap::form.form class="row g-3" action="{{route('product_categories.store')}}">
                            <div class="row">
                                <div class="col">
                                    <x-bootstrap::form.input name="name" label="Nome da Categoria"/>
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
ph
