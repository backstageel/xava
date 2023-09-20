<!--start header -->
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">

                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                           role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
                                class="alert-count">0</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Notificações</p>
                                    <p class="msg-header-clear ms-auto">Marcar como lidas</p>
                                </div>
                            </a>
                            <div class="header-notifications-list">

                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">Ver todas notificações</div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                           role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
                                class="alert-count">0</span>
                            <i class='bx bx-comment'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Mensagens</p>
                                    <p class="msg-header-clear ms-auto">Marcar como lidas</p>
                                </div>
                            </a>
                            <div class="header-message-list">

                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">Ver todas mensagens</div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                   role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('')}}assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ Auth::user()->name }}</p>
                        <p class="designattion mb-0">{{ Auth::user()->email }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{route('profile.edit')}}"><i class="bx bx-user">
                            </i><span>Perfil</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{route('change_passwords.create')}}">
                            <i class="bx bx-key"></i><span>Alterar Senha</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class='bx bx-log-out-circle'></i>
                            <span>Sair do Sistema</span>
                        </a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </nav>
    </div>
</header>
<!--end header -->
