<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var PreguntaG={id:0,pregunta:"",puntaje:0,curso_id:0,tipo_evaluacion_id:0,estado:1}; // Pregunta Globales
$(document).ready(function() {

    $("#TablePregunta").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });
    
    $("#PreguntaForm #TablePregunta select").change(function(){ AjaxPregunta.Cargar(HTMLCargarPregunta); });
    $("#PreguntaForm #TablePregunta input").blur(function(){ AjaxPregunta.Cargar(HTMLCargarPregunta); });

    $('#ModalPregunta').on('shown.bs.modal', function (event) {

        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax2();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax2();');
            $("#ModalPreguntaForm").append("<input type='hidden' value='"+PreguntaG.id+"' name='id'>");
        }
        $('#ModalPreguntaForm #txt_pregunta').val( PreguntaG.pregunta );
        $('#ModalPreguntaForm #txt_puntaje').val( PreguntaG.puntaje );
        $('#ModalPreguntaForm #slct_curso_id').selectpicker('val', PreguntaG.curso_id );
        $('#ModalPreguntaForm #slct_tipo_evaluacion_id').selectpicker('val', PreguntaG.tipo_evaluacion_id );
        $('#ModalPreguntaForm #slct_estado').selectpicker( 'val',PreguntaG.estado );
        $('#ModalPreguntaForm #txt_pregunta').focus();
    });

    $('#ModalPregunta').on('hidden.bs.modal', function (event) {
        $("#ModalPreguntaForm input[type='hidden']").not('.mant').remove();
    });

});

ValidaForm2=function(){
    var r=true;
    if( $.trim( $("#ModalPreguntaForm #slct_curso_id").val() )=='0' ){
        r=false;
        msjG.mensaje('warning','Seleccione Curso',4000);
    }
    else if( $.trim( $("#ModalPreguntaForm #slct_tipo_evaluacion_id").val() )=='0' ){
        r=false;
        msjG.mensaje('warning','Seleccione Tipo Evaluación',4000);
    }
    else if( $.trim( $("#ModalPreguntaForm #txt_pregunta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Pregunta',4000);
    }
    else if( $.trim( $("#ModalPreguntaForm #txt_puntaje").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Puntaje',4000);
    }
    return r;
}

AgregarEditar2=function(val,id){
    AddEdit=val;
    PreguntaG.id='';
    PreguntaG.pregunta='';
    PreguntaG.puntaje='';
    PreguntaG.curso_id='0';
    PreguntaG.tipo_evaluacion_id='0';
    PreguntaG.estado='1';
    if( val==0 ){
        PreguntaG.id=id;
        PreguntaG.pregunta=$("#TablePregunta #trid_"+id+" .pregunta").text();
        PreguntaG.puntaje=$("#TablePregunta #trid_"+id+" .puntaje").text();
        PreguntaG.curso_id=$("#TablePregunta #trid_"+id+" .curso_id").val();
        PreguntaG.tipo_evaluacion_id=$("#TablePregunta #trid_"+id+" .tipo_evaluacion_id").val();
        PreguntaG.estado=$("#TablePregunta #trid_"+id+" .estado").val();
    }
    $('#ModalPregunta').modal('show');
}

CambiarEstado2=function(estado,id){
       AjaxPregunta.CambiarEstado(HTMLCambiarEstado2,estado,id);
}

HTMLCambiarEstado2=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxPregunta.Cargar(HTMLCargarPregunta);
    }
}

AgregarEditarAjax2=function(){
    if( ValidaForm2() ){
        AjaxPregunta.AgregarEditar(HTMLAgregarEditar2);
    }
}

HTMLAgregarEditar2=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalPregunta').modal('hide');
        AjaxPregunta.Cargar(HTMLCargarPregunta);
    }
    else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarPregunta=function(result){
    var html="";
    $('#TablePregunta').DataTable().destroy();

    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado2(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado2(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+='<tr id="trid_'+r.id+'" onClick="CargarRespuesta('+r.id+',\''+r.pregunta+'\','+r.puntaje+',this)">'+
            "<td class='curso'>"+r.curso+"</td>"+
            "<td class='tipo_evaluacion'>"+r.tipo_evaluacion+"</td>"+
            "<td class='pregunta'>"+r.pregunta+"</td>"+
            "<td class='puntaje'>"+r.puntaje+"</td>"+
            "<td>"+
            "<input type='hidden' class='curso_id' value='"+r.curso_id+"'>"+
            "<input type='hidden' class='tipo_evaluacion_id' value='"+r.tipo_evaluacion_id+"'>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar2(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
  //      html+='<td><a class="btn btn-info btn-sm" onClick="CargarRespuesta('+r.id+',\''+r.pregunta+'\','+r.puntaje+',this)"><i class="fa fa-th-list fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TablePregunta tbody").html(html); 
    $("#TablePregunta").DataTable({
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
            $('#TablePregunta_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarPregunta','AjaxPregunta',result.data,'#TablePregunta_paginate');
        }
        
    });
};
SlctCargarTipoEvaluacion=function(result){
    var html="<option value='0'>.::Seleccione::.</option>";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.tipo_evaluacion+"</option>";
    });
    $("#ModalPregunta #slct_tipo_evaluacion_id").html(html);
    $("#ModalPregunta #slct_tipo_evaluacion_id").selectpicker('refresh');

};
CargarSlct=function(slct){
    if(slct==3){
    AjaxPregunta.CargarTipoEvaluacion(SlctCargarTipoEvaluacion);
    }
};
CargarRespuesta=function(id,pregunta,puntaje,boton){   
     masterG.pintar_fila(boton);
     $("#RespuestaForm #txt_pregunta_id").val(id);
     $("#ModalRespuestaForm #txt_pregunta_id").val(id);
     $("#ModalRespuestaForm #txt_pregunta").val(pregunta);
     $("#ModalRespuestaForm #txt_puntaje_max").val(puntaje);
     AjaxRespuesta.Cargar(HTMLCargarRespuesta);
     $("#RespuestaForm").css("display","");
     
};
</script>
