<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var ContenidoG={id:0,curso_id:0,unidad_contenido_id:0,titulo_contenido:"",contenido:'',referencia:''
,ruta_contenido:'',file_archivo:'',imagen_nombre:'',imagen_archivo:'',tipo_respuesta:0,fecha_inicio:'',
fecha_final:'',hora_inicio:'',hora_final:'',fecha_ampliada:'',fecha_inicio_d:'',
fecha_final_d:'',fecha_ampliada_d:'',estado:1}; // Datos Globales
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
    
    $(".hora").datetimepicker({
        format: "hh:ii:00",
        language: 'es',
        showMeridian: true,
        time:true,
        startView:1,
        minView:0,
        maxView:1,
        pickDate: true,
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
        $('#ModalContenidoForm #slct_unidad_contenido_id').selectpicker( 'val',ContenidoG.unidad_contenido_id );
        $('#ModalContenidoForm #txt_titulo_contenido').val( ContenidoG.titulo_contenido );
        $('#ModalContenidoForm #txt_file_nombre').val( ContenidoG.ruta_contenido );
        $('#ModalContenidoForm #txt_file_archivo').val( ContenidoG.file_archivo );
        $('#ModalContenidoForm #txt_imagen_nombre').val( ContenidoG.imagen_nombre );
        $('#ModalContenidoForm #txt_imagen_archivo').val( ContenidoG.imagen_archivo );
        $('#ModalContenidoForm #slct_tipo_respuesta').selectpicker('val', ContenidoG.tipo_respuesta );
        $('#ModalContenidoForm #txt_fecha_inicio').val( ContenidoG.fecha_inicio );
        $('#ModalContenidoForm #txt_fecha_final').val( ContenidoG.fecha_final );
        $('#ModalContenidoForm #txt_hora_inicio').val( ContenidoG.hora_inicio );
        $('#ModalContenidoForm #txt_hora_final').val( ContenidoG.hora_final );
        $('#ModalContenidoForm #txt_fecha_ampliada').val( ContenidoG.fecha_ampliada );
        $('#ModalContenidoForm #txt_fecha_inicio_d').val( ContenidoG.fecha_inicio_d );
        $('#ModalContenidoForm #txt_fecha_final_d').val( ContenidoG.fecha_final_d );
        $('#ModalContenidoForm #txt_fecha_ampliada_d').val( ContenidoG.fecha_ampliada_d );
        $('#ModalContenidoForm #slct_estado').selectpicker( 'val',ContenidoG.estado );
        ReferenciaHTML(ContenidoG.referencia);
    });

    $('#ModalContenido').on('hidden.bs.modal', function (event) {
        $("#ModalContenidoForm input[type='hidden']").not('.mant').remove();
        $('#ModalContenidoForm input[id="txt_referencia"]').not('.mant').remove();
    });

    $( "#ModalContenidoForm #slct_tipo_respuesta" ).change(function() {
        if( $('#ModalContenidoForm #slct_tipo_respuesta').val()=='1' ) {
            $( "#ModalContenidoForm #respuesta,#ModalContenidoForm #tarea" ).css("display","");
            $( "#ModalContenidoForm #video" ).css("display","none");
            $( "#ModalContenidoForm #respuesta .anotacion" ).html("Fecha de entrega de tareas");
        }else if( $('#ModalContenidoForm #slct_tipo_respuesta').val()=='2' ) {
            $( "#ModalContenidoForm #video,#ModalContenidoForm #respuesta" ).css("display","");
            $( "#ModalContenidoForm #tarea" ).css("display","none");
            $( "#ModalContenidoForm #respuesta .anotacion" ).html("Videoconferencia");
        }else{
            $( "#ModalContenidoForm #video,#ModalContenidoForm #respuesta,#ModalContenidoForm #tarea" ).css("display","none");
        }

    });
});

ValidaForm3=function(){
    var r=true;

    if( $.trim( $("#ModalContenidoForm #slct_unidad_contenido_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Unidad de Contenido',4000);
    }
    else if( $.trim( $("#ModalContenidoForm #txt_titulo_contenido").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Titulo de Contenido',4000);
    }
    else if( $.trim( $("#ModalContenidoForm #txt_contenido").val() )=='' ){
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
    else if( $.trim( $("#ModalContenidoForm #txt_fecha_inicio").val() )=='' && ($.trim( $("#ModalContenidoForm #slct_tipo_respuesta").val() )=='1' || $.trim( $("#ModalContenidoForm #slct_tipo_respuesta").val() )=='2')){
        r=false;
        msjG.mensaje('warning','Ingrese Fecha Inicio',4000);
    }
    else if( $.trim( $("#ModalContenidoForm #txt_hora_inicio").val() )=='' && $.trim( $("#ModalContenidoForm #slct_tipo_respuesta").val() )=='2'){
        r=false;
        msjG.mensaje('warning','Ingrese Hora Inicio',4000);
    }
    else if( $.trim( $("#ModalContenidoForm #txt_fecha_final").val() )=='' && $.trim( $("#ModalContenidoForm #slct_tipo_respuesta").val() )=='1'){
        r=false;
        msjG.mensaje('warning','Ingrese Fecha Final',4000);
    }
    else if( $.trim( $("#ModalContenidoForm #txt_hora_final").val() )=='' && $.trim( $("#ModalContenidoForm #slct_tipo_respuesta").val() )=='2'){
        r=false;
        msjG.mensaje('warning','Ingrese Hora Final',4000);
    }
    return r;
}

AgregarEditar3=function(val,id){
    AddEdit=val;
    ContenidoG.id='';
    ContenidoG.unidad_contenido_id='';
    ContenidoG.titulo_contenido='';
    ContenidoG.contenido='';
    ContenidoG.ruta_contenido='';
    ContenidoG.file_archivo='';
    ContenidoG.imagen_nombre='';
    ContenidoG.imagen_archivo='';
    ContenidoG.tipo_respuesta='';
    ContenidoG.fecha_inicio='';
    ContenidoG.fecha_final='';
    ContenidoG.hora_inicio='';
    ContenidoG.hora_final='';
    ContenidoG.fecha_ampliada='';
    ContenidoG.fecha_inicio_d='';
    ContenidoG.fecha_final_d='';
    ContenidoG.fecha_ampliada_d='';
    ContenidoG.referencia='';
    ContenidoG.estado='1';
    $('#respuesta,#video,#tarea').css("display","none");
    if( val==0 ){

        ContenidoG.id=id;
        ContenidoG.contenido=$("#DivContenido #trid_"+id+" .contenido").text();
        ContenidoG.unidad_contenido_id=$("#DivContenido #trid_"+id+" .unidad_contenido_id").val();
        ContenidoG.titulo_contenido=$("#DivContenido #trid_"+id+" .titulo_contenido").val();
        ContenidoG.ruta_contenido=$("#DivContenido #trid_"+id+" .ruta_contenido").val();
        ContenidoG.imagen_nombre=$("#DivContenido #trid_"+id+" .imagen_nombre").val();
        ContenidoG.tipo_respuesta=$("#DivContenido #trid_"+id+" .tipo_respuesta").val();
        ContenidoG.fecha_inicio=$("#DivContenido #trid_"+id+" .fecha_inicio").val();
        ContenidoG.fecha_final=$("#DivContenido #trid_"+id+" .fecha_final").val();
        ContenidoG.hora_inicio=$("#DivContenido #trid_"+id+" .hora_inicio").val();
        ContenidoG.hora_final=$("#DivContenido #trid_"+id+" .hora_final").val();
        ContenidoG.fecha_ampliada=$("#DivContenido #trid_"+id+" .fecha_ampliada").val();
        ContenidoG.fecha_inicio_d=$("#DivContenido #trid_"+id+" .fecha_inicio_d").val();
        ContenidoG.fecha_final_d=$("#DivContenido #trid_"+id+" .fecha_final_d").val();
        ContenidoG.fecha_ampliada_d=$("#DivContenido #trid_"+id+" .fecha_ampliada_d").val();
        ContenidoG.referencia=$("#DivContenido #trid_"+id+" .referencia").val();
        ContenidoG.estado=$("#DivContenido #trid_"+id+" .estado").val();
        if(ContenidoG.tipo_respuesta=='1'){
                $('#respuesta,#tarea').css("display","");
                $('#video').css("display","none");
                $( "#respuesta .anotacion" ).html("Fecha de entrega de tareas");
        }else if(ContenidoG.tipo_respuesta=='2'){
                $('#tarea').css("display","none");
                $('#video,#respuesta').css("display","");
                $( "#respuesta .anotacion" ).html("Videoconferencia");
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
    var pos=0;
    var aux_uc='';
    $.each(result.data,function(index,r){
        pos++;
        nombre=r.ruta_contenido.split('/');
        foto=r.foto_contenido.split('/');
        estadohtml='onClick="CambiarEstado3(1,'+r.id+')"';
        if(r.estado==1){
            estadohtml='onClick="CambiarEstado3(0,'+r.id+')"';
        }
        if(index==0){
            html+='<div class="panel box box-primary">'+
                      '<img class="box-header with-border collapsed" data-toggle="collapse" data-parent="#DivContenido" href="#collapse'+index+'" src="img/content_unit/'+r.foto_unidad+'" width="100%" min-height="90px;" height="90px;">'+
                      '</img>'+
                      '<div id="collapse'+index+'" class="panel-collapse collapse">'+
                        '<div class="box-body"> <div class="col-md-12">';
            aux_uc=r.unidad_contenido_id;
        }

        if( r.unidad_contenido_id!=aux_uc || pos%4==0 ){

            if( r.unidad_contenido_id!=aux_uc ){
            html+=          '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>';
            html+='<div class="panel box box-primary">'+
                      '<img class="box-header with-border collapsed" data-toggle="collapse" data-parent="#DivContenido" href="#collapse'+index+'" src="img/content_unit/'+r.foto_unidad+'" width="100%" style="min-height:90px;" height="90px;">'+
                      '</img>'+
                      '<div id="collapse'+index+'" class="panel-collapse collapse">'+
                        '<div class="box-body"> <div class="col-md-12">';
                aux_uc=r.unidad_contenido_id;
                pos=1;
            }
            else{
                html+="</div><div class='col-md-12'>";
            }
        }

        color="bg-blue";
        if(r.tipo_respuesta == 1){
            color="bg-red";
        }else if(r.tipo_respuesta == 2){
            color="bg-green";
        }

        html+='<div class="col-lg-4" id="trid_'+r.id+'" style="margin-top: 15px; -moz-box-shadow: 0 0 5px #888; -webkit-box-shadow: 0 0 5px#888; box-shadow: 0 0 5px #888;">'+
               '<input type="hidden" class="ruta_contenido" value="'+nombre[1]+'">'+
               '<input type="hidden" class="imagen_nombre" value="'+foto[1]+'">'+
               '<input type="hidden" class="unidad_contenido_id" value="'+r.unidad_contenido_id+'">'+
               '<input type="hidden" class="titulo_contenido" value="'+r.titulo_contenido+'">'+
               '<input type="hidden" class="fecha_inicio" value="'+r.fecha_inicio+'">'+
               '<input type="hidden" class="fecha_final" value="'+r.fecha_final+'">'+
               '<input type="hidden" class="hora_inicio" value="'+r.hora_inicio+'">'+
               '<input type="hidden" class="hora_final" value="'+r.hora_final+'">'+
               '<input type="hidden" class="fecha_ampliada" value="'+r.fecha_ampliada+'">'+
               '<input type="hidden" class="fecha_inicio_d" value="'+r.fecha_inicio_d+'">'+
               '<input type="hidden" class="fecha_final_d" value="'+r.fecha_final_d+'">'+
               '<input type="hidden" class="fecha_ampliada_d" value="'+r.fecha_ampliada_d+'">'+
               '<input type="hidden" class="tipo_respuesta" value="'+r.tipo_respuesta+'">'+
               '<input type="hidden" class="referencia" value="'+r.referencia+'">'+
               '<input type="hidden" class="estado" value="'+r.estado+'">'+
               '<div class="row">'+
                    '<div class="col-md-12">'+
                            '<div class="text-justify '+color+'" style="margin-bottom: 15px; margin-top:10px; font-size: 15px; padding: 5px 5px; background-color: #F5F5F5; border-radius: 10px; border: 3px solid #F8F8F8;">'+
                                '<p style="text-align:center">'+r.titulo_contenido+'</p>'+
                            '</div>'+
                        '</div>'+
                    '<div class="col-md-5 text-center" style="border-right: 2px solid #e9e9e9;">'+
                            '<a href="file/content/'+r.ruta_contenido+'" target="blank"><img class="img-responsive" src="file/content/'+r.foto_contenido+'" alt="" width="100%" height="" style="margin:10px auto;height: 150px;min-width: 150px;"></a>'+
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
                }else if(r.tipo_respuesta == 2){
                        var dia = new Date(r.fecha_inicio);
                        var dia_semana = ["Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"];
                     html+='<div>'+
                                '<p style="font-weight: normal;">'+
                                    '<label style="font-weight: bold;">Fecha: </label> '+r.fecha_inicio+'</br>'+
                                    '<label style="font-weight: bold;">Día: </label> '+dia_semana[dia.getDay()] +'</br>'+
                                    '<label style="font-weight: bold;">Hora Inicio. : </label> '+r.hora_inicio+'</br>'+
                                    '<label style="font-weight: bold;">Hora Final. : </label> '+r.hora_final+
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
                                  html+='<span class="fa fa-book fa-lg"></span> <a href="'+res_uri[i]+'" target="_blank">'+ res_uri[i] +'</a><br/>';
                                }
                      html+='</div>'+
                        '</div>';
                }

                html+='<div class="row">'+
                              '<div class="col-md-4" style="padding-right: 0px; padding-left: 5px; margin-top: 5px; overflow:hidden;">'+
                                '<button type="button" '+estadohtml+' class="col-xs-12 btn btn-danger"  data-placement="top" title="Eliminar"><span class="fa fa-trash fa-lg"></span> Eliminar</button>'+
                              '</div>'+
                              '<div class="col-md-4" style="padding-right: 0px; padding-left: 5px; margin-top: 5px; overflow:hidden;">'+
                                '<button type="button" onClick="AgregarEditar3(0,'+r.id+')" style="" class="col-xs-12 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><span class="fa fa-edit fa-lg"></span> Editar</button>'+
                              '</div>';
                                html+='<div class="col-md-4" style="padding-right: 0px; padding-left: 5px; margin-top: 5px; overflow:hidden;">';
                       if(r.tipo_respuesta==1){
                                html+='<button type="button" onClick="CargarContenidoRespuesta('+r.id+',\''+r.unidad_contenido+'\',\''+r.titulo_contenido+'\',\''+r.fecha_inicio+'\',\''+r.fecha_final+'\',\''+r.fecha_ampliada+'\''+')" class="col-xs-12 btn btn-info" data-toggle="tooltip" data-placement="top" title="Respuesta de Contenido"><span class="fa fa-list fa-lg"></span>Resp.</button>';
                            }
                              html+='</div>'+
                '</div>'+
            '</div>';
    });
    if(result.data.length>0){
        html+=            '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>';
    }
    $("#DivContenido").html(html);
};

CargarSlct=function(slct){
    if(slct==2){
    AjaxContenido.CargarUnidadContenido(SlctCargarUnidadContenido);
    }
};
SlctCargarUnidadContenido=function(result){
    var html="<option value>.::Seleccione::.</option>";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.unidad_contenido+"</option>";
    });
    $("#ModalContenidoForm #slct_unidad_contenido_id").html(html);
    $("#ModalContenidoForm #slct_unidad_contenido_id").selectpicker('refresh');

};
CargarContenidoProgramacion=function(id,programacion_unica_id){
     $("#ContenidoProgramacionForm #txt_contenido_id").val(id);
     $("#ModalContenidoProgramacionForm #txt_contenido_id").val(id);
     $("#ModalContenidoProgramacionForm #btn_listarpersona").data( 'filtros', 'estado:1|programacion_unica_id:'+programacion_unica_id );
     AjaxContenidoProgramacion.Cargar(HTMLCargarContenidoProgramacion);
     $("#ContenidoProgramacionForm").css("display","");
     $("#ContenidoRespuestaForm").css("display","none");

};
CargarContenidoRespuesta=function(id,unidad,titulo,fi,ff,fa){
    var html="<h3>"+unidad+"=> "+titulo+"</h3><br>"+
            "Fecha Inicio: "+fi+"  |  "+
            "Fecha Fin: "+ff;
        if( $.trim(fa)!='' ){
            html+="  |  Fecha Ampliada: "+fa;
        }
     $("#titulo_tarea").html(html);
     $("#ContenidoRespuestaForm #txt_contenido_id").val(id);
     AjaxContenidoRespuesta.Cargar(HTMLCargarContenidoRespuesta);
     $("#ContenidoRespuestaForm").css("display","");
     $("#ContenidoProgramacionForm").css("display","none");

};
onImagen = function (event,tipo) {
        var files = event.target.files || event.dataTransfer.files;
        if (!files.length)
            return;
        var image = new Image();
        var reader = new FileReader();
        reader.onload = (e) => {
            $('#ModalContenidoForm #txt_'+tipo+'_archivo').val(e.target.result);
            $('#ModalContenidoForm .img-circle').attr('src',e.target.result);
        };
        reader.readAsDataURL(files[0]);
        $('#ModalContenidoForm #txt_'+tipo+'_nombre').val(files[0].name);
//        console.log(files[0].name);
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
