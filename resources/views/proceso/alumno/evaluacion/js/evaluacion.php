<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var TipoEvaluacionG={id:0, dni:"", alumno:"", curso:"", fecha_inicio:"", fecha_final:"", docente:"", estado:1}; // estado:1

var evaluacionG_id = 0;
var evaluacionG = '';
//var evaluacionG_fecha_valida = '';
var evaluacionG_estado_cambio = 0;
var CantevalG = 0;
var ceval = 0;
var data_evaluacion_preg = [];
var data_alter_preg = [];

var tipo_evaluacionG = '';
var cursoG = '';

$(document).ready(function() {

    $("#TableEvaluacion").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    AjaxEvaluacion.Cargar(HTMLCargarEvaluacion);

    $("#TipoEvaluacionForm #TableEvaluacion select").change(function(){ AjaxEvaluacion.Cargar(HTMLCargarEvaluacion); });
    $("#TipoEvaluacionForm #TableEvaluacion input").blur(function(){ AjaxEvaluacion.Cargar(HTMLCargarEvaluacion); });

    $('#ModalTipoEvaluacion').on('shown.bs.modal', function (event) {

        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalTipoEvaluacionForm").append("<input type='hidden' value='"+TipoEvaluacionG.id+"' name='id'>");
        }
        $('#ModalTipoEvaluacionForm #txt_dni').val( TipoEvaluacionG.dni );
        $('#ModalTipoEvaluacionForm #txt_alumno').val( TipoEvaluacionG.alumno );
        $('#ModalTipoEvaluacionForm #txt_curso').val( TipoEvaluacionG.curso );
        $('#ModalTipoEvaluacionForm #txt_fecha_inicio').val( TipoEvaluacionG.fecha_inicio );
        $('#ModalTipoEvaluacionForm #txt_fecha_final').val( TipoEvaluacionG.fecha_final );
        $('#ModalTipoEvaluacionForm #txt_docente').val( TipoEvaluacionG.docente );
        //$('#ModalTipoEvaluacionForm #slct_estado').selectpicker( 'val',TipoEvaluacionG.estado );
        $('#ModalTipoEvaluacionForm #txt_curso').focus();
    });

    $('#ModalTipoEvaluacion').on('hidden.bs.modal', function (event) {
        $("#ModalTipoEvaluacionForm input[type='hidden']").not('.mant').remove();
    });

});

ValidaForm=function(){
    var r=true;

    if( $.trim( $("#ModalTipoEvaluacionForm #txt_curso").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Tipo Evaluacion',4000);
    }

    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    TipoEvaluacionG.id='';
    TipoEvaluacionG.curso='';
    TipoEvaluacionG.estado='1';
    if( val==0 ){
        TipoEvaluacionG.id=id;
        TipoEvaluacionG.curso=$("#TableEvaluacion #trid_"+id+" .curso").text();
        TipoEvaluacionG.estado=$("#TableEvaluacion #trid_"+id+" .estado").val();
    }
    $('#ModalTipoEvaluacion').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxEvaluacion.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxEvaluacion.Cargar(HTMLCargarEvaluacion);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxEvaluacion.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalTipoEvaluacion').modal('hide');
        AjaxEvaluacion.Cargar(HTMLCargarEvaluacion);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarEvaluacion=function(result){

    var html="";
    $('#TableEvaluacion').DataTable().destroy();
    //alert('llegoo');
    $.each(result.data.data,function(index,r){
        //estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        /*if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }*/
        //html+="<tr id='trid_"+r.id+"' >"+
        html+='<tr id="trid_'+r.id+'" onClick="CargarEvaluaciones('+r.id+','+r.pu_id+','+r.curso_id+',\''+r.curso+'\',\''+r.foto_cab+'\',this)">'+
            "<td class='carrera'>"+r.carrera+"</td>"+
            "<td class='semestre'>"+r.semestre+"</td>"+
            "<td class='ciclo'>"+r.ciclo+"</td>"+
            "<td class='curso'>"+
            //"<a target='_blank' href='img/course/"+r.foto+"'>"+
            "<img src='img/course/"+r.foto+"' style='height: 40px;width: 40px;'>"+
            "&nbsp"+r.curso+"</td>"+
            "<td class='docente'>"+r.docente+"</td>"+
            "<td class='fecha_inicio'>"+r.fecha_inicio+"</td>"+
            "<td class='fecha_final'>"+r.fecha_final+"</td>"+
            "<td class='evals'>"+r.evals+"</td>";
        //html +='<a class="btn btn-primary btn-sm" onClick="CargarContenido('+r.pu_id+','+r.curso_id+',\''+r.curso+'\')"><i class="fa fa-plus fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableEvaluacion tbody").html(html);
    $("#TableEvaluacion").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthMenu": [10],
        "language": {
            "info": "Mostrando página "+result.data.current_page+" / "+result.data.last_page+" de "+result.data.total,
            "infoEmpty": "No éxite registro(s) aún",
        },
        "initComplete": function () {
            $('#TableEvaluacion_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarEvaluacion','AjaxEvaluacion',result.data,'#TableEvaluacion_paginate');
        }
    });
};


CargarEvaluaciones=function(id, programacion_unica_id, curso_id,curso, imagen, boton){
    masterG.pintar_fila(boton); //Pinta la fila
    //alert(id+'- '+ programacion_unica_id+'- '+ curso_id+'- '+ curso+'- '+ boton);

    $("#imageCurso").attr("src","img/course/"+imagen);

     $("#EvaluacionForm #txt_programacion_id").val(id);
     $("#EvaluacionForm #txt_programacion_unica_id").val(programacion_unica_id);
     $("#EvaluacionForm #txt_curso").val(curso);

     AjaxTipoEvaluacion.Cargar(HTMLCargarTipoEvaluacion);
     //AjaxContenido.Cargar(HTMLCargarContenido);
     $("#EvaluacionForm").css("display","");
};


HTMLCargarTipoEvaluacion=function(result){
    var programacion_id = $("#EvaluacionForm #txt_programacion_id").val();
    var programacion_unica_id = $("#EvaluacionForm #txt_programacion_unica_id").val();
    var curso = $("#EvaluacionForm #txt_curso").val();
    var html="";
    //console.log(result.data.data);

    $.each(result.data.data,function(index, r){
        if(index == 0){
          html+='<div class="col-md-12">';
        }

        html+='<div class="col-lg-4">'+
            '<div class="panel panel-primary rotar" style="-moz-box-shadow: 0 0 7px #337ab7; -webkit-box-shadow: 0 0 7px #337ab7; box-shadow: 0 0 7px #337ab7;">'+
              '<div class="panel-heading text-center" style="text-transform: uppercase; text-shadow: 2px 2px 4px #FFFFFF;">'+
                '<h2 class="panel-title" style="font-size: 18px;">'+r.tipo_evaluacion+'</h2>'+
              '</div>'+
              '<div class="panel-body text-center">';

          if(r.estado_cambio == 0){
            html+='<button type="button" id="btniniciareval" name="btniniciareval" class="btn btn-default" onClick="iniciarEvaluacion('+r.id+','+programacion_id+','+programacion_unica_id+',\''+r.tipo_evaluacion+'\',\''+curso+'\')" style="font-weight: bold;">Iniciar Evaluación</button>';
          }else if(r.estado_cambio == 1){
            html+='<button type="button" id="btniniciareval" name="btniniciareval" class="btn btn-primary" onClick="verEvaluacion('+r.evaluacion_id+','+programacion_id+',\''+r.tipo_evaluacion+'\',\''+curso+'\')" style="font-weight: bold;">Ver Resultados</button>';
          }
        html+='</div>'+
            '</div>'+
          '</div>';

        if((index+1) % 3 == 0){
            html+='</div>';
            html+='<div class="col-md-12">';
        }
    });
    if(result.data.length>0){
        html+='</div>';
    }
    $("#DivContenido").html(html);
};


iniciarEvaluacion=function(id, programacion_id, programacion_unica_id, tipo_evaluacion, curso){
    $("#TipoEvaluacionForm").slideUp('slow');
    $("#EvaluacionForm").slideUp('slow');
    $("#ResultFinalEvaluacion").hide();

    $("#ResultEvaluacion #txt_tipo_evaluacion_id").val(id);
    $("#ResultEvaluacion #txt_programacion_id").val(programacion_id);
    $("#ResultEvaluacion #txt_programacion_unica_id").val(programacion_unica_id);

    $("#ResultEvaluacion #txt_tipo_evaluacion").val(tipo_evaluacion);
    $("#ResultEvaluacion #txt_curso").val(curso);
    AjaxTipoEvaluacion.CargarPreguntas(HTMLiniciarEvaluacion);
};

verEvaluacion=function(evaluacion_id, programacion_id, tipo_evaluacion, curso){
    $("#TipoEvaluacionForm").slideUp('slow');
    $("#EvaluacionForm").slideUp('slow');

    $("#ResultFinalEvaluacion #txt_evaluacion_id").val(evaluacion_id);
    $("#ResultFinalEvaluacion #txt_programacion_id").val(programacion_id);

    $("#ResultFinalEvaluacion #txt_tipo_evaluacion").val(tipo_evaluacion);
    $("#ResultFinalEvaluacion #txt_curso").val(curso);
    AjaxTipoEvaluacion.VerResultPreguntas(HTMLverEvaluacion);
};

HTMLiniciarEvaluacion=function(result){
  tipo_evaluacionG = $("#ResultEvaluacion #txt_tipo_evaluacion").val();
  cursoG = $("#ResultEvaluacion #txt_curso").val();

  if(result.val_fecha_evaluacion == 'error_fecha')
  {
    swal("Validación!", "Rango de fecha valido "+result.evaluacion_fecha_inicial+" a "+result.evaluacion_fecha_final, "warning");
    AjaxTipoEvaluacion.Cargar(HTMLCargarTipoEvaluacion);

    $("#TipoEvaluacionForm").slideDown('fast');
    $("#EvaluacionForm").slideDown('fast');

    $("#resultado").html('')
    $("#ResultEvaluacion").hide();
    return false;
  }
  else if(result.val_fecha_evaluacion == 'error_balotario')
  {
    swal("Validación!", "Usted no cuenta con una Evaluación actual!", "warning");

    AjaxTipoEvaluacion.Cargar(HTMLCargarTipoEvaluacion);

    $("#TipoEvaluacionForm").slideDown('fast');
    $("#EvaluacionForm").slideDown('fast');

    $("#resultado").html('')
    $("#ResultEvaluacion").hide();
    return false;
  }
  else
  {
      if(evaluacionG == '') {
        evaluacionG = result.data;
        CantevalG = evaluacionG.length; //Total Datos
        evaluacionG_id = result.evaluacion_id;
        evaluacionG_estado_cambio = result.evaluacion_estado_cambio;
      }
      
      //console.log(evaluacionG);
      $.each(evaluacionG, function(index, r){

        data_evaluacion_preg.push({
                        "pregunta_id" : r.pregunta_id,
                        "pregunta" : r.pregunta,
                        "imagen" : r.imagen,
                        "cantidad_pregunta" : r.cantidad_pregunta,
                        "alternativas" : r.alternativas
                    });
        data_evaluacion_preg = data_evaluacion_preg;
      });

      verContenidoIniciarEvaluacion();
  }
};


verContenidoIniciarEvaluacion = function (){
  var html = '';
          html += '<div class="panel panel-primary">'+
                  '<div class="panel-heading text-center">'+
                      '<h4>'+tipo_evaluacionG+' - '+cursoG+'<small style="color: #FFF;"> <label id="hora"></label></small><h4>'+
                  '</div>'+
                  '<div id="body-preguntas" class="panel-body" style="font-weight: normal;">'+
                      'Por favor complete las siguientes preguntas: '+
                  '</div>';

            if(data_evaluacion_preg)
            {
              html += '<ul class="list-group grupo_preguntas">';
              
              if(data_evaluacion_preg[ceval].imagen != '')
                html += '<p style="padding: 0px 15px;"><img src="img/question/'+data_evaluacion_preg[ceval].imagen+'" class="img-circle" alt=""></p>';
                        
              html += '<p style="padding: 10px 15px;">'+(ceval+1)+'.- '+data_evaluacion_preg[ceval].pregunta+' </p>';

                var alternativas = data_evaluacion_preg[ceval].alternativas.split("|");
                $.each(alternativas, function(index, a){
                    var data = a.split(":");
                    html += '<button type="button" class="list-group-item"><span class="badge" style="background-color: #FFF; padding: 0px 0px;">';
                    
                    //html += '<div class="radio"><label><input type="radio" name="rbalternativas'+data_evaluacion_preg[ceval].pregunta_id+'" id="rbp'+data[0]+'" value="'+data[0]+'" aria-label="..."></label></div></span>'+data[1];

                    html += '<div class="radio">'+
                                      '<label style="font-size: 1.5em">'+
                                          '<input type="radio" id="rbp'+data[0]+'" name="rbalternativas'+data_evaluacion_preg[ceval].pregunta_id+'" value="'+data[0]+'" aria-label="...">'+
                                          '<span class="cr"><i class="cr-icon fa fa-circle" style="color: #337ab7;"></i></span>'+                                          
                                      '</label>'+
                                  '</div></span>';
                    html += data[1]+'</button>';
                });
              html += '</ul>';
            }

          html += '<div id="footer-preguntas" class="col-md-12 panel-footer btn-primary"><div class="col-md-8 text-left">Pregunta N° '+(ceval+1)+" de "+data_evaluacion_preg.length+' </div><div class="col-md-4 text-right"><button type="button" id="'+data_evaluacion_preg[ceval].pregunta_id+'" onClick="verSiguientePregunta(this.id);" class="btn btn-default btn-sigue-pregu">Siguiente</button></div></div>'+
                '</div>';
    
    $("#resultado").html(html)
    $("#ResultEvaluacion").slideDown('slow');
}



HTMLverEvaluacion=function(result){
  var tipo_evaluacion = $("#ResultFinalEvaluacion #txt_tipo_evaluacion").val();
  var curso = $("#ResultFinalEvaluacion #txt_curso").val();

   var html = '';
      html += '<div class="panel panel-primary">'+
              '<div class="panel-heading text-center">'+
                  '<h4>'+tipo_evaluacion+' - '+curso+'<small style="color: #FFF;"> <label id="hora"></label></small><h4>'+
              '</div>'+
              '<div id="" class="panel-body" style="font-weight: normal;">'+
                  'A continuación su resultado de exámen: <br/><br/>';

          html += '<ul class="list-group">';
          var total_p = 0;
            $.each(result.data,function(index, r){
                html += '<li class="list-group-item list-group-item-info" style="font-weight: bold;">';

                if((r.imagen*1) != 0)
                  html += '<p style="padding: 0px 15px;"><img src="img/question/'+r.imagen+'" class="img-circle" alt=""></p>';

                html += '<strong>'+(index+1)+'.- </strong>'+r.pregunta+'</li>';

                html += '<li class="list-group-item"><span class="badge">'+r.puntaje+'</span><strong>R: </strong>'+r.respuesta+'</li>';
                total_p = total_p + parseInt(r.puntaje);
            });

            if(total_p.toFixed(2) > 10.5)
              html += '<li class="list-group-item list-group-item-success" style="font-weight: bold;"><span class="badge">'+total_p.toFixed(2)+'</span>APROBADO</li>';
            else
              html += '<li class="list-group-item list-group-item-danger" style="font-weight: bold;"><span class="badge">'+total_p.toFixed(2)+'</span>DESAPROBADO</li>';

          html += '</ul>';

      html += '</div>';
      html += '<div id="" class="panel-footer text-right btn-primary"><button type="button" id="btncerrar_examen" onClick="cerrarResultExamen();" class="btn btn-default btn-sigue-pregu">Cerrar</button></div>'+
            '</div>';
    $("#resultado_final").html(html)
    $("#ResultFinalEvaluacion").slideDown('slow');
};


verSiguientePregunta=function(id){
  if(!$(".radio input[name='rbalternativas"+id+"']").is(':checked'))
  {
    swal("Validación!", "Favor de seleccionar una opción!", "warning");
    return false;
  }
  else
  {
    if(CantevalG == (ceval + 1)) // Última pregunta seleccionado
    {
      data_alter_preg.push({
                        "evaluacion_id" : evaluacionG_id,
                        "pregunta_id" : id,
                        "respuesta_id" : $('input:radio[name=rbalternativas'+id+']:checked').val()
                    });
      data_alter_preg = data_alter_preg;

      $('#body-preguntas').html('<p class="bg-info text-center" style="font-size: 20px;">Gracias por completar su evaluación. <br/> '+
                                  '<input type= "hidden" name="txt_programacion_id" id="txt_programacion_id" class="form-control mant" value="">'+
                                  '<button type="button" id="btnprocesar_eval" onClick="guardarEvaluacion();" class="btn btn-primary btn-sigue-pregu">Procesar Examen</button>'+
                                  '</p>')
      $('.list-group').hide('slow').html('');
      $('#footer-preguntas').hide().html('');
    }
    else
    {
      /*
        var datAlternativo = new Object();
        datAlternativo.pregunta_id = pregunta_id;
        datAlternativo.respuesta_id = respuesta_id;
        data_alter_preg = JSON.stringify(datAlternativo);
      */
      data_alter_preg.push({
                        "evaluacion_id" : evaluacionG_id,
                        "pregunta_id" : id,
                        "respuesta_id" : $('input:radio[name=rbalternativas'+id+']:checked').val()
                    });
      data_alter_preg = data_alter_preg;

      ceval = ceval + 1; //Suma contador Global de Evaluacion
      //AjaxTipoEvaluacion.CargarPreguntas(HTMLiniciarEvaluacion);
      verContenidoIniciarEvaluacion();
    }
  }
}


cerrarResultExamen=function(){
  $("#resultado_final").html('')
  $("#ResultFinalEvaluacion").hide();

  //AjaxEvaluacion.Cargar(HTMLCargarEvaluacion);
  AjaxTipoEvaluacion.Cargar(HTMLCargarTipoEvaluacion);

  $("#TipoEvaluacionForm").slideDown('fast');
  $("#EvaluacionForm").slideDown('fast');

  $("#resultado").html('')
  $("#ResultEvaluacion").hide();
}

guardarEvaluacion=function(){
  //alert(JSON.stringify(data_alter_preg));
  AjaxTipoEvaluacion.GuardarEvaluacion(HTMLAgregarEvaluacion);
}

HTMLAgregarEvaluacion=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);

        //AjaxEvaluacion.Cargar(HTMLCargarEvaluacion);
        AjaxTipoEvaluacion.Cargar(HTMLCargarTipoEvaluacion);

        $("#TipoEvaluacionForm").slideDown('fast');
        $("#EvaluacionForm").slideDown('fast');

        $("#resultado").html('')
        $("#ResultEvaluacion").hide();
    }
    else{
        msjG.mensaje('warning',result.msj,3000);
    }
}
/*
Reloj();
function Reloj()
{
  var tiempo = new Date();
  var hora = tiempo.getHours();
  var minuto = tiempo.getMinutes();
  var segundo = tiempo.getSeconds();
  //alert(str_hora+' '+str_minuto+' '+str_segundo);
  $('#hora').text('dsdsdsdsd'); // hora+':'+minuto+':'+segundo
}
*/
</script>
