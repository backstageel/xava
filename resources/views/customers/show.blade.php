'
@extends("layouts.app")
@section("wrapper")
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Clientes</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Perfil do Cliente</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('customers.edit', $customer)}}" class="btn btn-primary">Editar</a>
                <a href="{{route('customers.destroy', $customer)}}" class="btn btn-primary">Remover</a>
                <a href="{{route('customers.create')}}" class="btn btn-primary">Adicionar</a>
                @php
                    $province = \App\Models\Province::find($customer->customerable->address_province_id);
                    $country=\App\Models\Country::find($customer->customerable->address_country_id);
                    $district=\App\Models\District::find($customer->customerable->address_district_id);
                    if($customer->customerable_type=="App\Models\Company"){
                        $customer_type="Empresa";
                    }else{
                        $customer_type="Individual";
                    }
                     if( ($customer->customerable->gender_id) !== null){
                         $gender= \App\Models\Gender::find($customer->customerable->gender_id);}

                @endphp
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
                                <img src="{{asset('assets/images/avatars/avatar-2.png')}}" alt="Admin"
                                     class="rounded-circle p-1 bg-primary" width="110">
                                <div class="mt-3">
                                    @if( ($customer->customerable->name) == null)
                                        <h4> {{$customer->customerable->first_name}}</h4>
                                        <h4>{{$customer->customerable->last_name}}</h4>
                                    @else
                                        <h4> {{$customer->customerable->name}}</h4>
                                    @endif


                                    <button class="btn btn-primary">Ligar</button>
                                    <button class="btn btn-outline-primary">Enviar Mensagem</button>
                                </div>
                            </div>
                            <hr class="my-4"/>
                            <h5 class="d-flex align-items-center mb-3">Dados do Cliente</h5>
                            <ul class="list-group list-group-flush">


                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Email</h6>
                                    <span class="text-secondary">{{$customer->customerable->email}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">nuit</h6>
                                    <span class="text-secondary">{{$customer->customerable->nuit}}</span>
                                </li>
                                @if( ($customer->customerable->gender_id) !== null)
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Genero</h6>
                                        <span class="text-secondary">{{$gender->name}}</span>
                                    </li>

                                @endif

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">nacionalidade</h6>
                                    @if($country !==null)
                                    <span class="text-secondary">{{$country->name}}</span>
                                    @endif
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">provincia</h6>
                                    @if($province!==null)
                                   <span class="text-secondary">{{$province->name}}</span>
                                    @endif
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">distito</h6>
                                    @if($district!==null)
                                    <span class="text-secondary">{{$district->name}}</span>
                                    @endif
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="d-flex align-items-center mb-3">Contactos</h5>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Contacto</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$customer->customerable->phone}}">
                                </div>
                            </div>
                            @if($customer_type =="Empresa")
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Pagina web</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$customer->customerable->website}}">
                                </div>
                            </div>
                            @endif
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Tipo de cliente</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$customer_type}}">
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection



