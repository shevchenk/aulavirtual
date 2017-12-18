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

    @include( 'mantenimiento.unidadcontenido.js.unidadcontenido_ajax' )
    @include( 'mantenimiento.unidadcontenido.js.unidadcontenido' )
    

@stop

@section('content')
<section class="content-header">
    <h1>Unidad de Contenido
        <small>Mantenimiento</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-sitemap"></i> Mantenimiento</a></li>
        <li class="active">Unidad de Contenido</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form id="UnidadContenidoForm">
                    <div class="box-body table-responsive no-padding">
                        <table id="TableUnidadContenido" class="table table-bordered table-hover">
                            <thead>
                                <tr class="cabecera">
                                    <th class="col-xs-5">
                                        <div class="form-group">
                                            <label><h4>Imagen:</h4></label>
                                        </div>
                                    </th>
                                    <th class="col-xs-5">
                                        <div class="form-group">
                                            <label><h4>Unidad de Contenido:</h4></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                <input type="text" class="form-control" name="txt_unidad_contenido" id="txt_unidad_contenido" placeholder="Unidad de Contenido" onkeypress="return masterG.enterGlobal(event,'.input-group',1);">
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-xs-1">[Estado]</th>
                                    <th class="col-xs-1">[Editar]</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr class="cabecera">                               
                                  <th>Imagen</th>
                                  <th>Unidad de Contenido</th>
                                  <th>[Estado]</th>
                                  <th>[Editar]</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class='btn btn-primary btn-sm' class="btn btn-primary" onClick="AgregarEditar(1)" >
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
     @include( 'mantenimiento.unidadcontenido.form.unidadcontenido' )
@stop
