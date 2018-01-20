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

@include( 'proceso.master.balotario.js.gestor_ajax' )
@include( 'proceso.master.balotario.js.gestor' )
@include( 'proceso.master.balotario.js.balotario_ajax' )
@include( 'proceso.master.balotario.js.balotario' )

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
                    <form id="BalotarioForm" style="display: none">
                        <input type= "hidden" name="txt_programacion_unica_id" id="txt_programacion_unica_id" class="form-control mant" >
                        <input type= "hidden" name="txt_estado" id="txt_estado" class="form-control mant" value="1">
                        <div class="panel panel-success">
                            <img id="imageCurso" class="panel-heading img-responsive" src='img/course/calculo2f.jpg' style="width:100%;min-height: 90px;">
                            <div class="panel-body table-responsive no-padding">
                                <div class="col-md-6 col-md-offset-3">
                                     <table id="TableUnidadPregunta" class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="cabecera">
                                                <th>Unidad Contenido</th>
                                                <th># de Preguntas</th>>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr class="cabecera">
                                               <th>Unidad Contenido</th>
                                               <th># de Preguntas</th>>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <table id="TableBalotario" class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="cabecera">
                                                <th class="col-xs-2">
                                                    <div class="form-group">
                                                        <label><h4>Cantidad de Preguntas de Balotario:</h4></label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_cantidad_maxima" id="txt_cantidad_maxima" placeholder="Cantidad Máxima" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="col-xs-2">
                                                    <div class="form-group">
                                                        <label><h4>Cantidad de Preguntas de Evaluación:</h4></label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_cantidad_pregunta" id="txt_cantidad_pregunta" placeholder="Cantidad de Pregunta" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="col-xs-2">
                                                    <div class="form-group">
                                                        <label><h4>Tipo de Evaluación:</h4></label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_tipo_evaluacion" id="txt_tipo_evaluacion" placeholder="Tipo de Evaluación" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                        </div>
                                                    </div>
                                                </th>
<!--                                                <th class="col-xs-2">
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
                                                </th>-->
                                                <th class="col-xs-1">[-]</th>
                                                <th class="col-xs-1">[-]</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr class="cabecera">
                                                <th>Cantidad de Preguntas de Balotario</th>
                                                <th>Cantidad de Preguntas de Evaluación</th>
                                                <th>Tipo de Evaluación</th>
<!--                                                <th>Estado</th>-->
                                                <th>[-]</th>
                                                <th>[-]</th>
                                            </tr>
                                        </tfoot>
                                    </table>
<!--                                    <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditar2(1)" >
                                        <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                                    </div>-->
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

@section('form')
@include( 'proceso.master.balotario.form.balotario' )
@stop
