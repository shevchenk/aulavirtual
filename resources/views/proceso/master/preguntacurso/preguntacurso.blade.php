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

@include( 'proceso.master.preguntacurso.js.preguntacurso_ajax' )
@include( 'proceso.master.preguntacurso.js.preguntacurso' )
@include( 'proceso.master.preguntacurso.js.pregunta_ajax' )
@include( 'proceso.master.preguntacurso.js.pregunta' )

@stop

@section('content')
<section class="content-header">
    <h1>Curso
        <small>Mantenimiento</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-sitemap"></i> Mantenimiento</a></li>
        <li class="active">Curso</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body  no-padding">
                    <form id="CursoForm">
                        <div class="panel panel-primary">
                            <div class="panel-heading" style="background-color: #337ab7;color:#fff">
                                <center>.::Cursos Disponibles::.</center>
                            </div>
                            <div class="panel-body table-responsive no-padding">
                                <div class="col-md-12">
                                    <table id="TableCurso" class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="cabecera">
                                                <th class="col-xs-10">
                                                    <div class="form-group">
                                                        <label><h4>Curso:</h4></label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_curso" id="txt_curso" placeholder="Curso" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="col-xs-1">[-]</th>
                                                <th class="col-xs-1">[-]</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr class="cabecera">                               
                                                <th>Curso</th>
                                                <th>[-]</th>
                                                <th>[-]</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- .box-body -->
                            </div>
                        </div>
                    </form><!-- .form -->
                    <hr>
                    <form id="PreguntaForm" style="display: none">
                        <input type= "hidden" name="txt_curso_id" id="txt_curso_id" class="form-control mant" >
                        <div class="panel panel-warning">
                            <div class="panel-heading" style="background-color: #FFE699;color:black">
                                <center>.::Preguntas::.</center>
                            </div>
                            <div class="panel-body table-responsive no-padding">
                                <div class="col-md-12">
                                    <table id="TablePregunta" class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="cabecera">
                                                <th class="col-xs-2">
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
                                                        <label><h4>Tipo Evaluacion:</h4></label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_tipo_evaluacion" id="txt_tipo_evaluacion" placeholder="Tipo de Evaluacion" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="col-xs-2">
                                                    <div class="form-group">
                                                        <label><h4>Pregunta:</h4></label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_pregunta" id="txt_pregunta" placeholder="Pregunta" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="col-xs-1">
                                                    <div class="form-group">
                                                        <label><h4>Puntaje:</h4></label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                            <input type="text" class="form-control" name="txt_puntaje" id="txt_puntaje" placeholder="Puntaje" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                                        </div>
                                                    </div>
                                                </th>
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
                                                <th class="col-xs-1">[-]</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr class="cabecera">
                                                <th>Curso</th>
                                                <th>Tipo Evaluacion</th>
                                                <th>Pregunta</th>
                                                <th>Puntaje</th>
                                                <th>Estado</th>
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
                </div>
            </div><!-- .box -->
        </div><!-- .col -->
    </div><!-- .row -->
</section><!-- .content -->
@stop

@section('form')
@include( 'proceso.master.preguntacurso.form.preguntacurso' )
@include( 'proceso.master.preguntacurso.form.pregunta' )
@stop
