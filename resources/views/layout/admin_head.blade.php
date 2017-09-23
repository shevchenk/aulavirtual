<a href="secureaccess.inicio" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>PAE</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>PAE</b>JS</span>
</a>

<nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!--li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-dashboard"></i>
                    <span class="label label-danger">12</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header"><b>Seleccione un Tema</b></li>
                    <li id="tema-body">
                    </li>
                </ul>
            </li-->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!--img src="img/user2-160x160.jpg" class="user-image" alt="User Image"-->
                    <span class="hidden-xs">{{ Auth::user()->paterno.' '.Auth::user()->materno.', '.Auth::user()->nombre }}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-header">
                        <!--img src="img/user2-160x160.jpg" class="img-circle" alt="User Image"-->
                        <p>
                          {{ Auth::user()->paterno.' '.Auth::user()->materno.', '.Auth::user()->nombre }}
                          <small>Miembro desde {{ Auth::user()->created_at }}</small>
                        </p>
                    </li>

                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="secureaccess.myself" class="btn btn-default btn-flat">Mis Datos</a>
                        </div>
                        <div class="pull-right">
                            <a href="salir" class="btn btn-default btn-flat">Salir</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
