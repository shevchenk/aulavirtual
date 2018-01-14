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

@include( 'proceso.master.reprogramacion.js.gestor_ajax' )
@include( 'proceso.master.reprogramacion.js.gestor' )
@include( 'proceso.master.reprogramacion.js.evaluacion_ajax' )
@include( 'proceso.master.reprogramacion.js.evaluacion' )
@include( 'proceso.master.gestor.js.listapersona_ajax' )
@include( 'proceso.master.gestor.js.listapersona' )

@stop

@section('content')
<section class="content-header">
    <h1>Generar Reprogramación
        <small>Proceso</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-sitemap"></i> Proceso</li>
        <li class="active">Generar Reprogramación</li>
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
                                                <th class="col-xs-2">
                                                    <div class="form-group">
                                                        <label><h4>Carrera:</h4></label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_carrera" id="txt_carrera" placeholder="Carrera" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="col-xs-1">
                                                    <div class="form-group">
                                                        <label><h4>Semestre:</h4></label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_semestre" id="txt_semestre" placeholder="Semestre" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="col-xs-1">
                                                    <div class="form-group">
                                                        <label><h4>Ciclo:</h4></label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_ciclo" id="txt_ciclo" placeholder="Ciclo" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="col-xs-3">
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
                                                        <label><h4>Docente:</h4></label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_master" id="txt_master" placeholder="Docente" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr class="cabecera">
                                                <th>Carrera</th>
                                                <th>Semestre</th>
                                                <th>Ciclo</th>
                                                <th>Curso</th>
                                                <th>Docente</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Final</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- .box-body -->
                            </div>
                        </div>
                    </form><!-- .form -->
                    <hr>
                    <form id="EvaluacionForm" style="display: none">
                        <div class="panel panel-primary active" style="padding-bottom: 10px;">
                            <img id="imageCurso" class="panel-heading img-responsive" src='img/course/calculo2f.jpg' style="width:100%;min-height: 90px;">
                            <div class="panel-body table-responsive">
                                <input type= "hidden" name="txt_programacion_unica_id" id="txt_programacion_unica_id" class="form-control mant">
                                <style media="screen">
                                    .rotar:hover{
                                        cursor: pointer;
                                        transform: rotate(-5deg);
                                        -webkit-transform: rotate(-5deg);
                                        -moz-transform: rotate(-5deg);
                                        -o-transform: rotate(-5deg);
                                    }
                                </style>
                                <div id="DivContenido" class="box-body table-responsive no-padding">
                                    <div class="col-md-12">
                                    </div>
                                </div>
                            </div><!-- .box-body -->
                        </div>
                    </form><!-- .form -->
                </div><!-- .box -->
            </div>
        </div><!-- .col -->
    </div><!-- .row -->
</section><!-- .content -->
@stop

@section('form')
@include( 'proceso.master.reprogramacion.form.evaluacion' )
@include( 'proceso.master.gestor.form.listapersona' )
@stop
