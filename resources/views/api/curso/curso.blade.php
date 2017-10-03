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



@stop

@section('content')
<section class="content-header">
    <h1>API
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
                <h3>Redireccionamiento ok: | {{ $mensaje }}</h3>
            </div><!-- .box -->
        </div><!-- .col -->
    </div><!-- .row -->
</section><!-- .content -->
@stop

