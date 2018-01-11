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

    @include( 'proceso.alumno.evaluacion.js.evaluacion_ajax' )
    @include( 'proceso.alumno.evaluacion.js.evaluacion' )

    @include( 'proceso.alumno.evaluacion.js.tipoevaluacion_ajax' )
    @include( 'proceso.alumno.evaluacion.js.tipoevaluacion' )

@stop

@section('content')
<section class="content-header">
    <h1>Mis evaluaciones
        <small>Alumnos</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-sitemap"></i> Mis evaluaciones</a></li>
        <li class="active">Alumnos</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box" style="overflow: hidden;">
                <form id="TipoEvaluacionForm">
                  <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color: #337ab7;color:#fff">
                        <center>.::Evaluaciones de Alumnos::.</center>
                    </div>

                        <div class="box-body table-responsive no-padding">
                          <div class="col-md-12">
                          <table id="TableEvaluacion" class="table table-bordered table-hover">
                              <thead>
                                  <tr class="cabecera">
                                  <input type="hidden" name="txt_estado" class="mant" value="1">
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
                                      <!--<th class="col-xs-1">[-]</th>-->
                                  </tr>
                              </thead>
                              <tbody>
                              </tbody>
                              <tfoot>
                                  <tr class="cabecera">
                                    <th>Curso</th>
                                    <th>Docente</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Final</th>
                                    <!--<th>[-]</th>-->
                                  </tr>
                              </tfoot>
                          </table>
                          </div>
                        </div><!-- .box-body -->
                  </div>
                </form><!-- .form -->

                <hr>
                <form id="EvaluacionForm" style="display: none">
                    <input type= "hidden" name="txt_programacion_id" id="txt_programacion_id" class="form-control mant">
                    <input type= "hidden" name="txt_programacion_unica_id" id="txt_programacion_unica_id" class="form-control mant">
                    <input type="hidden" id="txt_curso" name="txt_curso" class="form-controlmant">
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
                </form><!-- .form -->


                <form id="ResultEvaluacion" style="display: none">
                  <input type= "hidden" name="txt_programacion_id" id="txt_programacion_id" class="form-control mant">
                  <input type= "hidden" name="txt_programacion_unica_id" id="txt_programacion_unica_id" class="form-control mant">
                  <input type="hidden" id="txt_tipo_evaluacion_id" name="txt_tipo_evaluacion_id" class="form-controlmant">

                  <input type="hidden" id="txt_tipo_evaluacion" name="txt_tipo_evaluacion" class="form-controlmant">
                  <input type="hidden" id="txt_curso" name="txt_curso" class="form-controlmant">

                  <div class="col-md-12">
                    <div class="col-md-2"></div>

                    <div class="col-md-8" id="resultado">
                    </div>

                    <div class="col-md-2"></div>
                  </div>
                </form><!-- .form -->

                <form id="ResultFinalEvaluacion" style="display: none">
                  <input type= "hidden" name="txt_programacion_id" id="txt_programacion_id" class="form-control mant">
                  <input type="hidden" id="txt_evaluacion_id" name="txt_evaluacion_id" class="form-controlmant">

                  <input type="hidden" id="txt_tipo_evaluacion" name="txt_tipo_evaluacion" class="form-controlmant">
                  <input type="hidden" id="txt_curso" name="txt_curso" class="form-controlmant">

                  <div class="col-md-12">
                    <div class="col-md-2"></div>

                    <div class="col-md-8" id="resultado_final">
                    </div>

                    <div class="col-md-2"></div>
                  </div>
                </form><!-- .form -->

            </div><!-- .box -->
        </div><!-- .col -->
    </div><!-- .row -->
</section><!-- .content -->
@stop

@section('form')
     @include( 'proceso.alumno.gestor.form.contenido' )
@stop
