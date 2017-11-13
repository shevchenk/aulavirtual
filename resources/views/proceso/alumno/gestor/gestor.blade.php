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
                                  <!-- <th>[-]</th>
                                  <th>[-]</th> -->
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
                                  <!-- <th>[-]</th>
                                  <th>[-]</th> -->
                                </tr>
                            </tfoot>
                        </table>
                    <!--
                        <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditar3(1)" >
                            <i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                        </div>
                      -->
                    </div><!-- .box-body -->
                </form><!-- .form -->
                <hr>
                <div id="div_contenido_respuesta" class="box-body no-padding">
                  <div class="col-md-4">
                      <div class="panel panel-info">
                        <div class="panel-heading text-center">POR FAVOR INSERTAR SU RESPUESTA</div>
                        <div class="panel-body">
                            <form id="frmRepuestaAlum" name="frmRepuestaAlum" class="form-inline">
                              <input type= "hidden" name="txt_contenido_id" id="txt_contenido_id" class="form-control mant" >
                              <input type= "hidden" name="txt_programacion_id" id="txt_programacion_id" class="form-control mant" >
                              <div class="form-group">
                                <label class="sr-only" for="Respuesta">Respuesta</label>
                                <div class="input-group">
                                  <div class="input-group-addon" style="background-color: #F5F5F5;">Rpta:</div>
                                  <textarea class="form-control" id="txt_respuesta" name="txt_respuesta" placeholder="" style="width: 350px;" rows="3"></textarea>
                                </div>
                              </div>

                              <div class="form-group" style="margin-top:10px;">
                                  <label>Ruta</label>
                                  <input type="text" style="width: 330px;" readonly="" class="form-control input-sm" id="txt_file_nombre" name="txt_file_nombre" value="">
                                  <input type="text" style="display: none;" id="txt_file_archivo" name="txt_file_archivo">
                                  <label class="btn btn-default btn-flat margin btn-xs">
                                      <i class="fa fa-file-image-o fa-lg"></i>
                                      <input type="file" style="display: none;" onchange="onImagen(event);">
                                  </label>
                              </div>

                              <div class="form-group" style="padding-left: 110px; margin-top:10px;">
                                <button type="button" id="btnCancelRpta" name="btnCancelRpta" class="btn btn-default">Cancelar</button>&nbsp;&nbsp;
                                <button type="button" id="btnGrabarRpta" name="btnGrabarRpta" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Grabar</button>
                              </div>
                            </form>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-8">
                        <table id="TableRespuestaAlu" class="table table-bordered table-hover">
                          <thead>
                            <tr class="cabecera">
                              <th>Alumno</th>
                              <th>Respuesta</th>
                              <th>Ruta</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>-</td>
                              <td>-</td>
                              <td>-</td>
                            </tr>
                          </tbody>
                        </table>
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
