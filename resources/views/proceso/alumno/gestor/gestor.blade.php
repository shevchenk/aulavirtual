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

@include( 'proceso.alumno.gestor.js.gestor_ajax' )
@include( 'proceso.alumno.gestor.js.gestor' )

@include( 'proceso.alumno.gestor.js.contenido_ajax' )
@include( 'proceso.alumno.gestor.js.contenido' )

@stop

@section('content')
<section class="content-header">
    <h1>Gestor
        <small>Contenidos</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-sitemap"></i> Contenidos</a></li>
        <li class="active">Gestor</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form id="TipoEvaluacionForm">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="background-color: #337ab7;color:#fff">
                            <center>.::Programación del Presente Semestre::.</center>
                        </div>

                        <div class="box-body table-responsive no-padding">
                            <div class="col-md-12">
                                <table id="TableEvaluacion" class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="cabecera">
                                    <input type="hidden" name="txt_estado" class="mant" value="1">
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
                                    <th class="col-xs-2">
                                        <div class="form-group">
                                            <label><h4>Curso</h4></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_curso" id="txt_curso" placeholder="Curso" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group">
                                            <label><h4>Docente</h4></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_docente" id="txt_docente" placeholder="Docente" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group">
                                            <label><h4>Fecha Inicio</h4></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_fecha_inicio" id="txt_fecha_inicio" placeholder="Fecha Inicio" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-2">
                                        <div class="form-group">
                                            <label><h4>Fecha Final</h4></label>
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
                            </div>
                        </div><!-- .box-body -->
                    </div>
                </form><!-- .form -->

                <hr>
                <form id="ContenidoForm" style="display: none">
                    <div class="panel panel-success" style="padding-bottom: 10px;">
                        <img id="imageCurso" class="panel-heading img-responsive" src='img/course/calculo2f.jpg' style="width:100%;min-height: 90px;">

                        </img>
                        <div class="panel-body table-responsive no-padding">
                            <div class="col-md-12">
                                <input type= "hidden" name="txt_programacion_unica_id" id="txt_programacion_unica_id" class="form-control mant" >
                                <input type= "hidden" name="txt_programacion_id" id="txt_programacion_id" class="form-control mant" >
                                <div class="box box-solid">
                                    <div class="box-body">
                                        <div class="box-group" id="DivContenido">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .box-body -->
                    </div>
            </div>
            </form><!-- .form -->

            <hr>
            <div id="div_contenido_respuesta" class="box-body no-padding">
                <div class="panel panel-warnimg">
                    <div class="panel-heading" style="background-color: #FFE699;color:black">
                        <center>.::Desarrollo de la Tarea::.</center>
                    </div>
                    <div class="col-md-4" style="margin-top: 40px;">
                        <div class="panel panel-info">
                            <div class="panel-heading text-center">AGREGAR RESPUESTA AQUÍ</div>
                            <div class="panel-body">
                                <form id="frmRepuestaAlum" name="frmRepuestaAlum" class="form-inline">
                                    <input type= "hidden" name="txt_contenido_id" id="txt_contenido_id" class="form-control mant" >
                                    <input type= "hidden" name="programacion_unica_id" id="programacion_unica_id" class="form-control mant" >
                                    <div class="col-md-12">
                                        <label class="sr-only" for="Respuesta">Respuesta</label>
                                        <div class="input-group col-xs-12">
                                            <textarea class="form-control" id="txt_respuesta" name="txt_respuesta" placeholder="" rows="4"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12" style="margin-top:10px;">

                                        <input type="text" style="" readonly="" class="col-xs-7 input-sm" id="txt_file_nombre" name="txt_file_nombre" value="">
                                        <input type="text" style="display: none;" id="txt_file_archivo" name="txt_file_archivo">
                                        <label class="col-xs-5 btn btn-default btn-flat  btn-xs" style="height: 30px; margin-top: 0px;">
                                            <i class="fa fa-file-image-o fa-lg"></i>Cargar Documento
                                            <input type="file" style="display: none;" onchange="onImagen(event);">
                                        </label>
                                    </div>

                                    <div class="col-md-12" style="margin-top:10px;">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <button type="button" id="btnCancelRpta" name="btnCancelRpta" class="col-xs-12 btn btn-default">Cancelar</button>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" id="btnGrabarRpta" name="btnGrabarRpta" class="col-xs-12 btn btn-primary"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Enviar</button>
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="box-body table-responsive no-padding">
                            <table id="TableRespuestaAlu" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="cabecera">
                                        <th>Fecha de Envio</th>
                                        <th>Respuesta Enviada</th>
                                        <th>Archivo</th>
                                        <th>[-]</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- .box -->
    </div><!-- .col -->
</div><!-- .row -->
</section><!-- .content -->
@stop

@section('form')
@include( 'proceso.alumno.gestor.form.contenido' )
@stop
