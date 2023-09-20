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
                    <li class="breadcrumb-item active" aria-current="page">Perfil do colaborador</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <form action="{{ route('competitions.destroy', $competition) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este concurso?')">Remover</button>
                </form>

                <a href="{{route('competitions.edit', $competition)}}" class="btn btn-primary">Editar</a>
                <a href="{{route('competitions.create')}}" class="btn btn-primary">Adicionar</a>
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

                                <div class="mt-3">
                                    <h4>{{\App\Models\Company::find($competition->customer_id)->name}}</h4>
                                    <p class="text-secondary mb-1">{{$competition->companyType->name?? ''}}</p>
                                    <p class="text-muted font-size-sm">{{' '}}</p>
                                    <a href="{{ route('customers.show', \App\Models\Customer::where('customerable_id', $competition->customer_id)->first()) }}" class="btn btn-outline-primary">Ver Detalhes</a>

                                </div>
                            </div>
                            <hr class="my-4"/>
                            <h5 class="d-flex align-items-center mb-3">Dados Institucionais</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Codigo</h6>
                                    <span class="text-secondary">{{$competition->internal_reference}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Tipo de Instituição</h6>
                                    <span class="text-secondary">{{$competition->companyType->name?? ''}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Nome da Instituição</h6>
                                    <span class="text-secondary">{{\App\Models\Company::find($competition->customer_id)->name}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Tipo de Concurso</h6>
                                    <span class="text-secondary">{{$competition->competitionType->name}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Referencia</h6>
                                    <span class="text-secondary">{{$competition->competition_reference}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="d-flex align-items-center mb-3">Dados Financeiros</h5>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Categoria</label>
                                <div class="col-sm-9">
                                    <ul>
                                        @foreach ($competition->productCategory as $categoria)
                                            <li>{{ $categoria->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Sub Categorias: </label>
                                <div class="col-sm-9">
                                    @foreach (\App\Models\ProductCategorySubCategory::where('competition_id', $competition->id)->get()
                                             as $subcategory)
                                        {{\App\Models\ProductSubCategory::find($subcategory->product_sub_category_id)->name.','}}

                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Garantia Provisória</label>
                                <div class="col-sm-9 d-flex">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$competition->provisional_bank_guarantee}}">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Prémio </label>
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$competition->provisional_bank_guarantee_award}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Garantia Definitiva</label>
                                <div class="col-sm-9 d-flex">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$competition->definitive_guarantee}}">
                                    <label for="staticEmail" class="col-form-label text-end fw-bold ms-3">Prémio   </label> <!-- Adicionei um espaço aqui -->
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$competition->definitive_guarantee_award}}">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Garantia de Adiantamento</label>
                                <div class="col-sm-9 d-flex">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$competition->advance_guarantee}} ">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Prémio</label>
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$competition->advance_guarantee_award}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Data de Entrega de Proposta</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$competition->proposal_delivery_date}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Valor do vcaderno de encargo</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                           value="{{$competition->bidding_documents_value}}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-flex align-items-center mb-3">Resultados e reponsabilidadess</h5>

                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Resultado</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                   value="{{$competition->competitionResult->name?? ''}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Motivo</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                   value="{{$competition->competitionReason->name?? ''}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Descrição do Motivo</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                   value="{{$competition->reason_description}}">
                                        </div>
                                        <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Fase/Estagio</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                   value="{{$competition->competitionStatus->name??''}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Valor da Proposta</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                   value="{{$competition->proposal_value}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Responsavel</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                   value="{{$competition->responsible}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Responsável Rev.Prop.Técnica</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                   value="{{$competition->technical_proposal_review}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label text-end fw-bold">Responsável Rev.Documental</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                   value="{{$competition->documentary_review}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



