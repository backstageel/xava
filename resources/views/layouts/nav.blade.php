<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('')}}assets/images/xava-logo-intranet.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text"></h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i></div>
                <div class="menu-title">Recursos Humanos</div>
            </a>
            <ul>
                <li>
                    <a href="{{route('employees.index')}}" >
                        <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i></div>
                        <div class="menu-title">Colaboradores</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i></div>
                        <div class="menu-title">Documentos</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('documents.index', 'Procedimentos Internos')}}">
                                <i class="bx bx-right-arrow-alt"></i>
                                Procedimentos Internos
                            </a>
                        </li>
                        <li>
                            <a href="{{route('documents.index', 'Legislação Moçambicana')}}">
                                <i class="bx bx-right-arrow-alt"></i>
                                Legislação Moçambicana
                            </a>
                        </li>
                        <li>
                            <a href="{{route('documents.index', 'Documentos Actualizados')}}">
                                <i class="bx bx-right-arrow-alt"></i>
                                Documentos Actualizados
                            </a>
                        </li>
                        <li>
                            <a href="{{route('documents.index', 'Inventario do RH')}}">
                                <i class="bx bx-right-arrow-alt"></i>
                                Inventario do RH
                            </a>
                        </li>
                        <li>
                            <a href="#" class="has-arrow">
                                <div class="parent-icon"><i ></i></div>
                                <div class=" bx bx-right-arrow-alt "></div>
                                Actas
                            </a>
                            <ul>
                                <li>
                                    <a href="{{route('documents.index', 'IT')}}">
                                        <i class="bx bx-right-arrow-alt"></i>
                                        Departamento de Equipamento Informático
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('documents.index', 'motas')}}">
                                        <i class="bx bx-right-arrow-alt"></i>
                                        Departamento de Motas e Bicicletas
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="has-arrow" >
                        <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i></div>
                        <div class="menu-title">Emprestimos</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('loans.create')}}">
                                <i class="bx bx-right-arrow-alt"></i>
                                Simular Emprestimos
                            </a>
                        </li>
                        <li>
                            <a href="{{route('loan.myLoans')}}">
                                <i class="bx bx-right-arrow-alt"></i>
                                Meus Emprestimos
                            </a>
                        </li>
                        <li>
                            <a href="{{route('loans.index')}}">
                                <i class="bx bx-right-arrow-alt"></i>
                                Emprestimos
                            </a>
                        </li>
                    </ul>
                </li>


{{--                <li>--}}
{{--                    <a href="{{route('expense_requests.index')}}">--}}
{{--                        <i class="bx bx-right-arrow-alt"></i>--}}
{{--                        Requisição de Despesas--}}
{{--                    </a>--}}
{{--                </li>--}}


            </ul>
        </li>
{{--        <li>--}}
{{--            <a href="#" class="has-arrow">--}}
{{--                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i></div>--}}
{{--                <div class="menu-title">Parceiros</div>--}}
{{--            </a>--}}
{{--            <ul>--}}
{{--                <!--<li>--}}
{{--                    <a href="{{route('customer_types.index')}}">--}}
{{--                        <i class="bx bx-right-arrow-alt"></i>--}}
{{--                        Tipos de Clientes--}}
{{--                    </a>--}}
{{--                </li>-->--}}



{{--                <li>--}}
{{--                    <a href="{{route('suppliers.index')}}">--}}
{{--                        <i class="bx bx-right-arrow-alt"></i>--}}
{{--                        Fornecedores--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--            </ul>--}}
{{--        </li>--}}

        <li>
            <a href="#" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i></div>
                <div class="menu-title">Clientes</div>
            </a>
            <ul>

                <li>
                    <a href="{{route('customers.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Clientes Comerciais
                    </a>
                </li>

                <li>
                    <a href="{{route('contacts.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Lista de Consultores
                    </a>
                </li>

            </ul>
        </li>
        <li>
            <a href="#" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i></div>
                <div class="menu-title">Concursos</div>
            </a>
            <ul>

                <li>
                    <a href="{{route('competitions.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Lista de Concursos
                    </a>
                </li>

                <li>
                    <a href="{{route('product_sub_categories.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        SubCategoria de Industria de Concursos
                    </a>
                </li>
            </ul>
        </li>


        <li>


        <li>
            <a href="#" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i></div>
                <div class="menu-title">Vendas</div>
            </a>
            <ul>
                <li>
                    <a href="{{route('suppliers.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Fornecedores
                    </a>
                </li>
                <li>
                    <a href="{{route('sales.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Vendas
                    </a>
                </li>

                <li>
                    <a href="{{route('products.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Produtos
                    </a>
                </li>
                <li>
                    <a href="{{route('product_categories.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Categoria de Produtos
                    </a>
                </li>


            </ul>
        </li>


        <li>
            <a href="#" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Administração</div>
            </a>
            <ul>
                <li>
                    <a href="#" class="has-arrow">
{{--                        <div class="parent-icon"><i class="bx bx-repeat"></i>--}}
{{--                        </div>--}}
                        <div class="menu-title">Requisições</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('expense_requests.index')}}">
                                <i class="bx bx-right-arrow-alt"></i>
                                Requisição de Despesas
                            </a>
                        </li>
                        <li>
                            <a href="{{route('expense_request_types.index')}}">
                                <i class="bx bx-right-arrow-alt"></i>
                                Tipos de Despesas
                            </a>
                        </li>
                        <li>
                            <a href="{{route('expense_request.myRequest')}}">
                                <i class="bx bx-right-arrow-alt"></i>
                                Minhas Requisições
                            </a>
                        </li>
                        <li>
                            <a href="{{route('card_loads.index')}}">
                                <i class="bx bx-right-arrow-alt"></i>
                                Recarregar Caixa
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="has-arrow">
{{--                        <div class="parent-icon"><i class="bx bx-repeat"></i>--}}
{{--                        </div>--}}
                        <div class="menu-title">Férias</div>
                    </a>
                    <ul>
{{--                        <li>--}}
{{--                            <a href="{{ route('vacation.vacationsMap') }}">--}}
{{--                            <i class="bx bx-right-arrow-alt"></i>--}}
{{--                                Mapa de Férias--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        @php
                            $userID = Auth::user()->id;
                            $personID = \App\Models\Person::where('user_id',$userID)->value('id');
                            $employee_position_id = \App\Models\Employee::where('person_id',$personID)->value('employee_position_id');
                        @endphp

                            @if($employee_position_id==\App\Enums\EmployeePosition::GESTOR_ESCRITORIO ||
                                $employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_GERAL ||
                                $employee_position_id == \App\Enums\EmployeePosition::DIRECTOR_OPERATIVO
                                                        || $userID == 1)
                            <li>
                                <a href="{{route('vacations.index')}}">
                                    <i class="bx bx-right-arrow-alt"></i>
                                    lista de Férias
                                </a>
                            </li>
                            @endif

                        <li>
                            <a href="{{route('vacation.myVacation')}}">

                                <i class="bx bx-right-arrow-alt"></i>
                                Minhas Férias
                            </a>
                        </li>
                        <li>
                            <a href="{{route('vacation_collectives.index')}}">

                                <i class="bx bx-right-arrow-alt"></i>
                                Ferias Coletivas
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Relatórios</div>
            </a>
            <ul>
                <li>
                    <a href="{{route('sales.export')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Imprimir Lista de Vendas
                    </a>
                </li>

                <li>
                    <a href="{{route('competitions.export')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Imprimir Lista de Concursos
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
