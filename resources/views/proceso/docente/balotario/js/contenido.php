<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var ContenidoG={id:0,curso_id:0,contenido:'',referencia:'',ruta_contenido:'',file_archivo:'',tipo_respuesta:0,fecha_inicio:'',
fecha_final:'',fecha_ampliada:'',estado:1}; // Datos Globales
$(document).ready(function() {
     $("#TableContenido").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });

    $(".fecha").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: true,
        time:true,
        minView:2,
        autoclose: true,
        todayBtn: false
    });

    $('#ModalContenido').on('shown.bs.modal', function (event) {
        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax3();');
        }
        else{

            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax3();');
            $("#ModalContenidoForm").append("<input type='hidden' value='"+ContenidoG.id+"' name='id'>");
        }

        $('#ModalContenidoForm #txt_contenido').val( ContenidoG.contenido );
        $('#ModalContenidoForm #txt_file_nombre').val( ContenidoG.ruta_contenido );
        $('#ModalContenidoForm #txt_file_archivo').val( ContenidoG.file_archivo );
        $('#ModalContenidoForm #slct_tipo_respuesta').selectpicker('val', ContenidoG.tipo_respuesta );
        $('#ModalContenidoForm #txt_fecha_inicio').val( ContenidoG.fecha_inicio );
        $('#ModalContenidoForm #txt_fecha_final').val( ContenidoG.fecha_final );
        $('#ModalContenidoForm #txt_fecha_ampliada').val( ContenidoG.fecha_ampliada );
        $('#ModalContenidoForm #slct_estado').selectpicker( 'val',ContenidoG.estado );
        ReferenciaHTML(ContenidoG.referencia);
    });

    $('#ModalContenido').on('hidden.bs.modal', function (event) {
        $("#ModalContenidoForm input[type='hidden']").not('.mant').remove();
        $('#ModalContenidoForm input[id="txt_referencia"]').not('.mant').remove();
    });

    $( "#ModalContenidoForm #slct_tipo_respuesta" ).change(function() {
        if( $('#ModalContenidoForm #slct_tipo_respuesta').val()=='1' ) {
            $( "#ModalContenidoForm #respuesta" ).css("display","");
        }else{
            $( "#ModalContenidoForm #respuesta" ).css("display","none");
        }

    });
});

ValidaForm3=function(){
    var r=true;

    if( $.trim( $("#ModalContenidoForm #txt_contenido").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Contenido',4000);
    }
     else if( $.trim( $("#ModalContenidoForm #txt_file_nombre").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Archivo',4000);
    }
    else if( $.trim( $("#ModalContenidoForm #slct_tipo_respuesta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Tipo de Contenido',4000);
    }
    else if( $.trim( $("#ModalContenidoForm #txt_fecha_inicio").val() )=='' && $.trim( $("#ModalContenidoForm #slct_tipo_respuesta").val() )=='1'){
        r=false;
        msjG.mensaje('warning','Ingrese Fecha Inicio',4000);
    }
    else if( $.trim( $("#ModalContenidoForm #txt_fecha_final").val() )=='' && $.trim( $("#ModalContenidoForm #slct_tipo_respuesta").val() )=='1' ){
        r=false;
        msjG.mensaje('warning','Ingrese Fecha Final',4000);
    }
    else if( $.trim( $("#ModalContenidoForm #txt_fecha_ampliada").val() )=='' && $.trim( $("#ModalContenidoForm #slct_tipo_respuesta").val() )=='1'){
        r=false;
        msjG.mensaje('warning','Ingrese Fecha Ampliada',4000);
    }
    return r;
}

AgregarEditar3=function(val,id){
    AddEdit=val;
    ContenidoG.id='';
    ContenidoG.contenido='';
    ContenidoG.ruta_contenido='';
    ContenidoG.file_archivo='';
    ContenidoG.tipo_respuesta='';
    ContenidoG.fecha_inicio='';
    ContenidoG.fecha_final='';
    ContenidoG.fecha_ampliada='';
    ContenidoG.referencia='';
    ContenidoG.estado='1';
    $('#respuesta').css("display","none");
    if( val==0 ){

        ContenidoG.id=id;
        ContenidoG.contenido=$("#DivContenido #trid_"+id+" .contenido").text();
        ContenidoG.ruta_contenido=$("#DivContenido #trid_"+id+" .ruta_contenido").val();
        ContenidoG.tipo_respuesta=$("#DivContenido #trid_"+id+" .tipo_respuesta").val();
        ContenidoG.fecha_inicio=$("#DivContenido #trid_"+id+" .fecha_inicio").val();
        ContenidoG.fecha_final=$("#DivContenido #trid_"+id+" .fecha_final").val();
        ContenidoG.fecha_ampliada=$("#DivContenido #trid_"+id+" .fecha_ampliada").val();
        ContenidoG.referencia=$("#DivContenido #trid_"+id+" .referencia").val();
        ContenidoG.estado=$("#DivContenido #trid_"+id+" .estado").val();
        if(ContenidoG.tipo_respuesta=='1'){
                $('#respuesta').css("display","");
        }
    }
    $('#ModalContenido').modal('show');
}

CambiarEstado3=function(estado,id){
    sweetalertG.confirm("¿Estás seguro?", "Confirme la eliminación", function(){
        AjaxContenido.CambiarEstado(HTMLCambiarEstado3,estado,id);
    });
}

HTMLCambiarEstado3=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxContenido.Cargar(HTMLCargarContenido);
    }
}

AgregarEditarAjax3=function(){
    if( ValidaForm3() ){
        AjaxContenido.AgregarEditar(HTMLAgregarEditar3);
    }
}

HTMLAgregarEditar3=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalContenido').modal('hide');
        AjaxContenido.Cargar(HTMLCargarContenido);
    }
    else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarContenido=function(result){
    var html="";
    $.each(result.data,function(index,r){
        nombre=r.ruta_contenido.split('/');
        estadohtml='onClick="CambiarEstado3(1,'+r.id+')"';
        if(r.estado==1){
            estadohtml='onClick="CambiarEstado3(0,'+r.id+')"';
        }
        if(index==0){
            html+='<div class="col-md-12">';
        }
        html+='<div class="col-lg-4" id="trid_'+r.id+'" style="margin-top: 15px; -moz-box-shadow: 0 0 5px #888; -webkit-box-shadow: 0 0 5px#888; box-shadow: 0 0 5px #888;">'+
               '<input type="hidden" class="ruta_contenido" value="'+nombre[1]+'">'+
               '<input type="hidden" class="fecha_inicio" value="'+r.fecha_inicio+'">'+
               '<input type="hidden" class="fecha_final" value="'+r.fecha_final+'">'+
               '<input type="hidden" class="fecha_ampliada" value="'+r.fecha_ampliada+'">'+
               '<input type="hidden" class="tipo_respuesta" value="'+r.tipo_respuesta+'">'+
               '<input type="hidden" class="referencia" value="'+r.referencia+'">'+
               '<input type="hidden" class="estado" value="'+r.estado+'">'+
               '<div class="row">'+
                    '<div class="col-md-12">'+
                            '<div class="text-justify" style="margin-bottom: 15px; margin-top:10px; font-size: 15px; padding: 5px 5px; background-color: #F5F5F5; border-radius: 10px; border: 3px solid #F8F8F8;">'+
                                '<p>'+r.curso+'</p>'+
                                //'<small>Curso: '+r.curso+'</small>'+
                            '</div>'+
                        '</div>'+
                    '<div class="col-md-5 text-center" style="border-right: 2px solid #e9e9e9;">'+
                            '<a href="file/content/'+r.ruta_contenido+'" target="blank"><img class="img-responsive" src="img/course/'+r.foto+'" alt="" width="100%" height="" style="margin:10px auto;height: 150px;min-width: 150px;"></a>'+
                        '</div>'+
                    '<div class="col-md-7" style="border-left: 2px solid #e9e9e9;">'+
                        '<div class="text-justify" style="margin-bottom: 15px; margin-top:10px; font-size: 15px; padding: 5px 5px; background-color: #F5F5F5; border-radius: 10px; border: 3px solid #F8F8F8;">'+
                            '<p class="contenido">'+r.contenido+'</p>'+
                        '</div>';

                if(r.tipo_respuesta == 1){
                 html+='<div>'+
                            '<p style="font-weight: normal;">'+
                                '<label style="font-weight: bold;">Fecha Ini. : </label> '+r.fecha_inicio+'</br>'+
                                '<label style="font-weight: bold;">Fecha Fin. : </label> '+r.fecha_final+'</br>'+
                                '<label style="font-weight: bold;">Fecha Amp. : </label> '+ r.fecha_ampliada +
                            '</p>'+
                        '</div>';
                }else{
                  html+='<div style="height: 85px;"></div>';
                }

                html+='</div>'+
                '</div>';

                if(r.referencia)
                {
                  var res_uri = r.referencia.split("|");
                  html+='<div class="row">'+
                            '<div class="col-md-12 btn-default" style="font-weight: normal; padding-right: 5px; padding-left: 5px; margin-top: 5px; overflow:hidden;">'+
                                '';
                                for (i = 0; i < res_uri.length; i++) {
                                  html+='<span class="fa fa-book fa-lg"></span> <a href="http://'+res_uri[i]+'" target="blank">'+ res_uri[i] +'</a><br/>';
                                }
                      html+='</div>'+
                        '</div>';
                }

                html+='<div class="row">'+
                              '<div class="col-md-3" style="padding-right: 0px; padding-left: 5px; margin-top: 5px; overflow:hidden;">'+
                                '<button type="button" '+estadohtml+' class="col-xs-12 btn btn-danger"  data-placement="top" title="Eliminar"><span class="fa fa-trash fa-lg"></span> Eliminar</button>'+
                              '</div>'+
                              '<div class="col-md-3" style="padding-right: 0px; padding-left: 5px; margin-top: 5px; overflow:hidden;">'+
                                '<button type="button" onClick="AgregarEditar3(0,'+r.id+')" style="" class="col-xs-12 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><span class="fa fa-edit fa-lg"></span> Editar</button>'+
                              '</div>'+
                              '<div class="col-md-3" style="padding-right: 0px; padding-left: 5px; margin-top: 5px; overflow:hidden;">';
                      if(r.tipo_respuesta!=0){
                                html+='<button type="button" onClick="CargarContenidoProgramacion('+r.id+','+r.programacion_unica_id+')" style="" class="col-xs-12 btn btn-info" data-toggle="tooltip" data-placement="top" title="Ampliación de Respuesta"><span class="fa fa-list fa-lg"></span>Ampl.</button>';
                      }
                                html+='</div>'+
                                      '<div class="col-md-3" style="padding-right: 0px; padding-left: 5px; margin-top: 5px; overflow:hidden;">';
                       if(r.tipo_respuesta!=0){
                                html+='<button type="button" onClick="CargarContenidoRespuesta('+r.id+')" class="col-xs-12 btn btn-info" data-toggle="tooltip" data-placement="top" title="Respuesta de Contenido"><span class="fa fa-list fa-lg"></span>Resp.</button>';
                            }
                              html+='</div>'+
                '</div>'+
            '</div>';
        if((index+1)%3==0){
            html+='</div>';
            html+='<div class="col-md-12">';
        }
    });
    if(result.data.length>0){
        html+='</div>';
    }
    $("#DivContenido").html(html);
};

CargarSlct=function(slct){
    if(slct==1){
    AjaxContenido.CargarCurso(SlctCargarCurso);
    }
};
SlctCargarCurso=function(result){
    var html="<option value='0'>.::Seleccione::.</option>";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.curso+"</option>";
    });
    $("#ModalContenidoForm #slct_curso_id").html(html);
    $("#ModalContenidoForm #slct_curso_id").selectpicker('refresh');

};
CargarContenidoProgramacion=function(id,programacion_unica_id){
     $("#ContenidoProgramacionForm #txt_contenido_id").val(id);
     $("#ModalContenidoProgramacionForm #txt_contenido_id").val(id);
     $("#ModalContenidoProgramacionForm #btn_listarpersona").data( 'filtros', 'estado:1|programacion_unica_id:'+programacion_unica_id );
     AjaxContenidoProgramacion.Cargar(HTMLCargarContenidoProgramacion);
     $("#ContenidoProgramacionForm").css("display","");
     $("#ContenidoRespuestaForm").css("display","none");

};
CargarContenidoRespuesta=function(id){
     $("#ContenidoRespuestaForm #txt_contenido_id").val(id);
     AjaxContenidoRespuesta.Cargar(HTMLCargarContenidoRespuesta);
     $("#ContenidoRespuestaForm").css("display","");
     $("#ContenidoProgramacionForm").css("display","none");

};
onImagen = function (event) {
        var files = event.target.files || event.dataTransfer.files;
        if (!files.length)
            return;
        var image = new Image();
        var reader = new FileReader();
        reader.onload = (e) => {
            $('#ModalContenidoForm #txt_file_archivo').val(e.target.result);
            $('#ModalContenidoForm .img-circle').attr('src',e.target.result);
        };
        reader.readAsDataURL(files[0]);
        $('#ModalContenidoForm #txt_file_nombre').val(files[0].name);
        console.log(files[0].name);
};
AgregarReferencia= function(){
  var html='';
        html+='<div class="col-md-12"><div class="col-md-11"><div class="form-group">'+
             '<input type="text"  class="form-control" id="txt_referencia" name="txt_referencia[]">';
        html+="</div></div>";
        html+='<div class="col-md-1"><div class="form-group">'+
              '<button type="button" onclick="EliminarReferencia(this)" class="btn btn-danger btn-sm"><i class="fa fa-minus fa-sm"></i> </button>';
        html+="</div></div></div>";
  $("#referencia").append(html);

};
ReferenciaHTML=function(referencias){
    var html="";
    if(referencias.length>0){
        var referencia=referencias.split('|');
        for (i = 0; i < referencia.length; i++) {
            html+='<div class="col-md-12"><div class="col-md-11"><div class="form-group">'+
                  '<input type="text"  class="form-control" id="txt_referencia" name="txt_referencia[]" value="'+referencia[i]+'">';
            html+="</div></div>";
            html+='<div class="col-md-1"><div class="form-group">'+
                  '<button type="button" onclick="EliminarReferencia(this)" class="btn btn-danger btn-sm"><i class="fa fa-minus fa-sm"></i> </button>';
            html+="</div></div></div>";
        };
    }

    $("#referencia").html(html);
};

EliminarReferencia=function(boton){
        var tr = boton.parentNode.parentNode.parentNode;
        $(tr).remove();
};
</script>