@extends('layout.master')  

@section('include')
    @parent
    {{ Html::style('lib/datatables/dataTables.bootstrap.css') }}
    {{ Html::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ Html::script('lib/datatables/dataTables.bootstrap.min.js') }}

    {{ Html::style('lib/bootstrap-select/dist/css/bootstrap-select.min.css') }}
    {{ Html::script('lib/bootstrap-select/dist/js/bootstrap-select.min.js') }}
    {{ Html::script('lib/bootstrap-select/dist/js/i18n/defaults-es_ES.min.js') }}

    {{ Html::style('lib/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}
    {{ Html::script('lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}
    {{ Html::script('lib/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js') }}

    @include( 'proceso.gestor.js.gestor_ajax' )
    @include( 'proceso.gestor.js.gestor' )
    @include( 'proceso.gestor.js.contenido_ajax' )
    @include( 'proceso.gestor.js.contenido' )
    @include( 'proceso.gestor.js.contenidoprogramacion_ajax' )
    @include( 'proceso.gestor.js.contenidoprogramacion' )
    @include( 'proceso.gestor.js.listapersona_ajax' )
    @include( 'proceso.gestor.js.listapersona' )
    

@stop

@section('content')
<section class="content-header">
    <h1>Gestor de Contenido
        <small>Proceso</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-sitemap"></i> Mantenimiento</a></li>
        <li class="active">Gestor de Contenido</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body  no-padding"> <!-- table-responsive-->
                    <form id="ProgramacionUnicaForm">
                        <div class="box-body table-responsive no-padding">
                            <table id="TableProgramacionUnica" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="cabecera">
                                        <th class="col-xs-2">
                                            <div class="form-group">
                                                <label><h4>DNI:</h4></label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                    <input type="text" class="form-control" name="txt_dni" id="txt_dni" placeholder="DNI" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                                </div>
                                            </div>
                                        </th>
                                        <th class="col-xs-3">
                                            <div class="form-group">
                                                <label><h4>Docente:</h4></label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                    <input type="text" class="form-control" name="txt_docente" id="txt_docente" placeholder="Docente" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                                </div>
                                            </div>
                                        </th>
                                        <th class="col-xs-3">
                                            <div class="form-group">
                                                <label><h4>Curso:</h4></label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                    <input type="text" class="form-control" name="txt_curso" id="txt_curso" placeholder="Curso" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                                </div>
                                            </div>
                                        </th>
                                        <th class="col-xs-2">
                                            <div class="form-group">
                                                <label><h4>Fecha Inicio:</h4></label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                    <input type="text" class="form-control" name="txt_fecha_inicio" id="txt_fecha_inicio" placeholder="Fecha Inicio" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                                </div>
                                            </div>
                                        </th>
                                        <th class="col-xs-2">
                                            <div class="form-group">
                                                <label><h4>Fecha Final:</h4></label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                    <input type="text" class="form-control" name="txt_fecha_final" id="txt_fecha_final" placeholder="Fecha Final" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                                </div>
                                            </div>
                                        </th>
                                        <th class="col-xs-1">[-]</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr class="cabecera"> 
                                      <th>DNI</th>
                                      <th>Docente</th>
                                      <th>Curso</th>
                                      <th>Fecha Inicio</th>
                                      <th>Fecha Final</th>
                                      <th>[-]</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!-- .box-body -->
                    </form><!-- .form -->
                    <hr>
                    <form id="ContenidoForm" style="display: none">
                        <input type= "hidden" name="txt_programacion_unica_id" id="txt_programacion_unica_id" class="form-control mant" > 
                        <div class="box-body table-responsive no-padding">
                            <table id="TableContenido" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="cabecera">
                                      <th>Curso</th>
                                      <th>Contenido</th>
                                      <th>Tipo Respuesta</th>
                                      <th>Fecha Inicio</th>
                                      <th>Fecha Final</th>
                                      <th>Fecha Ampliada</th>
                                      <th>[-]</th>
                                      <th>[-]</th>
                                      <th>[-]</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr class="cabecera">
                                      <th>Curso</th>
                                      <th>Contenido</th>
                                      <th>Tipo Respuesta</th>
                                      <th>Fecha Inicio</th>
                                      <th>Fecha Final</th>
                                      <th>Fecha Ampliada</th>
                                      <th>[-]</th>
                                      <th>[-]</th>
                                      <th>[-]</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditar3(1)" >
                                <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                            </div>
                        </div><!-- .box-body -->
                    </form><!-- .form --> 
                    <hr>
                    <form id="ContenidoProgramacionForm" style="display: none">
                        <input type= "hidden" name="txt_contenido_id" id="txt_contenido_id" class="form-control mant" > 
                        <div class="box-body table-responsive no-padding">
                            <table id="TableContenidoProgramacion" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="cabecera">
                                      <th>Alumno</th>
                                      <th>Fecha de Ampliación</th>
                                      <th>[-]</th>
                                      <th>[-]</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr class="cabecera">
                                      <th>Alumno</th>
                                      <th>Fecha de Ampliación</th>
                                      <th>[-]</th>
                                      <th>[-]</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditar2(1)" >
                                <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                            </div>
                        </div><!-- .box-body -->
                    </form><!-- .form --> 
                </div><!-- .box -->
            </div>
        </div><!-- .col -->
    </div><!-- .row -->
</section><!-- .content -->
@stop

@section('form')
     @include( 'proceso.gestor.form.gestor' )
     @include( 'proceso.gestor.form.contenido' )
     @include( 'proceso.gestor.form.contenidoprogramacion' )
     @include( 'proceso.gestor.form.listapersona' )
@stop
