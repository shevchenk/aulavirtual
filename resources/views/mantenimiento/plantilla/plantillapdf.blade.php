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
                <table style="width: 100% !important">
                    <tr>
                        <td class="c1">
                            <b>CARRERA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><b style="padding-left: 4em;">:</b>
                        </td>
                        <td class="c2">
                            {{ $head->carrera }}
                        </td>
                        <td class="c1">
                            <b>SEMESTRE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><b style="padding-left: 4em;">:</b>
                        </td>
                        <td class="c2">
                            {{ $head->semestre }}
                        </td>
                    </tr>
                    <tr>
                        <td class="c1">
                            <b>CURSO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><b style="padding-left: 4em;">:</b>
                        </td>
                        <td class="c2">
                            {{ $head->curso }}
                        </td>
                        <td class="c1">
                            <b>CICLO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><b style="padding-left: 4em;">:</b>
                        </td>
                        <td class="c2">
                            {{ $head->ciclo }}
                        </td>
                    </tr>
                    <tr>
                        <td class="c1">
                            <b>PROFESOR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><b style="padding-left: 4em;">:</b>
                        </td>
                        <td class="c2">
                            {{ $head->profesor }}
                        </td>
                        <td class="c1">
                            <b>TIPO EVALUACIÓN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><b style="padding-left: 4em;">:</b>
                        </td>
                        <td class="c2">
                            {{ $head->tipo_evaluacion }}
                        </td>
                    </tr>
                </table>
                <hr>
                <div>
                    @if (isset($preguntas))
                    <ol>
                        @foreach ( $preguntas as $key => $val)
                        @php 
                        $k=explode('|',$key); 
                        $img='';
                        if($k[1]!=null){
                        $img='<img src="img/question/'.$k[1].'" style="width:200px"><br>';
                        }
                        @endphp
                        <li><?php echo $img ?>{{ $k[0] }}</li>
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

