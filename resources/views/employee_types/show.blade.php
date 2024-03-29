@extends("layouts.app")
@section("wrapper")
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{asset('')}}assets/images/avatars/avatar-2.png" alt="Admin"
                             class="rounded-circle p-1 bg-primary" width="110">
                        <div class="mt-3">
                            <h4>{{$company->name}}</h4>
                            <p class="text-secondary mb-1">{{$company->nuel}}</p>
                            <p class="text-muted font-size-sm">{{$company->address->name}}</p>

                        </div>
                    </div>
                    <hr class="my-4"/>
                    <ul class="list-group list-group-flush">
                        @foreach($company->objectClauses as $objectClause)
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">{{$objectClause->name}}</h6>
                            </li>
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"></h6>
                            <span class="text-secondary"><button
                                    class="btn btn-primary">Adicionar Objecto Social</button></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="d-flex align-items-center mb-3">Socios/Responsáveis</h5>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 text-secondary mb-3">
                            <input
                                onclick='Livewire.emit("openModal", "add-individual-partner", {{ json_encode(["companyId" => $company->id]) }})'
                                type="button" class="btn btn-primary px-4" value="Adicionar Personalidade"/>
                            <input type="button" class="btn btn-primary px-4" value="Adicionar Empresa"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="John Doe"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="john@example.com"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Phone</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="(239) 816-9029"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Mobile</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="(320) 380-4539"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Address</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="Bay Area, San Francisco, CA"/>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="d-flex align-items-center mb-3">Project Status</h5>
                            <p>Web Design</p>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"
                                     aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p>Website Markup</p>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 72%"
                                     aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p>One Page</p>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 89%"
                                     aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p>Mobile Template</p>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 55%"
                                     aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p>Backend API</p>
                            <div class="progress" style="height: 5px">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 66%"
                                     aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



