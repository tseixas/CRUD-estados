<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
                <a href="{{ url('estado/') }}">
                    <i class="fa fa-list-alt"></i>
                    <span>Estados</span>
                </a>
            </li>

            @if(Auth::user()->perfil == 'user_admin')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>Administrador</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ url('usuario/') }}">
                            <i class="fa fa-users"></i>
                            Usuários
                        </a>
                    </li>
                </ul>
            </li>
                @endif

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>