<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var ContenidoG={id:0,curso_id:0,contenido:'',ruta_contenido:'',file_archivo:'',tipo_respuesta:0,fecha_inicio:'',
fecha_final:'',fecha_ampliada:'',estado:1}; // Datos Globales
$(document).ready(function() {

    $('#div_contenido_respuesta').hide();

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
        //$('#ModalContenidoForm #txt_razon_social').focus();
    });

    $('#ModalContenido').on('hidden.bs.modal', function (event) {
        $("#ModalContenidoForm input[type='hidden']").not('.mant').remove();
    });

    $( "#ModalContenidoForm #slct_tipo_respuesta" ).change(function() {
        if( $('#ModalContenidoForm #slct_tipo_respuesta').val()=='1' ) {
            $( "#ModalContenidoForm #respuesta" ).css("display","");
        }else{
            $( "#ModalContenidoForm #respuesta" ).css("display","none");
        }

    });

    // PROCESO DE RESPUESTA
    $('#btnGrabarRpta').on('click', function () {
      AjaxContenido.AgregarRespuestaContenido(HTMLCargarContenRpta);
      $('#txt_respuesta').val('');
    });
    // --
});

ValidaForm3=function(){
    var r=true;

    if( $.trim( $("#ModalContenidoForm #txt_contenido").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Contenido',4000);
    }
     else if( $.trim( $("#ModalContenidoForm #txt_file_nombre").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Ruta de Contenido',4000);
    }
    else if( $.trim( $("#ModalContenidoForm #slct_tipo_respuesta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Tipo de Respuesta',4000);
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
    ContenidoG.estado='1';
    $('#respuesta').css("display","none");
    if( val==0 ){

        ContenidoG.id=id;
        ContenidoG.contenido=$("#TableContenido #trid_"+id+" .contenido").text();
        ContenidoG.ruta_contenido=$("#TableContenido #trid_"+id+" .ruta_contenido").text();
        ContenidoG.tipo_respuesta=$("#TableContenido #trid_"+id+" .tipo_respuesta").val();
        ContenidoG.fecha_inicio=$("#TableContenido #trid_"+id+" .fecha_inicio").text();
        ContenidoG.fecha_final=$("#TableContenido #trid_"+id+" .fecha_final").text();
        ContenidoG.fecha_ampliada=$("#TableContenido #trid_"+id+" .fecha_ampliada").text();
        ContenidoG.estado=$("#TableContenido #trid_"+id+" .estado").val();
        if(ContenidoG.tipo_respuesta=='1'){
                $('#respuesta').css("display","");
        }
    }
    $('#ModalContenido').modal('show');
}

CambiarEstado3=function(estado,id){
    sweetalertG.confirm("¿Estás seguro?", "Confirme la eliminación", function(){
        AjaxContenido.CambiarEstadoRespuestaContenido(HTMLCambiarEstado3,estado,id);
    });
}

HTMLCambiarEstado3=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        //AjaxContenido.Cargar(HTMLCargarContenido);
        AjaxContenido.CargarRespuestaContenido(HTMLCargarContenidoRpta);
    }
}

/*
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
*/

HTMLCargarContenRpta=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxContenido.CargarRespuestaContenido(HTMLCargarContenidoRpta);
    }else if( result.rst==3 ){
        msjG.mensaje('warning',result.msj,5000);
        AjaxContenido.CargarRespuestaContenido(HTMLCargarContenidoRpta);
    }
    else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarContenido=function(result){
    var html="";
    var tipo_respuesta='';
    var aux_uc='';
    var pos=0;

    $.each(result.data,function(index,r){
        pos++;
          if(r.tipo_respuesta == 1)
            tipo_respuesta='<button type="button" onClick="CargarContenidoProgramacion('+r.id+','+r.programacion_unica_id+')" class="col-xs-12 btn btn-primary" data-toggle="tooltip" data-placement="top" title="Responder Tarea"><span class="fa fa-list fa-lg"></span> Responder Tarea</button>';
          else
            tipo_respuesta+='';

            if(index==0){
                html+='<div class="panel box box-primary">'+
                          '<img class="box-header with-border collapsed" data-toggle="collapse" data-parent="#DivContenido" href="#collapse'+index+'"  src="img/content_unit/'+r.foto_unidad+'" width="100%" style="min-height=90px;" >'+
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
                          '<img class="box-header with-border collapsed" data-toggle="collapse" data-parent="#DivContenido" href="#collapse'+index+'" src="img/content_unit/'+r.foto_unidad+'" width="100%" style="min-height:90px;">'+
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

            html+='<div class="col-lg-4" style="margin-top: 15px; -moz-box-shadow: 0 0 5px #888; -webkit-box-shadow: 0 0 5px#888; box-shadow: 0 0 5px #888;">'+
                   ' <div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="text-justify '+color+'" style="margin-bottom: 15px; margin-top:10px; font-size: 15px; padding: 5px 5px; background-color: #F5F5F5; border-radius: 10px; border: 3px solid #F8F8F8;">'+
                                '<p>'+r.titulo_contenido+'</p>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-md-5 text-center" style="border-right: 2px solid #e9e9e9;">'+
                            '<a href="file/content/'+r.ruta_contenido+'" target="blank"><img class="img-responsive" src="file/content/'+r.foto_contenido+'" alt="" width="100%" height="" style="margin:10px auto;height: 150px;min-width: 150px;"></a>'+
                        '</div>'+
                        '<div class="col-md-7">'+
                            '<div class="text-justify" style="margin-bottom: 15px; margin-top:10px; font-size: 15px; padding: 5px 5px; background-color: #F5F5F5; border-radius: 10px; border: 3px solid #F8F8F8;">'+
                                '<p>'+r.contenido+'</p>'+
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
                        '<div class="col-md-12" style="padding-right: 5px; padding-left: 5px; margin-top: 5px; overflow:hidden;">'+
                            tipo_respuesta +
                        '</div>'+
                    '</div>'+
                '</div>';

            tipo_respuesta = '';
    });
    if(result.data.length>0){
        html+=          '</div>'+
                      '</div>'+
                      '</div>'+
                    '</div>';
    }
    $("#DivContenido").html(html);
};

HTMLCargarContenidoRpta=function(result){
    var html="";
    $('#TableRespuestaAlu').DataTable().destroy();

    $.each(result.data,function(index,r){
        estadohtml='<a id="'+r.id+'" onClick="CambiarEstado3(1,'+r.id+')" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg"></i></a>';
        if(r.estado==1){
            estadohtml='<a id="'+r.id+'" onClick="CambiarEstado3(0,'+r.id+')" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg"></i></a>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='created_at'>"+r.created_at+"</td>"+
            "<td class='respuesta'>"+r.respuesta+"</td>"+
            "<td class='ruta_respuesta'><a href='file/content/"+r.ruta_respuesta+"' target='blank'>"+r.ruta_respuesta+"</a></td>";
        html+="<td><input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>";
        html+="</tr>";
    });
    $("#TableRespuestaAlu tbody").html(html);
    $("#TableRespuestaAlu").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false

    });
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
CargarContenidoProgramacion=function(id, programacion_unica_id){
     $("#frmRepuestaAlum #txt_contenido_id").val(id);
     $("#frmRepuestaAlum #programacion_unica_id").val(programacion_unica_id);
     $('#div_contenido_respuesta').show();
     AjaxContenido.CargarRespuestaContenido(HTMLCargarContenidoRpta);
};

onImagen = function (event) {
        var files = event.target.files || event.dataTransfer.files;
        if (!files.length)
            return;
        var image = new Image();
        var reader = new FileReader();
        reader.onload = (e) => {
            $('#frmRepuestaAlum #txt_file_archivo').val(e.target.result);
            $('#frmRepuestaAlum .img-circle').attr('src',e.target.result);
        };
        reader.readAsDataURL(files[0]);
        $('#frmRepuestaAlum #txt_file_nombre').val(files[0].name);
        console.log(files[0].name);
};

</script>
