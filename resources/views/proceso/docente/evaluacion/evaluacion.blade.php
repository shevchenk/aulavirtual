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

    @include( 'proceso.docente.evaluacion.js.evaluacion_ajax' )
    @include( 'proceso.docente.evaluacion.js.evaluacion' )

    @include( 'proceso.docente.gestor.js.contenido_ajax' )
    @include( 'proceso.docente.gestor.js.contenido' )
    @include( 'proceso.docente.gestor.js.contenidoprogramacion_ajax' )
    @include( 'proceso.docente.gestor.js.contenidoprogramacion' )
    @include( 'proceso.docente.gestor.js.listapersona_ajax' )
    @include( 'proceso.docente.gestor.js.listapersona' )

@stop

@section('content')
<section class="content-header">
    <h1>Evaluaciones
        <small>Mantenimiento</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-sitemap"></i> Mantenimiento</a></li>
        <li class="active">Evaluaciones</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form id="TipoEvaluacionForm">
                    <div class="box-body table-responsive no-padding">
                        <table id="TableEvaluacion" class="table table-bordered table-hover">
                            <thead>
                                <tr class="cabecera">

                                    <th class="col-xs-2">
                                        <div class="form-group">
                                            <label><h4>DNI</h4></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_dni" id="txt_dni" placeholder="DNI" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group">
                                            <label><h4>Alumno</h4></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_alumno" id="txt_alumno" placeholder="Alumno" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group">
                                            <label><h4>Curso</h4></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_curso" id="txt_curso" placeholder="Curso" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group">
                                            <label><h4>Docente</h4></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_docente" id="txt_docente" placeholder="Docente" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group">
                                            <label><h4>Hora Inicio</h4></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_fecha_inicio" id="txt_fecha_inicio" placeholder="Hora Inicial" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group">
                                            <label><h4>Hora Final</h4></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_fecha_final" id="txt_fecha_final" placeholder="Hora Final" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>

                                <!--
                                    <th class="col-xs-2">
                                        <div class="form-group">
                                            <label><h4>Estado:</h4></label>
                                            <div class="input-group">
                                                <select class="form-control" name="slct_estado" id="slct_estado">
                                                    <option value='' selected>.::Todo::.</option>
                                                    <option value='0'>Inactivo</option>
                                                    <option value='1'>Activo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </th>
                                  -->
                                    <th class="col-xs-1">[-]</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr class="cabecera">
                                  <th>DNI</th>
                                  <th>Alumno</th>
                                  <th>Curso</th>
                                  <th>Docente</th>
                                  <th>Hora Inicio</th>
                                  <th>Hora Final</th>
                                  <th>[-]</th>
                                </tr>
                            </tfoot>
                        </table>
                      <!--
                        <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditar(1)" >
                            <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                        </div>
                      -->
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
                                  <th>Ruta Contenido</th>
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
                                  <th>Ruta Contenido</th>
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
        </div><!-- .col -->
    </div><!-- .row -->
</section><!-- .content -->
@stop

@section('form')
     @include( 'proceso.docente.gestor.form.contenido' )
     @include( 'proceso.docente.gestor.form.contenidoprogramacion' )
     @include( 'proceso.docente.gestor.form.listapersona' )
@stop
