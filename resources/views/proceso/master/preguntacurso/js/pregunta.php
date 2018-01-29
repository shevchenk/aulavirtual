<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var PreguntaG={id:0,pregunta:"",puntaje:0,curso_id:0,imagen_archivo:'',imagen_nombre:'',unidad_contenido_id:0,estado:1}; // Pregunta Globales
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
        $('#ModalPreguntaForm #slct_unidad_contenido_id').selectpicker('val', PreguntaG.unidad_contenido_id );
        $('#ModalPreguntaForm #slct_estado').selectpicker( 'val',PreguntaG.estado );
        if(PreguntaG.imagen_nombre!='null'){
            $('#ModalPreguntaForm #txt_imagen_nombre').val(PreguntaG.imagen_nombre);
            $('#ModalPreguntaForm .img-circle').attr('src',PreguntaG.imagen_archivo);
        }else{
            $('#ModalPreguntaForm #txt_imagen_nombre').val('');
            $('#ModalPreguntaForm .img-circle').attr('src','notting');
        }
        $('#ModalPreguntaForm #txt_imagen_archivo').val('');
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
    else if( $.trim( $("#ModalPreguntaForm #slct_unidad_contenido_id").val() )=='0' ){
        r=false;
        msjG.mensaje('warning','Seleccione Unidad de Contenido',4000);
    }
    else if( $.trim( $("#ModalPreguntaForm #txt_pregunta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Pregunta',4000);
    }
//    else if( $.trim( $("#ModalPreguntaForm #txt_puntaje").val() )=='' ){
//        r=false;
//        msjG.mensaje('warning','Ingrese Puntaje',4000);
//    }
    return r;
}

AgregarEditar2=function(val,id){
    AddEdit=val;
    PreguntaG.id='';
    PreguntaG.pregunta='';
    PreguntaG.puntaje='';
    PreguntaG.curso_id='0';
    PreguntaG.unidad_contenido_id='0';
    PreguntaG.estado='1';
    PreguntaG.imagen_archivo='';
    PreguntaG.imagen_nombre='';
    if( val==0 ){
        PreguntaG.id=id;
        PreguntaG.pregunta=$("#TablePregunta #trid_"+id+" .pregunta").text();
        PreguntaG.puntaje=$("#TablePregunta #trid_"+id+" .puntaje").text();
        PreguntaG.curso_id=$("#TablePregunta #trid_"+id+" .curso_id").val();
        PreguntaG.unidad_contenido_id=$("#TablePregunta #trid_"+id+" .unidad_contenido_id").val();
        PreguntaG.estado=$("#TablePregunta #trid_"+id+" .estado").val();
        PreguntaG.imagen=$("#TablePregunta #trid_"+id+" .imagen").val();
        if(PreguntaG.imagen!=null){
            PreguntaG.imagen_archivo='img/question/'+PreguntaG.imagen;
            PreguntaG.imagen_nombre=PreguntaG.imagen;
        }else {
            PreguntaG.imagen_archivo='';
            PreguntaG.imagen_nombre='';
        }   
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
            "<td class='unidad_contenido'>"+r.unidad_contenido+"</td>"+
            "<td class='pregunta'>";
            if(r.imagen!=null){
                html+="<img src='img/question/"+r.imagen+"' style='height: 40px;width: 40px;'>&nbsp;"; 
            }
        html+=r.pregunta+"</td>"+
//            "<td class='puntaje'>"+r.puntaje+"</td>"+
            "<td>"+
            "<input type='hidden' class='curso_id' value='"+r.curso_id+"'>"+
            "<input type='hidden' class='imagen' value='"+r.imagen+"'>"+
            "<input type='hidden' class='unidad_contenido_id' value='"+r.unidad_contenido_id+"'>";
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
SlctCargarUnidadContenido=function(result){
    var html="<option value='0'>.::Seleccione::.</option>";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.unidad_contenido+"</option>";
    });
    $("#ModalPregunta #slct_unidad_contenido_id").html(html);
    $("#ModalPregunta #slct_unidad_contenido_id").selectpicker('refresh');

};
CargarSlct=function(slct){
    if(slct==3){
    AjaxPregunta.CargarUnidadContenido(SlctCargarUnidadContenido);
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
onImagenPregunta = function (event) {
        var files = event.target.files || event.dataTransfer.files;
        if (!files.length)
            return;
        var image = new Image();
        var reader = new FileReader();
        reader.onload = (e) => {
            $('#ModalPreguntaForm #txt_imagen_archivo').val(e.target.result);
            $('#ModalPreguntaForm .img-circle').attr('src',e.target.result);
        };
        reader.readAsDataURL(files[0]);
        $('#ModalPreguntaForm #txt_imagen_nombre').val(files[0].name);
//        console.log(files[0].name);
};
</script>
