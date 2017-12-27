<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var TipoEvaluacionG={id:0, dni:"", alumno:"", curso:"", fecha_inicio:"", fecha_final:"", docente:"", estado:1}; // estado:1
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
    $.each(result.data.data,function(index,r){
        //estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        /*if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }*/

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='curso'>"+
            "<a target='_blank' href='img/course/"+r.foto+"'>"+
            "<img src='img/course/"+r.foto+"' style='height: 40px;width: 40px;'>"+
            "&nbsp</a>"+r.curso+"</td>"+
            "<td class='docente'>"+r.docente+"</td>"+
            "<td class='fecha_inicio'>"+r.fecha_inicio+"</td>"+
            "<td class='fecha_final'>"+r.fecha_final+"</td>"+
            "<td>";
        //html +='<a class="btn btn-primary btn-sm" onClick="CargarContenido('+r.pu_id+','+r.curso_id+',\''+r.curso+'\')"><i class="fa fa-plus fa-lg"></i> </a></td>';
        html +='<a class="btn btn-primary btn-sm" onClick="CargarEvaluaciones('+r.id+','+r.pu_id+','+r.curso_id+',\''+r.curso+'\',this)"><i class="fa fa-plus fa-lg"></i> </a></td>';
        html+="</tr>"
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


CargarEvaluaciones=function(id, programacion_unica_id, curso_id,curso, boton){
    masterG.pintar_fila(boton); //Pinta la fila
    //alert(id+'- '+ programacion_unica_id+'- '+ curso_id+'- '+ curso+'- '+ boton);

     $("#EvaluacionForm #txt_programacion_id").val(id);
     $("#EvaluacionForm #txt_programacion_unica_id").val(programacion_unica_id);
     $("#EvaluacionForm #txt_curso").val(curso);

     AjaxTipoEvaluacion.Cargar(HTMLCargarTipoEvaluacion);
     //AjaxContenido.Cargar(HTMLCargarContenido);

     $("#EvaluacionForm").css("display","");
     //$("#ContenidoProgramacionForm").css("display","none");
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

                html+='<button type="button" id="btniniciareval" name="btniniciareval" class="btn btn-default" onClick="iniciarEvaluacion('+r.id+','+programacion_id+','+programacion_unica_id+',\''+r.tipo_evaluacion+'\',\''+curso+'\')" style="font-weight: bold;">Iniciar Evaluación</button>';

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

  $("#ResultEvaluacion #txt_tipo_evaluacion_id").val(id);
  $("#ResultEvaluacion #txt_programacion_id").val(programacion_id);
  $("#ResultEvaluacion #txt_programacion_unica_id").val(programacion_unica_id);

  // Aqui va AJAX
  AjaxTipoEvaluacion.CargarPreguntas(HTMLiniciarEvaluacion); // HTMLiniciarEvaluacion = HTMLiniciarEvaluacion=function(result){}
  // --
};

HTMLiniciarEvaluacion=function(result){

  var html = '';
      html += '<div class="panel panel-primary">'+
              '<div class="panel-heading text-center">'+
                  '<h4>'+' - '+'<small style="color: #FFF;"> - 11:30:00</small><h4>'+
              '</div>'+
              '<div class="panel-body" style="font-weight: normal;">'+
                  'Por favor complete las siguientes preguntas: '+
              '</div>';
      
      $.each(result.data,function(index, r){
        html += '<ul class="list-group">'+
                  '<p style="padding: 10px 15px;">'+r.pregunta+' </p>';

          var alternativas = r.alternativas.split("|");
          $.each(alternativas, function(index, a){
              var data = a.split(":");
              html += '<button type="button" class="list-group-item"><span class="badge" style="background-color: #FFF; padding: 0px 0px;"><div class="radio"><label><input type="radio" name="rbpreguntas" id="rbp1" value="V" aria-label="..."></label></div></span>'+data[1]+'</button>';
          });
        html += '</ul>';          
      });

      html += '<div class="panel-footer text-right"><button type="button" class="btn btn-primary">Siguiente</button></div>'+
            '</div>';

  $("#resultado").html(html)
  $("#ResultEvaluacion").slideDown('slow');

};

</script>
