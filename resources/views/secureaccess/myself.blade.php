@extends('layout.master')  

@section('include')
    @parent
    {{ Html::style('lib/datatables/dataTables.bootstrap.css') }}
    {{ Html::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ Html::script('lib/datatables/dataTables.bootstrap.min.js') }}

    @include( 'secureaccess.js.myself_ajax' )
    @include( 'secureaccess.js.myself' )
@stop

@section('content')
<section class="content-header">
    <h1>Mis Datos
        <small>Datos Personales</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-sitemap"></i> Datos Personales</a></li>
        <li class="active">Mis Datos</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-4">
            <div class="box">
                <form id="MyselfForm">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Contraseña Nueva:</label>
                            <input type="password" class="form-control" id="txt_password" name="txt_password" placeholder="Contraseña Nueva">
                        </div>
                        <div class="form-group">
                            <label>Confirmar Contraseña Nueva:</label>
                            <input type="password" class="form-control" id="txt_password_confirm" name="txt_password_confirm" placeholder="Confirmar Contraseña Nueva">
                        </div>
                        <div class="form-group">
                            <label><i class="fa fa-asterisk"></i> Su contraseña Actual:</label>
                            <input type="password" class="form-control" id="txt_password_actual" name="txt_password_actual" placeholder="Su contraseña Actual">
                        </div>
                        <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="EditarAjax()" >
                            <i class="fa fa-edit fa-lg"></i>&nbsp;Guardar</a>
                        </div>
                    </div><!-- .box-body -->
                </form><!-- .form -->
            </div><!-- .box -->
        </div><!-- .col -->
    </div><!-- .row -->
</section><!-- .content -->
@stop

@section('form')
@stop
