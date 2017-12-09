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

{{ Html::style('lib/iCheck/all.css') }}
{{ Html::script('lib/iCheck/icheck.min.js') }}

@include( 'proceso.docente.balotario.js.balotario_ajax' )
@include( 'proceso.docente.balotario.js.balotario' )

@stop

@section('content')
<section class="content-header">
    <h1>Generar Balotario
        <small>Proceso</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-sitemap"></i> Proceso</li>
        <li class="active">Generar Balotario</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body  no-padding"> <!-- table-responsive-->
                    <form id="ProgramacionUnicaForm">
                        <div class="panel panel-primary">
                            <div class="panel-heading" style="background-color: #337ab7;color:#fff">
                                <center>.::Programaciones de Docente::.</center>
                            </div>
                            <div class="panel-body table-responsive no-padding">
                                <div class="col-md-12">
                                    <table id="TableProgramacionUnica" class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="cabecera">
                                                <th class="col-xs-4">
                                                    <div class="form-group">
                                                        <label><h4>Curso:</h4></label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_curso" id="txt_curso" placeholder="Curso" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="col-xs-2">
                                                    <div class="form-group">
                                                        <label><h4>Fecha Inicio:</h4></label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_fecha_inicio" id="txt_fecha_inicio" placeholder="Fecha Inicio" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="col-xs-2">
                                                    <div class="form-group">
                                                        <label><h4>Fecha Final:</h4></label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_fecha_final" id="txt_fecha_final" placeholder="Fecha Final" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
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
                                                <th>Curso</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Final</th>
                                                <th>[-]</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- .box-body -->
                            </div>
                        </div>
                    </form><!-- .form -->

                    <hr>

                    <form id="ContenidoForm" style="display: none">
                        <div class="panel panel-success" style="padding-bottom: 10px;">
                            <div class="panel-heading" style="background-color: #A9D08E;color:black">
                                <center>.::Contenido::.</center>
                            </div>
                            <div class="panel-body table-responsive no-padding">
                                <div class="col-md-12">
                                    <input type= "hidden" name="txt_programacion_unica_id" id="txt_programacion_unica_id" class="form-control mant" >
                                    <div id="DivContenido">
                                    </div>
                                    <div class="col-md-12 text-center" style="margin-top: 10px;">
                                        <div class='btn btn-primary btn-sm'onClick="AgregarEditar3(1)" >
                                            <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo
                                        </div>
                                        <div class='btn btn-info btn-sm' id="btn_replicar" >
                                            <i class="fa fa-copy fa-lg"></i>&nbsp;Replicar
                                        </div>
                                    </div>
                                </div><!-- .box-body -->
                            </div>
                        </div>
                    </form><!-- .form -->
                    <hr>
                    <form id="ContenidoProgramacionForm" style="display: none">
                        <input type= "hidden" name="txt_contenido_id" id="txt_contenido_id" class="form-control mant" >
                        <div class="panel panel-warning">
                            <div class="panel-heading" style="background-color: #FFE699;color:black">
                                <center>.::Ampliación de Respuesta::.</center>
                            </div>
                            <div class="panel-body table-responsive no-padding">
                                <div class="col-md-12">
                                    <table id="TableContenidoProgramacion" class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="cabecera">
                                                <th>Alumno</th>
                                                <th>Fecha de Ampliación</th>
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
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditar2(1)" >
                                        <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                                    </div>
                                </div><!-- .box-body -->
                            </div>
                        </div>
                    </form><!-- .form -->
                    <hr>
                    <form id="ContenidoRespuestaForm" style="display: none">
                        <input type= "hidden" name="txt_contenido_id" id="txt_contenido_id" class="form-control mant" >
                        <div class="panel panel-warning">
                            <div class="panel-heading" style="background-color: #FFE699;color:black">
                                <center>.::Respuesta de Contenido::.</center>
                            </div>
                            <div class="panel-body table-responsive no-padding">
                                <div class="col-md-12">
                                    <table id="TableContenidoRespuesta" class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="cabecera">
                                                <th>Alumno</th>
                                                <th>Respuesta</th>
                                                <th>Archivo</th>
                                                <th>Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr class="cabecera">
                                                <th>Alumno</th>
                                                <th>Respuesta</th>
                                                <th>Archivo</th>
                                                <th>Fecha</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- .box-body -->
                            </div>
                        </div>
                    </form><!-- .form -->
                </div><!-- .box -->
            </div>
        </div><!-- .col -->
    </div><!-- .row -->
</section><!-- .content -->
@stop

<!--@section('form')
@include( 'proceso.docente.gestor.form.contenido' )
@include( 'proceso.docente.gestor.form.contenidoprogramacion' )
@include( 'proceso.docente.gestor.form.listapersona' )
@stop-->
