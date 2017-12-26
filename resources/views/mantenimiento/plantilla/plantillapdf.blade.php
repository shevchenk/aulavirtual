<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Plantilla</title>
        
        @section('include')
            {{ Html::style('lib/bootstrap/css/bootstrap.min.css') }} 
            {{ Html::script('lib/bootstrap/js/bootstrap.min.js') }}

        @show
    </head>

    <body class="skin-blue sidebar-mini sidebar-collapse">
        <div class="wrapper">
            <div class="content-wrapper">
                <div class="col-md-3">
                    @if (isset($preguntas))
                    <ol>
                        @foreach ( $preguntas as $key => $val)
                        <li>{{ $key }}<span style="color: red">- Puntaje: {{ $val[0]->puntaje }}</span></li>
                        <ul>
                            @foreach ( $val as $k)
                            <li>{{ $k->respuesta }}</li>
                            @endforeach
                        </ul>
                        <br>
                        @endforeach
                    </ol>
                    @endif
                </div>
            
            </div>
        </div><!-- ./wrapper -->
    </body>
</html>

