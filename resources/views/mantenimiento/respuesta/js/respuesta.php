<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var RespuestaG={id:0,respuesta:"",puntaje:0,pregunta_id:0,ipo_respuesta_id:0,estado:1}; // Datos Globales
$(document).ready(function() {

    $("#TableRespuesta").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });
    
//    $('#ModalRespuesta').css('z-index', 1050);
//    $('#ModalListadocente').css('z-index', 1050);
//    $('#ModalDocente').css('z-index', 1060);
//    $('#ModalListapersona').css('z-index', 1070);
//    $('#ModalPersona').css('z-index', 1080);
//    
    CargarSlct(1);CargarSlct(3);
    AjaxRespuesta.Cargar(HTMLCargarRespuesta);
    
    $("#RespuestaForm #TableRespuesta select").change(function(){ AjaxRespuesta.Cargar(HTMLCargarRespuesta); });
    $("#RespuestaForm #TableRespuesta input").blur(function(){ AjaxRespuesta.Cargar(HTMLCargarRespuesta); });
    
    $('#ModalRespuesta').on('shown.bs.modal', function (event) {

        if( AddEdit==1 ){        
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalRespuestaForm").append("<input type='hidden' value='"+RespuestaG.id+"' name='id'>");
        }
        $('#ModalRespuestaForm #txt_respuesta').val( RespuestaG.respuesta );
        $('#ModalRespuestaForm #txt_puntaje').val( RespuestaG.puntaje );
        $('#ModalRespuestaForm #slct_pregunta_id').selectpicker('val', RespuestaG.pregunta_id );
        $('#ModalRespuestaForm #slct_tipo_respuesta_id').selectpicker('val', RespuestaG.tipo_respuesta_id );
        $('#ModalRespuestaForm #slct_estado').selectpicker( 'val',RespuestaG.estado );
        $('#ModalRespuestaForm #txt_respuesta').focus();
    });

    $('#ModalRespuesta').on('hidden.bs.modal', function (event) {
        $("#ModalRespuestaForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaForm=function(){
    var r=true;
    if( $.trim( $("#ModalRespuestaForm #slct_pregunta_id").val() )=='0' ){
        r=false;
        msjG.mensaje('warning','Seleccione Pregunta',4000);
    }
    else if( $.trim( $("#ModalRespuestaForm #slct_tipo_respuesta_id").val() )=='0' ){
        r=false;
        msjG.mensaje('warning','Seleccione Tipo de Respuesta',4000);
    }
    else if( $.trim( $("#ModalRespuestaForm #txt_respuesta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Respuesta',4000);
    }
    else if( $.trim( $("#ModalRespuestaForm #txt_puntaje").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Puntaje',4000);
    }
    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    RespuestaG.id='';
    RespuestaG.respuesta='';
    RespuestaG.puntaje='';
    RespuestaG.pregunta_id='0';
    RespuestaG.tipo_respuesta_id='0';
    RespuestaG.estado='1';
    if( val==0 ){
        RespuestaG.id=id;
        RespuestaG.respuesta=$("#TableRespuesta #trid_"+id+" .respuesta").text();
        RespuestaG.puntaje=$("#TableRespuesta #trid_"+id+" .puntaje").text();
        RespuestaG.pregunta_id=$("#TableRespuesta #trid_"+id+" .pregunta_id").val();
        RespuestaG.tipo_respuesta_id=$("#TableRespuesta #trid_"+id+" .tipo_respuesta_id").val();
        RespuestaG.estado=$("#TableRespuesta #trid_"+id+" .estado").val();
    }
    $('#ModalRespuesta').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxRespuesta.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxRespuesta.Cargar(HTMLCargarRespuesta);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxRespuesta.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalRespuesta').modal('hide');
        AjaxRespuesta.Cargar(HTMLCargarRespuesta);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarRespuesta=function(result){
    var html="";
    $('#TableRespuesta').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='pregunta'>"+r.pregunta+"</td>"+
            "<td class='tipo_respuesta'>"+r.tipo_respuesta+"</td>"+
            "<td class='respuesta'>"+r.respuesta+"</td>"+
            "<td class='puntaje'>"+r.puntaje+"</td>"+
            "<td>"+
            "<input type='hidden' class='pregunta_id' value='"+r.pregunta_id+"'>"+
            "<input type='hidden' class='tipo_respuesta_id' value='"+r.tipo_respuesta_id+"'>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableRespuesta tbody").html(html); 
    $("#TableRespuesta").DataTable({
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
            $('#TableRespuesta_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarRespuesta','AjaxRespuesta',result.data,'#TableRespuesta_paginate');
        }
    });

};

CargarSlct=function(slct){
    if(slct==1){
    AjaxRespuesta.CargarPregunta(SlctCargarPregunta);
    }
    if(slct==3){
    AjaxRespuesta.CargarTipoRespuesta(SlctCargarTipoRespuesta);
    }
}

SlctCargarPregunta=function(result){
    var html="<option value='0'>.::Seleccione::.</option>";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.pregunta+"</option>";
    });
    $("#ModalRespuesta #slct_pregunta_id").html(html); 
    $("#ModalRespuesta #slct_pregunta_id").selectpicker('refresh');

};

SlctCargarTipoRespuesta=function(result){
    var html="<option value='0'>.::Seleccione::.</option>";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.tipo_respuesta+"</option>";
    });
    $("#ModalRespuesta #slct_tipo_respuesta_id").html(html); 
    $("#ModalRespuesta #slct_tipo_respuesta_id").selectpicker('refresh');

};
</script>
