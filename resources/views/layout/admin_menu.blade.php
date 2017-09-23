<ul class="sidebar-menu">
        @if (isset($menu))
            @foreach ( $menu as $key => $val)
                <li class="treeview">
                    <a href="#">
                        <i class="{{ $val->icono }}"></i>
                        <span>{{ $val->menu }}</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @php $opciones=explode('||',$val->opciones); @endphp
                        @foreach ( $opciones as $op )
                        @php $dop=explode('|',$op); @endphp
                        <li><a href="{{ $dop[1] }}"><i class="{{ $dop[2] }}"></i> {{ $dop[0] }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        @endif
    <li class="treeview">
        <a href="#">
            <i class="fa fa-user-secret"></i> <span>Mis datos</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="secureaccess.myself"><i class="fa fa-lock"></i> Datos Personales </a></li>
        </ul>
    </li>
</ul>
