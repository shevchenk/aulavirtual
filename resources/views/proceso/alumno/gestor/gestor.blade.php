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
                        <center>.::Programaciones de Alumnos::.</center>
                    </div>

                        <div class="box-body table-responsive no-padding">
                          <div class="col-md-12">
                          <table id="TableEvaluacion" class="table table-bordered table-hover">
                              <thead>
                                  <tr class="cabecera">
                                  <input type="hidden" name="txt_estado" class="mant" value="1">
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
                          </div>
                        </div><!-- .box-body -->
                  </div>
                </form><!-- .form -->

                <hr>
                <form id="ContenidoForm" style="display: none">
                  <div class="panel panel-primary" style="padding-bottom: 10px;">
                      <div class="panel-heading" style="background-color: #337ab7;color:#fff">
                          <center>.::Contenidos del Alumno::.</center>
                      </div>
                    <input type= "hidden" name="txt_programacion_unica_id" id="txt_programacion_unica_id" class="form-control mant" >
                    <div id="DivContenido" class="box-body table-responsive no-padding">

                      <div class="col-md-12">
                          <div class="col-lg-4" style="margin-top: 15px; -moz-box-shadow: 0 0 5px #888; -webkit-box-shadow: 0 0 5px#888; box-shadow: 0 0 5px #888;">
                            <div class="row">
                              <div class="col-md-5 text-center" style="border-right: 2px solid #e9e9e9;">
                                <img class="img-responsive" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="100%" width="100%" height="" style="margin:10px auto;">
                              </div>
                              <div class="col-md-7">
                                <div class="text-justify" style="margin-bottom: 15px; margin-top:10px; font-size: 15px; padding: 5px 5px; background-color: #F5F5F5; border-radius: 10px; border: 3px solid #F8F8F8;">
                                  <p>Este es un Contenido de Ejemplo, espero quede bien!</p>
                                </div>
                                <div>
                                  <p style="font-weight: normal;">
                                    <label style="font-weight: bold;">Fecha Ini. : </label> 2017-11-25</br>
                                    <label style="font-weight: bold;">Fecha Fin. : </label> 2017-11-25</br>
                                    <label style="font-weight: bold;">Fecha Amp. : </label> 2017-11-25
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12" style="padding-right: 5px; padding-left: 5px; margin-top: 5px; overflow:hidden;">
                                <button type="button" class="col-xs-12 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Responder Tarea"><span class="fa fa-list fa-lg"></span> Responder Tarea</button>
                              </div>
                            </div>
                          </div>

                          <div class="col-lg-4" style="margin-top: 15px; -moz-box-shadow: 0 0 5px #888; -webkit-box-shadow: 0 0 5px#888; box-shadow: 0 0 5px #888;">
                            <div class="row">
                              <div class="col-md-5 text-center" style="border-right: 2px solid #e9e9e9;">
                                <img class="img-responsive" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="100%" width="100%" height="" style="margin:10px auto;">
                              </div>
                              <div class="col-md-7">
                                <div class="text-justify" style="margin-bottom: 15px; margin-top:10px; font-size: 15px; padding: 5px 5px; background-color: #F5F5F5; border-radius: 10px; border: 3px solid #F8F8F8;">
                                  <p>Este es un Contenido de Ejemplo, espero quede bien!</p>
                                </div>
                                <div>
                                  <p style="font-weight: normal;">
                                    <label style="font-weight: bold;">Fecha Ini. : </label> 2017-11-25</br>
                                    <label style="font-weight: bold;">Fecha Fin. : </label> 2017-11-25</br>
                                    <label style="font-weight: bold;">Fecha Amp. : </label> 2017-11-25
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3" style="padding-right: 0px; padding-left: 5px; margin-top: 5px; overflow:hidden;">
                                <button type="button" class="col-xs-12 btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><span class="fa fa-trash fa-lg"></span> Eliminar</button>
                              </div>
                              <div class="col-md-3" style="padding-right: 0px; padding-left: 5px; margin-top: 5px; overflow:hidden;">
                                <button type="button" style="" class="col-xs-12 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><span class="fa fa-edit fa-lg"></span> Editar</button>
                              </div>
                              <div class="col-md-3" style="padding-right: 0px; padding-left: 5px; margin-top: 5px; overflow:hidden;">
                                <button type="button" style="" class="col-xs-12 btn btn-info" data-toggle="tooltip" data-placement="top" title="Ver Contenido 1"><span class="fa fa-list fa-lg"></span> Contenido 1</button>
                              </div>
                              <div class="col-md-3" style="padding-right: 0px; padding-left: 5px; margin-top: 5px; overflow:hidden;">
                                <button type="button" class="col-xs-12 btn btn-info" data-toggle="tooltip" data-placement="top" title="Ver Contenido 2"><span class="fa fa-list fa-lg"></span> Contenido 2</button>
                              </div>
                            </div>
                          </div>

                      </div>



                    </div><!-- .box-body -->
                  </div>
                </form><!-- .form -->

                <hr>
                <div id="div_contenido_respuesta" class="box-body no-padding">
                  <div class="panel panel-primary">
                      <div class="panel-heading" style="background-color: #337ab7;color:#fff">
                          <center>.::Respuestas de Contenidos::.</center>
                      </div>
                      <div class="col-md-4" style="margin-top: 40px;">
                          <div class="panel panel-info">
                            <div class="panel-heading text-center">POR FAVOR INSERTAR SU RESPUESTA</div>
                            <div class="panel-body">
                                <form id="frmRepuestaAlum" name="frmRepuestaAlum" class="form-inline">
                                  <input type= "hidden" name="txt_contenido_id" id="txt_contenido_id" class="form-control mant" >
                                  <input type= "hidden" name="programacion_unica_id" id="programacion_unica_id" class="form-control mant" >
                                  <div class="col-md-12">
                                    <label class="sr-only" for="Respuesta">Respuesta</label>
                                    <div class="input-group col-xs-12">
                                      <div class="input-group-addon" style="background-color: #F5F5F5;">Rpta:</div>
                                      <textarea class="form-control" id="txt_respuesta" name="txt_respuesta" placeholder="" rows="4"></textarea>
                                    </div>
                                  </div>

                                  <div class="col-md-12" style="margin-top:10px;">

                                      <input type="text" style="" readonly="" class="col-xs-9 input-sm" id="txt_file_nombre" name="txt_file_nombre" value="">
                                      <input type="text" style="display: none;" id="txt_file_archivo" name="txt_file_archivo">
                                      <label class="col-xs-3 btn btn-default btn-flat  btn-xs" style="height: 30px; margin-top: 0px;">
                                          <i class="fa fa-file-image-o fa-lg"></i>
                                          <input type="file" style="display: none;" onchange="onImagen(event);">
                                      </label>
                                  </div>

                                  <div class="col-md-12" style="margin-top:10px;">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                      <button type="button" id="btnCancelRpta" name="btnCancelRpta" class="col-xs-12 btn btn-default">Cancelar</button>
                                    </div>
                                    <div class="col-md-4">
                                      <button type="button" id="btnGrabarRpta" name="btnGrabarRpta" class="col-xs-12 btn btn-primary"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Grabar</button>
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
                                  <th>Alumno</th>
                                  <th>Respuesta</th>
                                  <th>Ruta</th>
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
