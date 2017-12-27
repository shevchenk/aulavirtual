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

@include( 'mantenimiento.curso.js.curso_ajax' )
@include( 'mantenimiento.curso.js.curso' )


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
                <form id="CursoForm">
                    <div class="box-body table-responsive no-padding">
                        <table id="TableCurso" class="table table-bordered table-hover">
                            <thead>
                                <tr class="cabecera">
                                    <th class="col-xs-3">
                                        <div class="form-group">
                                            <label><h4>Curso:</h4></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_curso" id="txt_curso" placeholder="Curso" onkeypress="return masterG.enterGlobal(event, '.input-group', 1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-1">
                                        <div class="form-group">
                                            <label><h4>Imagen de Lista:</h4></label>
                                        </div>
                                    </th>
                                    <th class="col-xs-4">
                                        <div class="form-group">
                                            <label><h4>Imagen de Cabecera:</h4></label>
                                        </div>
                                    </th>
                                    <th class="col-xs-1">[Editar]</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr class="cabecera">
                                    <th>Curso</th>
                                    <th>Imagen de Lista</th>
                                    <th>Imagen de Cabecera</th>
                                    <th>[Editar]</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- .box-body -->
                </form><!-- .form -->
            </div><!-- .box -->
        </div><!-- .col -->
    </div><!-- .row -->
</section><!-- .content -->
@stop

@section('form')
@include( 'mantenimiento.curso.form.curso' )
@stop
