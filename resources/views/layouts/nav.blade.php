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
                    <a href="{{route('employees.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Colaboradores
                    </a>
                </li>
                <li>
                    <a href="{{route('customer_types.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Tipos de Clientes
                    </a>
                </li>
                <li>
                    <a href="{{route('product_categories.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Categoria de Produtos
                    </a>
                </li>
                @php
                    $user_id = auth()->user()->id;
                    $person= \App\Models\Person::where('user_id', $user_id)->first();

                    if($person){
                    $employee= \App\Models\Employee::where('person_id', $person->id);

                    }

                @endphp
                @if( isset($employee) && $employee->employee_position_id= 1)
                    <li>
                        <a href="{{route('loans.index')}}">
                            <i class="bx bx-right-arrow-alt"></i>
                            Empréstimos
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{route('loans.create')}}">
                            <i class="bx bx-right-arrow-alt"></i>
                            Simular Emprestimos
                        </a>
                    </li>
                @endif

            </ul>
        </li>
        <li>
            <a href="#" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i></div>
                <div class="menu-title">Parceiros</div>
            </a>
            <ul>
                <li>
                    <a href="{{route('customers.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Clientes
                    </a>
                </li>
                <li>
                    <a href="{{url('prospects.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Possiveis Clientes
                    </a>
                </li>
                <li>
                    <a href="{{route('suppliers.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Fornecedores
                    </a>
                </li>
                <li>
                    <a href="{{ url('contacts.index') }}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Contactos
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('products.index')}}">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Produtos</div>
            </a>
        </li>
        <li>

            <a href="{{route('customers.index')}}">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Clientes</div>
            </a>
        </li>
        <li>
            <a href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Administração</div>
            </a>
        </li>
        <li>
            <a href="javascript:;">
                <div class="parent-icon"><i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Relatórios</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
